<?php
// Temporary site-wide broken-link audit. Deleted after use.
require __DIR__ . '/wp-load.php';
header('Content-Type: text/plain');
@set_time_limit(600);

$home = home_url('/');
$host = parse_url($home, PHP_URL_HOST);

// 1. Gather all published page/post URLs to crawl.
$q = new WP_Query(array(
    'post_type'      => array('page', 'post'),
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
));
$crawl = array();
foreach ($q->posts as $id) {
    $crawl[] = get_permalink($id);
}
$crawl = array_values(array_unique($crawl));
echo "Crawling " . count($crawl) . " pages...\n\n";

// 2. Fetch each page, extract <a href> links. Map link -> set of source pages.
$linkSources = array(); // url => array of source pages
foreach ($crawl as $src) {
    $res = wp_remote_get($src, array('timeout' => 20, 'redirection' => 0, 'sslverify' => false));
    if (is_wp_error($res)) { echo "[FETCH FAIL] $src : " . $res->get_error_message() . "\n"; continue; }
    $body = wp_remote_retrieve_body($res);
    if (!$body) continue;

    if (preg_match_all('/<a\b[^>]*\bhref\s*=\s*([\'"])(.*?)\1/i', $body, $m)) {
        foreach ($m[2] as $href) {
            $href = trim(html_entity_decode($href, ENT_QUOTES));
            if ($href === '' ) continue;
            // skip non-navigational schemes & fragment-only links
            if ($href[0] === '#') continue;
            if (preg_match('~^(mailto:|tel:|javascript:|sms:|data:)~i', $href)) continue;
            // normalize protocol-relative & relative
            if (strpos($href, '//') === 0) $href = 'http:' . $href;
            if ($href[0] === '/') $href = rtrim($home, '/') . $href;
            // strip fragment
            $href = preg_replace('/#.*$/', '', $href);
            if ($href === '') continue;
            $linkSources[$href][$src] = true;
        }
    }
}

// 3. Classify each unique link: internal vs external, and test status.
$internalBroken = array();
$externalList   = array();
$redirects      = array();
$checked = 0;

foreach ($linkSources as $url => $srcs) {
    $uhost = parse_url($url, PHP_URL_HOST);
    $isInternal = ($uhost === $host) || ($uhost === 'localhost') || ($uhost === 'www.' . $host);
    // Treat the production domain references as "external-ish" but still flag.
    $prod = preg_match('#austinalpine\.com#i', $url);

    if (!$isInternal) {
        $externalList[$url] = array_keys($srcs);
        continue;
    }

    $checked++;
    $r = wp_remote_head($url, array('timeout' => 20, 'redirection' => 0, 'sslverify' => false));
    if (is_wp_error($r)) {
        // some servers reject HEAD; retry GET
        $r = wp_remote_get($url, array('timeout' => 20, 'redirection' => 0, 'sslverify' => false));
    }
    $code = is_wp_error($r) ? 0 : (int) wp_remote_retrieve_response_code($r);

    if ($code === 0 || $code >= 400) {
        $internalBroken[$url] = array('code' => $code, 'sources' => array_keys($srcs));
    } elseif ($code >= 300 && $code < 400) {
        $loc = is_wp_error($r) ? '' : wp_remote_retrieve_header($r, 'location');
        $redirects[$url] = array('code' => $code, 'to' => $loc, 'sources' => array_keys($srcs));
    }
}

echo "Unique links found: " . count($linkSources) . "\n";
echo "Internal links checked: $checked\n";
echo "External links (not status-checked here): " . count($externalList) . "\n";

echo "\n================ BROKEN INTERNAL LINKS (" . count($internalBroken) . ") ================\n";
if (!$internalBroken) echo "(none)\n";
foreach ($internalBroken as $url => $info) {
    echo "[{$info['code']}] $url\n";
    foreach ($info['sources'] as $s) echo "        linked from: $s\n";
}

echo "\n================ INTERNAL REDIRECTS (" . count($redirects) . ") ================\n";
if (!$redirects) echo "(none)\n";
foreach ($redirects as $url => $info) {
    echo "[{$info['code']}] $url  ->  {$info['to']}\n";
}

echo "\n================ EXTERNAL / OFF-DOMAIN LINKS (" . count($externalList) . " unique) ================\n";
foreach (array_keys($externalList) as $url) {
    echo "$url\n";
}
