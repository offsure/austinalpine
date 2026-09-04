<?php
/**
 * Commercial property category landing pages.
 */

require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

if (!function_exists('alpine_commercial_category_page_data')) {
    function alpine_commercial_category_page_data() {
        return array(
            'office-buildings' => array(
                'menu_title' => 'Office Buildings',
                'hero_title' => 'Office Building HVAC Services',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Office Buildings',
                'intro_title' => 'Commercial <span class="highlight">office building HVAC services</span> in Austin',
                'intro' => array(
                    'Office buildings in Austin need commercial HVAC systems that can support long operating hours, multiple tenant zones, conference rooms, lobbies, shared corridors, and day-to-day occupant comfort without creating constant service issues.',
                    'Many office properties rely on rooftop units, chillers, and air handling units to manage larger floorplates and variable occupancy. That makes preventive maintenance, fast commercial HVAC repair, and smart replacement planning essential for reducing complaints and protecting building operations.',
                ),
                'features' => array(
                    array('title' => 'Tenant Comfort Management', 'body' => 'Balanced airflow and temperature control help reduce hot and cold spots across offices, suites, and common areas.'),
                    array('title' => 'RTU, Chiller, and AHU Support', 'body' => 'Commercial office HVAC often depends on rooftop units, chillers, and air handling equipment that need consistent professional service.'),
                    array('title' => 'Preventive Maintenance for Office Properties', 'body' => 'Routine maintenance helps reduce breakdowns, protect efficiency, and extend equipment life in heavily used buildings.'),
                    array('title' => 'Responsive Commercial HVAC Repair', 'body' => 'When cooling or ventilation problems affect employees or tenants, fast repair helps restore normal working conditions.'),
                    array('title' => 'Energy Efficiency and Budget Control', 'body' => 'Office buildings benefit from HVAC strategies that improve comfort while helping owners manage operating costs.'),
                    array('title' => 'Long-Term Replacement Planning', 'body' => 'Aging office HVAC systems can be reviewed with a clearer plan for phased replacement and capital planning.'),
                ),
                'focus_title' => 'Common office HVAC systems and service priorities',
                'focus_intro' => 'Office building HVAC service usually centers on large shared equipment, tenant comfort, and practical building access planning for occupied commercial space.',
                'focus_points' => array('Rooftop units (RTUs)', 'Large chillers', 'Air handling units (AHUs)', 'Tenant comfort and zoning', 'Ventilation in shared office areas', 'After-hours service coordination'),
                'panel_one' => array(
                    'label' => 'Need Building Support?',
                    'title' => 'Plan office building HVAC service with less disruption',
                    'body' => 'Alpine Heating & Air Conditioning coordinates commercial HVAC repair, maintenance, and upgrade planning for Austin office properties.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Back to Commercial HVAC',
                    'title' => 'See the full commercial service overview',
                    'body' => 'Return to the main commercial HVAC page to review rates, equipment coverage, and company details.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Office building HVAC service is about keeping workspaces comfortable, reducing tenant complaints, and protecting the property from avoidable downtime and performance issues.',
                'quote_caption' => 'Commercial HVAC support for office buildings, professional suites, and multi-tenant workspaces in Austin',
            ),
            'medical-healthcare-facilities' => array(
                'menu_title' => 'Medical & Healthcare',
                'hero_title' => 'Medical & Healthcare Facility HVAC Services',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Medical & Healthcare Facilities',
                'intro_title' => '<span class="highlight">Medical and healthcare HVAC services</span> in Austin',
                'intro' => array(
                    'Enhance safety and operational continuity with specialized HVAC solutions for medical buildings, clinics, hospitals, and labs in Austin. We provide expert installation, maintenance, and emergency service for critical environments demanding strict temperature control, high filtration standards, and reliable ventilation to maintain sterile and comfortable surroundings.' ,
                ),
                'features_title' => 'Specialized HVAC Solutions for Healthcare Properties',
                'features' => array(
                    array('title' => 'Precise Climate & Humidity Control', 'body' => 'Tighter temperature and humidity tolerances for sensitive patient care areas and laboratory equipment.'),
                    array('title' => 'High-Filtration & IAQ Management', 'body' => 'Installation and maintenance of HEPA and advanced filtration systems to improve indoor air quality.'),
                    array('title' => 'Reliable Systems for Critical Spaces', 'body' => 'HVAC solutions optimized for 24/7 reliability, minimizing downtime to prevent immediate operational risks.'),
                    array('title' => 'Clean Room & Ventilation Compliance', 'body' => 'Optimizing airflow performance to ensure proper pressurization and air changes per hour (ACH).'),
                    array('title' => 'Non-Disruptive Facility Scheduling', 'body' => 'Flexible service hours tailored to maintain patient comfort and minimize disruption to clinical operations.'),
                    array('title' => 'Maintenance & Upgrades Planning', 'body' => 'Long-term maintenance plans, system audits, and proactive equipment upgrades to prevent failures.'),
                ),
                'focus_title' => 'Common healthcare HVAC priorities',
                'focus_intro' => 'Healthcare HVAC planning usually goes beyond comfort alone and focuses heavily on air quality, filtration, ventilation performance, and reliability in sensitive spaces.',
                'focus_points' => array('High-efficiency filtration', 'Ventilation control', 'Room-by-room stability', 'Humidity awareness', 'Air quality support', 'Critical uptime planning'),
                'panel_one' => array(
                    'label' => 'Facility Planning',
                    'title' => 'Coordinate healthcare HVAC needs with experienced commercial support',
                    'body' => 'Talk through climate control, ventilation, filtration, and reliability needs before the next repair or upgrade decision.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Commercial HVAC',
                    'title' => 'Return to the main commercial HVAC page',
                    'body' => 'Review service rates, equipment coverage, and broader commercial support details.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Healthcare HVAC service supports more than comfort. It helps protect indoor air quality, maintain stable operating conditions, and keep sensitive spaces running with fewer surprises.',
                'quote_caption' => 'Commercial HVAC support for clinics, hospitals, labs, and healthcare facilities in Austin',
            ),
            'manufacturing-plants' => array(
                'menu_title' => 'Manufacturing Plants',
                'hero_title' => 'Manufacturing plant HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Manufacturing Plants',
                'intro_title' => 'Commercial HVAC for <span class="highlight">manufacturing plants</span> and production environments',
                'intro' => array(
                    'Manufacturing facilities often depend on HVAC systems for both worker comfort and process stability. In many plants, climate control affects not only the building environment but also equipment performance, production quality, and daily operating efficiency.',
                    'These properties may require process cooling, higher-capacity ventilation, and specialized systems designed around heat loads, machinery, and the practical realities of industrial workspaces.',
                ),
                'features' => array(
                    array('title' => 'Process Cooling Support', 'body' => 'Production environments often need cooling tied directly to machinery and equipment loads.'),
                    array('title' => 'Worker Comfort Control', 'body' => 'Large floor areas still need practical cooling and heating support for employees.'),
                    array('title' => 'High-Demand Equipment', 'body' => 'Manufacturing properties may use larger or more specialized systems than standard commercial spaces.'),
                    array('title' => 'Ventilation and Air Movement', 'body' => 'Airflow strategy is often a key part of maintaining usable production space.'),
                    array('title' => 'Downtime Reduction', 'body' => 'Fast commercial response helps reduce disruption when HVAC problems affect the plant environment.'),
                    array('title' => 'Upgrade Planning', 'body' => 'Long-term planning helps facilities compare repair costs with better-performing replacement options.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Manufacturing spaces often combine comfort cooling with process-related HVAC requirements that need more specialized attention.',
                'focus_points' => array('Process cooling', 'Large-capacity ventilation', 'Industrial controls', 'Heat-load management', 'Machinery support', 'Production-area comfort'),
                'panel_one' => array(
                    'label' => 'Plant Support',
                    'title' => 'Discuss manufacturing HVAC needs with a commercial team',
                    'body' => 'Coordinate process cooling, environmental control, and repair planning for active production facilities.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Main Commercial Page',
                    'title' => 'Return to the commercial HVAC overview',
                    'body' => 'See the main commercial page for rates, team information, and supported equipment.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Manufacturing HVAC service has to respect production demands, machinery heat loads, and the operational cost of unplanned downtime.',
                'quote_caption' => 'Support for plants, production lines, fabrication spaces, and industrial work areas',
            ),
            'warehouse-industrial-facilities' => array(
                'menu_title' => 'Warehouse & Industrial',
                'hero_title' => 'Warehouse and industrial HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Warehouse & Industrial Facilities',
                'intro_title' => 'HVAC support for <span class="highlight">warehouse and industrial facilities</span>',
                'intro' => array(
                    'Warehouses and industrial properties often require practical HVAC strategies built around large open areas, loading activity, variable occupancy, and equipment that has to perform under challenging operating conditions.',
                    'These facilities may need ventilation, spot cooling, heating support, and system planning that balances building use, energy costs, and the demands of storage, logistics, and industrial workflows.',
                ),
                'features' => array(
                    array('title' => 'Large Open-Space Conditioning', 'body' => 'Warehouses need HVAC approaches that can handle broad square footage and shifting occupancy patterns.'),
                    array('title' => 'Ventilation Support', 'body' => 'Air movement and fresh-air management are often critical in industrial settings.'),
                    array('title' => 'Dock and Access Considerations', 'body' => 'Frequent door activity can create heat gain and airflow challenges.'),
                    array('title' => 'Equipment Reliability', 'body' => 'Industrial operations benefit from service that reduces HVAC interruptions.'),
                    array('title' => 'Practical Maintenance Planning', 'body' => 'Routine service helps facilities avoid surprise failures during active operating periods.'),
                    array('title' => 'Energy-Conscious Operation', 'body' => 'Large buildings often need HVAC strategies that keep comfort support from driving excessive operating cost.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Warehouse and industrial facilities usually prioritize usable working conditions, ventilation, and cost-aware performance across larger footprints.',
                'focus_points' => array('Large-area ventilation', 'Unit heaters', 'Rooftop units', 'Dock-zone conditioning', 'Industrial airflow', 'Maintenance access planning'),
                'panel_one' => array(
                    'label' => 'Facility Support',
                    'title' => 'Keep warehouse and industrial space operating reliably',
                    'body' => 'Request commercial HVAC help for repairs, seasonal maintenance, or planning larger building improvements.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Commercial Overview',
                    'title' => 'Review the full commercial HVAC page',
                    'body' => 'Go back to the main commercial HVAC page for company-level service information.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Warehouse HVAC service should match the realities of large open buildings, active loading patterns, and the need for steady industrial uptime.',
                'quote_caption' => 'Support for logistics facilities, storage buildings, and industrial-use properties',
            ),
            'apartments-condominiums' => array(
                'menu_title' => 'Apartments & Condos',
                'hero_title' => 'Apartment and condominium HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Apartment & Condominiums',
                'intro_title' => 'Commercial HVAC for <span class="highlight">apartments and condominiums</span>',
                'intro' => array(
                    'Multi-unit residential properties need HVAC support that accounts for resident comfort, shared equipment, unit turnover, and the service expectations that come with occupied buildings.',
                    'Apartment and condominium work can involve central equipment, split systems, shared comfort areas, and repair coordination that respects both property operations and the day-to-day resident experience.',
                ),
                'features' => array(
                    array('title' => 'Resident Comfort', 'body' => 'HVAC issues in multi-family properties affect daily living quickly and often need direct response.'),
                    array('title' => 'Common-Area Conditioning', 'body' => 'Lobbies, gyms, offices, and hallways require consistent climate control alongside unit-specific service.'),
                    array('title' => 'Turnover Support', 'body' => 'Vacancy and unit-turn service can be coordinated with property management schedules.'),
                    array('title' => 'Repair Coordination', 'body' => 'Commercial HVAC work should support communication between management, residents, and service teams.'),
                    array('title' => 'System Replacement Planning', 'body' => 'Aging equipment can be reviewed for phased replacement and long-term budget control.'),
                    array('title' => 'Maintenance Across Multiple Units', 'body' => 'Preventive planning helps reduce repeated service calls and comfort complaints.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Multi-family properties often require a mix of resident-facing service, common-area comfort, and practical property-level planning.',
                'focus_points' => array('Split systems', 'Common-area RTUs', 'Shared mechanical systems', 'Resident scheduling', 'Turnover readiness', 'Property manager coordination'),
                'panel_one' => array(
                    'label' => 'Property Support',
                    'title' => 'Coordinate apartment and condo HVAC service more smoothly',
                    'body' => 'Get help planning repairs, maintenance, and replacement work for occupied multi-family properties.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Commercial HVAC',
                    'title' => 'Return to the commercial HVAC overview',
                    'body' => 'Review the main commercial page for rates, team experience, and supported equipment.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Apartment and condominium HVAC service should support both resident comfort and the operating needs of the property team behind the scenes.',
                'quote_caption' => 'Commercial support for apartments, condominiums, and managed multi-unit communities',
            ),
            'high-rise-residential-properties' => array(
                'menu_title' => 'High-Rise Residential',
                'hero_title' => 'High-rise residential HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . High-Rise Residential Properties',
                'intro_title' => 'HVAC support for <span class="highlight">high-rise residential properties</span>',
                'intro' => array(
                    'High-rise residential buildings need HVAC service that understands vertical distribution, shared infrastructure, occupied-unit coordination, and the complexity that comes with larger residential towers.',
                    'These properties may rely on central mechanical systems, common-area conditioning, and building-wide airflow strategies that require experienced commercial planning and dependable response.',
                ),
                'features' => array(
                    array('title' => 'Vertical System Complexity', 'body' => 'High-rise properties often involve more complex distribution and infrastructure than low-rise buildings.'),
                    array('title' => 'Occupied-Unit Coordination', 'body' => 'Service work must account for residents, access needs, and building management requirements.'),
                    array('title' => 'Common-Area Comfort', 'body' => 'Lobbies, corridors, amenities, and shared spaces need consistent HVAC performance.'),
                    array('title' => 'Building-Wide Reliability', 'body' => 'Mechanical issues can affect multiple floors or resident groups quickly.'),
                    array('title' => 'Planned Maintenance', 'body' => 'Preventive HVAC planning helps reduce repeated service problems across the property.'),
                    array('title' => 'Upgrade and Capital Planning', 'body' => 'High-rise buildings benefit from long-term replacement strategies, not just reactive repair.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'High-rise residential properties usually need HVAC planning that respects both mechanical complexity and day-to-day resident experience.',
                'focus_points' => array('Central mechanical systems', 'Amenity-space comfort', 'Resident coordination', 'Vertical distribution', 'Access logistics', 'Capital planning'),
                'panel_one' => array(
                    'label' => 'Tower Support',
                    'title' => 'Plan high-rise residential HVAC work with a commercial approach',
                    'body' => 'Request help with repairs, maintenance planning, or larger upgrade discussions for high-rise residential properties.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Back to Commercial Page',
                    'title' => 'See the main commercial HVAC overview',
                    'body' => 'Return to the commercial HVAC page to review broader service details and supported equipment.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'High-rise HVAC service should balance building-wide system performance with the practical realities of occupied residential towers.',
                'quote_caption' => 'Commercial support for residential towers, mixed-use buildings, and large vertical communities',
            ),
            'it-data-centers' => array(
                'menu_title' => 'IT Data Centers',
                'hero_title' => 'IT data center cooling',
                'hero_breadcrumb' => 'Home . Commercial HVAC . IT Data Centers',
                'intro_title' => 'Precision cooling for <span class="highlight">IT data centers</span> and server environments',
                'intro' => array(
                    'Data centers and server rooms require highly reliable cooling because large heat loads from IT equipment can create immediate risk when temperature control drops. These properties often need specialized systems and tighter operating tolerances than traditional commercial spaces.',
                    'Cooling support in these environments focuses on uptime, heat management, airflow control, and service planning that helps protect critical infrastructure from avoidable thermal stress.',
                ),
                'features' => array(
                    array('title' => 'High-Precision Cooling', 'body' => 'IT environments need cooling support that can respond to concentrated, consistent heat loads.'),
                    array('title' => 'Critical Uptime', 'body' => 'Unexpected cooling failure in a data environment can escalate quickly.'),
                    array('title' => 'Airflow Management', 'body' => 'Proper airflow is central to managing rack loads and room-level heat buildup.'),
                    array('title' => 'Equipment Reliability', 'body' => 'Maintenance and monitoring support help reduce the chance of disruptive failures.'),
                    array('title' => 'Specialized System Planning', 'body' => 'Data-center cooling often involves systems and controls beyond standard comfort cooling.'),
                    array('title' => 'Capacity Review', 'body' => 'Growing IT demand can require HVAC reassessment before heat loads outpace existing equipment.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Data-center and server-room cooling is usually driven by heat-load control, airflow strategy, and uptime protection.',
                'focus_points' => array('Precision cooling', 'Server-room airflow', 'Heat-load management', 'Redundancy awareness', 'High-sensitivity response', 'Critical equipment protection'),
                'panel_one' => array(
                    'label' => 'Critical Cooling Support',
                    'title' => 'Talk through data center cooling needs before the next issue becomes urgent',
                    'body' => 'Request commercial support for server-room cooling, equipment reliability, or future capacity planning.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Commercial HVAC',
                    'title' => 'Return to the full commercial HVAC page',
                    'body' => 'See the broader commercial offering, supported equipment, and company details.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Data center cooling is not ordinary comfort control. It is a reliability system that protects critical equipment from concentrated heat and avoidable downtime.',
                'quote_caption' => 'Support for server rooms, network spaces, and high-load IT environments',
            ),
            'retail-food-service' => array(
                'menu_title' => 'Retail & Food Service',
                'hero_title' => 'Retail and food service HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . Retail & Food Service',
                'intro_title' => 'Commercial HVAC for <span class="highlight">retail and food service</span> spaces',
                'intro' => array(
                    'Retail stores, restaurants, and supermarkets need HVAC systems that support customer comfort, staff working conditions, and the daily demands of active commercial spaces with changing occupancy and frequent door traffic.',
                    'These businesses may also depend on refrigeration-related equipment, rooftop units, and comfort cooling strategies that help maintain steady indoor conditions without adding unnecessary disruption to operations.',
                ),
                'features' => array(
                    array('title' => 'Customer Comfort', 'body' => 'Retail and dining spaces need indoor conditions that support a better guest experience.'),
                    array('title' => 'Kitchen and Occupancy Demands', 'body' => 'Food-service environments often create higher internal heat and ventilation challenges.'),
                    array('title' => 'Rooftop Unit Support', 'body' => 'RTUs are common in retail and restaurant properties and need attentive ongoing service.'),
                    array('title' => 'Refrigeration Awareness', 'body' => 'Supermarkets and food-service sites often need HVAC planning that respects refrigeration-related conditions.'),
                    array('title' => 'Fast Repair Response', 'body' => 'Comfort issues can affect revenue, staff, and customer experience quickly.'),
                    array('title' => 'Efficient Operation', 'body' => 'Energy-conscious HVAC performance matters in spaces with long business hours and variable traffic.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Retail and food-service HVAC usually centers on customer-facing comfort, heat-load control, and well-maintained rooftop equipment support.',
                'focus_points' => array('Rooftop units (RTUs)', 'Dining-area comfort', 'Door-traffic heat gain', 'Kitchen ventilation awareness', 'Refrigeration-adjacent conditions', 'Fast business-hour response'),
                'panel_one' => array(
                    'label' => 'Business Support',
                    'title' => 'Keep customer-facing spaces comfortable and operational',
                    'body' => 'Request commercial service for stores, restaurants, or food-service environments that cannot afford HVAC downtime.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Back to Commercial HVAC',
                    'title' => 'Review the full commercial HVAC overview',
                    'body' => 'Go back to the main commercial page for service rates, team details, and equipment coverage.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Retail and food-service HVAC needs to protect customer comfort, support staff, and keep business operations moving without unnecessary interruption.',
                'quote_caption' => 'Support for stores, restaurants, supermarkets, and other customer-facing commercial spaces',
            ),
            'school-education-facilities' => array(
                'menu_title' => 'School & Education',
                'hero_title' => 'School and education facility HVAC',
                'hero_breadcrumb' => 'Home . Commercial HVAC . School & Education Facilities',
                'intro_title' => 'Reliable HVAC support for <span class="highlight">school and education facilities</span>',
                'intro' => array(
                    'Schools, colleges, and universities need HVAC systems that can support classrooms, offices, common areas, and larger campus buildings with consistent ventilation, heating, and cooling performance.',
                    'Educational facilities often require large-scale system planning, maintenance scheduling around occupancy windows, and responsive service that helps reduce disruption for students, faculty, and staff.',
                ),
                'features' => array(
                    array('title' => 'Large-Scale Ventilation', 'body' => 'Education spaces depend on ventilation and air movement across classrooms, halls, and shared buildings.'),
                    array('title' => 'Occupancy-Driven Comfort', 'body' => 'School schedules create predictable but intense HVAC demand during active hours.'),
                    array('title' => 'Campus Reliability', 'body' => 'Mechanical issues can affect learning conditions and staff operations quickly.'),
                    array('title' => 'Seasonal Scheduling', 'body' => 'Breaks and off-hours often create windows for larger service and maintenance work.'),
                    array('title' => 'Heating and Cooling Balance', 'body' => 'Education facilities need year-round support, not just seasonal repair.'),
                    array('title' => 'Long-Term Maintenance Planning', 'body' => 'Routine service helps protect budgets and reduce disruptive failures during the school year.'),
                ),
                'focus_title' => 'Typical systems and priorities',
                'focus_intro' => 'Education properties usually need robust large-scale ventilation and scheduling-aware maintenance that fits active academic environments.',
                'focus_points' => array('Classroom comfort', 'Campus ventilation', 'Large-scale heating', 'Break-period maintenance', 'High-occupancy airflow', 'Administrative area support'),
                'panel_one' => array(
                    'label' => 'Campus Support',
                    'title' => 'Coordinate education HVAC service with an experienced commercial team',
                    'body' => 'Request planning support for repairs, maintenance schedules, and larger HVAC projects across school properties.',
                    'link_text' => 'Request Estimate',
                    'link_slug' => 'request-an-estimate-austin-tx',
                ),
                'panel_two' => array(
                    'label' => 'Commercial HVAC',
                    'title' => 'Return to the commercial HVAC overview',
                    'body' => 'See the main commercial page for broader commercial service information and supported equipment.',
                    'link_text' => 'View Commercial HVAC',
                    'link_slug' => 'commercial-hvac-austin-tx',
                ),
                'quote' => 'Education HVAC service should support healthy learning environments, steady building performance, and maintenance planning that respects the academic calendar.',
                'quote_caption' => 'Support for schools, colleges, universities, and education-focused commercial buildings',
            ),
        );
    }
}

if (!function_exists('alpine_commercial_category_menu_items')) {
    function alpine_commercial_category_menu_items() {
        $items = array();

        foreach (alpine_commercial_category_page_data() as $slug => $page) {
            $items[] = array(
                'slug' => $slug,
                'title' => !empty($page['menu_title']) ? $page['menu_title'] : $page['hero_title'],
                'url' => alpine_get_commercial_category_page_url($slug),
            );
        }

        return $items;
    }
}

if (!function_exists('alpine_get_commercial_category_page_url')) {
    function alpine_get_commercial_category_page_url($slug) {
        $slug = trim($slug, '/');
        $candidate_paths = array(
            'commercial-hvac-austin-tx/' . $slug,
            'commercial-hvac/' . $slug,
            $slug,
        );

        foreach ($candidate_paths as $path) {
            $page = get_page_by_path($path, OBJECT, 'page');

            if ($page instanceof WP_Post) {
                return get_permalink($page);
            }
        }

        if (function_exists('alpine_get_site_page_url')) {
            $commercial_page_url = trailingslashit(alpine_get_site_page_url('commercial_hvac'));

            return $commercial_page_url . $slug . '/';
        }

        return home_url('/commercial-hvac-austin-tx/' . $slug . '/');
    }
}

if (!function_exists('alpine_get_commercial_panel_link_url')) {
    function alpine_get_commercial_panel_link_url($slug) {
        $slug = trim($slug, '/');

        if ($slug === '') {
            return home_url('/');
        }

        $shared_page_keys = array(
            'commercial-hvac-austin-tx' => 'commercial_hvac',
            'commercial-hvac' => 'commercial_hvac',
            'request-an-estimate-austin-tx' => 'estimate',
            'request-an-estimate' => 'estimate',
        );

        if (isset($shared_page_keys[$slug]) && function_exists('alpine_get_site_page_url')) {
            return alpine_get_site_page_url($shared_page_keys[$slug]);
        }

        $candidate_paths = array(
            $slug,
            'commercial-hvac-austin-tx/' . $slug,
            'commercial-hvac/' . $slug,
        );

        foreach ($candidate_paths as $path) {
            $page = get_page_by_path($path, OBJECT, 'page');

            if ($page instanceof WP_Post) {
                return get_permalink($page);
            }
        }

        return home_url('/' . $slug . '/');
    }
}

if (!function_exists('alpine_get_commercial_service_contact_url')) {
    function alpine_get_commercial_service_contact_url() {
        $contact_url = function_exists('alpine_get_site_page_url')
            ? alpine_get_site_page_url('contact')
            : home_url('/contact-us/');

        return add_query_arg(
            array(
                'service' => 'commercial-services',
            ),
            $contact_url
        ) . '#contactForm';
    }
}

if (!function_exists('alpine_render_commercial_category_page')) {
    function alpine_render_commercial_category_page($slug) {
        $pages = alpine_commercial_category_page_data();

        if (!isset($pages[$slug])) {
            status_header(404);
            get_header();
            echo '<main class="container py-5"><h1>Commercial category page not found</h1></main>';
            get_footer();
            return;
        }

        $page = $pages[$slug];

        if (function_exists('alpine_overlay_landing_page')) {
            $page = alpine_overlay_landing_page($page, get_queried_object_id(), 'commercial');
        }

        $upload_base_url = trailingslashit(wp_get_upload_dir()['baseurl']);
        $commercial_hero_background_url = $upload_base_url . '2026/04/commercial-bg-img.jpg';
        $commercial_hero_logo_url = $upload_base_url . '2026/04/Commercial-Services-lg.png';
        $commercial_hero_form_id = function_exists('alpine_get_cf7_form_id_by_title')
            ? alpine_get_cf7_form_id_by_title('Homepage Hero Form')
            : 0;
        $commercial_hero_form = $commercial_hero_form_id
            ? do_shortcode('[contact-form-7 id="' . $commercial_hero_form_id . '" title="Homepage Hero Form"]')
            : do_shortcode('[contact-form-7 id="bf38474" title="Contact form 1"]');
        $commercial_overview_url = alpine_get_commercial_panel_link_url('commercial-hvac-austin-tx');
        $commercial_service_contact_url = alpine_get_commercial_service_contact_url();
        $hero_intro = !empty($page['intro'][0]) ? $page['intro'][0] : '';
        $hero_highlights = !empty($page['focus_points']) ? array_slice($page['focus_points'], 0, 3) : array();

        get_header();
        ?>
<div class="service-page installation-page commercial-page commercial-category-page">
  <section
    class="page-hero"
    style="background: linear-gradient(108deg, rgba(20, 59, 114, 0.72), rgba(92, 126, 176, 0.58)), url('<?php echo esc_url($commercial_hero_background_url); ?>') center/cover no-repeat;"
  >
    <div class="container hero-content">
      <div class="hero-copy commercial-hero-copy">
        <img loading="lazy" decoding="async" class="commercial-hero-logo" src="<?php echo esc_url($commercial_hero_logo_url); ?>" alt="<?php echo esc_attr($page['hero_title']); ?>">
        <h1><?php echo esc_html($page['hero_title']); ?></h1>
        <?php if ($hero_intro !== '') : ?>
          <p class="hero-subtext commercial-hero-subtext"><?php echo esc_html($hero_intro); ?></p>
        <?php endif; ?>
        <?php if (!empty($hero_highlights)) : ?>
          <div class="commercial-hero-highlights" aria-label="Key service highlights">
            <?php foreach ($hero_highlights as $highlight) : ?>
              <span><?php echo esc_html($highlight); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <div class="hero-cta-group commercial-hero-actions">
          <a href="<?php echo esc_url($commercial_service_contact_url); ?>" class="btn service-cta-btn">Request Commercial HVAC Service</a>
        </div>
        <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Commercial HVAC', 'url' => $commercial_overview_url),
            array('label' => !empty($page['menu_title']) ? $page['menu_title'] : $page['hero_title']),
        )); ?>
      </div>
      <div class="hero-form-card commercial-hero-form-card">
        <div class="hero-form-wrap">
          <?php echo $commercial_hero_form; ?>
        </div>
      </div>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>

<main>
  <section class="section-space">
    <div class="container">
      <div class="service-copy-wrap">
        <div class="service-split commercial-intro-section">
          <div class="commercial-intro-copy">
            <h2 class="section-title"><?php echo wp_kses_post($page['intro_title']); ?></h2>
            <?php foreach ($page['intro'] as $paragraph) : ?>
              <p class="service-intro"><?php echo esc_html($paragraph); ?></p>
            <?php endforeach; ?>
          </div>

          <div class="service-visual-grid commercial-intro-visuals">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url($upload_base_url . '2026/04/hvac_commercial-scaled.jpg'); ?>" alt="<?php echo esc_attr($page['hero_title']); ?>">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url($upload_base_url . '2026/04/hvac_commercial_service-scaled.jpg'); ?>" alt="<?php echo esc_attr($page['hero_title'] . ' support'); ?>">
            </article>
          </div>
        </div>

        <?php if (!empty($page['features_title'])) : ?>
          <h2 class="section-title mt-5"><?php echo esc_html($page['features_title']); ?></h2>
        <?php endif; ?>

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

        <section class="commercial-detail-section mt-5">
          <div class="commercial-detail-copy">
            <span class="section-pill">Property Focus</span>
            <h2 class="section-title"><?php echo esc_html($page['focus_title']); ?></h2>
            <p class="service-intro"><?php echo esc_html($page['focus_intro']); ?></p>
          </div>

          <div class="commercial-focus-grid">
            <?php foreach ($page['focus_points'] as $point) : ?>
              <article class="commercial-focus-card">
                <span><?php echo esc_html($point); ?></span>
              </article>
            <?php endforeach; ?>
          </div>
        </section>

        <div class="service-panel-grid mt-5">
          <article class="service-info-panel">
            <span class="section-pill"><?php echo esc_html($page['panel_one']['label']); ?></span>
            <h3><?php echo esc_html($page['panel_one']['title']); ?></h3>
            <p><?php echo esc_html($page['panel_one']['body']); ?></p>
            <a href="<?php echo esc_url($commercial_service_contact_url); ?>" class="btn service-cta-btn">Request Commercial HVAC Service</a>
          </article>
        </div>

        <div class="service-testimonial mt-5">
          <article class="service-photo-card">
            <img loading="lazy" decoding="async" src="<?php echo esc_url($upload_base_url . '2026/04/hvac_commercial_service-scaled.jpg'); ?>" alt="<?php echo esc_attr($page['hero_title'] . ' planning'); ?>">
          </article>
          <article class="service-testimonial-quote">
            <span><?php echo esc_html($page['hero_title']); ?></span>
            <blockquote><?php echo esc_html($page['quote']); ?></blockquote>
            <p><?php echo esc_html($page['quote_caption']); ?></p>
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
