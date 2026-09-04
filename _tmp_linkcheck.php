<?php
// Temporary diagnostic endpoint — lists all published permalinks. Deleted after use.
require __DIR__ . '/wp-load.php';
header('Content-Type: text/plain');
$q = new WP_Query(array(
    'post_type'      => array('page', 'post'),
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
));
foreach ($q->posts as $id) {
    echo get_permalink($id) . "\n";
}
