<?php
/**
 * Reusable service area page system.
 */

if (!function_exists('alpine_normalize_service_area_slug')) {
    function alpine_normalize_service_area_slug($slug) {
        $slug = trim((string) $slug, '/');

        $aliases = array(
            'bee-caves-tx' => 'bee-cave-tx',
            'service-areas/bee-caves-tx' => 'service-areas/bee-cave-tx',
        );

        return isset($aliases[$slug]) ? $aliases[$slug] : $slug;
    }
}

if (!function_exists('alpine_service_area_page_url')) {
    function alpine_service_area_page_url($slug) {
        return home_url('/' . alpine_normalize_service_area_slug($slug) . '/');
    }
}

if (!function_exists('alpine_get_service_area_location_url')) {
    function alpine_get_service_area_location_url($slug) {
        $slug = alpine_normalize_service_area_slug($slug);

        if ($slug === '') {
            return home_url('/');
        }

        $candidate_paths = array(
            $slug,
            'service-areas/' . $slug,
        );

        foreach ($candidate_paths as $path) {
            $page = get_page_by_path($path, OBJECT, 'page');

            if ($page instanceof WP_Post) {
                return get_permalink($page);
            }
        }

        return alpine_service_area_page_url('service-areas/' . $slug);
    }
}

if (!function_exists('alpine_get_service_area_internal_links')) {
    function alpine_get_service_area_internal_links() {
        $links = array(
            array(
                'label' => 'Our Services',
                'page_key' => 'services',
            ),
            array(
                'label' => 'Repair Services',
                'preferred_slug' => 'ac-repair',
                'fallback_slugs' => array('heating-repair'),
                'fallback_path' => '/ac-repair/',
            ),
            array(
                'label' => 'Maintenance Plan',
                'page_key' => 'maintenance_plan',
            ),
            array(
                'label' => 'Request an Estimate',
                'page_key' => 'estimate',
            ),
        );

        foreach ($links as &$link) {
            if (!empty($link['page_key']) && function_exists('alpine_get_site_page_url')) {
                $link['url'] = alpine_get_site_page_url($link['page_key']);
                continue;
            }

            if (!empty($link['preferred_slug']) && function_exists('alpine_get_page_url')) {
                $link['url'] = alpine_get_page_url(
                    $link['preferred_slug'],
                    !empty($link['fallback_slugs']) ? $link['fallback_slugs'] : array(),
                    !empty($link['fallback_path']) ? $link['fallback_path'] : '/'
                );
                continue;
            }

            $link['url'] = !empty($link['fallback_path']) ? home_url($link['fallback_path']) : home_url('/');
        }
        unset($link);

        return $links;
    }
}

if (!function_exists('alpine_service_area_locations')) {
    function alpine_service_area_locations() {
        return array(
            'austin-tx' => array(
                'intent_content' => array(
                    'Nobody searches for emergency AC repair in Austin from a comfortable couch. If the system quit during a triple-digit stretch, call us directly — no-cool visits jump the queue, and same-day service is the norm when you reach us before mid-morning.',
                    'We also answer the slower questions: why the upstairs never cools, whether a 14-year-old unit deserves one more repair, and what AC replacement really costs in Austin. Real numbers, a licensed local team, and no pressure to buy anything.',
                ),
                'city' => 'Austin',
                'state' => 'TX',
                'nearby' => array('Downtown Austin', 'South Austin', 'North Austin'),
                'intro' => 'Austin cooling seasons stretch from April into October, and the city\'s housing mix ages equipment unevenly — postwar cottages in the central neighborhoods hide undersized ductwork, while newer builds south of Ben White push big open floor plans onto a single system. Alpine Heating & Air Conditioning handles AC repair, HVAC installation, and maintenance across Austin, TX, wherever your home falls on that spectrum.',
                'meta_description' => 'From Hyde Park bungalows to new builds off Slaughter Lane, Austin, TX homes get responsive AC repair, installation, and maintenance from Alpine.',
                'services' => array(
                    array('title' => 'AC Repair in Austin', 'description' => 'Diagnose warm air, weak airflow, frozen coils, and system failures before peak heat turns them into larger comfort problems.'),
                    array('title' => 'HVAC Installation in Austin', 'description' => 'Replace outdated equipment with systems sized for better efficiency, airflow, and stronger cooling across Austin homes.'),
                    array('title' => 'HVAC Maintenance in Austin', 'description' => 'Seasonal tune-ups help Austin systems run cleaner, reduce surprise breakdowns, and protect long-term performance.'),
                ),
                'cta_body' => 'If you need AC repair, equipment replacement, or seasonal maintenance in Austin, request an estimate and we will get your visit on the calendar quickly.',
                'seasonal_content' => 'Austin summers bring intense heat and high cooling demand that can strain older or poorly maintained systems. Regular maintenance helps ensure your AC unit handles peak demand without breakdowns, while professional repairs address efficiency losses and comfort issues before they become emergencies.',
                'about_area' => 'From historic central Austin neighborhoods to growing suburbs, the Austin area has diverse home types and ages requiring flexible HVAC solutions that balance repair budgets with long-term performance and energy savings.'
            ),
            'bee-cave-tx' => array(
                'intent_content' => array(
                    'Searching for AC repair near me from Bee Cave usually happens on a 100-degree afternoon when the house will not drop below 80. We run the Highway 71 corridor regularly, so same-day AC repair in Bee Cave is realistic, not a marketing line.',
                    'For bigger decisions — AC replacement cost on a larger Hill Country home, zoning that actually works, energy bills that crept up — request an estimate and get numbers specific to your house, not a brochure range.',
                ),
                'city' => 'Bee Cave',
                'state' => 'TX',
                'nearby' => array('Falconhead', 'Spanish Oaks', 'Bee Cave Road corridor'),
                'intro' => 'Out past the Highway 71 corridor, Bee Cave homes sit on exposed Hill Country terrain that soaks up afternoon sun — and cooling systems feel every degree of it. Alpine Heating & Air Conditioning covers Bee Cave, TX with AC repair, installation planning, and preventive maintenance for Falconhead, Spanish Oaks, and the neighborhoods along Bee Cave Road.',
                'meta_description' => 'Hill Country homes from Falconhead to Spanish Oaks trust Alpine for AC repair, installation, and HVAC maintenance in Bee Cave, TX.',
                'services' => array(
                    array('title' => 'AC Repair in Bee Cave', 'description' => 'Target cooling problems early so your system can recover faster during hot west-Austin weather.'),
                    array('title' => 'HVAC Installation in Bee Cave', 'description' => 'Install better-matched equipment for quieter operation, stronger airflow, and improved efficiency.'),
                    array('title' => 'HVAC Maintenance in Bee Cave', 'description' => 'Routine service helps Bee Cave systems stay prepared for heavy daily cooling demand.'),
                ),
                'cta_body' => 'Book HVAC service in Bee Cave, TX if your system needs repair, replacement planning, or preventive maintenance.',
                'seasonal_content' => 'Bee Cave sits in the western hills where elevation and exposure can affect cooling efficiency. Homeowners benefit from systems tuned for the local climate and well-maintained equipment that handles the region\'s temperature variability.',
                'about_area' => 'Located west of central Austin, Bee Cave features upscale neighborhoods and estates that require specialized HVAC solutions. The area\'s proximity to scenic hill country makes reliable climate control important for both comfort and home value.',
            ),
            'cedar-park-tx' => array(
                'intent_content' => array(
                    'AC not cooling in Cedar Park? In neighborhoods built through the 1990s and 2000s, the culprit is often an original system at the end of its run. We diagnose first, quote honestly, and treat emergency AC repair calls as exactly that.',
                    'When repair-versus-replace is the real question, we put both numbers side by side: what this fix costs today against what a new system costs to own. Cedar Park homeowners get the math, then make the call.',
                ),
                'city' => 'Cedar Park',
                'state' => 'TX',
                'nearby' => array('Anderson Mill West', 'Buttercup Creek', 'Twin Creeks'),
                'intro' => 'Much of Cedar Park went up in the 1990s and 2000s, which means a whole generation of original HVAC systems is now reaching the end of its working life. Alpine Heating & Air Conditioning provides AC repair, honest repair-or-replace guidance, and maintenance in Cedar Park, TX — including Anderson Mill West, Buttercup Creek, and Twin Creeks.',
                'meta_description' => 'Get AC repair, installation, and HVAC maintenance in Cedar Park, TX from Alpine Heating & Air Conditioning - emergency service available.',
                'seasonal_content' => 'Cedar Park sits in a fast-growing area where newer construction and regular home turnover create steady demand for cooling upgrades and repair service. The Texas heat and humidity mean air conditioning systems work harder here than in many northern climates.',
                'about_area' => 'As a northern Austin suburb, Cedar Park attracts families and professionals who need HVAC systems that keep up for both established neighborhoods and newer developments. Many homes require system upgrades to handle the full-year cooling and heating demands of Central Texas.',
            ),
            'cedar-valley-tx' => array(
                'intent_content' => array(
                    'Living outside the core does not shrink your options. Cedar Valley sits inside our standard service area, so emergency AC repair, seasonal tune-ups, and full replacements all come with the same scheduling as an Austin address.',
                    'If you have been putting off a failing system because getting quotes felt like a project, one estimate visit covers sizing, options, and a real AC replacement cost for your property.',
                ),
                'city' => 'Cedar Valley',
                'state' => 'TX',
                'nearby' => array('Southwest Travis County', 'Dripping Springs approach', 'Rural residential areas'),
                'intro' => 'Cedar Valley sits southwest of Austin, where homes are more spread out and the cooling season is every bit as long. Alpine Heating & Air Conditioning brings AC repair, installation, and maintenance to Cedar Valley, TX — living outside the city core shouldn\'t mean waiting longer for a technician.',
                'meta_description' => 'Southwest Travis County properties get full HVAC coverage — AC repair, installation, and maintenance in Cedar Valley, TX without the long wait.',
                'seasonal_content' => 'Cedar Valley\'s more rural setting means HVAC systems can be particularly critical for comfort and family well-being. Regular maintenance helps prevent unexpected breakdowns that might be harder to address in less densely populated areas.',
                'about_area' => 'Cedar Valley represents Austin\'s suburban growth into Travis County hill country, offering larger properties and a more relaxed lifestyle. Homeowners here need reliable HVAC professionals they can trust for both routine service and emergency repairs.',
            ),
            'hutto-tx' => array(
                'intent_content' => array(
                    'A lot of Hutto homes are young enough that a failed AC feels premature — but builder-grade systems working through their first hard summers fail earlier than they should. We handle warranty-age diagnostics, honest repairs, and same-day emergency calls.',
                    'Before you accept a big repair bill on a young system, get a second opinion. Sometimes the right fix costs hundreds less; sometimes the smart move is an upgrade the first system should have been.',
                ),
                'city' => 'Hutto',
                'state' => 'TX',
                'nearby' => array('Star Ranch', 'Riverwalk', 'Brushy Creek edge'),
                'intro' => 'Hutto has grown fast, and its newer subdivisions are full of builder-grade systems working through their first hard Texas summers. Alpine Heating & Air Conditioning serves Hutto, TX with AC repair, installation upgrades, and the routine maintenance that keeps a young system from aging before its time.',
                'meta_description' => 'Responsive AC repair, HVAC installation, and maintenance for Hutto, TX families, from Star Ranch to Riverwalk and the growing neighborhoods nearby.',
                'seasonal_content' => 'Hutto\'s growth as a family-oriented community means many newer homes with modern HVAC systems that benefit from preventive maintenance. Keeping these systems well-maintained helps homeowners avoid costly repairs during peak cooling season.',
                'about_area' => 'Located northeast of Austin, Hutto has experienced rapid residential growth with many family neighborhoods. Homeowners appreciate HVAC service providers who can handle both newer system installations and older equipment maintenance.',
            ),
            'lakeway-tx' => array(
                'intent_content' => array(
                    'When the AC gives out on a July weekend in Lakeway, waiting until Monday is not a plan. Emergency AC repair calls from the Lakeway and Lake Travis area get priority routing, and most no-cool visits happen the same day.',
                    'Lake humidity, hillside lots, and larger zoned homes also change the replacement conversation — AC replacement cost in Lakeway depends on zoning and sizing more than brand. An in-home estimate settles the real number in one visit.',
                ),
                'city' => 'Lakeway',
                'state' => 'TX',
                'nearby' => array('Rough Hollow', 'Old Lakeway', 'Serene Hills'),
                'intro' => 'Between lake humidity and hillside lots, Lakeway homes ask more of their HVAC systems than most. Alpine Heating & Air Conditioning handles AC repair, replacement planning, installation, and maintenance in Lakeway, TX, keeping homes near Lake Travis comfortable through the long cooling season.',
                'meta_description' => 'Keep your Lake Travis home comfortable year-round: AC repair, HVAC installation, and maintenance in Lakeway, TX from Rough Hollow to Serene Hills.',
                'seasonal_content' => 'Lakeway\'s proximity to Lake Travis creates unique microclimates where humidity levels can vary from nearby areas. Properly sized and maintained air conditioning systems ensure comfort despite the area\'s environmental conditions.',
                'about_area' => 'Lakeway is a resort-style community with many larger homes and properties where HVAC systems need to handle both residential comfort and entertaining spaces. Homeowners appreciate quality system installations and reliable maintenance support.',
            ),
            'leander-tx' => array(
                'intent_content' => array(
                    'Leander splits between brand-new builds still under warranty and early-2000s homes facing their first big HVAC decision. We service both: warranty-age diagnostics on one street, repair-or-replace math on the next.',
                    'Need help fast? Same-day AC repair in Leander is routine for our crews working the 183 corridor. Need help deciding? Estimates are free and the recommendation comes with numbers, not pressure.',
                ),
                'city' => 'Leander',
                'state' => 'TX',
                'nearby' => array('Crystal Falls', 'Travisso', 'Block House Creek'),
                'intro' => 'Leander\'s growth has produced a housing stock that runs from brand-new builds to early-2000s homes facing their first major HVAC decisions. Alpine Heating & Air Conditioning serves Leander, TX with AC repair, installation, and maintenance for every stage of that curve — including the awkward years when repair and replacement both look reasonable.',
                'meta_description' => 'From Crystal Falls to Travisso, Leander, TX homes count on Alpine for AC repair, HVAC installation, and maintenance as the city keeps growing.',
                'seasonal_content' => 'Leander\'s rapid growth means many neighborhoods have homes of different ages with varying HVAC system types. Professional service providers who understand both newer and older systems are valuable for maintaining comfort across the diverse community.',
                'about_area' => 'Located northwest of Austin, Leander combines suburban convenience with growth opportunities. Homeowners range from those with newly built homes to those with established properties, all requiring quality HVAC support.',
            ),
            'lost-creek-tx' => array(
                'intent_content' => array(
                    'Lost Creek homeowners rarely search twice — the first HVAC company either shows up fast and works clean, or it does not get a second call. Emergency AC repair here gets same-day priority, and our technicians handle zoned and high-end systems as everyday work.',
                    'For aging equipment, we quote replacement with real specifics: sizing for the actual house, zoning that matches how you live in it, and a cost figure you can hold us to.',
                ),
                'city' => 'Lost Creek',
                'state' => 'TX',
                'nearby' => array('Lost Creek Boulevard area', 'Westlake edge', 'Barton Creek approach'),
                'intro' => 'Tucked into the wooded hills off Loop 360, Lost Creek pairs heavy shade and established homes with HVAC systems that have seen a few Texas summers. Alpine Heating & Air Conditioning serves Lost Creek, TX with AC repair, installation, and maintenance — close enough to treat the neighborhood like home turf.',
                'meta_description' => 'Premium AC repair, HVAC installation, and maintenance for Lost Creek, TX homes near the Westlake and Barton Creek corridors.',
                'seasonal_content' => 'Lost Creek\'s upscale residential character means homeowners expect premium HVAC service with professional technicians who take pride in quality work and customer service.',
                'about_area' => 'Lost Creek is an exclusive neighborhood where many properties feature high-end homes requiring sophisticated HVAC systems. Residents appreciate service providers who understand their community\'s standards for comfort and reliability.',
            ),
            'manor-tx' => array(
                'intent_content' => array(
                    'For many Manor homeowners this is the first house — and the first dead AC. Here is the short version: diagnostic first, a clear price before any work, and same-day emergency AC repair when the house is genuinely cooking.',
                    'If the quote turns out to be a replacement conversation, financing options can spread the cost, and we will tell you plainly whether the old unit is worth saving. No scare tactics on a young family budget.',
                ),
                'city' => 'Manor',
                'state' => 'TX',
                'nearby' => array('ShadowGlen', 'Presidential Meadows', 'Greenbury'),
                'intro' => 'Manor\'s newer neighborhoods east of Austin are full of first-time homeowners who want a cooling problem fixed without the runaround. Alpine Heating & Air Conditioning provides AC repair, new installation support, and preventive maintenance in Manor, TX with straight answers and easy scheduling.',
                'meta_description' => 'ShadowGlen, Presidential Meadows, and the communities east of Austin: Manor, TX families get straight-shooting AC repair, installation, and maintenance.',
                'seasonal_content' => 'Manor\'s growing residential communities mean many homeowners are building equity in their properties and want long-lasting HVAC systems to protect their investment and ensure family comfort.',
                'about_area' => 'Manor is an emerging residential area east of Austin where families appreciate practical home solutions and service that shows up on time. Growing neighborhoods support strong demand for both new installation and ongoing maintenance services.',
            ),
            'pflugerville-tx' => array(
                'intent_content' => array(
                    'Pflugerville has a wave of 1990s and 2000s systems all aging out at once, which is why AC not cooling is the most common call we get from this zip code every summer. Repairs are prioritized by urgency — no heat and no cooling always come first.',
                    'If your repair bills are stacking up, ask for the replacement comparison: what you have spent, what the next failure likely costs, and what a right-sized new system runs in Pflugerville. Five minutes of math usually makes the decision obvious.',
                ),
                'city' => 'Pflugerville',
                'state' => 'TX',
                'nearby' => array('Falcon Pointe', 'Blackhawk', 'Avalon'),
                'intro' => 'Plenty of Pflugerville homes date to the 1990s and 2000s, and their original systems are hitting the age where small repairs start stacking up. Alpine Heating & Air Conditioning serves Pflugerville, TX with AC repair, straight repair-or-replace guidance, installation, and maintenance that heads off the surprise breakdowns.',
                'meta_description' => 'Professional AC repair, HVAC installation, and maintenance in Pflugerville, TX. Emergency service available for heating and cooling issues.',
                'seasonal_content' => 'Pflugerville experiences the same intense summer cooling demands as central Austin but also needs heating that holds up through occasional winter cold snaps. A well-maintained HVAC system helps manage both seasons efficiently while keeping utility costs predictable.',
                'about_area' => 'Located east of Austin, Pflugerville has grown significantly with newer residential areas and established neighborhoods. Homeowners here need reliable HVAC service providers who understand both modern and older system installations.',
            ),
            'rollingwood-tx' => array(
                'intent_content' => array(
                    'Rollingwood is minutes from our daily routes, so emergency AC repair here rarely waits. If the system died in an August heat wave, call — same-day service is the usual outcome, not the exception.',
                    'Established homes here often have older equipment that still has life in it. We repair what deserves repairing and give a straight replacement number when it does not, so you are never guessing which side of the line you are on.',
                ),
                'city' => 'Rollingwood',
                'state' => 'TX',
                'nearby' => array('Rollingwood Drive area', 'West Lake corridor', 'Zilker edge'),
                'intro' => 'Rollingwood may be a small enclave beside Zilker Park, but its homes face the same brutal cooling season as the rest of Austin. Alpine Heating & Air Conditioning serves Rollingwood, TX with AC repair, installation, and maintenance — and the quick response a close-in neighborhood expects.',
                'meta_description' => 'Established Rollingwood, TX homes along the West Lake corridor near Zilker get expert AC repair, HVAC installation, and system upgrades.',
                'seasonal_content' => 'Rollingwood\'s established residential character means many homes have aging HVAC systems that benefit from experienced service and thoughtful upgrade planning.',
                'about_area' => 'Rollingwood is a charming established community where homeowners value long-term relationships with trusted service providers who understand their neighborhoods and care about quality work.',
            ),
            'round-rock-tx' => array(
                'intent_content' => array(
                    'July is when Round Rock systems quit, and July is when we run priority routing for no-cool calls. Emergency AC repair in Round Rock means a technician on the way, a diagnosis you can understand, and a price before the work starts.',
                    'For systems past their prime, the replacement question deserves real numbers: most Round Rock homeowners land between the entry and mid-tier ranges, and an in-home estimate turns that range into a figure for your actual house.',
                ),
                'city' => 'Round Rock',
                'state' => 'TX',
                'nearby' => array('Teravista', 'Forest Creek', 'Brushy Creek'),
                'intro' => 'When a system quits in Round Rock in July, the fix has to come fast — and if it\'s an older unit, the next conversation is usually repair versus replace. Alpine Heating & Air Conditioning serves Round Rock, TX with AC repair, clear-eyed replacement planning, installation, and maintenance.',
                'meta_description' => 'Same-day HVAC help in Round Rock, TX — Alpine Heating & Air Conditioning handles AC repair, installation, and maintenance across the city.',
                'seasonal_content' => 'Round Rock summers can be particularly harsh on air conditioning systems, especially as the area continues rapid growth. Professional maintenance and timely repairs help extend equipment life and prevent mid-summer breakdowns during peak heat.',
                'about_area' => 'As a major north Austin suburb with strong tech industry presence, Round Rock includes both newer and established residential communities. Homeowners need HVAC service that can keep pace with their busy schedules and home comfort needs.',
            ),
            'sunset-valley-tx' => array(
                'intent_content' => array(
                    'Sunset Valley sits inside south Austin, which means AC repair near me searches here reach a company whose trucks are already close. No-cool calls get same-day priority through the summer.',
                    'High summer bills are the other common call — usually an aging unit, leaky ducts, or a system that was never sized right. A tune-up finds which one is costing you money, and fixing it usually costs less than the bills it stops.',
                ),
                'city' => 'Sunset Valley',
                'state' => 'TX',
                'nearby' => array('Brodie Lane area', 'South Lamar edge', 'Oak Hill corridor'),
                'intro' => 'Sunset Valley sits entirely inside south Austin, so residents sometimes wonder whether \'Austin\' service areas really reach them. They do — Alpine Heating & Air Conditioning provides AC repair, installation, and maintenance in Sunset Valley, TX, minutes from anywhere in the metro.',
                'meta_description' => 'Minutes from Brodie Lane and the Oak Hill corridor, Sunset Valley, TX homes get quick AC repair, HVAC installation, and seasonal maintenance.',
                'seasonal_content' => 'Sunset Valley\'s south-central Austin location means homes face substantial cooling demands during long summers. Well-maintained systems ensure efficient performance and lower energy costs throughout the season.',
                'about_area' => 'Sunset Valley offers a mix of established neighborhoods with strong community character. Homeowners appreciate HVAC service providers who are familiar with the area\'s housing stock and community needs.',
            ),
            'the-hills-tx' => array(
                'intent_content' => array(
                    'Bigger homes, zoned systems, and country-club schedules — HVAC service in The Hills has to show up on time and know its way around multi-zone equipment. Ours does, and urgent no-cool calls get routed ahead of routine work.',
                    'Replacement planning here is mostly a sizing and zoning exercise: get those right and comfort plus operating cost follow. Get an in-home estimate for a real number instead of a generic range.',
                ),
                'city' => 'The Hills',
                'state' => 'TX',
                'nearby' => array('The Hills Country Club area', 'Lakeway edge', 'Lake Travis communities'),
                'intro' => 'Homes in The Hills, the golf-course community near Lakeway, tend toward larger footprints and zoned systems that reward experienced hands. Alpine Heating & Air Conditioning serves The Hills, TX with AC repair, installation, and maintenance sized to bigger homes and heavier cooling loads.',
                'meta_description' => 'Country club and Lake Travis homes in The Hills, TX get attentive HVAC repair, installation, and maintenance sized for larger, zoned houses.',
                'seasonal_content' => 'The Hills\'s elevated terrain and proximity to Lake Travis create environmental conditions where quality HVAC systems and professional service are particularly valuable for maintaining comfort.',
                'about_area' => 'The Hills is an upscale resort community where golf courses, lakes, and entertainment venues require sophisticated climate control. Residents expect premium HVAC service from knowledgeable professionals.',
            ),
            'volente-tx' => array(
                'intent_content' => array(
                    'Lakeside living is easier on people than on air conditioners — moisture exposure ages outdoor coils faster near the water. Annual maintenance with coil cleaning is the cheap defense, and we build it into every Volente tune-up.',
                    'When something quits mid-summer, Volente is inside our standard emergency AC repair coverage. Call early on hot days and a same-day visit is usually possible.',
                ),
                'city' => 'Volente',
                'state' => 'TX',
                'nearby' => array('Lakeshore homes', 'Anderson Mill approach', 'Lake Travis north shore'),
                'intro' => 'Volente\'s spot on the north shore of Lake Travis means lake humidity and long cooling seasons both shape how HVAC equipment performs. Alpine Heating & Air Conditioning provides AC repair, installation, and maintenance in Volente, TX with those lakeside conditions in mind.',
                'meta_description' => 'Lakeside humidity is hard on cooling equipment — Volente, TX homes on the Lake Travis north shore get AC repair and maintenance built for it.',
                'seasonal_content' => 'Volente\'s Lake Travis location means homes experience lakeside humidity and variable weather patterns that require well-maintained HVAC systems for reliable comfort throughout the year.',
                'about_area' => 'Volente is a scenic lake community where homeowners value both natural beauty and home comfort. HVAC service providers who understand the area\'s unique environmental conditions are highly appreciated.',
            ),
            'west-lake-hills-tx' => array(
                'intent_content' => array(
                    'Custom hillside homes with two systems and long duct runs fail in their own particular ways — an upstairs that will not cool, one zone that never matches the thermostat. We diagnose those properly instead of guessing, and emergency calls get same-day priority.',
                    'Replacement in West Lake Hills is usually staged — one system now, the second on its own schedule — with sizing done for the actual structure. Ask for the two-system plan and real costs up front.',
                ),
                'city' => 'West Lake Hills',
                'state' => 'TX',
                'nearby' => array('Davenport Ranch', 'Rob Roy', 'Bee Cave Road corridor'),
                'intro' => 'West Lake Hills pairs hillside terrain and mature oaks with larger custom homes — and HVAC systems that have to be sized and serviced to match. Alpine Heating & Air Conditioning serves West Lake Hills, TX with AC repair, HVAC installation, and maintenance suited to how these homes are actually built.',
                'meta_description' => 'Davenport Ranch, Rob Roy, and the Bee Cave Road corridor: West Lake Hills, TX custom homes get AC repair and HVAC service to match the house.',
                'seasonal_content' => 'West Lake Hills\'s proximity to expanding Austin and high home values mean residents invest in quality HVAC systems and appreciate professional maintenance that protects their properties.',
                'about_area' => 'West Lake Hills is an established upscale community where homes feature quality construction and sophisticated systems. Homeowners expect HVAC service providers who match their community\'s standards for professionalism and performance.',
            ),
        );
    }
}

if (!function_exists('alpine_get_service_area_location')) {
    function alpine_get_service_area_location($slug = null) {
        $locations = alpine_service_area_locations();

        if (null === $slug) {
            $slug = get_query_var('pagename');

            if (!$slug && is_page()) {
                $post = get_queried_object();
                if ($post && !empty($post->post_name)) {
                    $slug = $post->post_name;
                }
            }
        }

        $slug = alpine_normalize_service_area_slug($slug);

        return isset($locations[$slug]) ? $locations[$slug] : null;
    }
}

if (!function_exists('alpine_get_service_area_page_config')) {
    function alpine_get_service_area_page_config($slug = null) {
        $location = alpine_get_service_area_location($slug);

        if (!$location) {
            return null;
        }

        $city = $location['city'];
        $state = $location['state'];

        return array(
            'slug' => $slug ?: get_query_var('pagename'),
            'city' => $city,
            'state' => $state,
            'title' => 'HVAC Services in ' . $city . ', ' . $state,
            'h1' => 'HVAC Services in ' . $city . ', ' . $state,
            'intro' => !empty($location['intro']) ? $location['intro'] : $city . ' homeowners face the same long Central Texas cooling season as the rest of the Austin area, and their systems need the same steady care. Alpine Heating & Air Conditioning provides AC repair, installation, and maintenance in ' . $city . ', ' . $state . ' with clear recommendations and responsive scheduling.',
            'meta_description' => !empty($location['meta_description']) ? $location['meta_description'] : 'Alpine Heating & Air Conditioning provides AC repair, installation, and maintenance in ' . $city . ', ' . $state . '. Get responsive local HVAC service for year-round home comfort.',
            'services' => !empty($location['services']) ? $location['services'] : alpine_service_area_default_services($city, $slug),
            'intent_content' => !empty($location['intent_content']) ? $location['intent_content'] : array(),
            'internal_links' => alpine_get_service_area_internal_links(),
            'nearby' => $location['nearby'],
            'cta_title' => 'Need HVAC service in ' . $city . ', ' . $state . '?',
            'cta_body' => !empty($location['cta_body']) ? $location['cta_body'] : alpine_service_area_default_cta($city, $slug),
            'cta_label' => 'Request Estimate',
            'cta_url' => alpine_get_site_page_url('estimate'),
        );
    }
}

if (!function_exists('alpine_service_area_default_services')) {
    /**
     * Default service cards for cities without hand-written ones. Four rotating
     * variants (picked deterministically per slug) keep the copy from repeating
     * verbatim across every city page.
     */
    function alpine_service_area_default_services($city, $slug) {
        $v = abs(crc32((string) $city)) % 4;

        $repair = array(
            sprintf('Weak airflow, warm air, and short cycling all have causes a technician can pin down — we find and fix them before %s heat turns them into breakdowns.', $city),
            sprintf('From frozen coils to failed capacitors, we track down why the cooling stopped and get %s homes comfortable again fast.', $city),
            sprintf('When the AC quits on a %s summer afternoon, we diagnose the actual fault and repair it right the first time.', $city),
            sprintf('Cooling trouble in %s rarely fixes itself. We trace the cause — airflow, refrigerant, controls — and repair it before it grows.', $city),
        );
        $install = array(
            sprintf('Aging equipment gets replaced with a system sized for your %s home, not a one-size guess — better comfort and lower bills follow.', $city),
            sprintf('We match new systems to square footage, ductwork, and how your household actually runs the AC in %s.', $city),
            sprintf('A right-sized installation cools a %s home evenly, runs quieter, and costs less to operate summer after summer.', $city),
            sprintf('From load calculation through startup testing, new %s systems go in tuned for efficiency and comfort that lasts.', $city),
        );
        $maintain = array(
            sprintf('A spring tune-up ahead of %s cooling season catches worn parts while they are still cheap to fix.', $city),
            sprintf('Seasonal maintenance keeps %s systems efficient, bills predictable, and surprise breakdowns rare.', $city),
            sprintf('Clean coils, tested components, verified airflow — the unglamorous work that spares %s homes an expensive summer.', $city),
            sprintf('Regular tune-ups extend equipment life and keep small issues in %s homes from becoming July emergencies.', $city),
        );

        return array(
            array('title' => 'AC Repair in ' . $city, 'description' => $repair[$v]),
            array('title' => 'HVAC Installation in ' . $city, 'description' => $install[($v + 1) % 4]),
            array('title' => 'HVAC Maintenance in ' . $city, 'description' => $maintain[($v + 2) % 4]),
        );
    }
}

if (!function_exists('alpine_service_area_default_cta')) {
    function alpine_service_area_default_cta($city, $slug) {
        $v = abs(crc32('cta' . (string) $city)) % 4;
        $ctas = array(
            sprintf('Ready to get your %s home comfortable again? Request an estimate and we will take it from there.', $city),
            sprintf('Tell us what your system is doing — or not doing — and we will schedule the right visit for your %s home.', $city),
            sprintf('From quick repairs to full replacement planning, the next step for your %s home starts with a simple estimate request.', $city),
            sprintf('Get a clear price and an honest recommendation for your %s home — request an estimate today.', $city),
        );
        return $ctas[$v];
    }
}

if (!function_exists('alpine_is_service_area_page')) {
    function alpine_is_service_area_page() {
        return (bool) alpine_get_service_area_page_config();
    }
}

if (!function_exists('alpine_render_service_area_template')) {
    function alpine_render_service_area_template($config = null) {
        $page = $config ? wp_parse_args($config, alpine_get_service_area_page_config()) : alpine_get_service_area_page_config();

        if (!$page) {
            status_header(404);
            get_template_part('404');
            return;
        }

        if (function_exists('alpine_overlay_landing_page')) {
            $page = alpine_overlay_landing_page($page, get_queried_object_id(), 'service_area');
        }

        if (empty($page['h1']) && !empty($page['headline'])) {
            $page['h1'] = $page['headline'];
        }

        get_header();
        // LocalBusiness JSON-LD is emitted sitewide from inc/seo-tags.php, with
        // areaServed narrowed to this city — no per-template schema block needed.
        ?>
<main class="service-page installation-page service-area-template-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div class="hero-copy">
        <span class="hero-chip">Service Area</span>
        <h1><?php echo esc_html($page['h1']); ?></h1>
        <p class="hero-subtext"><?php echo esc_html('Local HVAC support for homeowners in ' . $page['city'] . ', ' . $page['state'] . '.'); ?></p>
        <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Service Areas', 'url' => function_exists('alpine_get_site_page_url') ? alpine_get_site_page_url('service_areas') : home_url('/service-areas/')),
            array('label' => $page['city'] . ', ' . $page['state']),
        )); ?>
      </div>
      <article class="hero-sidecard">
        <strong>Air Conditioning and Heating Specialists</strong>
        <p>Repair, installation, and maintenance support tailored to <?php echo esc_html($page['city']); ?> homes.</p>
      </article>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>

  <section class="section-space">
    <div class="container">
      <div class="service-copy-wrap service-area-stack">
        <section class="service-area-intro-card">
          <div class="service-area-intro-copy">
            <span class="section-pill">Local HVAC Support</span>
            <h2 class="section-title">Reliable heating and cooling in <span class="highlight"><?php echo esc_html($page['city']); ?></span></h2>
            <p class="service-intro"><?php echo esc_html($page['intro']); ?></p>
          </div>
          <div class="service-area-intro-points" aria-label="<?php echo esc_attr( $page['city'] . ' service highlights' ); ?>">
            <span>Repair</span>
            <span>Installation</span>
            <span>Maintenance</span>
            <span><?php echo esc_html( $page['city'] ); ?> Coverage</span>
          </div>
        </section>

        <section class="service-area-section service-area-services">
          <div class="service-area-section-head">
            <span class="section-pill">Core Services</span>
            <h2 class="section-title">HVAC services in <span class="highlight"><?php echo esc_html($page['city']); ?></span></h2>
          </div>
          <div class="service-feature-grid mt-4">
            <?php foreach ($page['services'] as $service) : ?>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3><?php echo esc_html($service['title']); ?></h3>
                  <p><?php echo esc_html($service['description']); ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>

        <section class="service-area-section service-area-links">
          <div class="service-area-section-head">
            <span class="section-pill">Explore More</span>
            <h2 class="section-title">Helpful internal links</h2>
          </div>
          <div class="service-overview-grid mt-4">
            <?php foreach ($page['internal_links'] as $link) : ?>
              <article class="service-overview-card">
                <div>
                  <h3><?php echo esc_html($link['label']); ?></h3>
                  <p><?php echo esc_html('Explore related HVAC information and next steps for ' . $page['city'] . ', ' . $page['state'] . '.'); ?></p>
                  <a href="<?php echo esc_url($link['url']); ?>">Visit Page</a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>

        <?php if ( !empty($page['seasonal_content']) || !empty($page['about_area']) ) : ?>
        <section class="service-area-context-grid">
          <?php if ( !empty($page['seasonal_content']) ) : ?>
          <article class="service-area-context-card seasonal-content-section">
            <span class="section-pill">Seasonal Focus</span>
            <h2 class="section-title">HVAC Seasonal Considerations in <span class="highlight"><?php echo esc_html($page['city']); ?></span></h2>
            <p class="service-intro"><?php echo esc_html($page['seasonal_content']); ?></p>
          </article>
          <?php endif; ?>

          <?php if ( !empty($page['about_area']) ) : ?>
          <article class="service-area-context-card about-area-section">
            <span class="section-pill">Local Context</span>
            <h2 class="section-title">About the <span class="highlight"><?php echo esc_html($page['city']); ?></span> Area</h2>
            <p class="service-intro"><?php echo esc_html($page['about_area']); ?></p>
          </article>
          <?php endif; ?>
        </section>
        <?php endif; ?>

        <?php if ( !empty($page['intent_content']) ) : ?>
        <section class="service-area-section service-area-intent">
          <div class="service-area-section-head">
            <span class="section-pill">When You Need Us Fast</span>
            <h2 class="section-title">HVAC help <span class="highlight"><?php echo esc_html($page['city']); ?></span> homeowners search for</h2>
          </div>
          <?php foreach ((array) $page['intent_content'] as $intent_paragraph) : ?>
            <p class="service-intro"><?php echo esc_html($intent_paragraph); ?></p>
          <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php
        $city_faqs = function_exists('alpine_get_service_area_faq_set') ? alpine_get_service_area_faq_set($page['slug']) : array();
        if (!empty($city_faqs)) :
            if (function_exists('alpine_render_faq_schema')) {
                alpine_render_faq_schema($city_faqs);
            }
        ?>
        <section class="service-area-section service-area-faq">
          <div class="service-area-section-head">
            <span class="section-pill">Local Answers</span>
            <h2 class="section-title">Common HVAC questions in <span class="highlight"><?php echo esc_html($page['city']); ?></span></h2>
          </div>
          <div class="accordion site-faq-accordion mt-4" id="cityFaqAccordion">
            <?php foreach ($city_faqs as $faq_index => $faq) : ?>
              <div class="accordion-item">
                <h3 class="accordion-header" id="<?php echo esc_attr('city-faq-heading-' . $faq_index); ?>">
                  <button class="accordion-button<?php echo 0 === $faq_index ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="<?php echo esc_attr('#city-faq-item-' . $faq_index); ?>" aria-expanded="<?php echo 0 === $faq_index ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr('city-faq-item-' . $faq_index); ?>">
                    <?php echo esc_html($faq['question']); ?>
                  </button>
                </h3>
                <div id="<?php echo esc_attr('city-faq-item-' . $faq_index); ?>" class="accordion-collapse collapse<?php echo 0 === $faq_index ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr('city-faq-heading-' . $faq_index); ?>" data-bs-parent="#cityFaqAccordion">
                  <div class="accordion-body"><?php echo isset($faq['answer_html']) ? wp_kses_post($faq['answer_html']) : esc_html(isset($faq['answer']) ? $faq['answer'] : ''); ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>

        <section class="service-area-section service-area-nearby">
          <div class="service-area-section-head">
            <span class="section-pill">Nearby Coverage</span>
            <h2 class="section-title">Areas served around <span class="highlight"><?php echo esc_html($page['city']); ?></span></h2>
          </div>
          <div class="service-feature-grid mt-4">
            <?php foreach ($page['nearby'] as $nearby_index => $nearby) : ?>
              <?php
              $nearby_lines = array(
                  'We serve %1$s too — the same AC repair, installation, and maintenance coverage as %2$s.',
                  'Located in %1$s? You are inside our regular service area, with the same scheduling as %2$s.',
                  'Crews working in %2$s are minutes from %1$s — repair, installation, and maintenance included.',
              );
              $nearby_line = sprintf($nearby_lines[$nearby_index % count($nearby_lines)], $nearby, $page['city']);
              ?>
              <article class="service-feature">
                <span class="service-feature-icon">•</span>
                <div>
                  <h3><?php echo esc_html($nearby); ?></h3>
                  <p><?php echo esc_html($nearby_line); ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>


        <section class="service-info-panel service-info-panel-alt service-area-cta-panel">
          <span class="section-pill">Request Service</span>
          <h2 class="section-title"><?php echo esc_html($page['cta_title']); ?></h2>
          <p class="service-intro"><?php echo esc_html($page['cta_body']); ?></p>
          <a href="<?php echo esc_url($page['cta_url']); ?>" class="btn service-cta-btn"><?php echo esc_html($page['cta_label']); ?></a>
        </section>
      </div>
    </div>
  </section>
</main>
<?php
        get_footer();
    }
}
