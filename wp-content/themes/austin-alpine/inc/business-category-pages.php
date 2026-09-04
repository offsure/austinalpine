<?php
/**
 * Business category landing pages.
 */

require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

if (!function_exists('alpine_business_category_page_data')) {
    function alpine_business_category_page_data() {
        return array(
            'air-conditioning-system-supplier' => array(
                'menu_title' => 'AC System Supplier',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Air conditioning system supplier',
                'hero_breadcrumb' => 'Home . Services . Air Conditioning System Supplier',
                'intro_title' => 'Local <span class="highlight">air conditioning system supplier</span> support in Austin',
                'intro' => array(
                    'Alpine Heating & Air Conditioning gives homeowners and property managers a clear way to compare cooling equipment with guidance focused on sizing, efficiency, reliability, and long-term comfort instead of one-size-fits-all recommendations.',
                    'This service is especially useful for properties in Downtown Austin, North Austin, South Austin, East Austin, West Austin, Mueller, Tarrytown, and Circle C Ranch where system demand, home layout, and cooling expectations can vary widely.'
                ),
                'features' => array(
                    array('title' => 'Cooling Equipment Guidance', 'body' => 'System recommendations are based on home size, comfort goals, and expected summer demand.'),
                    array('title' => 'Efficiency Options', 'body' => 'Customers can compare equipment choices built for lower strain and better day-to-day performance.'),
                    array('title' => 'Replacement Planning', 'body' => 'Older systems can be matched to newer equipment with a clearer upgrade path.'),
                    array('title' => 'Neighborhood-Specific Support', 'body' => 'Projects are supported across areas such as Mueller, Tarrytown, Circle C Ranch, and nearby Austin neighborhoods.'),
                    array('title' => 'Installation Coordination', 'body' => 'System supply decisions stay connected to practical installation planning.'),
                    array('title' => 'Long-Term Comfort Focus', 'body' => 'The goal is better cooling performance with fewer surprises during peak heat.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'North Austin', 'South Austin', 'East Austin', 'West Austin', 'Mueller', 'Tarrytown', 'Circle C Ranch'),
                'panel_one' => array(
                    'label' => 'Need a Quote?',
                    'title' => 'Compare cooling systems with a clearer next step',
                    'body' => 'Alpine Heating & Air Conditioning will narrow down the right system type and turn shopping into a real installation or replacement plan.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See full air conditioning services',
                    'body' => 'Customers comparing equipment often also need installation, repair, or maintenance guidance.',
                    'link' => 'air-conditioning-services-austin-tx',
                    'link_text' => 'View AC Services'
                ),
            ),
            'air-conditioning-repair-service' => array(
                'menu_title' => 'AC Repair Service',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Air conditioning repair service',
                'hero_breadcrumb' => 'Home . Services . Air Conditioning Repair Service',
                'intro_title' => 'Trusted <span class="highlight">air conditioning repair service</span> for Austin homes',
                'intro' => array(
                    'Alpine Heating & Air Conditioning provides air conditioning repair service for cooling systems dealing with warm air, weak airflow, short cycling, frozen coils, thermostat issues, and full summer breakdowns.',
                    'Repair calls are supported in neighborhoods and local areas such as Downtown Austin, South Austin, North Austin, East Austin, West Austin, Brushy Creek, Teravista, Forest Creek, Falcon Pointe, and Blackhawk.'
                ),
                'features' => array(
                    array('title' => 'No-Cool Diagnostics', 'body' => 'Troubleshooting is centered on the most common reasons a system stops cooling properly.'),
                    array('title' => 'Fast Response Mindset', 'body' => 'Cooling failures during Austin heat need a direct repair path, not generic advice.'),
                    array('title' => 'Thermostat and Airflow Checks', 'body' => 'Control issues and distribution problems can be isolated before major work is recommended.'),
                    array('title' => 'Neighborhood Coverage', 'body' => 'Support extends across Brushy Creek, Teravista, Falcon Pointe, Blackhawk, and nearby Austin areas.'),
                    array('title' => 'Repair vs Replace Guidance', 'body' => 'Customers get clearer direction when repeated repairs stop making sense.'),
                    array('title' => 'All-Season Reliability', 'body' => 'The goal is to restore comfort and reduce the chance of another near-term breakdown.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'South Austin', 'North Austin', 'East Austin', 'West Austin', 'Brushy Creek', 'Teravista', 'Forest Creek', 'Falcon Pointe', 'Blackhawk'),
                'panel_one' => array(
                    'label' => 'Schedule Repair',
                    'title' => 'Move from AC trouble to booked service quickly',
                    'body' => 'Skip the phone tree — go straight from a cooling problem to a booked repair visit.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Repair'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'Compare repair with other AC options',
                    'body' => 'If the current system is aging, installation or replacement may also need review.',
                    'link' => 'ac-repair',
                    'link_text' => 'View AC Repair Page'
                ),
            ),
            'heating-equipment-supplier' => array(
                'menu_title' => 'Heating Equipment Supplier',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Heating equipment supplier',
                'hero_breadcrumb' => 'Home . Services . Heating Equipment Supplier',
                'intro_title' => 'Dependable <span class="highlight">heating equipment supplier</span> guidance for local homes',
                'intro' => array(
                    'Alpine Heating & Air Conditioning helps customers compare heating equipment with a focus on dependable winter performance, system fit, efficiency, and practical upgrade planning.',
                    'Heating equipment support extends through areas like North Austin, South Austin, West Austin, Mueller, Circle C Ranch, Anderson Mill West, Buttercup Creek, Twin Creeks, Rough Hollow, and Serene Hills.'
                ),
                'features' => array(
                    array('title' => 'Heating System Selection', 'body' => 'Recommendations stay tied to home layout, usage, and seasonal needs.'),
                    array('title' => 'Efficiency Planning', 'body' => 'Equipment options can be compared for better comfort and reduced waste.'),
                    array('title' => 'Replacement Support', 'body' => 'Older heating systems can be matched to better long-term replacement paths.'),
                    array('title' => 'Town-Area Coverage', 'body' => 'Support reaches neighborhoods such as Anderson Mill West, Twin Creeks, and Rough Hollow.'),
                    array('title' => 'Installation Coordination', 'body' => 'Equipment discussions stay connected to proper setup and startup planning.'),
                    array('title' => 'Comfort-First Guidance', 'body' => 'The goal is reliable heating when colder weather arrives.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('North Austin', 'South Austin', 'West Austin', 'Mueller', 'Circle C Ranch', 'Anderson Mill West', 'Buttercup Creek', 'Twin Creeks', 'Rough Hollow', 'Serene Hills'),
                'panel_one' => array(
                    'label' => 'Next Step',
                    'title' => 'Plan a heating equipment upgrade with clearer options',
                    'body' => 'Alpine Heating & Air Conditioning connects the right heating equipment choice to installation or replacement planning.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See heating installation support',
                    'body' => 'Heating equipment selection works best when paired with the full installation path.',
                    'link' => 'heating-installation',
                    'link_text' => 'View Heating Installation'
                ),
            ),
            'furnace-repair-service' => array(
                'menu_title' => 'Furnace Repair Service',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Furnace repair service',
                'hero_breadcrumb' => 'Home . Services . Furnace Repair Service',
                'intro_title' => 'Responsive <span class="highlight">furnace repair service</span> when heat drops out',
                'intro' => array(
                    'Alpine Heating & Air Conditioning provides furnace repair service for no-heat situations, uneven warmth, unusual noises, startup problems, thermostat issues, and seasonal heating performance concerns.',
                    'Furnace repair support reaches local areas such as Downtown Austin, North Austin, South Austin, East Austin, West Austin, Brushy Creek, Teravista, Forest Creek, Davenport Ranch, and Rob Roy.'
                ),
                'features' => array(
                    array('title' => 'No-Heat Troubleshooting', 'body' => 'Heating problems are diagnosed clearly so the right repair path can start quickly.'),
                    array('title' => 'Control and Airflow Checks', 'body' => 'Thermostat issues and distribution problems are reviewed alongside furnace faults.'),
                    array('title' => 'Seasonal Reliability', 'body' => 'Repair work is centered on dependable performance through colder weather.'),
                    array('title' => 'Local Neighborhood Coverage', 'body' => 'Support reaches areas like Davenport Ranch, Rob Roy, Brushy Creek, and Teravista.'),
                    array('title' => 'Repair vs Replace Guidance', 'body' => 'Customers get practical direction when an older furnace keeps failing.'),
                    array('title' => 'Direct Booking Path', 'body' => 'The goal is to make it easy to move from heating trouble to real service.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'North Austin', 'South Austin', 'East Austin', 'West Austin', 'Brushy Creek', 'Teravista', 'Forest Creek', 'Davenport Ranch', 'Rob Roy'),
                'panel_one' => array(
                    'label' => 'Need Heat?',
                    'title' => 'Get furnace issues diagnosed with a direct next step',
                    'body' => 'Furnace repair visitors usually need fast scheduling and clear repair guidance.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Service'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See dedicated heating repair coverage',
                    'body' => 'This category page connects naturally into the broader heating repair service path.',
                    'link' => 'heating-repair',
                    'link_text' => 'View Heating Repair'
                ),
            ),
            'furnace-parts-supplier' => array(
                'menu_title' => 'Furnace Parts Supplier',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Furnace parts supplier',
                'hero_breadcrumb' => 'Home . Services . Furnace Parts Supplier',
                'intro_title' => 'Local <span class="highlight">furnace parts supplier</span> support for repair-driven heating needs',
                'intro' => array(
                    'Alpine Heating & Air Conditioning supports homeowners and property managers who need compatible furnace parts as part of practical repair and heating reliability planning.',
                    'Furnace parts support is relevant across areas including North Austin, South Austin, Mueller, Tarrytown, Circle C Ranch, Anderson Mill West, Twin Creeks, Falcon Pointe, Forest Creek, and Rough Hollow.'
                ),
                'features' => array(
                    array('title' => 'Compatible Parts Guidance', 'body' => 'Replacement parts are matched for fit, safety, and dependable furnace operation.'),
                    array('title' => 'Repair-Connected Support', 'body' => 'Parts decisions stay tied to real repair needs instead of guesswork.'),
                    array('title' => 'Heating Reliability Focus', 'body' => 'The goal is restoring dependable performance during colder stretches.'),
                    array('title' => 'Neighborhood Reach', 'body' => 'Support extends across areas like Tarrytown, Falcon Pointe, Forest Creek, and Rough Hollow.'),
                    array('title' => 'Older System Evaluation', 'body' => 'When parts are harder to justify, replacement guidance can stay nearby.'),
                    array('title' => 'Clear Next Steps', 'body' => 'Customers get practical direction on whether repair is still the smarter path.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('North Austin', 'South Austin', 'Mueller', 'Tarrytown', 'Circle C Ranch', 'Anderson Mill West', 'Twin Creeks', 'Falcon Pointe', 'Forest Creek', 'Rough Hollow'),
                'panel_one' => array(
                    'label' => 'Repair Support',
                    'title' => 'Get furnace repair needs matched to the right next step',
                    'body' => 'Part selection works best when it is connected to real diagnosis and heating-system condition.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Service'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See furnace and heating repair help',
                    'body' => 'Most furnace-parts questions are part of a broader repair or replacement conversation.',
                    'link' => 'heating-repair',
                    'link_text' => 'View Heating Repair'
                ),
            ),
            'heating-contractor' => array(
                'menu_title' => 'Heating Contractor',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Heating contractor',
                'hero_breadcrumb' => 'Home . Services . Heating Contractor',
                'intro_title' => 'Experienced <span class="highlight">heating contractor</span> support across Austin neighborhoods',
                'intro' => array(
                    'Alpine Heating & Air Conditioning works as a heating contractor for homeowners who need repair, maintenance, replacement planning, and dependable cold-weather comfort support.',
                    'Heating contractor work is supported in local areas including North Austin, South Austin, West Austin, East Austin, Mueller, Circle C Ranch, Brushy Creek, Buttercup Creek, Teravista, and Serene Hills.'
                ),
                'features' => array(
                    array('title' => 'Heating Repairs', 'body' => 'Restore performance when furnaces and heaters stop operating reliably.'),
                    array('title' => 'Seasonal Maintenance', 'body' => 'Routine heating service helps protect efficiency and reduce breakdowns.'),
                    array('title' => 'Replacement Planning', 'body' => 'Older systems can be reviewed with clearer repair-versus-upgrade guidance.'),
                    array('title' => 'Control and Airflow Support', 'body' => 'Comfort issues often involve thermostats, airflow, and whole-system behavior.'),
                    array('title' => 'Town-Area Coverage', 'body' => 'Support reaches communities like Buttercup Creek, Serene Hills, and Teravista.'),
                    array('title' => 'Year-Round HVAC Context', 'body' => 'Heating service stays connected to broader whole-home comfort planning.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('North Austin', 'South Austin', 'West Austin', 'East Austin', 'Mueller', 'Circle C Ranch', 'Brushy Creek', 'Buttercup Creek', 'Teravista', 'Serene Hills'),
                'panel_one' => array(
                    'label' => 'Need Service?',
                    'title' => 'Book heating support with a local contractor',
                    'body' => 'From here you can go straight to heating repair, maintenance, or replacement — whichever your system actually needs.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'Explore heating pages',
                    'body' => 'Customers often need to compare heating repair, installation, and maintenance together.',
                    'link' => 'heating-installation',
                    'link_text' => 'View Heating Services'
                ),
            ),
            'hvac-contractor' => array(
                'menu_title' => 'HVAC Contractor',
                'hero_chip' => 'Business Category',
                'hero_title' => 'HVAC contractor',
                'hero_breadcrumb' => 'Home . Services . HVAC Contractor',
                'intro_title' => 'Full-service <span class="highlight">HVAC contractor</span> support for Austin homes',
                'intro' => array(
                    'Alpine Heating & Air Conditioning is an HVAC contractor for residential properties that need year-round help with air conditioning, heating, airflow, maintenance, indoor air quality, and system replacement planning.',
                    'HVAC contractor support is available across local areas such as Downtown Austin, North Austin, South Austin, East Austin, West Austin, Mueller, Tarrytown, Circle C Ranch, Anderson Mill West, Twin Creeks, Brushy Creek, and Davenport Ranch.'
                ),
                'features' => array(
                    array('title' => 'Cooling and Heating Support', 'body' => 'One contractor covers repairs, maintenance, and replacement planning.'),
                    array('title' => 'Indoor Comfort Upgrades', 'body' => 'Airflow, filtration, humidity, and thermostat improvements stay connected to core HVAC needs.'),
                    array('title' => 'Preventive Service', 'body' => 'Routine maintenance helps reduce surprise failures and protect efficiency.'),
                    array('title' => 'Broad Neighborhood Coverage', 'body' => 'Support reaches areas such as Tarrytown, Twin Creeks, Brushy Creek, and Davenport Ranch.'),
                    array('title' => 'Project Coordination', 'body' => 'Installation and replacement work can be planned with fewer surprises.'),
                    array('title' => 'Long-Term Reliability', 'body' => 'The focus is dependable comfort through every season, not just one urgent visit.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'North Austin', 'South Austin', 'East Austin', 'West Austin', 'Mueller', 'Tarrytown', 'Circle C Ranch', 'Anderson Mill West', 'Twin Creeks', 'Brushy Creek', 'Davenport Ranch'),
                'panel_one' => array(
                    'label' => 'Start Here',
                    'title' => 'Work with one HVAC contractor for the next step',
                    'body' => 'This category is built for customers who want one local team for repairs, maintenance, upgrades, and replacements.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See the main services hub',
                    'body' => 'The full services page connects this category to the broader Alpine Heating & Air Conditioning offering.',
                    'link' => 'air-conditioning-services',
                    'link_text' => 'View Our Services'
                ),
            ),
            'repair-service' => array(
                'menu_title' => 'Repair Service',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Repair service',
                'hero_breadcrumb' => 'Home . Services . Repair Service',
                'intro_title' => 'Reliable <span class="highlight">repair service</span> for heating and cooling problems',
                'intro' => array(
                    'Alpine Heating & Air Conditioning provides repair service for heating and cooling equipment when systems stop performing the way they should, whether the problem involves cooling loss, airflow issues, controls, or heating reliability.',
                    'Repair support reaches neighborhoods and local areas including Downtown Austin, North Austin, South Austin, East Austin, West Austin, Falcon Pointe, Blackhawk, Forest Creek, Teravista, and Rough Hollow.'
                ),
                'features' => array(
                    array('title' => 'Cooling Repairs', 'body' => 'Air conditioning problems are diagnosed and addressed before comfort drops further.'),
                    array('title' => 'Heating Repairs', 'body' => 'Furnaces and heaters can be serviced when winter performance becomes unreliable.'),
                    array('title' => 'Airflow and Control Checks', 'body' => 'Comfort issues often involve more than the core unit alone.'),
                    array('title' => 'Local Area Support', 'body' => 'Repair calls are supported across communities like Falcon Pointe, Blackhawk, and Teravista.'),
                    array('title' => 'Practical Recommendations', 'body' => 'Customers get clearer guidance on repair versus replacement decisions.'),
                    array('title' => 'Direct Scheduling', 'body' => 'The path from equipment trouble to booked service stays simple.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'North Austin', 'South Austin', 'East Austin', 'West Austin', 'Falcon Pointe', 'Blackhawk', 'Forest Creek', 'Teravista', 'Rough Hollow'),
                'panel_one' => array(
                    'label' => 'Need Help?',
                    'title' => 'Move from repair need to booked service quickly',
                    'body' => 'Already know the system needs attention? Request service and skip straight to scheduling.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Repair'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See the full heating repair page',
                    'body' => 'The heating repair page covers diagnosis, common failures, and what a visit looks like.',
                    'link' => 'heating-repair',
                    'link_text' => 'View Repair Services'
                ),
            ),
            'furnace-store' => array(
                'menu_title' => 'Furnace Store',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Furnace store',
                'hero_breadcrumb' => 'Home . Services . Furnace Store',
                'intro_title' => 'Local <span class="highlight">furnace store</span> guidance for heating replacements',
                'intro' => array(
                    'Alpine Heating & Air Conditioning supports homeowners searching for a furnace store by helping them evaluate heating system options, equipment decisions, and replacement needs with local guidance.',
                    'Furnace-related sales and replacement support can be discussed for North Austin, South Austin, West Austin, Mueller, Circle C Ranch, Buttercup Creek, Anderson Mill West, Twin Creeks, Davenport Ranch, and Rob Roy.'
                ),
                'features' => array(
                    array('title' => 'Furnace Replacement Planning', 'body' => 'Customers can compare options when older heating systems stop making sense.'),
                    array('title' => 'Heating Equipment Guidance', 'body' => 'Equipment discussions stay tied to home needs, performance, and efficiency.'),
                    array('title' => 'Local Neighborhood Support', 'body' => 'Projects are supported in areas like Buttercup Creek, Davenport Ranch, and Rob Roy.'),
                    array('title' => 'Installation Coordination', 'body' => 'Store-style product interest stays connected to real installation planning.'),
                    array('title' => 'Repair vs Replace Insight', 'body' => 'Customers get a clearer picture of whether another repair is worth it.'),
                    array('title' => 'Comfort-Driven Decisions', 'body' => 'The goal is dependable heat with a practical long-term path.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('North Austin', 'South Austin', 'West Austin', 'Mueller', 'Circle C Ranch', 'Buttercup Creek', 'Anderson Mill West', 'Twin Creeks', 'Davenport Ranch', 'Rob Roy'),
                'panel_one' => array(
                    'label' => 'Compare Options',
                    'title' => 'Review furnace replacement paths with local guidance',
                    'body' => 'Alpine Heating & Air Conditioning turns initial furnace shopping into a real heating-system plan.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See heating replacement support',
                    'body' => 'Furnace sales and equipment comparisons usually lead into broader replacement planning.',
                    'link' => 'heating-replacement',
                    'link_text' => 'View Heating Replacement'
                ),
            ),
            'air-conditioning-contractor' => array(
                'menu_title' => 'AC Contractor',
                'hero_chip' => 'Business Category',
                'hero_title' => 'Air conditioning contractor',
                'hero_breadcrumb' => 'Home . Services . Air Conditioning Contractor',
                'intro_title' => 'Experienced <span class="highlight">air conditioning contractor</span> support for local cooling projects',
                'intro' => array(
                    'Alpine Heating & Air Conditioning is an air conditioning contractor serving customers who need cooling installation, repair, maintenance, replacement planning, and stronger overall summer performance.',
                    'Air conditioning contractor support is available across Downtown Austin, North Austin, South Austin, East Austin, West Austin, Mueller, Tarrytown, Circle C Ranch, Brushy Creek, Falcon Pointe, Teravista, and Forest Creek.'
                ),
                'features' => array(
                    array('title' => 'Cooling Installation and Replacement', 'body' => 'System planning stays focused on fit, performance, and long-term comfort.'),
                    array('title' => 'AC Repair Support', 'body' => 'Contractor-level service includes diagnostics and practical repair recommendations.'),
                    array('title' => 'Maintenance Planning', 'body' => 'Routine cooling care helps protect performance through heavy summer use.'),
                    array('title' => 'Local Area Reach', 'body' => 'Projects are supported across neighborhoods like Tarrytown, Circle C Ranch, Falcon Pointe, and Teravista.'),
                    array('title' => 'Efficiency and Airflow Review', 'body' => 'Cooling performance is shaped by more than the equipment alone.'),
                    array('title' => 'Direct Project Path', 'body' => 'Customers can move from research to estimate requests without extra friction.')
                ),
                'area_title' => 'Areas of town supported',
                'areas' => array('Downtown Austin', 'North Austin', 'South Austin', 'East Austin', 'West Austin', 'Mueller', 'Tarrytown', 'Circle C Ranch', 'Brushy Creek', 'Falcon Pointe', 'Teravista', 'Forest Creek'),
                'panel_one' => array(
                    'label' => 'Cooling Project',
                    'title' => 'Plan cooling work with a local contractor',
                    'body' => 'Compare installation, repair, and replacement side by side with one contractor handling all three.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'See the main air conditioning page',
                    'body' => 'The broader AC service page connects this category to the full cooling offering.',
                    'link' => 'air-conditioning-services-austin-tx',
                    'link_text' => 'View AC Services'
                ),
            ),
        );
    }
}

if (!function_exists('alpine_business_category_menu_items')) {
    function alpine_business_category_menu_items() {
        $items = array();

        foreach (alpine_business_category_page_data() as $slug => $page) {
            $items[] = array(
                'slug' => $slug,
                'title' => $page['menu_title'],
                'url' => home_url('/' . trim($slug, '/') . '/'),
            );
        }

        return $items;
    }
}

if (!function_exists('alpine_render_business_category_page')) {
    function alpine_render_business_category_page($slug) {
        $pages = alpine_business_category_page_data();

        if (!isset($pages[$slug])) {
            status_header(404);
            get_header();
            echo '<main class="container py-5"><h1>Business category page not found</h1></main>';
            get_footer();
            return;
        }

        $page = $pages[$slug];

        if (function_exists('alpine_overlay_landing_page')) {
            $page = alpine_overlay_landing_page($page, get_queried_object_id(), 'business');
        }

        get_header();
        ?>
<div class="service-page installation-page dedicated-service-page business-category-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div>
        <span class="hero-chip"><?php echo esc_html($page['hero_chip']); ?></span>
        <h1><?php echo esc_html($page['hero_title']); ?></h1>
        <?php alpine_breadcrumb_nav(alpine_breadcrumb_items_from_string($page['hero_breadcrumb'])); ?>
      </div>
      <strong>Air Conditioning and Heating Specialists</strong>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>
</header>

<main>
  <section class="section-space">
    <div class="container">
      <div class="service-copy-wrap">
        <div class="service-split">
          <div>
            <h2 class="section-title"><?php echo wp_kses_post($page['intro_title']); ?></h2>
            <?php foreach ($page['intro'] as $paragraph) : ?>
              <p class="service-intro"><?php echo esc_html($paragraph); ?></p>
            <?php endforeach; ?>
          </div>

          <div class="service-visual-grid">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/ac-maintenance.jpg')); ?>" alt="<?php echo esc_attr($page['hero_title']); ?>">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/hvac_commercial-scaled.jpg')); ?>" alt="<?php echo esc_attr($page['hero_title'] . ' support'); ?>">
            </article>
          </div>
        </div>

        <div class="service-feature-grid">
          <?php foreach ($page['features'] as $feature) : ?>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3><?php echo esc_html($feature['title']); ?></h3>
                <p><?php echo esc_html($feature['body']); ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="service-area-links-section mt-5">
          <div class="service-area-links-header">
            <h2 class="section-title"><?php echo esc_html($page['area_title']); ?></h2>
            <p class="service-intro"><?php echo esc_html('Alpine Heating & Air Conditioning supports ' . strtolower($page['hero_title']) . ' requests in the following neighborhoods and nearby areas of town.'); ?></p>
          </div>

          <div class="service-area-links-grid">
            <?php foreach ($page['areas'] as $area) : ?>
              <div class="service-area-link-card">
                <span class="service-area-link-city"><?php echo esc_html($area); ?></span>
                <span class="service-area-link-meta">TX</span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="service-panel-grid">
          <article class="service-info-panel">
            <span class="section-pill"><?php echo esc_html($page['panel_one']['label']); ?></span>
            <h3><?php echo esc_html($page['panel_one']['title']); ?></h3>
            <p><?php echo esc_html($page['panel_one']['body']); ?></p>
            <a href="<?php echo esc_url(alpine_get_business_category_panel_link_url($page['panel_one']['link'])); ?>" class="btn service-cta-btn"><?php echo esc_html($page['panel_one']['link_text']); ?></a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill"><?php echo esc_html($page['panel_two']['label']); ?></span>
            <h3><?php echo esc_html($page['panel_two']['title']); ?></h3>
            <p><?php echo esc_html($page['panel_two']['body']); ?></p>
            <a href="<?php echo esc_url(alpine_get_business_category_panel_link_url($page['panel_two']['link'])); ?>" class="btn service-cta-btn"><?php echo esc_html($page['panel_two']['link_text']); ?></a>
          </article>
        </div>

        <?php alpine_render_service_area_links_section(); ?>
      </div>
    </div>
  </section>

  <section class="service-strip">
    <div class="container">
      <strong>Quality heating &amp; air conditioning solutions</strong>
      <a href="<?php echo esc_url(alpine_get_site_page_url('contact')); ?>" class="btn service-cta-btn">Schedule Appointment</a>
    </div>
  </section>
</main>
</div>
<?php
        get_footer();
    }
}
