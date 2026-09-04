<?php
/**
 * Plugin Name: Austin Alpine Service Area Pages
 * Description: Creates and maintains service area child pages under the Service Areas hub.
 */

if (!function_exists('alpine_service_area_locations_for_creation')) {
    function alpine_service_area_locations_for_creation() {
        return array(
            'austin-tx' => array('city' => 'Austin', 'state' => 'TX'),
            'bee-caves-tx' => array('city' => 'Bee Caves', 'state' => 'TX'),
            'cedar-park-tx' => array('city' => 'Cedar Park', 'state' => 'TX'),
            'cedar-valley-tx' => array('city' => 'Cedar Valley', 'state' => 'TX'),
            'hutto-tx' => array('city' => 'Hutto', 'state' => 'TX'),
            'lakeway-tx' => array('city' => 'Lakeway', 'state' => 'TX'),
            'leander-tx' => array('city' => 'Leander', 'state' => 'TX'),
            'lost-creek-tx' => array('city' => 'Lost Creek', 'state' => 'TX'),
            'manor-tx' => array('city' => 'Manor', 'state' => 'TX'),
            'pflugerville-tx' => array('city' => 'Pflugerville', 'state' => 'TX'),
            'rollingwood-tx' => array('city' => 'Rollingwood', 'state' => 'TX'),
            'round-rock-tx' => array('city' => 'Round Rock', 'state' => 'TX'),
            'sunset-valley-tx' => array('city' => 'Sunset Valley', 'state' => 'TX'),
            'the-hills-tx' => array('city' => 'The Hills', 'state' => 'TX'),
            'volente-tx' => array('city' => 'Volente', 'state' => 'TX'),
            'west-lake-hills-tx' => array('city' => 'West Lake Hills', 'state' => 'TX'),
        );
    }
}

if (!function_exists('alpine_service_area_duplicate_slug_map')) {
    function alpine_service_area_duplicate_slug_map() {
        return array(
            'beecaves-tx' => 'bee-caves-tx',
            'cedarpark-tx' => 'cedar-park-tx',
            'cedarvalley-tx' => 'cedar-valley-tx',
            'lostcreek-tx' => 'lost-creek-tx',
            'roundrock-tx' => 'round-rock-tx',
            'sunsetvalley-tx' => 'sunset-valley-tx',
            'thehills-tx' => 'the-hills-tx',
            'westlakehills-tx' => 'west-lake-hills-tx',
        );
    }
}

if (!function_exists('alpine_get_service_area_parent_page_id')) {
    function alpine_get_service_area_parent_page_id() {
        $parent = get_page_by_path('service-areas', OBJECT, 'page');

        if ($parent instanceof WP_Post) {
            return (int) $parent->ID;
        }

        $parent_id = wp_insert_post(array(
            'post_title'   => 'Service Areas',
            'post_content' => 'Explore Austin Alpine service coverage throughout the greater Austin area.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'service-areas',
        ));

        if (is_wp_error($parent_id) || !$parent_id) {
            return 0;
        }

        return (int) $parent_id;
    }
}

if (!function_exists('alpine_service_area_page_content')) {
    function alpine_service_area_page_content($city, $state) {
        $location = $city . ', ' . $state;

        return implode("\n\n", array(
            'Austin Alpine provides dependable HVAC service in ' . $location . ' for homeowners who need fast AC repair, efficient installation, and preventive maintenance.',
            'We help customers in ' . $location . ' stay comfortable through long summer heat, abrupt weather changes, and year-round system demand.',
            'Services include AC repair, HVAC installation, HVAC maintenance, and support for better indoor comfort and system performance.',
            'Request service today to schedule help in ' . $location . '.',
        ));
    }
}

if (!function_exists('alpine_sync_service_area_pages')) {
    function alpine_sync_service_area_pages() {
        $parent_id = alpine_get_service_area_parent_page_id();

        if (!$parent_id) {
            return array('updated' => array(), 'errors' => array('parent' => 'Unable to create or load the Service Areas page.'));
        }

        $result = array(
            'updated' => array(),
            'errors' => array(),
        );

        foreach (alpine_service_area_locations_for_creation() as $slug => $location) {
            $page = get_page_by_path('service-areas/' . $slug, OBJECT, 'page');

            if (!($page instanceof WP_Post)) {
                continue;
            }

            $update = wp_update_post(array(
                'ID' => $page->ID,
                'post_title' => 'AC Repair in ' . $location['city'] . ', ' . $location['state'],
                'post_content' => alpine_service_area_page_content($location['city'], $location['state']),
            ), true);

            if (is_wp_error($update)) {
                $result['errors'][$slug] = $update->get_error_message();
                continue;
            }

            update_post_meta($page->ID, '_wp_page_template', 'service-area.php');
            $result['updated'][] = $slug;
        }

        return $result;
    }
}

if (!function_exists('alpine_cleanup_duplicate_service_area_pages')) {
    function alpine_cleanup_duplicate_service_area_pages() {
        $result = array(
            'trashed' => array(),
            'errors' => array(),
        );

        foreach (alpine_service_area_duplicate_slug_map() as $duplicate_slug => $canonical_slug) {
            $duplicate = get_page_by_path('service-areas/' . $duplicate_slug, OBJECT, 'page');

            if (!($duplicate instanceof WP_Post)) {
                continue;
            }

            $canonical = get_page_by_path('service-areas/' . $canonical_slug, OBJECT, 'page');

            if (!($canonical instanceof WP_Post)) {
                $result['errors'][$duplicate_slug] = 'Canonical page missing: ' . $canonical_slug;
                continue;
            }

            $trashed = wp_trash_post($duplicate->ID);

            if (!$trashed) {
                $result['errors'][$duplicate_slug] = 'Failed to trash duplicate page.';
                continue;
            }

            $result['trashed'][] = $duplicate_slug;
        }

        return $result;
    }
}

if (!function_exists('alpine_create_service_area_pages')) {
    function alpine_create_service_area_pages() {
        $parent_id = alpine_get_service_area_parent_page_id();

        if (!$parent_id) {
            return array('created' => array(), 'existing' => array(), 'errors' => array('parent' => 'Unable to create or load the Service Areas page.'));
        }

        $result = array(
            'created' => array(),
            'existing' => array(),
            'errors' => array(),
        );

        foreach (alpine_service_area_locations_for_creation() as $slug => $location) {
            $path = 'service-areas/' . $slug;
            $existing = get_page_by_path($path, OBJECT, 'page');

            if ($existing instanceof WP_Post) {
                update_post_meta($existing->ID, '_wp_page_template', 'service-area.php');
                $result['existing'][] = $path;
                continue;
            }

            $page_id = wp_insert_post(array(
                'post_title'   => 'AC Repair in ' . $location['city'] . ', ' . $location['state'],
                'post_content' => alpine_service_area_page_content($location['city'], $location['state']),
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $slug,
                'post_parent'  => $parent_id,
            ));

            if (is_wp_error($page_id) || !$page_id) {
                $result['errors'][$path] = is_wp_error($page_id) ? $page_id->get_error_message() : 'Unknown error';
                continue;
            }

            update_post_meta($page_id, '_wp_page_template', 'service-area.php');
            $result['created'][] = $path;
        }

        return $result;
    }
}
