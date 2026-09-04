<?php
/**
 * Semantic breadcrumb navigation with BreadcrumbList JSON-LD.
 *
 * Replaces the old plain-text hero breadcrumb <p> tags. The <nav> carries the
 * same `hero-breadcrumb` class, so the existing show/hide and pill styling in
 * style.css keeps applying exactly as before.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render a breadcrumb <nav> plus matching BreadcrumbList JSON-LD.
 *
 * @param array  $items Ordered items: array('label' => string, 'url' => string|null).
 *                      The last item is the current page and renders unlinked.
 * @param string $class Class(es) for the <nav>; default keeps hero styling hooks.
 */
function alpine_breadcrumb_nav($items, $class = 'hero-breadcrumb') {
    $items = array_values(array_filter((array) $items, function ($item) {
        return is_array($item) && !empty($item['label']);
    }));

    if (empty($items)) {
        return;
    }

    $schema_items = array();
    foreach ($items as $index => $item) {
        $entry = array(
            '@type'    => 'ListItem',
            'position' => $index + 1,
            'name'     => wp_strip_all_tags($item['label']),
        );
        if (!empty($item['url'])) {
            $entry['item'] = $item['url'];
        }
        $schema_items[] = $entry;
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $schema_items,
    );

    $last = count($items) - 1;
    ?>
    <nav class="<?php echo esc_attr(trim('breadcrumb-nav ' . $class)); ?>" aria-label="Breadcrumb">
      <ol>
        <?php foreach ($items as $index => $item) : ?>
          <li<?php echo $index === $last ? ' aria-current="page"' : ''; ?>>
            <?php if ($index > 0) : ?><span class="dot" aria-hidden="true">.</span><?php endif; ?>
            <?php if ($index !== $last && !empty($item['url'])) : ?>
              <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
            <?php else : ?>
              <span><?php echo esc_html($item['label']); ?></span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </nav>
    <script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES); ?></script>
    <?php
}

/**
 * Build breadcrumb items from the "Home . Services . AC Repair" strings the
 * page-data arrays already carry. Known middle crumbs get linked; the final
 * segment is the current page.
 */
function alpine_breadcrumb_items_from_string($breadcrumb) {
    $labels = array_values(array_filter(array_map('trim', explode('.', (string) $breadcrumb))));

    if (empty($labels)) {
        return array();
    }

    $last  = count($labels) - 1;
    $items = array();

    foreach ($labels as $index => $label) {
        $url = null;

        if ($index !== $last) {
            $key = strtolower($label);
            if ($key === 'home') {
                $url = home_url('/');
            } elseif (function_exists('alpine_get_site_page_url')) {
                $map = array(
                    'services'      => 'services',
                    'service areas' => 'service_areas',
                    'resources'     => 'resources',
                );
                if (isset($map[$key])) {
                    $url = alpine_get_site_page_url($map[$key]);
                }
            }
        }

        $items[] = array('label' => $label, 'url' => $url);
    }

    return $items;
}
