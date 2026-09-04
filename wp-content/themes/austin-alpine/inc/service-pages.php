<?php
/**
 * Dedicated service landing pages.
 */

require_once get_stylesheet_directory() . '/inc/service-area-template.php';
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

if (!function_exists('alpine_service_page_url')) {
    function alpine_service_page_url($slug) {
        $slug = trim((string) $slug, '/');

        if ($slug === '') {
            return home_url('/');
        }

        $site_page_slug_map = array(
            'request-an-estimate-austin-tx' => 'estimate',
            'request-an-estimate' => 'estimate',
            'hvac-financing' => 'financing',
            'hvac-financing-austin-tx' => 'financing',
            'air-conditioning-services' => 'services',
            'our-services' => 'services',
            'service-areas' => 'service_areas',
            'contact-us' => 'contact',
            'about' => 'about',
            'resources' => 'resources',
            'hvac-resources' => 'resources',
            'special-rebate' => 'specials',
            'special-rebate-austin-tx' => 'specials',
            'hvac-maintenance-plan' => 'maintenance_plan',
            'hvac-maintenance-plan-austin-tx' => 'maintenance_plan',
        );

        if (isset($site_page_slug_map[$slug]) && function_exists('alpine_get_site_page_url')) {
            return alpine_get_site_page_url($site_page_slug_map[$slug]);
        }

        $page = get_page_by_path($slug, OBJECT, 'page');
        if ($page instanceof WP_Post) {
            $permalink = get_permalink($page);
            if ($permalink) {
                return $permalink;
            }
        }

        return home_url('/' . $slug . '/');
    }
}

if (!function_exists('alpine_service_page_data')) {
    function alpine_service_page_data() {
        return array(
            'ac-installation' => array(
                'hero_chip' => 'Cooling Service',
                'hero_title' => 'AC Installation in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . AC Installation',
                'intro_title' => 'Professional <span class="highlight">AC installation</span> for reliable comfort',
                'intro' => array(
                    'A new air conditioning system should be sized properly, installed cleanly, and configured for the way your home actually uses cooling. Alpine Heating & Air Conditioning helps homeowners choose efficient equipment and install it with long-term comfort in mind.',
                    'Whether you are comparing system options, replacing an outdated unit, or planning a brand-new cooling setup, we help you land on equipment that cools efficiently through the worst weeks of summer.'
                ),
                'features' => array(
                    array('title' => 'System Sizing', 'body' => 'Equipment recommendations are matched to the home, layout, and cooling load.'),
                    array('title' => 'Energy Efficiency', 'body' => 'Modern systems can reduce strain, improve comfort, and lower utility waste.'),
                    array('title' => 'Thermostat Setup', 'body' => 'Controls are configured so the new system works smoothly from day one.'),
                    array('title' => 'Replacement Planning', 'body' => 'Customers replacing older equipment get a clearer path to the right system.'),
                    array('title' => 'Clean Installation', 'body' => 'Attention to startup, airflow, and final testing helps avoid future issues.'),
                    array('title' => 'Austin Heat Ready', 'body' => 'Every system is selected and installed with heavy Central Texas cooling demand in mind.')
                ),
                'cards' => array(
                    array('title' => 'AC Repair', 'body' => 'If the current unit may still be salvageable, compare repair options first.', 'link' => 'ac-repair'),
                    array('title' => 'AC Maintenance', 'body' => 'Preventive service helps protect new cooling equipment after installation.', 'link' => 'ac-maintenance'),
                    array('title' => 'Thermostat Services', 'body' => 'Smart thermostat upgrades pair naturally with a new AC system.', 'link' => 'thermostat-services'),
                    array('title' => 'Emergency HVAC Repair', 'body' => 'Fast help is available if installation follows an urgent system failure.', 'link' => 'emergency-hvac-repair')
                ),
                'panel_one' => array(
                    'label' => 'New System',
                    'title' => 'Plan an AC installation with fewer surprises',
                    'body' => 'We walk you through system type, efficiency ratings, controls, and installation scope before any work begins, so you know exactly what to expect.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'Compare repair, maintenance, and replacement paths',
                    'body' => 'Not every system needs immediate replacement. If your current equipment can still be repaired or maintained cost-effectively, we can help you compare those options first.',
                    'link' => 'air-conditioning-services',
                    'link_text' => 'Explore Services'
                ),
                'faq' => array(
                    array('q' => 'When is AC installation the right choice?', 'a' => 'Installation is usually the strongest fit for homes with failing, undersized, or inefficient cooling equipment, or for properties adding central air for the first time.'),
                    array('q' => 'What does a professional AC installation include?', 'a' => 'Proper sizing for your home, efficient equipment selection, thermostat setup, careful startup testing, and a clean install that protects long-term performance.'),
                    array('q' => 'Do you handle AC replacement as well as new installation?', 'a' => 'Yes. Replacing an existing system and installing a first-time system follow the same careful process, from load calculation to final testing.'),
                    array('q' => 'How do I get started with a new AC system?', 'a' => 'Request an estimate online or give us a call. We will assess your home, explain your options, and recommend the right system for your budget.')
                ),
            ),
            'ac-repair' => array(
                'hero_chip' => 'Cooling Service',
                'hero_title' => 'AC Repair in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . AC Repair',
                'intro_title' => 'Fast <span class="highlight">AC repair</span> for cooling problems',
                'intro' => array(
                    'When an air conditioner stops cooling, short cycles, leaks, freezes up, or starts making unusual noise, you need clear answers and a technician on the way, not a runaround.',
                    'From urgent cooling failures to nagging performance problems, our technicians focus on practical diagnostics and clear next-step guidance so your comfort is restored quickly.'
                ),
                'features' => array(
                    array('title' => 'No Cool Diagnosis', 'body' => 'Troubleshooting covers common cooling failures, weak airflow, and frozen coils.'),
                    array('title' => 'Major Brand Service', 'body' => 'We repair all major air conditioning makes and models.'),
                    array('title' => 'Clear Recommendations', 'body' => 'Customers need to know when repair makes sense and when replacement is smarter.'),
                    array('title' => 'Thermostat Checks', 'body' => 'Control issues can be isolated before deeper equipment work is recommended.'),
                    array('title' => 'Refrigerant & Electrical Issues', 'body' => 'Refrigerant leaks and electrical faults are diagnosed and explained in plain language.'),
                    array('title' => 'Emergency Availability', 'body' => 'When cooling fails in peak heat, urgent repair visits are available.')
                ),
                'cards' => array(
                    array('title' => 'Emergency HVAC Repair', 'body' => 'Complete breakdown in extreme weather? Get urgent repair help fast.', 'link' => 'emergency-hvac-repair'),
                    array('title' => 'AC Maintenance', 'body' => 'Preventive tune-ups help reduce the chance of another cooling failure.', 'link' => 'ac-maintenance'),
                    array('title' => 'AC Installation', 'body' => 'If repair costs keep rising, installation may become the better path.', 'link' => 'ac-installation'),
                    array('title' => 'Indoor Air Quality', 'body' => 'Some cooling complaints are really airflow or air quality problems, not equipment failures.', 'link' => 'indoor-air-quality')
                ),
                'panel_one' => array(
                    'label' => 'Urgent Help',
                    'title' => 'Move quickly from AC trouble to booked service',
                    'body' => 'If your system is blowing warm air or not keeping up, the next step should be simple: schedule repair and get a technician on the way.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Schedule Repair'
                ),
                'panel_two' => array(
                    'label' => 'Long-Term Care',
                    'title' => 'Follow repairs with maintenance',
                    'body' => 'After a repair, regular maintenance is the best way to prevent the next breakdown before it starts.',
                    'link' => 'ac-maintenance',
                    'link_text' => 'View AC Maintenance'
                ),
                'faq' => array(
                    array('q' => 'What AC problems do you repair?', 'a' => 'No cooling, warm air, poor airflow, frozen coils, refrigerant issues, thermostat problems, leaks, and electrical faults are all common repairs we handle.'),
                    array('q' => 'Do you offer emergency AC repair?', 'a' => 'Yes. Cooling failures during peak Austin heat cannot wait, so urgent repair visits are available when you need them.'),
                    array('q' => 'How do I know whether to repair or replace my AC?', 'a' => 'We focus on repair first. If the system is aging and repair costs keep climbing, we will walk you through replacement options honestly so you can compare.'),
                    array('q' => 'How do I schedule AC repair?', 'a' => 'Call us or request service online and we will get a technician headed your way as quickly as possible.')
                ),
            ),
            'ac-maintenance' => array(
                'hero_chip' => 'Cooling Service',
                'hero_title' => 'AC Maintenance in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . AC Maintenance',
                'intro_title' => 'Seasonal <span class="highlight">AC maintenance</span> and tune-ups',
                'intro' => array(
                    'Air conditioning maintenance gets you ahead of summer breakdowns, improve system efficiency, and keep cooling equipment working the way it should before peak heat arrives.',
                    'Routine tune-ups also make it easier to catch wear early, plan repairs before they become urgent, and protect the performance of your system over time.'
                ),
                'features' => array(
                    array('title' => 'Seasonal Tune-Ups', 'body' => 'Cooling systems are checked ahead of heavy summer demand.'),
                    array('title' => 'Efficiency Protection', 'body' => 'Routine cleaning and inspection help systems run more effectively.'),
                    array('title' => 'Breakdown Prevention', 'body' => 'Preventive maintenance reduces the chance of surprise service calls.'),
                    array('title' => 'Performance Review', 'body' => 'Visits can uncover worn parts, airflow issues, and cooling loss early.'),
                    array('title' => 'Plan-Friendly Service', 'body' => 'Tune-ups pair naturally with an ongoing maintenance plan for year-round coverage.'),
                    array('title' => 'All Makes and Models', 'body' => 'We maintain all major brands and system types, whatever equipment your home has.')
                ),
                'cards' => array(
                    array('title' => 'Maintenance Plan', 'body' => 'Enroll in a plan for scheduled tune-ups, priority service, and fewer surprises.', 'link' => 'hvac-maintenance-plan-austin-tx'),
                    array('title' => 'AC Repair', 'body' => 'If maintenance uncovers active faults, repair should be the next step.', 'link' => 'ac-repair'),
                    array('title' => 'AC Installation', 'body' => 'Older systems found to be struggling can move toward installation planning.', 'link' => 'ac-installation'),
                    array('title' => 'Indoor Air Quality', 'body' => 'Filter and airflow improvements often complement cooling maintenance.', 'link' => 'indoor-air-quality')
                ),
                'panel_one' => array(
                    'label' => 'Preventive Care',
                    'title' => 'Keep cooling systems ready for peak season',
                    'body' => 'In Austin, one of the smartest things a homeowner can do is service the AC before summer heat pushes the system to its limit.',
                    'link' => 'hvac-maintenance-plan-austin-tx',
                    'link_text' => 'Explore Maintenance Plan'
                ),
                'panel_two' => array(
                    'label' => 'Need Repairs?',
                    'title' => 'Move to repair only when maintenance finds a real issue',
                    'body' => 'If a tune-up uncovers a genuine problem, we explain the repair clearly and let you decide — no scare tactics, no pressure.',
                    'link' => 'ac-repair',
                    'link_text' => 'View AC Repair'
                ),
                'faq' => array(
                    array('q' => 'Why does AC maintenance matter in Austin?', 'a' => 'Austin summers push cooling systems hard. Regular maintenance catches wear early, protects efficiency, and reduces the chance of a mid-season breakdown.'),
                    array('q' => 'What is included in an AC maintenance visit?', 'a' => 'Tune-ups, inspections, cleaning, efficiency checks, and early detection of worn parts before they turn into breakdowns.'),
                    array('q' => 'Do AC tune-ups count as maintenance?', 'a' => 'Yes. Tune-ups are a key part of AC maintenance and help improve efficiency, reliability, and seasonal performance.'),
                    array('q' => 'How often should I schedule AC maintenance?', 'a' => 'At least once a year, ideally in spring before peak heat arrives. A maintenance plan makes the schedule automatic.')
                ),
            ),
            'ac-replacement' => array(
                'hero_chip' => 'Cooling Service',
                'hero_title' => 'AC Replacement in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . AC Replacement',
                'intro_title' => 'Replace an aging <span class="highlight">AC system</span> with confidence',
                'intro' => array(
                    'AC replacement is often the right conversation when a system is aging, repair costs keep stacking up, or energy bills are rising without better comfort.',
                    'If you already know your air conditioner is near the end of its useful life, we will guide you to the right next system with clear numbers and no pressure.'
                ),
                'features' => array(
                    array('title' => 'Old System Upgrades', 'body' => 'We swap out failing, inefficient cooling equipment for modern systems that hold up.'),
                    array('title' => 'Efficiency Gains', 'body' => 'Newer systems can improve comfort while reducing waste and strain.'),
                    array('title' => 'Repair vs Replace Guidance', 'body' => 'Customers often need help deciding when ongoing repairs stop making sense.'),
                    array('title' => 'Equipment Selection', 'body' => 'System type and efficiency options can be explained clearly.'),
                    array('title' => 'Thermostat Compatibility', 'body' => 'Replacement projects often include control upgrades at the same time.'),
                    array('title' => 'Clear Estimates', 'body' => 'Straightforward quotes and in-home consultations make the decision easier.')
                ),
                'cards' => array(
                    array('title' => 'AC Installation', 'body' => 'Replacement and installation go hand in hand — see how a new system gets installed.', 'link' => 'ac-installation'),
                    array('title' => 'AC Repair', 'body' => 'For borderline cases, repair can remain an alternate path.', 'link' => 'ac-repair'),
                    array('title' => 'Thermostat Services', 'body' => 'New equipment often benefits from updated controls.', 'link' => 'thermostat-services'),
                    array('title' => 'HVAC Financing', 'body' => 'Flexible financing can make a replacement project easier to budget.', 'link' => 'hvac-financing-austin-tx')
                ),
                'panel_one' => array(
                    'label' => 'Upgrade Path',
                    'title' => 'Make replacement decisions with clearer numbers',
                    'body' => 'Replacement planning should help homeowners compare ongoing repair costs against a quieter, more efficient system with years of life ahead of it.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Replacement Quote'
                ),
                'panel_two' => array(
                    'label' => 'Payment Options',
                    'title' => 'Financing options for replacement projects',
                    'body' => 'Replacement decisions often depend on available financing and the total value of a newer, more efficient system.',
                    'link' => 'hvac-financing-austin-tx',
                    'link_text' => 'View Financing'
                ),
                'faq' => array(
                    array('q' => 'When should I replace my AC instead of repairing it?', 'a' => 'When repair bills keep stacking up, efficiency keeps falling, or the system is roughly 12 to 15 years old, replacement usually makes better financial sense.'),
                    array('q' => 'What should I consider when replacing an AC system?', 'a' => 'Repair-versus-replace costs, efficiency ratings, correct sizing, financing options, and thermostat compatibility all factor into a good decision.'),
                    array('q' => 'Does replacement include full installation?', 'a' => 'Yes. Removing the old system and professionally installing the new one are handled as one project, through final startup and testing.'),
                    array('q' => 'How do I get a replacement quote?', 'a' => 'Request a replacement estimate or an in-home consultation and we will walk you through your options with clear numbers.')
                ),
            ),
            'heating-installation' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heating Installation in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heating Installation',
                'intro_title' => 'Professional <span class="highlight">heating installation</span> built for lasting comfort',
                'intro' => array(
                    'A new heating system should do more than turn on and off. It should warm the home evenly, run efficiently, and match the square footage, insulation, and airflow needs of the property. Alpine Heating & Air Conditioning provides heating installation in Austin, TX for homeowners who want dependable comfort without guessing their way through equipment decisions.',
                    'Whether you are replacing an older furnace, installing a heater in a recently purchased home, or upgrading to a more efficient setup, our team focuses on proper system selection, clean installation, and performance testing so your comfort is ready when colder weather arrives.'
                ),
                'features' => array(
                    array('title' => 'Home-by-Home Sizing', 'body' => 'Heating equipment is matched to the layout and demand of the home instead of using one-size-fits-all recommendations.'),
                    array('title' => 'Furnace and Heater Options', 'body' => 'Installation support can cover central furnaces, replacement heaters, and complete system upgrades.'),
                    array('title' => 'Efficiency-Focused Upgrades', 'body' => 'Modern equipment can improve comfort while reducing waste and monthly operating costs.'),
                    array('title' => 'Thermostat and Control Setup', 'body' => 'New installations are paired with compatible controls for smoother day-to-day operation.'),
                    array('title' => 'Clean Startup Testing', 'body' => 'Final checks confirm airflow, ignition, and steady heating performance before we call the job done.'),
                    array('title' => 'Austin Winter Readiness', 'body' => 'Even short cold snaps in Central Texas demand a system homeowners can rely on.')
                ),
                'cards' => array(
                    array('title' => 'Heating Repair', 'body' => 'Some systems still have life left in them and may only need targeted repairs.', 'link' => 'heating-repair'),
                    array('title' => 'Heating Maintenance', 'body' => 'Seasonal tune-ups help protect a newly installed heating system.', 'link' => 'heating-maintenance'),
                    array('title' => 'Heater Replacement', 'body' => 'Ready to retire an aging heater? Replacement planning starts here.', 'link' => 'heater-replacement'),
                    array('title' => 'Thermostat Services', 'body' => 'Smart controls can improve comfort and heating efficiency.', 'link' => 'thermostat-services')
                ),
                'panel_one' => array(
                    'label' => 'Seasonal Upgrade',
                    'title' => 'Install new heating before winter exposes an aging system',
                    'body' => 'Planning ahead gives homeowners more time to compare options, improve efficiency, and avoid an emergency replacement during a cold snap.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Service',
                    'title' => 'Compare installation with repair and replacement',
                    'body' => 'Not every heating problem calls for a full installation, so it helps to keep practical repair and replacement options close by.',
                    'link' => 'heating-repair',
                    'link_text' => 'View Heating Repair'
                ),
                'faq' => array(
                    array('q' => 'When is heating installation the right choice?', 'a' => 'Installation is usually the best fit when the current system is unreliable, inefficient, incorrectly sized, or no longer worth repairing.'),
                    array('q' => 'Do you install furnaces as well as heat pumps?', 'a' => 'Yes. We install central furnaces, heat pumps, and replacement heaters, and we recommend the type that actually fits your home, ductwork, and budget rather than a one-size-fits-all option.'),
                    array('q' => 'What should homeowners expect during installation?', 'a' => 'Most projects start with system sizing and equipment recommendations, followed by professional installation, startup testing, and thermostat setup.'),
                    array('q' => 'How long does a heating installation take?', 'a' => 'Most residential installations are finished in a single day. Jobs that involve ductwork changes or equipment relocation can run longer, and we tell you up front if yours will.')
                ),
            ),
            'heating-repair' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heating Repair in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heating Repair',
                'intro_title' => 'Responsive <span class="highlight">heating repair</span> when comfort drops fast',
                'intro' => array(
                    'When a heater stops working, blows cool air, short cycles, or leaves rooms unevenly heated, you want a diagnosis, a price, and a fix — in that order. Alpine Heating & Air Conditioning provides heating repair in Austin, TX for systems that are no longer delivering the comfort, safety, or reliability your home depends on.',
                    'Our technicians handle these problems every week: no-heat calls, weak airflow, strange smells, unusual noises, ignition trouble, thermostat issues, and older systems that may be approaching replacement.'
                ),
                'features' => array(
                    array('title' => 'No-Heat Diagnostics', 'body' => 'Troubleshooting starts with the issues that leave homes cold or uncomfortable.'),
                    array('title' => 'Furnace and Heater Service', 'body' => 'Repairs can address common furnace failures as well as broader whole-home heating issues.'),
                    array('title' => 'Warning-Sign Troubleshooting', 'body' => 'Unusual noises, odors, short cycling, and rising utility bills are all signs worth checking quickly.'),
                    array('title' => 'Thermostat and Airflow Checks', 'body' => 'Control problems and airflow restrictions are reviewed before larger repairs are recommended.'),
                    array('title' => 'Seasonal Urgency', 'body' => 'Cold-weather breakdowns are stressful, so no-heat calls move to the front of the line when a front rolls through Central Texas.'),
                    array('title' => 'Repair or Replace Clarity', 'body' => 'If the system is aging or repair costs are rising, homeowners can compare next-step options with confidence.')
                ),
                'cards' => array(
                    array('title' => 'Heating Installation', 'body' => 'If repair no longer makes sense, installation becomes the next path.', 'link' => 'heating-installation'),
                    array('title' => 'Heating Maintenance', 'body' => 'Routine service can reduce the chance of future heating failures.', 'link' => 'heating-maintenance'),
                    array('title' => 'Furnace Repair', 'body' => 'Ignition failures, burner trouble, and other furnace-specific problems get dedicated attention.', 'link' => 'furnace-repair'),
                    array('title' => 'Heater Replacement', 'body' => 'Older systems with repeat failures may be better candidates for replacement.', 'link' => 'heater-replacement')
                ),
                'panel_one' => array(
                    'label' => 'Fast Response',
                    'title' => 'Get your heat back without the runaround',
                    'body' => 'Tell us what the system is doing and we come prepared to diagnose it, explain the fix in plain language, and get your home warm again.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Schedule Heating Repair'
                ),
                'panel_two' => array(
                    'label' => 'Preventive Follow-Up',
                    'title' => 'Use repairs as the moment to plan future maintenance',
                    'body' => 'Once your system is working again, tune-ups and seasonal service are the best way to reduce the risk of another winter breakdown.',
                    'link' => 'heating-maintenance',
                    'link_text' => 'View Heating Maintenance'
                ),
                'faq' => array(
                    array('q' => 'What are common signs a heating system needs repair?', 'a' => 'Common warning signs include no heat, cold spots, short cycling, unusual smells, banging or rattling sounds, and rising heating bills.'),
                    array('q' => 'Do you repair furnaces as well as heat pumps?', 'a' => 'Yes. Our technicians work on gas furnaces, electric heat, and heat pump systems from all the major brands.'),
                    array('q' => 'What if my heat goes out at night or on a weekend?', 'a' => 'Call us. We keep emergency availability for sudden cold-weather breakdowns that cannot wait for regular business hours.'),
                    array('q' => 'How quickly can you get someone out?', 'a' => 'In most cases we can schedule promptly, and we give you a realistic arrival window when you call instead of leaving you waiting all day.')
                ),
            ),
            'heating-maintenance' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heating Maintenance in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heating Maintenance',
                'intro_title' => 'Seasonal <span class="highlight">heating maintenance</span> that helps prevent breakdowns',
                'intro' => array(
                    'Heating maintenance gives homeowners a chance to catch wear, airflow restrictions, safety concerns, and efficiency losses before colder weather puts extra strain on the system. Alpine Heating & Air Conditioning provides heating maintenance in Austin, TX for furnaces and heaters that need seasonal attention before winter arrives.',
                    'A thorough tune-up catches wear early, protects efficiency, and cuts the odds of waking up to a no-heat problem when temperatures dip across Central Texas.'
                ),
                'features' => array(
                    array('title' => 'Detailed Heating Tune-Ups', 'body' => 'Maintenance visits can include inspection, cleaning, adjustment, and performance testing.'),
                    array('title' => 'Safety Checks', 'body' => 'Seasonal service helps identify issues before they become comfort or safety problems.'),
                    array('title' => 'Efficiency Protection', 'body' => 'A well-maintained heating system is better positioned to run smoothly with less waste.'),
                    array('title' => 'Repair Prevention', 'body' => 'Tune-ups help uncover worn parts and airflow issues before they become mid-season breakdowns.'),
                    array('title' => 'Maintenance Plan Fit', 'body' => 'Heating maintenance pairs naturally with recurring service plans and annual care.'),
                    array('title' => 'Cold-Snap Readiness', 'body' => 'Even in Austin, reliable heat matters when a cold front moves in quickly.')
                ),
                'cards' => array(
                    array('title' => 'Heating Repair', 'body' => 'If a tune-up uncovers a fault, repair should be the next step.', 'link' => 'heating-repair'),
                    array('title' => 'Heating Installation', 'body' => 'Maintenance can reveal when older heating equipment is near end of life.', 'link' => 'heating-installation'),
                    array('title' => 'Maintenance Plan', 'body' => 'Heating tune-ups pair naturally with broader HVAC maintenance plans.', 'link' => 'hvac-maintenance-plan-austin-tx'),
                    array('title' => 'Heater Repair', 'body' => 'When maintenance uncovers an active issue, a repair-focused page should be close by.', 'link' => 'heater-repair')
                ),
                'panel_one' => array(
                    'label' => 'Seasonal Prep',
                    'title' => 'Get ahead of winter performance problems',
                    'body' => 'A preseason tune-up is one of the smartest ways to improve startup, reduce stress on the system, and lower the chances of an unexpected repair call.',
                    'link' => 'hvac-maintenance-plan-austin-tx',
                    'link_text' => 'Explore Maintenance Plan'
                ),
                'panel_two' => array(
                    'label' => 'Need Repairs?',
                    'title' => 'Move to repairs only when the tune-up finds a real issue',
                    'body' => 'Most tune-ups end with a clean bill of health. When we do find a worn part, we show you the issue and price the fix before touching anything.',
                    'link' => 'heating-repair',
                    'link_text' => 'View Heating Repair'
                ),
                'faq' => array(
                    array('q' => 'How often should a heating system be maintained?', 'a' => 'Annual maintenance is the best baseline for most heating systems, ideally before the colder season starts.'),
                    array('q' => 'What is included in a heating tune-up?', 'a' => 'A typical visit covers inspection, cleaning, safety checks, airflow and thermostat verification, and the small adjustments that keep a system running efficiently.'),
                    array('q' => 'Do you do furnace tune-ups specifically?', 'a' => 'Yes. Furnace tune-ups and heater maintenance are both part of the same seasonal service visit.'),
                    array('q' => 'Is a maintenance plan worth it in Austin?', 'a' => 'For most homeowners, yes. A plan pairs your fall heating tune-up with a spring AC check, so both sides of the system get serviced before their busy season.')
                ),
            ),
            'heating-replacement' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heating Replacement in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heating Replacement',
                'intro_title' => 'Upgrade with practical <span class="highlight">heating replacement</span> guidance',
                'intro' => array(
                    'Heating replacement is often the right conversation when an older furnace becomes unreliable, repair costs keep stacking up, or your current heater simply is not keeping the home comfortable anymore. Alpine Heating & Air Conditioning helps homeowners in Austin, TX move from uncertainty to a clearer replacement plan.',
                    'The goal is not to push new equipment before it is needed. It is to help you compare the cost and risk of keeping an aging system against the long-term value of updated, more dependable heating equipment.'
                ),
                'features' => array(
                    array('title' => 'Aging System Upgrades', 'body' => 'Replacement support is geared toward systems that are old, unreliable, or expensive to keep repairing.'),
                    array('title' => 'Repair vs Replace Clarity', 'body' => 'Homeowners get better direction when they can compare repair history against replacement value.'),
                    array('title' => 'Efficiency Improvements', 'body' => 'Newer heating equipment can improve comfort while reducing wasted energy.'),
                    array('title' => 'Proper Equipment Matching', 'body' => 'Replacement still starts with choosing the right system for the home.'),
                    array('title' => 'Control Upgrades', 'body' => 'New heating equipment often pairs well with updated thermostats and smarter controls.'),
                    array('title' => 'Clear, Written Estimates', 'body' => 'You get equipment options at more than one price point, with the trade-offs spelled out before you commit.')
                ),
                'cards' => array(
                    array('title' => 'Heating Installation', 'body' => 'See how we size, install, and test new heating equipment.', 'link' => 'heating-installation'),
                    array('title' => 'Heating Repair', 'body' => 'Not sure the system is done? A repair visit can settle the question.', 'link' => 'heating-repair'),
                    array('title' => 'Thermostat Services', 'body' => 'Replacement projects often include smarter heating controls.', 'link' => 'thermostat-services'),
                    array('title' => 'HVAC Financing', 'body' => 'Spread the cost of a new system with flexible payment options.', 'link' => 'hvac-financing-austin-tx')
                ),
                'panel_one' => array(
                    'label' => 'Upgrade Path',
                    'title' => 'Replace heating equipment before failure becomes urgent',
                    'body' => 'If you already suspect the heater is on its last winters, a planned replacement costs less stress than an emergency one. We help you compare options on your timeline.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Replacement Quote'
                ),
                'panel_two' => array(
                    'label' => 'Budget Support',
                    'title' => 'Pair heating replacement with financing options',
                    'body' => 'A new heating system is a real investment. Financing options let you handle it in predictable monthly payments instead of one hit to savings.',
                    'link' => 'hvac-financing-austin-tx',
                    'link_text' => 'View Financing'
                ),
                'faq' => array(
                    array('q' => 'How do I know it is time to replace my heating system?', 'a' => 'Age, rising repair bills, uneven heat, and climbing utility costs are the usual signals. If the system is 12 to 15 years old and struggling, replacement is worth comparing against another repair.'),
                    array('q' => 'Will a new system lower my heating bills?', 'a' => 'Usually. Modern equipment runs more efficiently, and correct sizing and installation quality often matter as much as the efficiency rating on the box.'),
                    array('q' => 'Do you remove the old equipment?', 'a' => 'Yes. Replacement includes removing the old unit, installing the new system, and testing everything before we call the job done.'),
                    array('q' => 'How do I get a replacement quote?', 'a' => 'Request an estimate online or give us a call. We look at your home, talk through options, and put clear pricing in front of you with no obligation.')
                ),
            ),
            'furnace-repair' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Furnace Repair in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Furnace Repair',
                'intro_title' => 'Expert <span class="highlight">furnace repair</span> that gets the heat back on',
                'intro' => array(
                    'When a furnace stops producing heat, struggles to start, or begins making unusual sounds, homeowners need more than generic HVAC advice. Alpine Heating & Air Conditioning provides furnace repair in Austin, TX with service focused on restoring warmth, identifying the cause of the failure, and helping you decide whether repair is still the smart move.',
                    'We work on gas furnace and forced-air heating problems of every kind: no heat, poor airflow, frequent cycling, unusual odors, ignition trouble, dirty or failing components, and systems that are simply showing their age.'
                ),
                'features' => array(
                    array('title' => 'Fast Furnace Diagnostics', 'body' => 'Troubleshooting is centered on the common reasons furnaces stop heating reliably.'),
                    array('title' => 'Ignition and Startup Issues', 'body' => 'Hard starts, short cycling, and inconsistent ignition are all strong furnace-repair signals.'),
                    array('title' => 'Airflow and Temperature Problems', 'body' => 'Weak airflow and uneven heating can point to both furnace and duct-related issues.'),
                    array('title' => 'Noise and Odor Troubleshooting', 'body' => 'Banging, rattling, burning smells, and other warning signs should be checked promptly.'),
                    array('title' => 'Safety-Minded Service', 'body' => 'Furnace concerns should be addressed with close attention to performance and household safety.'),
                    array('title' => 'Repair vs Replacement Guidance', 'body' => 'Older furnaces may be better candidates for replacement than another major repair.')
                ),
                'cards' => array(
                    array('title' => 'Heating Repair', 'body' => 'Broader heating-service support is helpful when the issue extends beyond the furnace itself.', 'link' => 'heating-repair'),
                    array('title' => 'Heater Repair', 'body' => 'Whatever kind of heater warms your home, the repair process starts the same way.', 'link' => 'heater-repair'),
                    array('title' => 'Heating Maintenance', 'body' => 'Routine maintenance helps reduce mid-season furnace breakdowns.', 'link' => 'heating-maintenance'),
                    array('title' => 'Heater Replacement', 'body' => 'If the furnace is near the end of its life, replacement should be close by.', 'link' => 'heater-replacement')
                ),
                'panel_one' => array(
                    'label' => 'Need Heat Fast?',
                    'title' => 'Book furnace repair with a direct next step',
                    'body' => 'A furnace that will not heat is not a someday problem. Request service and we will get a technician headed your way with the parts common failures call for.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Furnace Repair'
                ),
                'panel_two' => array(
                    'label' => 'Looking Ahead',
                    'title' => 'Protect the furnace after repairs are complete',
                    'body' => 'Once your system is running again, a seasonal tune-up reduces strain and catches the next failure before the next cold front does.',
                    'link' => 'heating-maintenance',
                    'link_text' => 'View Heating Maintenance'
                ),
                'faq' => array(
                    array('q' => 'What are signs a furnace needs repair?', 'a' => 'Common warning signs include no heat, frequent cycling, unusual noises, burning smells, weak airflow, and higher-than-normal utility bills.'),
                    array('q' => 'Can a dirty filter cause furnace problems?', 'a' => 'Yes. A clogged filter can restrict airflow, increase strain on the system, and contribute to comfort and efficiency issues.'),
                    array('q' => 'How do I know if I should repair or replace a furnace?', 'a' => 'If the furnace is older, breaking down often, or facing a costly repair, replacement may be worth comparing against another service call.'),
                    array('q' => 'Do you service all furnace brands?', 'a' => 'We work on all major brands, including Carrier, Trane, Lennox, Amana, and Daikin, and we stock common parts so most repairs finish in one visit.')
                ),
            ),
            'heater-repair' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heater Repair in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heater Repair',
                'intro_title' => 'Dependable <span class="highlight">heater repair</span> for homes that will not warm up',
                'intro' => array(
                    'Heater repair is often the search homeowners use when the house feels cold, the unit is running without warming the rooms, or the system has stopped responding altogether. Alpine Heating & Air Conditioning provides heater repair in Austin, TX with service designed to restore reliable warmth and solve the underlying issue, not just the symptoms.',
                    'Our team helps troubleshoot no-heat calls, weak airflow, thermostat trouble, unusual sounds, uneven temperatures, and systems that are running longer than they should while delivering less comfort.'
                ),
                'features' => array(
                    array('title' => 'No-Heat Service Calls', 'body' => 'We start with the problems you notice first: cold rooms, a silent unit, or air that never warms up.'),
                    array('title' => 'Whole-System Troubleshooting', 'body' => 'Heater repair can involve the unit, thermostat, airflow, or supporting components.'),
                    array('title' => 'Uneven Heat Solutions', 'body' => 'Cold rooms and inconsistent temperatures are common repair-related complaints.'),
                    array('title' => 'Strange Sound and Smell Checks', 'body' => 'Odd operating behavior is often the first sign that service is needed.'),
                    array('title' => 'Local Cold-Snap Readiness', 'body' => 'Austin homeowners still need reliable heat when winter weather moves in.'),
                    array('title' => 'Repair-First Guidance', 'body' => 'We fix what can be fixed. Replacement only comes up when the numbers genuinely favor it.')
                ),
                'cards' => array(
                    array('title' => 'Heating Repair', 'body' => 'Heat pump or central system acting up? Full heating repair covers every setup.', 'link' => 'heating-repair'),
                    array('title' => 'Furnace Repair', 'body' => 'Have a gas furnace? Furnace-specific diagnostics and parts live here.', 'link' => 'furnace-repair'),
                    array('title' => 'Heating Maintenance', 'body' => 'Tune-ups help reduce the chance of future heater breakdowns.', 'link' => 'heating-maintenance'),
                    array('title' => 'Heater Replacement', 'body' => 'If the current unit is worn out, replacement becomes the next path.', 'link' => 'heater-replacement')
                ),
                'panel_one' => array(
                    'label' => 'Direct Help',
                    'title' => 'Move from heater trouble to booked service quickly',
                    'body' => 'When the home is not warming properly, request service and we will get a technician scheduled fast — usually with a same-week window, often sooner.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Schedule Heater Repair'
                ),
                'panel_two' => array(
                    'label' => 'After the Repair',
                    'title' => 'Reduce repeat heater problems with seasonal maintenance',
                    'body' => 'Once your comfort is restored, annual tune-ups catch wear before the next heating season tests the system.',
                    'link' => 'heating-maintenance',
                    'link_text' => 'Explore Maintenance'
                ),
                'faq' => array(
                    array('q' => 'What issues usually require heater repair?', 'a' => 'Common issues include no heat, uneven warmth, weak airflow, unusual noises, thermostat problems, and systems that keep cycling without reaching the set temperature.'),
                    array('q' => 'Is heater repair different from furnace repair?', 'a' => 'Heater repair is a broader search term. Furnace repair fits within it when the home uses a furnace-based heating system.'),
                    array('q' => 'When is it smarter to replace instead of repair?', 'a' => 'When a system is older and repairs are getting expensive or frequent, we run the numbers with you. Sometimes one more repair makes sense; sometimes it clearly does not.'),
                    array('q' => 'How do I schedule heater repair?', 'a' => 'Call (512) 759-4247 or request service online. Tell us what the system is doing and we will come prepared to diagnose it.')
                ),
            ),
            'heater-replacement' => array(
                'hero_chip' => 'Heating Service',
                'hero_title' => 'Heater Replacement in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Heater Replacement',
                'intro_title' => 'Upgrade aging equipment with confident <span class="highlight">heater replacement</span>',
                'intro' => array(
                    'Heater replacement is often the better long-term move when your current system is aging, struggling to keep up, or costing more to repair every winter. Alpine Heating & Air Conditioning helps homeowners in Austin, TX compare replacement options with a focus on dependable comfort, efficiency, and clean installation.',
                    'If you are dealing with frequent repairs, rising energy bills, uneven temperatures, or a heater that no longer feels trustworthy, replacement may provide a more practical path than continuing to invest in equipment that is near the end of its service life.'
                ),
                'features' => array(
                    array('title' => 'Old Heater Upgrades', 'body' => 'Replacement support is built for systems that are no longer performing reliably or efficiently.'),
                    array('title' => 'Repair vs Replace Decisions', 'body' => 'Homeowners can compare ongoing repair costs against the value of newer equipment.'),
                    array('title' => 'Improved Comfort and Efficiency', 'body' => 'A replacement project can improve temperature consistency and reduce wasted energy.'),
                    array('title' => 'System Selection Guidance', 'body' => 'The right replacement should be sized and matched to the home before installation begins.'),
                    array('title' => 'Thermostat Compatibility', 'body' => 'New heating equipment often works best with updated controls and settings.'),
                    array('title' => 'Straightforward Quotes', 'body' => 'You see equipment choices, pricing, and installation details in writing before deciding anything.')
                ),
                'cards' => array(
                    array('title' => 'Heating Installation', 'body' => 'See how new equipment gets sized, installed, and tested.', 'link' => 'heating-installation'),
                    array('title' => 'Heating Repair', 'body' => 'Repairs can still be the better fit for systems with years left in them.', 'link' => 'heating-repair'),
                    array('title' => 'Furnace Repair', 'body' => 'Weigh one more furnace repair against the cost of replacement.', 'link' => 'furnace-repair'),
                    array('title' => 'HVAC Financing', 'body' => 'Break a replacement project into manageable monthly payments.', 'link' => 'hvac-financing-austin-tx')
                ),
                'panel_one' => array(
                    'label' => 'Upgrade Path',
                    'title' => 'Replace an unreliable heater before it fails at the worst time',
                    'body' => 'Waiting for a full failure usually means replacing in a hurry, in the cold, at whatever price is available. Getting a quote now costs nothing and buys you options.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Replacement Quote'
                ),
                'panel_two' => array(
                    'label' => 'Budget Support',
                    'title' => 'Keep financing and planning resources close by',
                    'body' => 'Comparing equipment is easier when you can see payment options next to the price tags. Our financing partners cover most budgets and credit situations.',
                    'link' => 'hvac-financing-austin-tx',
                    'link_text' => 'View Financing'
                ),
                'faq' => array(
                    array('q' => 'When should a heater be replaced instead of repaired?', 'a' => 'Replacement is often worth considering when the unit is older, repair costs are high, breakdowns are becoming frequent, or comfort has dropped off noticeably.'),
                    array('q' => 'Does heater replacement include installation?', 'a' => 'Yes. Once the right system is selected, replacement naturally includes removal of the old unit and installation of the new one.'),
                    array('q' => 'Is heater replacement the same as furnace replacement?', 'a' => 'For most homes, yes — people use the terms interchangeably. Either way, we help you choose and install the right new heating equipment for the house.'),
                    array('q' => 'What does a replacement estimate include?', 'a' => 'System sizing for your home, equipment recommendations at more than one price point, and installation details, so you can compare options before committing.')
                ),
            ),
            'indoor-air-quality' => array(
                'hero_chip' => 'Air Quality Service',
                'hero_title' => 'Indoor Air Quality in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Indoor Air Quality',
                'intro_title' => 'Better <span class="highlight">indoor air quality</span> for healthier living',
                'intro' => array(
                    'Indoor air quality is a major part of home comfort because temperature alone does not solve problems like dust, stale air, humidity imbalance, or airborne irritants.',
                    'We help homeowners dealing with dust, odors, allergens, stale air, mold concerns, or general whole-home comfort problems tied to indoor air conditions — starting with an honest look at what is actually causing the issue.'
                ),
                'features' => array(
                    array('title' => 'Air Filtration', 'body' => 'Filter upgrades help reduce airborne dust and circulating debris.'),
                    array('title' => 'Air Purification', 'body' => 'Purifiers and related systems can support cleaner indoor breathing air.'),
                    array('title' => 'Duct & Airflow Checks', 'body' => 'Leaky or dirty ducts undo good filtration, so airflow gets checked alongside air quality.'),
                    array('title' => 'Humidity Support', 'body' => 'Balanced moisture levels help improve comfort and indoor health.'),
                    array('title' => 'Whole-Home Comfort', 'body' => 'Air quality work supports more than temperature alone.'),
                    array('title' => 'Healthy Home Focus', 'body' => 'Cleaner, more balanced indoor air supports healthier and more comfortable everyday living.')
                ),
                'cards' => array(
                    array('title' => 'Humidity Control', 'body' => 'Damp, sticky rooms or dry winter air? Moisture balance is fixable.', 'link' => 'humidity-control'),
                    array('title' => 'Thermostat Services', 'body' => 'Controls and ventilation strategy can affect comfort and air circulation.', 'link' => 'thermostat-services'),
                    array('title' => 'Ductwork Services', 'body' => 'Leaky or dirty ducts can undo everything your filter is trying to catch.', 'link' => 'ductwork-services'),
                    array('title' => 'AC Maintenance', 'body' => 'System cleanliness and filter changes pair naturally with cooling maintenance.', 'link' => 'ac-maintenance')
                ),
                'panel_one' => array(
                    'label' => 'Healthier Air',
                    'title' => 'Move from symptoms to the right IAQ solution',
                    'body' => 'Tell us the symptoms — dust that keeps coming back, musty smells, allergy flare-ups, rooms that feel damp — and we connect them to practical fixes that make the home feel better every day.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request IAQ Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Related Support',
                    'title' => 'Connect air quality with ductwork and humidity services',
                    'body' => 'Air quality problems rarely have a single cause. Ductwork condition and humidity levels are usually part of the answer, so we look at all three together.',
                    'link' => 'humidity-control',
                    'link_text' => 'View Humidity Control'
                ),
                'faq' => array(
                    array('q' => 'What indoor air quality services do you offer?', 'a' => 'Filtration upgrades, air purifiers, humidity control, and ductwork improvements that reduce dust, allergens, and odors throughout the home.'),
                    array('q' => 'Why does my home feel stuffy even with the AC running?', 'a' => 'Cooling alone does not address humidity, filtration, or ventilation. If the air feels stale or damp, an air quality evaluation can pinpoint what is missing.'),
                    array('q' => 'Can better filtration help with allergies?', 'a' => 'It often does. Higher-grade filters and purifiers capture more pollen, pet dander, and fine dust than the standard one-inch filters most systems come with.'),
                    array('q' => 'How do I get started?', 'a' => 'Schedule an indoor air consultation. We look at your system, your ductwork, and the symptoms you are noticing, then recommend targeted fixes rather than a bundle of equipment you may not need.')
                ),
            ),
            'ductless-mini-splits' => array(
                'hero_chip' => 'Ductless Service',
                'hero_title' => 'Ductless Mini-Splits in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Ductless Mini-Splits',
                'intro_title' => 'Efficient <span class="highlight">ductless mini-splits</span> for zoned comfort',
                'intro' => array(
                    'Ductless mini-split service gives homeowners and business owners an efficient comfort option for spaces where traditional ductwork is limited, impractical, or too costly to add.',
                    'We handle installations, repairs, maintenance, and replacements for mini-split systems in additions, retrofits, offices, garages, and hard-to-condition rooms.'
                ),
                'features' => array(
                    array('title' => 'Zoned Comfort', 'body' => 'Mini-splits help target heating and cooling where it is needed most.'),
                    array('title' => 'Installations', 'body' => 'Ductless systems are often ideal where major ductwork is impractical.'),
                    array('title' => 'Repairs', 'body' => 'Dedicated repair support keeps mini-splits performing consistently.'),
                    array('title' => 'Maintenance', 'body' => 'Routine tune-ups help maintain efficiency and reliability.'),
                    array('title' => 'Replacement', 'body' => 'Older mini-splits can be upgraded when performance starts slipping.'),
                    array('title' => 'Targeted Applications', 'body' => 'Room additions, converted spaces, and comfort problem areas are ideal candidates.')
                ),
                'cards' => array(
                    array('title' => 'AC Installation', 'body' => 'Some homeowners compare mini-splits against traditional cooling installs.', 'link' => 'ac-installation'),
                    array('title' => 'Heating Installation', 'body' => 'Ductless systems can also satisfy targeted heating needs.', 'link' => 'heating-installation'),
                    array('title' => 'Thermostat Services', 'body' => 'Control options still matter for ductless system usability and comfort.', 'link' => 'thermostat-services'),
                    array('title' => 'Indoor Air Quality', 'body' => 'Cleaner operation and air quality support can complement ductless service.', 'link' => 'indoor-air-quality')
                ),
                'panel_one' => array(
                    'label' => 'Flexible Comfort',
                    'title' => 'A smarter solution for rooms central HVAC cannot reach',
                    'body' => 'Ductless systems are a strong fit when you want focused comfort without opening up the home for a major duct renovation.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Compare Options',
                    'title' => 'Comparing mini-splits to central HVAC?',
                    'body' => 'We will help you weigh a ductless setup against central system replacement or new installation so you choose the right fit for your home.',
                    'link' => 'ac-installation',
                    'link_text' => 'Compare AC Installation'
                ),
                'faq' => array(
                    array('q' => 'What ductless mini-split services do you offer?', 'a' => 'Installation, repair, maintenance, and replacement — plus honest guidance on zoned comfort for room additions and retrofit projects.'),
                    array('q' => 'When is a ductless mini-split the right choice?', 'a' => 'When adding ductwork is impractical or too costly — think room additions, garages, sunrooms, and offices that need their own comfort zone.'),
                    array('q' => 'Do mini-splits handle both heating and cooling?', 'a' => 'Yes. Most modern mini-split systems are heat pumps that cool in summer and heat in winter from the same equipment.'),
                    array('q' => 'How do I find out if a mini-split fits my space?', 'a' => 'Request an estimate or system consultation and we will evaluate the room and recommend the right setup.')
                ),
            ),
            'thermostat-services' => array(
                'hero_chip' => 'Control Service',
                'hero_title' => 'Thermostat Services in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Thermostat Services',
                'intro_title' => 'Expert <span class="highlight">thermostat services</span> for better control',
                'intro' => array(
                    'Thermostat service covers more than installation alone. We handle thermostat repair, replacement, and smart-control upgrades for homeowners whose HVAC performance feels inconsistent or inefficient.',
                    'The right thermostat, wired and configured correctly, makes a real difference in comfort, efficiency, and daily system control — whether the job involves a new smart thermostat, troubleshooting, or replacement.'
                ),
                'features' => array(
                    array('title' => 'Thermostat Installation', 'body' => 'New thermostat setup can improve control, comfort, and ease of use.'),
                    array('title' => 'Thermostat Repair', 'body' => 'Faulty controls can mimic larger HVAC problems and deserve dedicated service.'),
                    array('title' => 'Programmable Controls', 'body' => 'Smarter schedules help reduce waste and improve convenience.'),
                    array('title' => 'System Compatibility', 'body' => 'Controls should match the heating and cooling system they serve.'),
                    array('title' => 'Comfort Accuracy', 'body' => 'Calibration and performance issues can affect the whole HVAC experience.'),
                    array('title' => 'Upgrade-Friendly Service', 'body' => 'Pairing a control upgrade with new equipment? We handle both in the same visit.')
                ),
                'cards' => array(
                    array('title' => 'AC Installation', 'body' => 'New cooling systems often benefit from better thermostat controls.', 'link' => 'ac-installation'),
                    array('title' => 'Heating Installation', 'body' => 'Heating upgrades frequently include thermostat replacement or setup.', 'link' => 'heating-installation'),
                    array('title' => 'AC Repair', 'body' => 'Some apparent AC failures originate in thermostat problems.', 'link' => 'ac-repair'),
                    array('title' => 'Heating Repair', 'body' => 'Thermostat issues can also look like heater or furnace trouble.', 'link' => 'heating-repair')
                ),
                'panel_one' => array(
                    'label' => 'Control Upgrade',
                    'title' => 'Fix thermostat issues before they become bigger HVAC frustrations',
                    'body' => 'A misreading or failing thermostat can run up bills and mask real equipment problems. A quick service visit rules it out before frustration sets in.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Thermostat Service'
                ),
                'panel_two' => array(
                    'label' => 'System Pairing',
                    'title' => 'Upgrading equipment? Upgrade the controls with it',
                    'body' => 'New AC or heating equipment performs best with a thermostat that speaks its language. Bundling the two saves a second service visit.',
                    'link' => 'ac-installation',
                    'link_text' => 'View AC Installation'
                ),
                'faq' => array(
                    array('q' => 'What thermostat services do you provide?', 'a' => 'Installation, replacement, repair, and smart or programmable upgrades, along with the wiring and compatibility checks your HVAC system needs.'),
                    array('q' => 'Can a bad thermostat make my AC or heater act up?', 'a' => 'Yes. Faulty sensors, wiring issues, or poor placement can cause short cycling, uneven temperatures, and comfort complaints that look like equipment failures.'),
                    array('q' => 'Which smart thermostats do you install?', 'a' => 'We install and configure the major brands, including Nest, ecobee, and Honeywell, and we confirm compatibility with your system before recommending one.'),
                    array('q' => 'How do I schedule thermostat service?', 'a' => 'Request an estimate online or call us. Most thermostat visits are quick, and we can usually pair them with other service you already have planned.')
                ),
            ),
            'programmable-thermostats-installation-austin-tx' => array(
                'hero_chip' => 'Control Upgrade',
                'hero_title' => 'Programmable Thermostats Installation in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Programmable Thermostats Installation',
                'intro_title' => 'Install <span class="highlight">programmable thermostats</span> for smarter home comfort',
                'intro' => array(
                    'Programmable thermostats give homeowners more control over comfort, energy use, and day-to-day HVAC performance. Upgrading from a manual thermostat can make it easier to stay comfortable while reducing wasted heating and cooling.',
                    'These systems let you build schedules around your routine, maintain a more consistent indoor temperature, and take advantage of newer control features without constantly adjusting settings by hand.'
                ),
                'features' => array(
                    array('title' => 'Energy Savings', 'body' => 'Programmable schedules can reduce unnecessary runtime and help control rising utility costs.'),
                    array('title' => 'Routine-Based Scheduling', 'body' => 'Set temperatures around work hours, sleep, and time away from home for more efficient operation.'),
                    array('title' => 'Consistent Comfort', 'body' => 'A better control strategy helps reduce hot and cold spots and keeps the home closer to your preferred temperature.'),
                    array('title' => 'Zoned System Support', 'body' => 'Programmable thermostats can pair well with zoned heating and cooling setups for more precise comfort.'),
                    array('title' => 'Modern Control Features', 'body' => 'Many upgrades include Wi-Fi connectivity and other user-friendly control options.'),
                    array('title' => 'Professional Installation', 'body' => 'Correct placement, setup, and system compatibility checks help the thermostat perform the way it should.')
                ),
                'cards' => array(
                    array('title' => 'Thermostat Services', 'body' => 'General thermostat repair and replacement options are available too.', 'link' => 'thermostat-services'),
                    array('title' => 'AC Installation', 'body' => 'New cooling equipment often pairs naturally with control upgrades.', 'link' => 'ac-installation'),
                    array('title' => 'Heating Installation', 'body' => 'Heating projects are another strong time to upgrade thermostat controls.', 'link' => 'heating-installation'),
                    array('title' => 'HVAC Maintenance Plan', 'body' => 'Ongoing system care helps keep comfort and efficiency improvements working over time.', 'link' => 'hvac-maintenance-plan-austin-tx')
                ),
                'panel_one' => array(
                    'label' => 'Comfort Upgrade',
                    'title' => 'Replace manual control with a thermostat that works around your routine',
                    'body' => 'If you want easier scheduling, better comfort management, and a more efficient HVAC routine, programmable thermostat installation is a practical next step.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Expert Setup',
                    'title' => 'Avoid DIY wiring mistakes and install the right control the first time',
                    'body' => 'Professional installation gets the thermostat choice, placement, and wiring right the first time — and avoids the repair bills DIY mistakes cause.',
                    'link' => 'thermostat-services',
                    'link_text' => 'View Thermostat Services'
                ),
                'faq' => array(
                    array('q' => 'Why install a programmable thermostat?', 'a' => 'Programmable thermostats help reduce wasted energy, improve convenience, and maintain a more consistent comfort schedule throughout the day.'),
                    array('q' => 'Do programmable thermostats help with high energy bills?', 'a' => 'They can. Better scheduling and less manual over-adjustment often help reduce unnecessary heating and cooling runtime.'),
                    array('q' => 'Should a programmable thermostat be installed professionally?', 'a' => 'Professional installation helps confirm compatibility, wiring, placement, and correct setup for the HVAC system.'),
                    array('q' => 'What is the difference between programmable and smart thermostats?', 'a' => 'Programmable models follow the schedules you set. Smart thermostats also learn your patterns, adjust remotely from your phone, and report energy use. We can help you decide which fits your routine.')
                ),
            ),
            'ductwork-services' => array(
                'hero_chip' => 'Airflow Service',
                'hero_title' => 'Ductwork Services in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Ductwork Services',
                'intro_title' => 'Improve airflow with <span class="highlight">ductwork services</span>',
                'intro' => array(
                    'Poor airflow, comfort imbalance, and damaged duct runs are problems of their own — separate from equipment breakdowns — and they call for airflow-specific help.',
                    'Alpine Heating & Air Conditioning handles duct installation, duct repair, vent work, and sealing to help improve airflow, reduce waste, and support more even comfort throughout the home.'
                ),
                'features' => array(
                    array('title' => 'Duct Installation', 'body' => 'New or adjusted duct runs help support proper airflow and system performance.'),
                    array('title' => 'Duct Repair', 'body' => 'Damaged or leaking ducts can reduce comfort and waste conditioned air.'),
                    array('title' => 'Vent Work', 'body' => 'Supply and return adjustments can support more balanced comfort.'),
                    array('title' => 'Air Duct Sealing', 'body' => 'Sealing can improve airflow, efficiency, and room-to-room consistency.'),
                    array('title' => 'Comfort Balancing', 'body' => 'Uneven temperatures and weak airflow often trace back to the duct system.'),
                    array('title' => 'IAQ Support', 'body' => 'Duct condition also affects cleanliness and indoor air circulation.')
                ),
                'cards' => array(
                    array('title' => 'Indoor Air Quality', 'body' => 'Duct performance and air quality are closely linked.', 'link' => 'indoor-air-quality'),
                    array('title' => 'AC Repair', 'body' => 'Some cooling complaints are actually duct and airflow problems.', 'link' => 'ac-repair'),
                    array('title' => 'Heating Repair', 'body' => 'Uneven heat can also point back to the duct system.', 'link' => 'heating-repair'),
                    array('title' => 'Humidity Control', 'body' => 'Whole-home comfort improves when airflow and moisture are handled together.', 'link' => 'humidity-control')
                ),
                'panel_one' => array(
                    'label' => 'Airflow',
                    'title' => 'Fix comfort problems that equipment-only service misses',
                    'body' => 'Poor airflow and uneven comfort often start in the duct system, so these issues deserve clear service options of their own.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Ductwork Service'
                ),
                'panel_two' => array(
                    'label' => 'Comfort Upgrade',
                    'title' => 'Better ducts support air quality and system performance',
                    'body' => 'Better ducts can improve comfort, efficiency, and indoor air quality at the same time.',
                    'link' => 'indoor-air-quality',
                    'link_text' => 'View IAQ Services'
                ),
                'faq' => array(
                    array('q' => 'What ductwork services do you provide?', 'a' => 'Duct installation, duct repair, vent work, air duct sealing, airflow improvement, and comfort balancing throughout the home.'),
                    array('q' => 'Could my comfort problem be ductwork rather than the AC or furnace?', 'a' => 'Often, yes. Weak airflow, uneven rooms, and rising bills frequently trace to leaking or poorly routed ducts rather than the equipment itself.'),
                    array('q' => 'Do you offer duct sealing?', 'a' => 'Yes. Sealing leaky ducts is one of the most cost-effective ways to improve airflow, efficiency, and room-to-room consistency.'),
                    array('q' => 'How do I get my ducts evaluated?', 'a' => 'Request an estimate or airflow evaluation and we will inspect the duct system and explain your options.')
                ),
            ),
            'humidity-control' => array(
                'hero_chip' => 'Air Quality Service',
                'hero_title' => 'Humidity Control in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Humidity Control',
                'intro_title' => 'Balanced <span class="highlight">humidity control</span> for healthier comfort',
                'intro' => array(
                    'Humidity control is one of the most important parts of indoor comfort because moisture levels affect how the air feels, how hard your HVAC system works, and how healthy the home feels overall.',
                    'If your home feels damp, dry, musty, or uncomfortable no matter the thermostat setting, moisture management is often the missing piece.'
                ),
                'features' => array(
                    array('title' => 'Moisture Balance', 'body' => 'Humidity control helps keep indoor air more comfortable year-round.'),
                    array('title' => 'Dehumidifier Support', 'body' => 'Dedicated moisture reduction can improve indoor comfort and air feel.'),
                    array('title' => 'Mold Prevention Support', 'body' => 'Balanced humidity helps reduce conditions that encourage mold growth.'),
                    array('title' => 'Whole-Home Comfort', 'body' => 'Moisture levels affect how air feels, not just how it measures on a thermostat.'),
                    array('title' => 'IAQ Integration', 'body' => 'Humidity work pairs naturally with broader indoor air quality improvements.'),
                    array('title' => 'Healthier Indoor Conditions', 'body' => 'Balanced indoor moisture supports healthier, cleaner, and more comfortable everyday living.')
                ),
                'cards' => array(
                    array('title' => 'Indoor Air Quality', 'body' => 'Humidity control is one of the strongest IAQ support services.', 'link' => 'indoor-air-quality'),
                    array('title' => 'Ductwork Services', 'body' => 'Airflow and distribution affect how humidity feels throughout a home.', 'link' => 'ductwork-services'),
                    array('title' => 'AC Maintenance', 'body' => 'Cooling performance and humidity comfort often overlap strongly.', 'link' => 'ac-maintenance'),
                    array('title' => 'Thermostat Services', 'body' => 'The right controls make day-to-day comfort easier to manage.', 'link' => 'thermostat-services')
                ),
                'panel_one' => array(
                    'label' => 'Moisture Control',
                    'title' => 'Treat humidity as a real comfort and air-quality issue',
                    'body' => 'Humidity problems can make a house feel damp, stale, or uncomfortable even when the thermostat says the temperature is fine.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Humidity Evaluation'
                ),
                'panel_two' => array(
                    'label' => 'Related IAQ',
                    'title' => 'Humidity is one part of the indoor air picture',
                    'body' => 'Filtration, purification, airflow, and moisture control all work together — we can help you see the whole picture.',
                    'link' => 'indoor-air-quality',
                    'link_text' => 'View Indoor Air Quality'
                ),
                'faq' => array(
                    array('q' => 'What humidity problems can you fix?', 'a' => 'Damp or muggy rooms, overly dry winter air, musty odors, condensation, and comfort problems tied to moisture imbalance.'),
                    array('q' => 'Why does humidity matter so much for comfort?', 'a' => 'Moisture levels change how air feels, how hard your HVAC system works, and how healthy the home is — even when the temperature reads fine.'),
                    array('q' => 'Do you install whole-home dehumidifiers?', 'a' => 'Yes. Dedicated dehumidification is one of the strongest tools for balancing indoor moisture in Central Texas homes.'),
                    array('q' => 'How do I get help with humidity issues?', 'a' => 'Request a humidity evaluation or an indoor air consultation and we will recommend the right solution for your home.')
                ),
            ),
            'air-filtration' => array(
                'hero_chip' => 'Air Quality Service',
                'hero_title' => 'Air Filtration in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Air Filtration',
                'intro_title' => 'Cleaner air starts with better <span class="highlight">air filtration</span>',
                'intro' => array(
                    'The filter in your HVAC system is the first line of defense against dust, pollen, pet dander, and airborne particles that circulate through your home every day.',
                    'We help Austin homeowners upgrade from basic filters to filtration systems matched to their equipment, their allergies, and the way their household actually lives.'
                ),
                'features' => array(
                    array('title' => 'Filter Upgrades', 'body' => 'Move beyond basic fiberglass filters to media filters that capture far more of what floats through your air.'),
                    array('title' => 'Allergy Relief', 'body' => 'Higher-efficiency filtration reduces pollen, dander, and dust that trigger allergy and asthma symptoms.'),
                    array('title' => 'Right-Fit Selection', 'body' => 'Filter efficiency must match your system airflow — too restrictive is as bad as too loose. We size it correctly.'),
                    array('title' => 'Whole-Home Coverage', 'body' => 'Media cabinets and return-air filtration treat all the air your system moves, not just one room.'),
                    array('title' => 'Equipment Protection', 'body' => 'Clean coils and blower assemblies last longer and run more efficiently behind good filtration.'),
                    array('title' => 'Simple Maintenance', 'body' => 'We set a replacement schedule that fits the filter type, so performance never quietly slips.')
                ),
                'cards' => array(
                    array('title' => 'Indoor Air Quality', 'body' => 'Filtration is one piece of a complete indoor air quality strategy.', 'link' => 'indoor-air-quality'),
                    array('title' => 'Air Purification', 'body' => 'Purifiers neutralize contaminants that filters alone cannot capture.', 'link' => 'air-purification'),
                    array('title' => 'Humidity Control', 'body' => 'Balanced moisture rounds out what better filtration starts.', 'link' => 'humidity-control'),
                    array('title' => 'AC Maintenance', 'body' => 'Regular tune-ups keep filtration and airflow working together properly.', 'link' => 'ac-maintenance')
                ),
                'panel_one' => array(
                    'label' => 'Cleaner Air',
                    'title' => 'Breathe easier with filtration matched to your home',
                    'body' => 'If dust returns the day after cleaning or allergies flare indoors, your filtration is the first place to look. We will assess it and recommend the right upgrade.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Filtration Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Complete Picture',
                    'title' => 'Pair filtration with purification for full coverage',
                    'body' => 'Filters capture particles; purifiers handle the odors, germs, and vapors that slip through. Together they cover what no single product can.',
                    'link' => 'indoor-air-quality',
                    'link_text' => 'View Indoor Air Quality'
                ),
                'faq' => array(
                    array('q' => 'What air filtration options do you install?', 'a' => 'Media filter cabinets, high-MERV pleated filters, and return-air filtration upgrades sized to your system, plus guidance on the right efficiency for your home.'),
                    array('q' => 'Will a better filter help with allergies?', 'a' => 'Usually, yes. Higher-efficiency filters capture much more pollen, pet dander, and fine dust than the basic filters most systems come with.'),
                    array('q' => 'Can a filter be too strong for my system?', 'a' => 'Yes. An overly restrictive filter starves the system of airflow and hurts performance. We match filter efficiency to what your blower can handle.'),
                    array('q' => 'How often should filters be replaced?', 'a' => 'Basic filters monthly, quality pleated filters every two to three months, and media cabinet filters roughly twice a year. We will set the right schedule for yours.')
                ),
            ),
            'air-purification' => array(
                'hero_chip' => 'Air Quality Service',
                'hero_title' => 'Air Purification in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Air Purification',
                'intro_title' => 'Whole-home <span class="highlight">air purification</span> beyond filtration',
                'intro' => array(
                    'Filters capture particles, but odors, smoke, viruses, bacteria, and chemical vapors call for a different tool. Whole-home air purifiers treat the air your HVAC system moves through every room.',
                    'We install and service purification systems for Austin homes dealing with lingering odors, allergy pressure, or air that simply never feels fresh.'
                ),
                'features' => array(
                    array('title' => 'Whole-Home Purifiers', 'body' => 'In-duct purification treats all conditioned air, not just the room where a portable unit sits.'),
                    array('title' => 'Odor Reduction', 'body' => 'Cooking, pet, and musty odors are neutralized at the source instead of being masked.'),
                    array('title' => 'Germ Defense', 'body' => 'Purification technologies reduce airborne bacteria and viruses circulating between rooms.'),
                    array('title' => 'Smoke & VOC Help', 'body' => 'Chemical vapors and smoke particles that pass through filters can be addressed with the right purifier.'),
                    array('title' => 'System-Matched Install', 'body' => 'Purifiers are selected and mounted to work with your equipment and duct layout.'),
                    array('title' => 'Low Upkeep', 'body' => 'Most whole-home purifiers need only simple periodic service, which we can fold into maintenance visits.')
                ),
                'cards' => array(
                    array('title' => 'Indoor Air Quality', 'body' => 'See how purification fits into a complete air quality plan.', 'link' => 'indoor-air-quality'),
                    array('title' => 'Air Filtration', 'body' => 'Purifiers work best alongside strong particle filtration.', 'link' => 'air-filtration'),
                    array('title' => 'Ductwork Services', 'body' => 'Clean air needs clean, sealed ducts to travel through.', 'link' => 'ductwork-services'),
                    array('title' => 'Humidity Control', 'body' => 'Balanced moisture completes the healthy-air picture.', 'link' => 'humidity-control')
                ),
                'panel_one' => array(
                    'label' => 'Fresher Air',
                    'title' => 'Stop chasing odors room by room',
                    'body' => 'A whole-home purifier treats the air every time it cycles through the system, so improvement reaches every room without portable units.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Purification Estimate'
                ),
                'panel_two' => array(
                    'label' => 'Layered Approach',
                    'title' => 'Filtration first, purification second',
                    'body' => 'The best results come from pairing good particle filtration with purification. We will help you build the combination that fits your concerns and budget.',
                    'link' => 'air-filtration',
                    'link_text' => 'View Air Filtration'
                ),
                'faq' => array(
                    array('q' => 'How is an air purifier different from a filter?', 'a' => 'Filters physically capture particles. Purifiers neutralize or destroy contaminants — odors, bacteria, viruses, and chemical vapors — that pass through most filters.'),
                    array('q' => 'Do whole-home purifiers really beat portable units?', 'a' => 'For whole-house results, yes. In-duct purifiers treat every room the system serves, while portable units only help the room they sit in.'),
                    array('q' => 'Will a purifier help with cooking or pet odors?', 'a' => 'Yes. Odor reduction is one of the most noticeable day-one improvements homeowners report after installing whole-home purification.'),
                    array('q' => 'How do I choose the right purification system?', 'a' => 'Request an estimate and we will look at your equipment, duct layout, and specific air concerns, then recommend a system that addresses them directly.')
                ),
            ),
            'emergency-hvac-repair' => array(
                'hero_chip' => 'Urgent Service',
                'hero_title' => 'Emergency HVAC Repair in Austin, TX',
                'hero_breadcrumb' => 'Home . Services . Emergency HVAC Repair',
                'intro_title' => 'Rapid <span class="highlight">emergency HVAC repair</span> when comfort cannot wait',
                'intro' => array(
                    'When the AC fails in extreme heat or the heater goes out in winter, you need help fast — not a phone tree and a next-week appointment.',
                    'Our emergency service focuses on fast response, practical help, and a clear path to getting a technician scheduled as quickly as possible.'
                ),
                'features' => array(
                    array('title' => 'Urgent Cooling Breakdowns', 'body' => 'When the AC quits in triple-digit heat, urgent repair comes first.'),
                    array('title' => 'No-Heat Calls', 'body' => 'Heating emergencies get priority response during cold snaps.'),
                    array('title' => 'Fast Scheduling', 'body' => 'Immediate response with practical next steps, from first call to finished repair.'),
                    array('title' => 'Major Brand Support', 'body' => 'We handle urgent repairs across all major brands and system types.'),
                    array('title' => 'Repair First', 'body' => 'Getting your system running again comes first; replacement only enters the conversation when truly needed.'),
                    array('title' => 'Direct Help', 'body' => 'Call or request service online and we will get a technician moving.')
                ),
                'cards' => array(
                    array('title' => 'AC Repair', 'body' => 'For cooling problems that are not urgent yet, see our full AC repair service.', 'link' => 'ac-repair'),
                    array('title' => 'Heating Repair', 'body' => 'Ongoing heater trouble without an outage? Explore full heating repair support.', 'link' => 'heating-repair'),
                    array('title' => 'AC Replacement', 'body' => 'In some emergencies, a failed system turns into replacement planning.', 'link' => 'ac-replacement'),
                    array('title' => 'Heating Replacement', 'body' => 'Emergency heating failures can also become replacement projects.', 'link' => 'heating-replacement')
                ),
                'panel_one' => array(
                    'label' => 'Immediate Help',
                    'title' => 'A direct path from breakdown to booked service',
                    'body' => 'When comfort is suddenly gone, the path from search to booked repair should be simple, clear, and fast.',
                    'link' => 'request-an-estimate-austin-tx',
                    'link_text' => 'Request Emergency Service'
                ),
                'panel_two' => array(
                    'label' => 'After the Repair',
                    'title' => 'After the emergency: maintenance and next steps',
                    'body' => 'Once the immediate problem is handled, the next natural paths are preventive care or replacement if the system is failing repeatedly.',
                    'link' => 'air-conditioning-services',
                    'link_text' => 'View All Services'
                ),
                'faq' => array(
                    array('q' => 'Do you offer emergency HVAC repair in Austin?', 'a' => 'Yes. When cooling fails in extreme heat or the heat goes out in winter, we prioritize urgent calls and get a technician out as quickly as possible.'),
                    array('q' => 'What counts as an HVAC emergency?', 'a' => 'No cooling during a heat wave, no heat in freezing weather, electrical burning smells, refrigerant or water leaks, and any failure that makes the home unsafe or unlivable.'),
                    array('q' => 'Will you push me toward a new system during an emergency?', 'a' => 'No. Repair comes first. Replacement only enters the conversation if the system is failing repeatedly or a repair genuinely is not cost-effective.'),
                    array('q' => 'How do I request emergency service?', 'a' => 'Call us directly for the fastest response, or request service online and mark it as urgent.')
                ),
            ),
        );
    }
}

if (!function_exists('alpine_render_service_page')) {
    function alpine_render_service_page($slug) {
        $pages = alpine_service_page_data();
        if (!isset($pages[$slug])) {
            status_header(404);
            get_header();
            echo '<main class="container py-5"><h1>Service page not found</h1></main>';
            get_footer();
            return;
        }

        $page = $pages[$slug];

        if (function_exists('alpine_overlay_landing_page')) {
            $page = alpine_overlay_landing_page($page, get_queried_object_id(), 'service');
        }

        $service_intro_primary_image = home_url('/wp-content/uploads/2026/03/repair-service.webp');
        $service_intro_secondary_image = home_url('/wp-content/uploads/2026/04/maintenance_img.jpg');
        get_header();
        ?>
<div class="service-page installation-page dedicated-service-page">
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
              <img loading="lazy" decoding="async" src="<?php echo esc_url($service_intro_primary_image); ?>" alt="Alpine technician servicing an HVAC system">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url($service_intro_secondary_image); ?>" alt="Technician walking a homeowner through service options">
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

        <div class="service-panel-grid">
          <article class="service-info-panel">
            <span class="section-pill"><?php echo esc_html($page['panel_one']['label']); ?></span>
            <h3><?php echo esc_html($page['panel_one']['title']); ?></h3>
            <p><?php echo esc_html($page['panel_one']['body']); ?></p>
            <a href="<?php echo esc_url(alpine_service_page_url($page['panel_one']['link'])); ?>" class="btn service-cta-btn"><?php echo esc_html($page['panel_one']['link_text']); ?></a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill"><?php echo esc_html($page['panel_two']['label']); ?></span>
            <h3><?php echo esc_html($page['panel_two']['title']); ?></h3>
            <p><?php echo esc_html($page['panel_two']['body']); ?></p>
            <a href="<?php echo esc_url(alpine_service_page_url($page['panel_two']['link'])); ?>" class="btn service-cta-btn"><?php echo esc_html($page['panel_two']['link_text']); ?></a>
          </article>
        </div>

        <?php if (!empty($page['cards'])) : ?>
          <div class="service-feature-grid service-related-grid">
            <?php foreach ($page['cards'] as $card) : ?>
              <article class="service-feature">
                <span class="service-feature-icon">→</span>
                <div>
                  <h3><a href="<?php echo esc_url(alpine_service_page_url($card['link'])); ?>"><?php echo esc_html($card['title']); ?></a></h3>
                  <p><?php echo esc_html($card['body']); ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($page['faq'])) : ?>
          <?php
          $service_faqs = array();
          foreach ($page['faq'] as $faq) {
              $service_faqs[] = array('question' => $faq['q'], 'answer' => $faq['a']);
          }

          if (function_exists('alpine_render_faq_schema')) {
              alpine_render_faq_schema($service_faqs);
          }
          ?>
          <div class="service-faq-block">
            <h2 class="section-title">Common questions about <?php echo esc_html(strtolower(preg_replace('/\s+in Austin,\s*TX/i', '', $page['hero_title']))); ?></h2>
            <div class="accordion site-faq-accordion" id="servicePageFaq">
              <?php foreach ($service_faqs as $index => $faq) : ?>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="<?php echo esc_attr('service-faq-heading-' . $index); ?>">
                    <button class="accordion-button<?php echo 0 === $index ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="<?php echo esc_attr('#service-faq-item-' . $index); ?>" aria-expanded="<?php echo 0 === $index ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr('service-faq-item-' . $index); ?>">
                      <?php echo esc_html($faq['question']); ?>
                    </button>
                  </h3>
                  <div id="<?php echo esc_attr('service-faq-item-' . $index); ?>" class="accordion-collapse collapse<?php echo 0 === $index ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr('service-faq-heading-' . $index); ?>" data-bs-parent="#servicePageFaq">
                    <div class="accordion-body"><?php echo esc_html($faq['answer']); ?></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

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
