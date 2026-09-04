<?php
/**
 * SEO metadata helpers for All in One SEO.
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_stylesheet_directory() . '/inc/service-pages.php';

function alpine_seo_brand_short() {
    return 'Alpine Heating & Air';
}

function alpine_seo_clean_text($text) {
    $text = html_entity_decode(wp_strip_all_tags(strip_shortcodes((string) $text)), ENT_QUOTES, get_bloginfo('charset'));
    return trim(preg_replace('/\s+/', ' ', $text));
}

function alpine_seo_trim_text($text, $limit = 155) {
    $text = alpine_seo_clean_text($text);

    if (function_exists('mb_strlen') && mb_strlen($text) <= $limit) {
        return $text;
    }

    if (!function_exists('mb_strlen') && strlen($text) <= $limit) {
        return $text;
    }

    $slice = function_exists('mb_substr') ? mb_substr($text, 0, $limit - 1) : substr($text, 0, $limit - 1);
    $slice = preg_replace('/\s+\S*$/', '', $slice);

    return rtrim($slice, ' .,;:-') . '.';
}

function alpine_seo_keyword_string($keywords) {
    $keywords = array_filter(array_map('trim', (array) $keywords));
    $keywords = array_unique($keywords);

    return implode(', ', $keywords);
}

function alpine_seo_manual_entries() {
    return array(
        // ---- Core / brand ----
        'home' => array(
            'title' => 'HVAC Services Austin, TX | AC Repair & Installation',
            'description' => 'Alpine Heating & Air Conditioning provides AC repair, HVAC installation, heating service, maintenance, and emergency HVAC repair in Austin and Central Texas.',
            'keywords' => array('hvac austin tx', 'ac repair austin', 'air conditioning repair austin tx', 'hvac contractor austin', 'heating and cooling austin'),
        ),
        'about' => array(
            'title' => 'About Alpine Heating & Air Conditioning | Austin HVAC',
            'description' => 'Learn about Alpine Heating & Air Conditioning, a local Austin HVAC company known for honest communication, dependable workmanship, and lasting home comfort.',
            'keywords' => array('about alpine heating and air', 'austin hvac company', 'local hvac contractor austin', 'trusted hvac austin tx'),
        ),
        'contact-us' => array(
            'title' => 'Contact Alpine Heating & Air Conditioning | Austin HVAC',
            'description' => 'Contact Alpine Heating & Air Conditioning for HVAC repair, AC service, heating help, maintenance, and estimates in Austin, TX.',
            'keywords' => array('contact hvac company austin', 'austin hvac service', 'schedule ac repair austin', 'alpine heating and air conditioning'),
        ),
        'request-an-estimate' => array(
            'title' => 'Request an HVAC Estimate Austin, TX | Alpine Heating',
            'description' => 'Request an HVAC estimate in Austin, TX for AC repair, replacement, installation, heating, or maintenance. Compare options before your next comfort investment.',
            'keywords' => array('hvac estimate austin', 'ac replacement estimate austin', 'hvac quote austin tx', 'free hvac estimate austin'),
        ),
        'blog' => array(
            'title' => 'HVAC Blog | AC Repair Tips & Home Comfort Advice | Alpine',
            'description' => 'Read expert HVAC tips, AC maintenance guides, heating advice, indoor air quality insights, and energy-saving tips from Alpine Heating & Air in Austin, TX.',
            'keywords' => array('hvac blog austin', 'ac repair tips', 'hvac maintenance guides', 'home comfort advice austin tx'),
        ),
        'employment' => array(
            'title' => 'HVAC Careers Austin, TX | Alpine Heating & Air',
            'description' => 'Explore HVAC career opportunities with Alpine Heating & Air Conditioning in Austin, TX, and join a team built on quality work and dependable service.',
            'keywords' => array('hvac jobs austin', 'hvac careers austin tx', 'hvac technician jobs austin', 'alpine heating careers'),
        ),

        // ---- Primary service categories ----
        'air-conditioning-services' => array(
            'title' => 'Air Conditioning Services Austin, TX | AC Repair & Install',
            'description' => 'Schedule AC repair, air conditioning installation, replacement, and maintenance in Austin, TX with Alpine Heating & Air Conditioning.',
            'keywords' => array('air conditioning services austin', 'ac repair austin tx', 'ac installation austin', 'ac maintenance austin', 'cooling service austin'),
        ),
        'heating-services' => array(
            'title' => 'Heating Services Austin, TX | Furnace Repair & Install',
            'description' => 'Get heating repair, furnace service, heater installation, replacement, and seasonal maintenance for Austin homes and businesses.',
            'keywords' => array('heating repair austin', 'furnace repair austin tx', 'heater repair austin', 'heating installation austin', 'furnace service austin'),
        ),
        'ductless-services' => array(
            'title' => 'Ductless Mini Split Services Austin, TX | Alpine HVAC',
            'description' => 'Ductless mini split installation, repair, and maintenance for Austin homes, additions, garages, offices, and hard-to-condition rooms.',
            'keywords' => array('ductless mini split austin', 'mini split installation austin', 'ductless ac repair austin', 'mini split service austin'),
        ),
        'indoor-air-quality' => array(
            'title' => 'Indoor Air Quality Austin, TX | Filtration & Purifiers',
            'description' => 'Improve indoor air quality in Austin with filtration, air purifier, humidity control, ductwork, and HVAC airflow solutions.',
            'keywords' => array('indoor air quality austin', 'air purifier austin tx', 'hvac filtration austin', 'humidity control austin', 'air quality services austin'),
        ),
        'thermostat-services' => array(
            'title' => 'Thermostat Services in Austin, TX | Alpine Heating & Air',
            'description' => 'Thermostat repair, replacement, and smart control upgrades in Austin, TX. Improve comfort, scheduling, and HVAC efficiency with the right thermostat.',
            'keywords' => array('thermostat services austin', 'thermostat repair austin tx', 'smart thermostat installation austin', 'thermostat replacement austin'),
        ),
        'programmable-thermostats-installation' => array(
            'title' => 'Programmable Thermostat Installation Austin, TX | Alpine',
            'description' => 'Programmable and smart thermostat installation in Austin, TX. Improve scheduling, comfort consistency, and energy efficiency with the right controls.',
            'keywords' => array('programmable thermostat installation austin', 'smart thermostat installation austin tx', 'thermostat installation austin', 'nest thermostat install austin'),
        ),

        // ---- Heating service detail pages ----
        'heating-installation' => array(
            'title' => 'Heating Installation in Austin, TX | Alpine Heating & Air',
            'description' => 'A new heating system should warm your home evenly and run efficiently. We install heating systems in Austin, TX matched to your home, comfort, and budget.',
            'keywords' => array('heating installation austin tx', 'furnace installation austin', 'new heating system austin', 'heater install austin'),
        ),
        'heating-repair' => array(
            'title' => 'Heating Repair in Austin, TX | Alpine Heating & Air',
            'description' => 'Heater blowing cool air, short cycling, or leaving rooms uneven? Alpine Heating & Air delivers dependable heating repair for homes across Austin, TX.',
            'keywords' => array('heating repair austin tx', 'furnace repair austin', 'no heat repair austin', 'heater not working austin'),
        ),
        'heating-replacement' => array(
            'title' => 'Heating Replacement in Austin, TX | Alpine Heating & Air',
            'description' => 'When repair costs keep stacking up or an old furnace turns unreliable, we help Austin homeowners plan an efficient heating replacement with confidence.',
            'keywords' => array('heating replacement austin tx', 'furnace replacement austin', 'new furnace install austin', 'heating system upgrade austin'),
        ),
        'heating-maintenance' => array(
            'title' => 'Heating Maintenance in Austin, TX | Alpine Heating & Air',
            'description' => 'Catch wear, airflow issues, and safety concerns before cold weather hits. Seasonal heating maintenance for Austin homes from Alpine Heating & Air.',
            'keywords' => array('heating maintenance austin tx', 'furnace tune up austin', 'heating system inspection austin', 'winter hvac maintenance austin'),
        ),
        'furnace-repair' => array(
            'title' => 'Furnace Repair in Austin, TX | Alpine Heating & Air',
            'description' => 'Furnace not heating, hard to start, or making odd noises? Alpine Heating & Air provides fast, reliable furnace repair for homes across Austin, TX.',
            'keywords' => array('furnace repair austin tx', 'furnace not heating austin', 'gas furnace repair austin', 'heater repair austin'),
        ),
        'heater-repair' => array(
            'title' => 'Heater Repair in Austin, TX | Alpine Heating & Air',
            'description' => 'When the house feels cold or the heater runs without warming up, our Austin technicians diagnose the problem and restore reliable heat fast.',
            'keywords' => array('heater repair austin tx', 'heating repair austin', 'no heat repair austin', 'furnace repair austin'),
        ),
        'heater-replacement' => array(
            'title' => 'Heater Replacement in Austin, TX | Alpine Heating & Air',
            'description' => 'Aging heater costing more to repair each winter? We help Austin homeowners replace failing systems with efficient, properly sized heating equipment.',
            'keywords' => array('heater replacement austin tx', 'heating system replacement austin', 'furnace replacement austin', 'new heater install austin'),
        ),

        // ---- Service-intent / category landing pages ----
        'air-conditioning-contractor' => array(
            'title' => 'Air Conditioning Contractor Austin, TX | Alpine HVAC',
            'description' => 'Looking for an air conditioning contractor in Austin, TX? Alpine Heating & Air handles cooling installation, repair, maintenance, and replacement.',
            'keywords' => array('air conditioning contractor austin', 'ac contractor austin tx', 'hvac contractor austin', 'cooling company austin'),
        ),
        'air-conditioning-repair-service' => array(
            'title' => 'Air Conditioning Repair Service Austin, TX | Alpine HVAC',
            'description' => 'AC blowing warm air, short cycling, or leaking? Our Austin air conditioning repair service restores reliable cooling with accurate, lasting fixes.',
            'keywords' => array('air conditioning repair service austin', 'ac repair austin tx', 'ac not cooling austin', 'emergency ac repair austin'),
        ),
        'air-conditioning-system-supplier' => array(
            'title' => 'Air Conditioning System Supplier Austin, TX | Alpine HVAC',
            'description' => 'Comparing cooling systems in Austin, TX? We help homeowners and property managers choose the right AC equipment with guidance on sizing and efficiency.',
            'keywords' => array('air conditioning system supplier austin', 'ac equipment austin tx', 'new ac system austin', 'cooling system supplier austin'),
        ),
        'hvac-contractor' => array(
            'title' => 'HVAC Contractor in Austin, TX | Alpine Heating & Air',
            'description' => 'Looking for a full-service HVAC contractor in Austin, TX? Air conditioning, heating, and airflow handled by one licensed local team.',
            'keywords' => array('hvac contractor austin', 'hvac company austin tx', 'heating and cooling contractor austin', 'residential hvac austin'),
        ),
        'heating-contractor' => array(
            'title' => 'Heating Contractor in Austin, TX | Alpine Heating & Air',
            'description' => 'Furnace repair, maintenance, and honest replacement planning from a trusted heating contractor in Austin, TX — winter comfort handled.',
            'keywords' => array('heating contractor austin', 'furnace contractor austin tx', 'heating company austin', 'hvac heating contractor austin'),
        ),
        'heating-equipment-supplier' => array(
            'title' => 'Heating Equipment Supplier Austin, TX | Alpine HVAC',
            'description' => 'Compare heating equipment for your Austin home with guidance on dependable winter performance, system fit, and long-term efficiency from Alpine Heating & Air.',
            'keywords' => array('heating equipment supplier austin', 'furnace equipment austin tx', 'heating system supplier austin', 'new heater austin'),
        ),
        'furnace-repair-service' => array(
            'title' => 'Furnace Repair Service Austin, TX | Alpine Heating & Air',
            'description' => 'From no-heat calls to noisy startups and thermostat faults, our Austin furnace repair service diagnoses the issue and restores steady, reliable warmth.',
            'keywords' => array('furnace repair service austin', 'furnace repair austin tx', 'gas furnace repair austin', 'no heat furnace austin'),
        ),
        'furnace-parts-supplier' => array(
            'title' => 'Furnace Parts Supplier Austin, TX | Alpine Heating & Air',
            'description' => 'Need compatible furnace parts in Austin, TX? Alpine Heating & Air sources the right components as part of practical, dependable furnace repair.',
            'keywords' => array('furnace parts supplier austin', 'furnace parts austin tx', 'furnace repair parts austin', 'heating parts austin'),
        ),
        'furnace-store' => array(
            'title' => 'Furnace Store in Austin, TX | Heating Systems | Alpine',
            'description' => 'Shopping for a furnace in Austin, TX? We help homeowners weigh heating system options, efficiency ratings, and equipment decisions before they buy.',
            'keywords' => array('furnace store austin', 'furnace sales austin tx', 'new furnace austin', 'heating systems austin'),
        ),

        // ---- Commercial verticals ----
        'commercial-hvac-austin-tx' => array(
            'title' => 'Commercial HVAC Austin, TX | Repair, Maintenance & Install',
            'description' => 'Commercial HVAC service in Austin for offices, healthcare facilities, retail spaces, apartments, warehouses, and industrial properties.',
            'keywords' => array('commercial hvac austin', 'commercial ac repair austin', 'commercial hvac maintenance', 'rooftop unit service austin', 'hvac contractor austin tx'),
        ),
        'office-buildings' => array(
            'title' => 'Office Building HVAC Austin, TX | Alpine Heating & Air',
            'description' => 'Office buildings in Austin run HVAC hard — long hours, tenant zones, conference rooms. We keep RTUs, chillers, and air handlers performing.',
            'keywords' => array('office building hvac austin', 'commercial office hvac austin tx', 'tenant hvac austin', 'office ac repair austin'),
        ),
        'medical-healthcare-facilities' => array(
            'title' => 'Medical & Healthcare HVAC Austin, TX | Alpine HVAC',
            'description' => 'Specialized HVAC for Austin medical buildings, clinics, hospitals, and labs, supporting air quality, safety, and operational continuity year-round.',
            'keywords' => array('medical hvac austin', 'healthcare facility hvac austin tx', 'clinic hvac austin', 'hospital hvac austin'),
        ),
        'retail-food-service' => array(
            'title' => 'Retail & Food Service HVAC Austin, TX | Alpine HVAC',
            'description' => 'HVAC for Austin retail stores, restaurants, and supermarkets, supporting customer comfort, staff conditions, and the demands of busy daily operations.',
            'keywords' => array('retail hvac austin', 'restaurant hvac austin tx', 'supermarket hvac austin', 'commercial kitchen hvac austin'),
        ),
        'apartments-condominiums' => array(
            'title' => 'Apartment & Condominium HVAC Austin, TX | Alpine HVAC',
            'description' => 'Resident comfort, shared equipment, and unit turnovers: responsive commercial HVAC service for Austin apartments and condominium properties.',
            'keywords' => array('apartment hvac austin', 'condominium hvac austin tx', 'multi-family hvac austin', 'property management hvac austin'),
        ),
        'high-rise-residential-properties' => array(
            'title' => 'High-Rise Residential HVAC Austin, TX | Alpine HVAC',
            'description' => 'HVAC service for Austin high-rise residential buildings, with attention to vertical distribution, shared infrastructure, and occupied-unit coordination.',
            'keywords' => array('high-rise hvac austin', 'residential tower hvac austin tx', 'multi-story building hvac austin', 'commercial hvac austin'),
        ),
        'warehouse-industrial-facilities' => array(
            'title' => 'Warehouse & Industrial HVAC Austin, TX | Alpine HVAC',
            'description' => 'Practical HVAC for Austin warehouses and industrial properties, built around large open areas, loading activity, variable occupancy, and equipment heat.',
            'keywords' => array('warehouse hvac austin', 'industrial hvac austin tx', 'distribution center hvac austin', 'large facility hvac austin'),
        ),
        'manufacturing-plants' => array(
            'title' => 'Manufacturing Plant HVAC Austin, TX | Alpine HVAC',
            'description' => 'When climate control affects daily operations, Austin manufacturing plants need commercial HVAC that keeps workers comfortable and processes stable.',
            'keywords' => array('manufacturing hvac austin', 'industrial hvac austin tx', 'plant hvac service austin', 'process cooling austin'),
        ),
        'it-data-centers' => array(
            'title' => 'Data Center & Server Room Cooling Austin, TX | Alpine',
            'description' => 'Reliable cooling for Austin data centers and server rooms. We help manage heavy IT heat loads and protect equipment from temperature-related risk.',
            'keywords' => array('data center cooling austin', 'server room cooling austin tx', 'it cooling austin', 'crac unit service austin'),
        ),
        'school-education-facilities' => array(
            'title' => 'School & Education HVAC Austin, TX | Alpine HVAC',
            'description' => 'Dependable HVAC for Austin schools, colleges, and universities, supporting classrooms, offices, common areas, and larger campus buildings year-round.',
            'keywords' => array('school hvac austin', 'education facility hvac austin tx', 'campus hvac austin', 'classroom hvac austin'),
        ),

        // ---- Tools, resources & offers ----
        'service-areas' => array(
            'title' => 'HVAC Service Areas Near Austin, TX | Alpine Heating & Air',
            'description' => 'See HVAC service areas near Austin, including Cedar Park, Round Rock, Lakeway, West Lake Hills, Bee Cave, Pflugerville, and nearby communities.',
            'keywords' => array('hvac service areas austin', 'ac repair near austin tx', 'hvac cedar park', 'hvac round rock', 'hvac lakeway'),
        ),
        'maintenance-plan' => array(
            'title' => 'HVAC Maintenance Plans Austin, TX | AC Tune-Ups',
            'description' => 'Protect comfort and efficiency year-round with an HVAC maintenance plan in Austin, TX. Seasonal AC tune-ups, heating checks, and priority service.',
            'keywords' => array('hvac maintenance plan austin', 'ac tune up plan austin', 'hvac service agreement austin', 'heating maintenance austin'),
        ),
        'financing' => array(
            'title' => 'HVAC Financing in Austin, TX | AC Replacement Options',
            'description' => 'Explore HVAC financing in Austin, TX for AC replacement, heating installation, and larger comfort projects, with flexible options to fit your budget.',
            'keywords' => array('hvac financing austin', 'ac financing austin tx', 'air conditioner financing austin', 'furnace financing austin'),
        ),
        'special-rebates' => array(
            'title' => 'HVAC Specials & Rebates Austin, TX | Alpine Heating & Air',
            'description' => 'See current HVAC specials and rebates in Austin, TX. Save on new system installation, upgrades, and comfort add-ons that improve everyday efficiency.',
            'keywords' => array('hvac specials austin', 'ac rebates austin tx', 'hvac promotions austin', 'new system rebates austin'),
        ),
        'resources' => array(
            'title' => 'HVAC Resources & Guides Austin, TX | Alpine Heating & Air',
            'description' => 'Helpful HVAC resources for Austin homeowners. Research common comfort issues, compare your options, and choose the right next step with less guesswork.',
            'keywords' => array('hvac resources austin', 'hvac guides homeowners', 'hvac help austin tx', 'ac troubleshooting tips'),
        ),
        'hvac-troubleshooter' => array(
            'title' => 'HVAC Troubleshooter | Diagnose Common AC & Heat Issues',
            'description' => 'Use our HVAC troubleshooter to walk through common air conditioning and heating issues, understand likely causes, and decide when to call a technician.',
            'keywords' => array('hvac troubleshooting', 'ac not working diagnosis', 'furnace troubleshooting', 'hvac symptom checker austin'),
        ),
        'seer-calculator' => array(
            'title' => 'SEER Savings Calculator | Estimate AC Energy Costs',
            'description' => 'Use our SEER calculator to estimate summer cooling costs and potential savings based on your system size, SEER rating, and local electricity rate.',
            'keywords' => array('seer calculator', 'ac energy savings calculator', 'seer rating savings', 'hvac efficiency calculator'),
        ),
    );
}

function alpine_seo_get_current_slug() {
    if (is_front_page()) {
        return 'home';
    }

    // The posts page is not singular, so resolve its slug explicitly.
    if (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        return $posts_page_id ? (string) get_post_field('post_name', $posts_page_id) : 'blog';
    }

    if (!is_singular()) {
        return '';
    }

    $post = get_queried_object();
    return $post instanceof WP_Post ? (string) $post->post_name : '';
}

function alpine_seo_entry_from_service_page($slug) {
    if (!function_exists('alpine_service_page_data')) {
        return null;
    }

    $pages = alpine_service_page_data();
    if (empty($pages[$slug])) {
        return null;
    }

    $page = $pages[$slug];
    $title = alpine_seo_clean_text($page['hero_title']) . ' | ' . alpine_seo_brand_short();
    $intro = !empty($page['intro'][0]) ? $page['intro'][0] : $page['hero_title'];
    $service = preg_replace('/\s+in Austin,\s*TX/i', '', alpine_seo_clean_text($page['hero_title']));

    return array(
        'title' => $title,
        'description' => alpine_seo_trim_text($intro, 155),
        'keywords' => array(
            strtolower($service) . ' austin tx',
            strtolower($service) . ' near me',
            'hvac services austin',
            'austin hvac contractor',
            'alpine heating and air conditioning',
        ),
    );
}

function alpine_seo_entry_from_business_category($slug) {
    if (!function_exists('alpine_business_category_page_data')) {
        return null;
    }

    $pages = alpine_business_category_page_data();
    if (empty($pages[$slug])) {
        return null;
    }

    $page = $pages[$slug];
    $topic = alpine_seo_clean_text($page['hero_title']);

    return array(
        'title' => ucwords($topic) . ' Austin, TX | ' . alpine_seo_brand_short(),
        'description' => alpine_seo_trim_text(!empty($page['intro'][0]) ? $page['intro'][0] : $topic, 155),
        'keywords' => array(
            strtolower($topic) . ' austin',
            strtolower($topic) . ' austin tx',
            'hvac contractor austin',
            'air conditioning services austin',
            'alpine heating and air conditioning',
        ),
    );
}

function alpine_seo_entry_from_commercial_category($slug) {
    if (!function_exists('alpine_commercial_category_page_data')) {
        return null;
    }

    $pages = alpine_commercial_category_page_data();
    if (empty($pages[$slug])) {
        return null;
    }

    $page = $pages[$slug];
    $topic = alpine_seo_clean_text($page['hero_title']);

    return array(
        'title' => $topic . ' Austin, TX | ' . alpine_seo_brand_short(),
        'description' => alpine_seo_trim_text(!empty($page['intro'][0]) ? $page['intro'][0] : $topic, 155),
        'keywords' => array(
            strtolower($topic) . ' austin',
            'commercial hvac austin',
            'commercial ac repair austin',
            'commercial hvac maintenance austin',
            'austin hvac contractor',
        ),
    );
}

function alpine_seo_entry_from_service_area($slug) {
    if (!function_exists('alpine_service_area_locations')) {
        return null;
    }

    $locations = alpine_service_area_locations();
    if (empty($locations[$slug])) {
        return null;
    }

    $location = $locations[$slug];
    $city_state = $location['city'] . ', ' . $location['state'];

    // Hand-tuned, varied titles so the service-area pages don't all share one
    // templated title — each leads with its city (stronger local signal), the
    // service phrasing rotates, and Austin no longer echoes the homepage title.
    $title_variants = array(
        'austin-tx'          => 'Austin, TX HVAC Company | AC & Heating Repair',
        'bee-cave-tx'        => 'Bee Cave, TX HVAC | AC Repair & Installation',
        'cedar-park-tx'      => 'Cedar Park, TX AC Repair & HVAC Installation',
        'cedar-valley-tx'    => 'Cedar Valley, TX HVAC | AC & Heating Service',
        'hutto-tx'           => 'Hutto, TX AC Repair & HVAC Maintenance',
        'lakeway-tx'         => 'Lakeway, TX HVAC | AC Repair & Installation',
        'leander-tx'         => 'Leander, TX AC Repair, Install & HVAC Service',
        'lost-creek-tx'      => 'Lost Creek, TX HVAC | AC & Heating Repair',
        'manor-tx'           => 'Manor, TX HVAC | AC Repair & Installation',
        'pflugerville-tx'    => 'Pflugerville, TX AC Repair & HVAC Service',
        'rollingwood-tx'     => 'Rollingwood, TX HVAC | AC Repair & Upgrades',
        'round-rock-tx'      => 'Round Rock, TX AC Repair & HVAC Installation',
        'sunset-valley-tx'   => 'Sunset Valley, TX HVAC | AC & Heating Repair',
        'the-hills-tx'       => 'The Hills, TX HVAC | AC Repair & Installation',
        'volente-tx'         => 'Volente, TX HVAC | AC Repair & Maintenance',
        'west-lake-hills-tx' => 'West Lake Hills, TX HVAC | AC & Heating',
    );

    $title = isset($title_variants[$slug])
        ? $title_variants[$slug]
        : $city_state . ' HVAC | AC Repair & Installation';

    return array(
        'title' => $title,
        'description' => alpine_seo_trim_text(!empty($location['meta_description']) ? $location['meta_description'] : $location['intro'], 155),
        'keywords' => array(
            'hvac ' . strtolower($location['city']) . ' tx',
            'ac repair ' . strtolower($location['city']) . ' tx',
            'air conditioning service ' . strtolower($location['city']),
            'hvac installation ' . strtolower($location['city']),
            'hvac maintenance ' . strtolower($location['city']),
        ),
    );
}

function alpine_seo_get_entry() {
    // Projects resolve first: the section includes archive and taxonomy views,
    // which are not singular and so carry no slug for the lookups below.
    if (function_exists('alpine_seo_entry_for_projects')) {
        $project_entry = alpine_seo_entry_for_projects();
        if (!empty($project_entry)) {
            return $project_entry;
        }
    }

    $slug = alpine_seo_get_current_slug();
    if (!$slug) {
        return null;
    }

    $manual = alpine_seo_manual_entries();
    if (!empty($manual[$slug])) {
        return $manual[$slug];
    }

    foreach (array(
        'alpine_seo_entry_from_service_page',
        'alpine_seo_entry_from_business_category',
        'alpine_seo_entry_from_commercial_category',
        'alpine_seo_entry_from_service_area',
    ) as $resolver) {
        $entry = $resolver($slug);
        if (!empty($entry)) {
            return $entry;
        }
    }

    return null;
}

function alpine_seo_filter_aioseo_title($title) {
    if (is_admin()) {
        return $title;
    }

    $entry = alpine_seo_get_entry();
    return !empty($entry['title']) ? $entry['title'] : $title;
}
add_filter('aioseo_title', 'alpine_seo_filter_aioseo_title', 20);

function alpine_seo_filter_aioseo_description($description) {
    if (is_admin()) {
        return $description;
    }

    $entry = alpine_seo_get_entry();
    return !empty($entry['description']) ? $entry['description'] : $description;
}
add_filter('aioseo_description', 'alpine_seo_filter_aioseo_description', 20);

function alpine_seo_filter_aioseo_keywords($keywords) {
    if (is_admin()) {
        return $keywords;
    }

    $entry = alpine_seo_get_entry();
    return !empty($entry['keywords']) ? alpine_seo_keyword_string($entry['keywords']) : $keywords;
}
add_filter('aioseo_keywords', 'alpine_seo_filter_aioseo_keywords', 20);

/**
 * Sitewide HVACBusiness (LocalBusiness) structured data.
 *
 * Emitted on every front-end page so Google always sees consistent NAP data.
 * Service-area pages narrow areaServed to their own city via
 * alpine_seo_current_service_area_city().
 */
function alpine_seo_normalize_phone($phone) {
    $digits = preg_replace('/\D+/', '', (string) $phone);

    if (strlen($digits) === 10) {
        $digits = '1' . $digits;
    }

    return '+' . $digits;
}

function alpine_seo_current_service_area_city() {
    if (!function_exists('alpine_is_service_area_page') || !alpine_is_service_area_page()) {
        return null;
    }

    if (!function_exists('alpine_service_area_locations')) {
        return null;
    }

    $slug = alpine_seo_get_current_slug();
    $locations = alpine_service_area_locations();

    return isset($locations[$slug]) ? $locations[$slug] : null;
}

function alpine_seo_local_business_schema() {
    $phone = function_exists('alpine_get_setting') ? alpine_get_setting('phone_number', '(512) 759-4247') : '(512) 759-4247';
    $email = function_exists('alpine_get_setting') ? alpine_get_setting('email_general', 'info@austinalpine.com') : 'info@austinalpine.com';

    $same_as = array();
    if (function_exists('alpine_get_setting')) {
        foreach (array(
            alpine_get_setting('facebook_url', 'https://www.facebook.com/austinalpine/'),
            alpine_get_setting('yelp_url', 'https://www.yelp.com/biz/alpine-heating-and-air-conditioning-austin'),
            alpine_get_setting('twitter_url', 'https://twitter.com/austinalpineair'),
        ) as $url) {
            if ($url) {
                $same_as[] = $url;
            }
        }
    }

    $logo_url = '';
    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        $logo_src = wp_get_attachment_image_src($logo_id, 'full');
        if (!empty($logo_src[0])) {
            $logo_url = $logo_src[0];
        }
    }
    if (!$logo_url) {
        $logo_url = trailingslashit(wp_get_upload_dir()['baseurl']) . '2026/03/logo.webp';
    }

    $service_area_city = alpine_seo_current_service_area_city();

    if ($service_area_city) {
        $area_served = array(
            '@type' => 'City',
            'name'  => $service_area_city['city'] . ', ' . $service_area_city['state'],
        );
    } else {
        $area_served = array();
        $cities = array('Austin', 'Bee Cave', 'Cedar Park', 'Cedar Valley', 'Hutto', 'Lakeway', 'Leander', 'Lost Creek', 'Manor', 'Pflugerville', 'Rollingwood', 'Round Rock', 'Sunset Valley', 'The Hills', 'Volente', 'West Lake Hills');
        foreach ($cities as $city) {
            $area_served[] = array('@type' => 'City', 'name' => $city . ', TX');
        }
    }

    $schema = array(
        '@context'  => 'https://schema.org',
        '@type'     => 'HVACBusiness',
        '@id'       => home_url('/#localbusiness'),
        'name'      => 'Alpine Heating & Air Conditioning',
        'foundingDate' => '2006',
        'url'       => home_url('/'),
        'telephone' => alpine_seo_normalize_phone($phone),
        'email'     => $email,
        'image'     => $logo_url,
        'logo'      => $logo_url,
        'address'   => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '1205 Sheldon Cove Bldg. 2, Ste. J.',
            'addressLocality' => 'Austin',
            'addressRegion'   => 'TX',
            'postalCode'      => '78753',
            'addressCountry'  => 'US',
        ),
        'geo'       => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => 30.3447804,
            'longitude' => -97.68545,
        ),
        'openingHoursSpecification' => array(
            array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                'opens'     => '07:00',
                'closes'    => '19:00',
            ),
        ),
        'areaServed'  => $area_served,
        'serviceType' => array('AC Repair', 'HVAC Installation', 'Heating Repair', 'HVAC Maintenance', 'Indoor Air Quality'),
        'priceRange'  => '$$',
    );

    if (!empty($same_as)) {
        $schema['sameAs'] = $same_as;
    }

    return $schema;
}

function alpine_seo_output_local_business_schema() {
    if (is_admin() || is_feed() || is_404()) {
        return;
    }

    echo '<script type="application/ld+json">' . wp_json_encode(alpine_seo_local_business_schema(), JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'alpine_seo_output_local_business_schema', 5);

function alpine_seo_filter_facebook_tags($tags) {
    $entry = alpine_seo_get_entry();
    if (empty($entry)) {
        return $tags;
    }

    $tags['og:title'] = $entry['title'];
    $tags['og:description'] = $entry['description'];

    return $tags;
}
add_filter('aioseo_facebook_tags', 'alpine_seo_filter_facebook_tags', 20);

function alpine_seo_filter_twitter_tags($tags) {
    $entry = alpine_seo_get_entry();
    if (empty($entry)) {
        return $tags;
    }

    $tags['twitter:title'] = $entry['title'];
    $tags['twitter:description'] = $entry['description'];

    return $tags;
}
add_filter('aioseo_twitter_tags', 'alpine_seo_filter_twitter_tags', 20);
