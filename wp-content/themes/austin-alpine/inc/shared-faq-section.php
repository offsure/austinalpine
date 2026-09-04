<?php
/**
 * Shared FAQ section markup.
 */

if ( ! function_exists( 'alpine_get_service_area_faq_sets' ) ) {
	/**
	 * Per-city FAQ sets (cost, sizing, urgency). Rendered on the city pages
	 * with FAQPage schema; keys are bare city slugs like 'lakeway-tx'.
	 */
	function alpine_get_service_area_faq_sets() {
		return array(
			'austin-tx' => array(
				array(
					'question'    => 'How much does AC repair cost in Austin, TX?',
					'answer_html' => '<p>The cost of AC repair in Austin, TX typically ranges from $150 to $1,200, depending on the type of issue and how long your system has been running under Texas heat conditions. Smaller issues like capacitor replacements or thermostat fixes fall on the lower end, while more complex problems like refrigerant leaks, blower motor failures, or compressor issues can push costs well over $1,500.</p><p>In Austin specifically, pricing is influenced by:</p><ul><li>Extreme summer demand (May-September)</li><li>Longer system run times compared to other states</li><li>Older systems still using outdated refrigerants</li><li>Accessibility challenges (tight attics, older homes)</li></ul><p>If your system is over 10-12 years old, repair costs can climb quickly because parts wear out faster in this climate.</p><p><strong>What it really means for you:</strong> A properly repaired AC system restores more than airflow. It brings your home back to a place where you can relax, sleep comfortably, and escape the Austin heat without thinking about your system again.</p>',
				),
				array(
					'question'    => 'What does it cost to replace an HVAC system in Austin?',
					'answer_html' => '<p>A full HVAC system replacement in Austin, TX typically costs between $9,000 and $14,000, with high-efficiency or larger systems ranging from $14,000 to $20,000+.</p><p>The biggest cost drivers include:</p><ul><li>Square footage of your home</li><li>Energy efficiency rating (SEER2)</li><li>Condition of existing ductwork</li><li>Installation complexity</li></ul><p>Many homeowners underestimate the importance of installation quality. In Austin&#8217;s climate, a poorly installed system can struggle even if the equipment is top-tier.</p><p>Replacing your HVAC system is not just about cooling. It is about designing a system that can handle consistent 100+ degree temperatures without overworking.</p><p><strong>What it really means for you:</strong> A new HVAC system gives you consistent comfort throughout your home. No hot spots, no constant adjustments, just a reliable environment where your home feels like a true escape from the outside heat.</p>',
				),
				array(
					'question'    => 'Why is my AC not keeping up with Austin heat?',
					'answer_html' => '<p>If your air conditioner is not keeping up in Austin, it is usually due to one of four issues:</p><ul><li>The system is undersized for your home</li><li>Airflow is restricted (dirty coils, duct issues)</li><li>Insulation is not sufficient for Texas heat</li><li>The system is aging or losing efficiency</li></ul><p>Austin homes, especially in older neighborhoods like Tarrytown or Central Austin, often have ductwork or insulation issues that prevent proper cooling, even if the AC unit itself is working.</p><p>Another key factor is design temperature. Most systems are built to maintain a 20-degree difference from outside air, so when it is 105 degrees Fahrenheit, your system may struggle to keep interiors below the mid-70s if not properly configured.</p><p><strong>What it really means for you:</strong> When your system is working correctly, your home becomes a place to recharge. Stepping inside feels instantly cooler, calmer, and more controlled no matter how intense the heat is outside.</p>',
				),
				array(
					'question'    => 'When should I replace instead of repair my AC in Austin?',
					'answer_html' => '<p>For homeowners in Austin, the repair vs. replace decision usually comes down to:</p><ul><li>System age: 10-15 years is replacement range</li><li>Repair cost: If it exceeds 30-40% of replacement cost</li><li>Frequency of breakdowns</li></ul><p>Because Austin systems run so frequently, older units decline faster than in cooler climates. What might be a repairable system elsewhere often becomes inefficient and unreliable here.</p><p>If your system struggles to maintain temperature or your energy bills are rising, replacement is often the smarter financial decision long-term.</p><p><strong>What it really means for you:</strong> Choosing replacement at the right time means fewer disruptions, fewer emergency calls, and a home that stays consistently comfortable without you having to think about it.</p>',
				),
			),
			'round-rock-tx' => array(
				array(
					'question'    => 'What size AC system do I need for a home in Round Rock?',
					'answer_html' => '<p>The right AC size for a Round Rock home typically falls between 2.5 and 5 tons, but sizing depends on more than square footage.</p><p>Important factors include:</p><ul><li>Home layout and ceiling height</li><li>Sun exposure and window placement</li><li>Insulation quality</li><li>Air leakage</li></ul><p>Many newer homes in Round Rock are more energy-efficient, which means they may require smaller systems than older homes of the same size.</p><p>A proper Manual J load calculation is the only accurate way to size a system. Anything else is guesswork.</p><p><strong>What it really means for you:</strong> When your system is sized correctly, every room feels right. No hot bedrooms, no cold spots, just a balanced home that feels comfortable throughout the day.</p>',
				),
				array(
					'question'    => 'How much does a new HVAC system cost in Round Rock?',
					'answer_html' => '<p>A new HVAC system in Round Rock, TX typically costs between $8,500 and $13,500, depending on system efficiency, home size, and installation requirements.</p><p>Factors that impact pricing:</p><ul><li>Energy efficiency upgrades</li><li>Smart thermostat integration</li><li>Ductwork repairs or modifications</li><li>System zoning options</li></ul><p>Because Round Rock has a mix of newer and expanding neighborhoods, installation complexity can vary significantly.</p><p><strong>What it really means for you:</strong> A properly installed system does not just cool your home. It creates a consistent environment where your family can relax comfortably without worrying about rising energy costs.</p>',
				),
				array(
					'question'    => 'Will a new AC system lower my energy bill in Round Rock?',
					'answer_html' => '<p>Yes. Upgrading to a modern system can reduce energy costs by 20% to 40%, especially if your current unit is over 10 years old.</p><p>New systems are built with:</p><ul><li>Higher SEER2 efficiency ratings</li><li>Variable-speed technology</li><li>Improved airflow management</li></ul><p>In a Texas climate where cooling is your largest energy expense, efficiency improvements make a noticeable difference.</p><p><strong>What it really means for you:</strong> Lower bills combined with better comfort means your home feels easier to live in. Less stress, more predictability, and more value from your investment.</p>',
				),
				array(
					'question'    => 'How long do HVAC systems last in Round Rock?',
					'answer_html' => '<p>In Central Texas, most HVAC systems last 10 to 15 years due to extended cooling seasons.</p><p>Factors that shorten lifespan:</p><ul><li>Heavy summer usage</li><li>Lack of regular maintenance</li><li>Poor initial installation</li></ul><p>Even well-maintained systems begin to lose efficiency after about 10 years.</p><p><strong>What it really means for you:</strong> Understanding your system&#8217;s lifespan helps you plan ahead, so your home stays comfortable without sudden breakdowns disrupting your routine.</p>',
				),
			),
			'cedar-park-tx' => array(
				array(
					'question'    => 'Is it better to repair or replace my HVAC system in Cedar Park?',
					'answer_html' => '<p>If your system is relatively new and the issue is minor, repair is usually the best option. However, if your system is older and repairs are becoming frequent, replacement often provides better long-term value.</p><p>Key considerations:</p><ul><li>Age of system</li><li>Repair frequency</li><li>Energy efficiency</li></ul><p>In Cedar Park, where homes often prioritize efficiency, upgrading can deliver noticeable improvements.</p><p><strong>What it really means for you:</strong> A dependable system means fewer surprises, just a home that stays comfortable without constant interruptions.</p>',
				),
				array(
					'question'    => 'How much should I budget for HVAC replacement in Cedar Park?',
					'answer_html' => '<p>Most homeowners in Cedar Park should budget between $9,000 and $14,000 for a full HVAC system replacement.</p><p>Costs vary based on:</p><ul><li>System efficiency</li><li>Home size</li><li>Installation complexity</li></ul><p>Investing in a properly installed system ensures long-term reliability.</p><p><strong>What it really means for you:</strong> It is an investment that pays off every day, in comfort, energy savings, and the confidence that your home is running the way it should.</p>',
				),
				array(
					'question'    => 'Are heat pumps a good option in Cedar Park?',
					'answer_html' => '<p>Yes. Heat pumps are an excellent option in Cedar Park due to the region&#8217;s mild winters and long cooling season.</p><p>Benefits include:</p><ul><li>Energy efficiency</li><li>Dual heating and cooling capability</li><li>Lower operational costs</li></ul><p>They are especially effective in well-insulated homes.</p><p><strong>What it really means for you:</strong> A single system handling everything means simpler living, consistent comfort without overthinking your setup.</p>',
				),
				array(
					'question'    => 'Why are my summer energy bills so high in Cedar Park?',
					'answer_html' => '<p>High energy bills are usually caused by:</p><ul><li>Inefficient HVAC systems</li><li>Poor insulation</li><li>Air leaks or duct issues</li></ul><p>In Texas, cooling costs dominate energy usage, so even small inefficiencies add up quickly.</p><p><strong>What it really means for you:</strong> Fixing these issues gives you a home that stays cool without draining your wallet, making comfort feel effortless instead of expensive.</p>',
				),
			),
			'bee-cave-tx' => array(
				array(
					'question'    => 'How much does HVAC replacement cost in Bee Cave, TX?',
					'answer_html' => '<p>In Bee Cave, HVAC replacement costs are typically higher than the Austin average due to larger homes and more complex system requirements. Most homeowners invest between $12,000 and $20,000+, especially for high-efficiency or multi-zone systems.</p><p>Key cost drivers in Bee Cave include:</p><ul><li>Larger square footage requiring higher tonnage systems</li><li>Zoned cooling for multiple levels or wings</li><li>Custom ductwork or retrofits in high-end homes</li><li>Premium efficiency systems to manage long-term energy costs</li></ul><p><strong>What it really means for you:</strong> A properly designed system ensures your entire home, not just parts of it, stays cool and comfortable, protecting the investment you have made in a high-value property.</p>',
				),
				array(
					'question'    => 'Why is cooling a home in Bee Cave more expensive?',
					'answer_html' => '<p>Homes in Bee Cave are often larger, more open, and have more sun exposure, all of which increase cooling demand.</p><p>Other factors include:</p><ul><li>High ceilings and open layouts</li><li>Expansive windows</li><li>Multiple living areas requiring balanced airflow</li></ul><p>These homes require systems that are not just powerful, but properly engineered.</p><p><strong>What it really means for you:</strong> When your system is built correctly, every room feels right, turning a large home into a consistently comfortable living space instead of a constant battle with temperature.</p>',
				),
				array(
					'question'    => 'What type of HVAC system works best for homes in Bee Cave?',
					'answer_html' => '<p>For Bee Cave homes, high-efficiency systems with zoning are often the best solution.</p><p>Recommended setups include:</p><ul><li>Variable-speed systems</li><li>Zoned HVAC systems</li><li>Smart thermostats for multiple areas</li></ul><p>These systems allow better control across larger spaces.</p><p><strong>What it really means for you:</strong> Instead of adjusting temperatures constantly, your home adapts to you, delivering comfort exactly where and when you need it.</p>',
				),
				array(
					'question'    => 'Is upgrading to a high-efficiency HVAC system worth it in Bee Cave?',
					'answer_html' => '<p>Yes, especially in larger homes where energy usage is higher.</p><p>High-efficiency systems:</p><ul><li>Reduce monthly energy costs</li><li>Improve temperature consistency</li><li>Extend system lifespan</li></ul><p>In Bee Cave, the savings and comfort gains are more noticeable due to home size.</p><p><strong>What it really means for you:</strong> You get a home that feels consistently comfortable without the shock of high utility bills, combining luxury with efficiency.</p>',
				),
			),
			'lakeway-tx' => array(
				array(
					'question'    => 'How much does AC repair cost in Lakeway, TX?',
					'answer_html' => '<p>Most AC repairs in Lakeway fall between $150 and $1,200, depending on the issue. Larger repairs like compressors or coils can exceed $2,000.</p><p>Factors affecting cost:</p><ul><li>System age</li><li>Lakeway&#8217;s summer heat load</li><li>Accessibility and installation setup</li></ul><p>Because systems run heavily during summer, wear and tear accumulates quickly.</p><p><strong>What it really means for you:</strong> A timely repair restores comfort fast, so your home stays a place to relax, not somewhere you are constantly adjusting to stay cool.</p>',
				),
				array(
					'question'    => 'Why does my AC run constantly in Lakeway summers?',
					'answer_html' => '<p>Lakeway summers push HVAC systems hard, and constant operation is often caused by:</p><ul><li>Undersized systems</li><li>Poor insulation</li><li>Duct leakage</li><li>Aging equipment</li></ul><p>Many homes near the lake also deal with additional heat exposure and humidity.</p><p><strong>What it really means for you:</strong> Fixing the root issue means your home cools efficiently, giving you a space that feels calm and controlled, even during peak heat.</p>',
				),
				array(
					'question'    => 'What does it cost to replace an HVAC system in Lakeway?',
					'answer_html' => '<p>Most homeowners in Lakeway spend between $9,000 and $15,000, depending on system efficiency and home size.</p><p>Costs can increase with:</p><ul><li>Larger homes</li><li>Upgraded systems</li><li>Ductwork modifications</li></ul><p><strong>What it really means for you:</strong> A new system gives you reliable, even cooling, turning your home into a place where comfort is consistent, not something you have to manage.</p>',
				),
				array(
					'question'    => 'When is the best time to replace an AC system in Lakeway?',
					'answer_html' => '<p>The best time is fall through early spring, when demand is lower and scheduling is easier.</p><p>Benefits include:</p><ul><li>Better pricing opportunities</li><li>More flexible installation timelines</li><li>Proper system design without rush</li></ul><p><strong>What it really means for you:</strong> Planning ahead ensures your home is ready before the heat hits, so comfort is not something you have to worry about later.</p>',
				),
			),
			'hutto-tx' => array(
				array(
					'question'    => 'How much does HVAC replacement cost in Hutto, TX?',
					'answer_html' => '<p>In Hutto, most HVAC replacements range from $8,500 to $13,500, depending on system type and home size.</p><p>Costs are influenced by:</p><ul><li>New construction vs older homes</li><li>Efficiency upgrades</li><li>Installation requirements</li></ul><p><strong>What it really means for you:</strong> A properly installed system keeps your home comfortable without overworking, helping you protect your investment and avoid unnecessary costs.</p>',
				),
				array(
					'question'    => 'Why are my energy bills high in Hutto during summer?',
					'answer_html' => '<p>High energy bills are often caused by:</p><ul><li>Inefficient HVAC systems</li><li>Poor insulation</li><li>Duct leakage</li></ul><p>In Texas, cooling accounts for the majority of energy usage, so inefficiencies show up quickly.</p><p><strong>What it really means for you:</strong> Fixing these issues gives you a home that stays cool without constant high bills, making comfort feel affordable and consistent.</p>',
				),
				array(
					'question'    => 'What size AC system do I need for a home in Hutto?',
					'answer_html' => '<p>Most homes in Hutto require 2.5 to 4 tons, depending on layout and efficiency.</p><p>Sizing depends on:</p><ul><li>Square footage</li><li>Insulation</li><li>Sun exposure</li></ul><p><strong>What it really means for you:</strong> The right size system means no hot rooms and no wasted energy, just a home that feels evenly comfortable throughout.</p>',
				),
				array(
					'question'    => 'How long do HVAC systems last in Hutto?',
					'answer_html' => '<p>Most systems last 10-15 years, with heavy summer usage shortening lifespan.</p><p>Proper maintenance can extend system life, but performance declines over time.</p><p><strong>What it really means for you:</strong> Knowing your system&#8217;s lifespan helps you plan ahead, so your home stays comfortable without unexpected breakdowns.</p>',
				),
			),
			'leander-tx' => array(
				array(
					'question'    => 'How much does a new HVAC system cost in Leander, TX?',
					'answer_html' => '<p>Most homeowners in Leander spend between $8,500 and $13,500 for a full HVAC replacement.</p><p>Pricing depends on:</p><ul><li>Home size</li><li>Efficiency level</li><li>Installation complexity</li></ul><p><strong>What it really means for you:</strong> A new system delivers consistent comfort, making your home feel like a place to relax, not manage temperatures.</p>',
				),
				array(
					'question'    => 'Will upgrading my HVAC system reduce energy costs in Leander?',
					'answer_html' => '<p>Yes. Newer systems can reduce energy usage by 20-40%, especially if replacing older units.</p><p>Modern systems use:</p><ul><li>Variable-speed technology</li><li>Improved airflow design</li><li>Higher efficiency ratings</li></ul><p><strong>What it really means for you:</strong> Lower bills combined with better comfort makes your home easier to live in, with fewer surprises each month.</p>',
				),
				array(
					'question'    => 'Why is my AC struggling in Leander heat?',
					'answer_html' => '<p>Common causes include:</p><ul><li>Undersized systems</li><li>Airflow restrictions</li><li>Aging equipment</li></ul><p>Leander&#8217;s rapid growth means many homes vary in build quality, affecting HVAC performance.</p><p><strong>What it really means for you:</strong> Fixing these issues gives you a home that cools properly, turning hot days into something you do not have to think about.</p>',
				),
				array(
					'question'    => 'Should I repair or replace my HVAC system in Leander?',
					'answer_html' => '<p>If your system is older or repairs are frequent, replacement is usually the better long-term choice.</p><p><strong>What it really means for you:</strong> A reliable system means fewer interruptions and a home that stays comfortable without constant attention.</p>',
				),
			),
			'manor-tx' => array(
				array(
					'question'    => 'How much does AC repair cost in Manor, TX?',
					'answer_html' => '<p>Most AC repairs in Manor range from $150 to $1,200, depending on the issue.</p><p>Costs depend on:</p><ul><li>Type of repair</li><li>System age</li><li>Seasonal demand</li></ul><p><strong>What it really means for you:</strong> A quick repair restores comfort, so your home stays cool and livable even during peak heat.</p>',
				),
				array(
					'question'    => 'What does HVAC replacement cost in Manor?',
					'answer_html' => '<p>Most homeowners spend between $8,000 and $13,000 for a full system replacement.</p><p><strong>What it really means for you:</strong> A new system ensures your home stays comfortable without rising costs or ongoing issues.</p>',
				),
				array(
					'question'    => 'Why is my AC running constantly in Manor?',
					'answer_html' => '<p>This is often caused by:</p><ul><li>Inefficient systems</li><li>Poor insulation</li><li>High outdoor temperatures</li></ul><p><strong>What it really means for you:</strong> Fixing it means your home cools faster and runs more efficiently, giving you a space that feels comfortable without constant strain.</p>',
				),
				array(
					'question'    => 'Is a heat pump a good option in Manor, TX?',
					'answer_html' => '<p>Yes. Heat pumps perform well in Manor due to mild winters and high cooling demand.</p><p><strong>What it really means for you:</strong> One system handling both heating and cooling simplifies your home, delivering consistent comfort year-round.</p>',
				),
			),
			'pflugerville-tx' => array(
				array(
					'question'    => 'How much does HVAC replacement cost in Pflugerville?',
					'answer_html' => '<p>Most HVAC replacements in Pflugerville range from $8,500 to $13,500, depending on system efficiency and home size.</p><p><strong>What it really means for you:</strong> A properly installed system keeps your home comfortable without overworking, making your space feel reliable and easy to live in.</p>',
				),
				array(
					'question'    => 'Why are my cooling costs high in Pflugerville?',
					'answer_html' => '<p>High costs are usually due to:</p><ul><li>Older systems</li><li>Poor insulation</li><li>Duct inefficiencies</li></ul><p><strong>What it really means for you:</strong> Addressing these issues gives you a home that stays cool without high monthly bills, turning comfort into something predictable.</p>',
				),
				array(
					'question'    => 'What size HVAC system do I need in Pflugerville?',
					'answer_html' => '<p>Most homes require 2.5 to 5 tons, depending on layout and insulation.</p><p><strong>What it really means for you:</strong> Correct sizing ensures every room feels right, creating a balanced, comfortable home environment.</p>',
				),
				array(
					'question'    => 'How long do HVAC systems last in Pflugerville?',
					'answer_html' => '<p>Most systems last 10-15 years in Texas conditions.</p><p><strong>What it really means for you:</strong> Planning ahead keeps your home comfortable and avoids sudden disruptions.</p>',
				),
			),
			'cedar-valley-tx' => array(
				array(
					'question'    => 'How much does AC repair cost in Cedar Valley, TX?',
					'answer_html' => '<p>Most AC repairs in Cedar Valley run between $150 and $1,200 depending on the fault. Capacitors, contactors, and thermostat issues sit at the low end; refrigerant leaks and motor failures cost more.</p><p><strong>What it really means for you:</strong> Living southwest of the city does not mean paying city-emergency premiums. You get the same pricing and the same repair standards as any Austin address.</p>',
				),
				array(
					'question'    => 'Do you offer same-day AC repair near Cedar Valley?',
					'answer_html' => '<p>Yes. No-cool calls get priority, and Cedar Valley is inside our regular coverage — not an add-on zone. In summer, calling before mid-morning gives you the best shot at a same-day visit.</p>',
				),
				array(
					'question'    => 'Is it worth replacing an older AC on a Cedar Valley property?',
					'answer_html' => '<p>Once a system passes 10 to 15 years, or a single repair reaches 30-40% of replacement cost, replacement usually wins. Larger rural properties often gain the most because oversized or undersized old equipment wastes the most energy.</p>',
				),
			),
			'lost-creek-tx' => array(
				array(
					'question'    => 'What does AC replacement cost for a Lost Creek home?',
					'answer_html' => '<p>Lost Creek homes trend larger than the Austin average, so budgets run $10,000 to $16,000 for most projects and higher for multi-zone or high-efficiency setups.</p><p><strong>What it really means for you:</strong> The number depends on the house, not a price sheet — an in-home estimate pins it down in one visit.</p>',
				),
				array(
					'question'    => 'Can you service zoned or high-end HVAC systems in Lost Creek?',
					'answer_html' => '<p>Yes. Zoned systems, variable-speed equipment, and multi-system homes are routine work for our technicians, including diagnostics on dampers and zone boards that general handymen will not touch.</p>',
				),
				array(
					'question'    => 'How fast can you reach Lost Creek for emergency AC repair?',
					'answer_html' => '<p>Lost Creek sits minutes off Loop 360, so urgent no-cool calls are usually reached the same day during normal demand and prioritized during heat waves.</p>',
				),
			),
			'rollingwood-tx' => array(
				array(
					'question'    => 'How much does AC repair cost in Rollingwood?',
					'answer_html' => '<p>Typical repairs land between $150 and $1,200. Rollingwood homes often have older, well-built systems where a targeted repair buys years of additional life — worth checking before assuming replacement.</p>',
				),
				array(
					'question'    => 'My AC is not cooling — how fast can someone get to Rollingwood?',
					'answer_html' => '<p>Fast. Rollingwood is one of the closest communities to our routes, and no-cool calls get bumped to the front of the schedule during summer.</p>',
				),
				array(
					'question'    => 'When should an established Rollingwood home replace instead of repair?',
					'answer_html' => '<p>Watch three signals: the system is 12+ years old, repairs are becoming yearly events, or a single fix exceeds about a third of replacement cost. Any two of those together usually settle the question.</p>',
				),
			),
			'sunset-valley-tx' => array(
				array(
					'question'    => 'Do you cover Sunset Valley for same-day AC repair?',
					'answer_html' => '<p>Yes — Sunset Valley sits inside south Austin, minutes from routes we run daily. Summer no-cool calls are prioritized, and morning calls usually mean same-day service.</p>',
				),
				array(
					'question'    => 'What do AC repairs cost in Sunset Valley?',
					'answer_html' => '<p>The same as the rest of the metro: roughly $150-$350 for quick fixes, $400-$900 for mid-level issues, and $1,000+ when compressors or coils are involved.</p>',
				),
				array(
					'question'    => 'Why are my summer electric bills so high in Sunset Valley?',
					'answer_html' => '<p>Usually some mix of an aging system, dirty coils, duct leakage, or a unit that was never sized right. A tune-up identifies which one is eating your money — often the fix costs far less than the bills it stops.</p>',
				),
			),
			'the-hills-tx' => array(
				array(
					'question'    => 'What does AC replacement cost in The Hills?',
					'answer_html' => '<p>Homes in The Hills are typically larger and often zoned, so most replacements run $12,000 to $18,000, with premium variable-speed systems above that.</p><p><strong>What it really means for you:</strong> Sizing and zoning design matter more than brand at this scale — that is where comfort and operating cost are actually decided.</p>',
				),
				array(
					'question'    => 'Can you maintain zoned systems in The Hills?',
					'answer_html' => '<p>Yes. Multi-zone equipment, dampers, and dual-system homes are standard work, and maintenance visits cover every zone — not just the equipment closet.</p>',
				),
				array(
					'question'    => 'Do you handle urgent AC repair in The Hills?',
					'answer_html' => '<p>Yes. The Lakeway corridor is regular territory for our crews, so urgent no-cool calls in The Hills are reached quickly, usually the same day outside extreme demand spikes.</p>',
				),
			),
			'volente-tx' => array(
				array(
					'question'    => 'Does lake air wear out AC systems faster in Volente?',
					'answer_html' => '<p>It can. Outdoor coils near the water face more moisture exposure, which accelerates corrosion on unprotected equipment. Annual maintenance with coil cleaning is the cheapest defense — and worth asking about coated coils at replacement time.</p>',
				),
				array(
					'question'    => 'How much does AC repair cost in Volente?',
					'answer_html' => '<p>The usual Austin-area ranges apply: $150-$1,200 for most repairs. Corrosion-related coil and electrical issues from lakeside exposure sit toward the upper end.</p>',
				),
				array(
					'question'    => 'Do you reach Volente for emergency AC service?',
					'answer_html' => '<p>Yes. The north shore of Lake Travis is inside our standard coverage. Call early on hot days — lakeside calls get routed with the same priority as any no-cool emergency.</p>',
				),
			),
			'west-lake-hills-tx' => array(
				array(
					'question'    => 'What does AC replacement cost in West Lake Hills?',
					'answer_html' => '<p>Larger custom homes here typically land between $12,000 and $20,000 depending on size, zoning, and efficiency tier. Two-system homes are common and are usually replaced in stages rather than all at once.</p>',
				),
				array(
					'question'    => 'My upstairs will not cool — is that normal for a West Lake Hills home?',
					'answer_html' => '<p>It is common in hillside multi-story homes and almost always fixable: duct balancing, zoning adjustments, or a struggling second system are the usual causes. Diagnosis tells you which before any money is spent.</p>',
				),
				array(
					'question'    => 'Do you offer same-day AC repair in West Lake Hills?',
					'answer_html' => '<p>Yes. West Lake Hills is minutes from central Austin routes, and cooling emergencies get scheduled ahead of routine work throughout the summer.</p>',
				),
			),
		);
	}
}

if ( ! function_exists( 'alpine_get_service_area_faq_set' ) ) {
	function alpine_get_service_area_faq_set( $slug ) {
		$sets = alpine_get_service_area_faq_sets();
		$slug = basename( (string) $slug );

		return isset( $sets[ $slug ] ) ? $sets[ $slug ] : array();
	}
}

if ( ! function_exists( 'alpine_get_sitewide_faq_items' ) ) {
	function alpine_get_sitewide_faq_items() {
		$service_area_slug = null;

		if ( function_exists( 'alpine_is_service_area_page' ) && alpine_is_service_area_page() ) {
			$service_area_slug = get_query_var( 'pagename' );

			if ( ! $service_area_slug && is_page() ) {
				$post = get_queried_object();
				if ( $post && ! empty( $post->post_name ) ) {
					$service_area_slug = $post->post_name;
				}
			}

			if ( function_exists( 'alpine_normalize_service_area_slug' ) ) {
				$service_area_slug = alpine_normalize_service_area_slug( $service_area_slug );
			}
		}

		$service_area_faqs = alpine_get_service_area_faq_sets();

		if ( $service_area_slug && isset( $service_area_faqs[ $service_area_slug ] ) ) {
			return $service_area_faqs[ $service_area_slug ];
		}

		if ( is_front_page() ) {
			return array(
				array(
					'question'    => 'Why do HVAC repairs feel expensive in Austin?',
					'answer_html' => '<p>In Austin, you are not just paying for a quick fix. You are paying for a system that has been under extreme stress for months.</p><p>AC units here run longer than almost anywhere else in the country, especially from late spring through early fall. That constant use wears down key components faster, which means:</p><ul><li>Repairs happen more often</li><li>Failures tend to be more serious</li><li>Demand spikes during peak heat</li></ul><p>You are also paying for:</p><ul><li>Skilled diagnostics</li><li>Reliable parts</li><li>Fast service when you need it most</li></ul><p><strong>What it really means for you:</strong> When your system is fixed the right way, you are not thinking about it anymore. You are walking into a cool home after a long day, sleeping comfortably at night, and not worrying about the next breakdown. That peace of mind inside your home is what you are really investing in.</p>',
				),
				array(
					'question'    => 'What do most homeowners actually pay for AC repairs in Austin?',
					'answer_html' => '<p>In the Austin market, here is what most real repairs look like:</p><ul><li>Quick fixes: $150-$350</li><li>Mid-level issues: $400-$900</li><li>Larger repairs: $1,000-$2,500+</li></ul><p>What drives cost:</p><ul><li>System age</li><li>Refrigerant type</li><li>Summer demand</li><li>Accessibility (attics in Texas heat)</li></ul><p>If a repair climbs past $1,500, it is usually time to start comparing replacement options.</p><p><strong>What it really means for you:</strong> A properly repaired system keeps your home consistently cool without surprises. No hot rooms, no constant adjustments, just a house that feels right when you walk in, which is exactly what your home should give you.</p>',
				),
				array(
					'question'    => 'What does a full HVAC replacement realistically cost in Texas?',
					'answer_html' => '<p>For most homeowners in Central Texas:</p><ul><li>Entry-level systems: $6,000-$9,000</li><li>Mid-tier (most common): $9,000-$14,000</li><li>High-efficiency systems: $14,000-$20,000+</li></ul><p>What actually affects price:</p><ul><li>Home size and layout</li><li>Ductwork condition</li><li>Installation quality</li></ul><p>The difference between systems is not just equipment. It is how well everything is designed and installed.</p><p><strong>What it really means for you:</strong> A properly installed system does more than cool your home. Even temperatures, quieter operation, and lower energy bills make the house feel like a place you actually want to be, not just somewhere you escape the heat.</p>',
				),
				array(
					'question'    => 'How do I know if I should repair my AC or replace it?',
					'answer_html' => '<p>In Austin, the decision usually comes down to three things:</p><ul><li>Age: 10-15 years = replacement territory</li><li>Repair cost: 30-40% of new system = replace</li><li>Frequency: repeated repairs = temporary fixes</li></ul><p>Older systems in Texas heat tend to decline quickly once problems start stacking up.</p><p><strong>What it really means for you:</strong> Making the right call here means fewer headaches later. Instead of constantly wondering when the next issue will hit, you get reliability, a home that stays comfortable without you having to think about it.</p>',
				),
				array(
					'question'    => 'Why does replacing an AC system cost more than expected?',
					'answer_html' => '<p>Because you are not just swapping a unit. You are rebuilding a system that has to perform in extreme conditions.</p><p>Costs include:</p><ul><li>Equipment</li><li>Labor</li><li>System design</li><li>Code compliance</li><li>Possible duct or electrical upgrades</li></ul><p>The biggest factor is not the brand. It is the installation.</p><p><strong>What it really means for you:</strong> When it is done right, everything just works. Your home cools faster, stays consistent, and runs more efficiently. You stop noticing the system and start enjoying your space the way it is supposed to feel.</p>',
				),
				array(
					'question'    => 'How much should I plan to spend on a new AC system in Austin?',
					'answer_html' => '<p>A realistic range for most homeowners:</p><p><strong>$9,000 to $13,000</strong></p><p>That typically covers:</p><ul><li>Proper sizing</li><li>Reliable performance</li><li>Long-term efficiency</li></ul><p>Lower-cost installs often cut corners. Higher-end systems should deliver noticeable improvements.</p><p><strong>What it really means for you:</strong> This is not just an expense. It is an upgrade to your daily life. A well-chosen system keeps your home comfortable during the hottest days of the year, protects your investment, and makes your space feel stable and predictable.</p>',
				),
				array(
					'question'    => 'What does a heat pump cost for a typical Texas home?',
					'answer_html' => '<p>For a 2,000 sq ft home:</p><ul><li>Standard system: $8,000-$12,000</li><li>High-efficiency: $12,000-$16,000+</li></ul><p>Heat pumps are gaining traction in Austin because they handle both heating and cooling efficiently.</p><p><strong>What it really means for you:</strong> One system doing everything means simplicity. Your home stays comfortable year-round without juggling different systems, and that consistency makes everyday living easier.</p>',
				),
				array(
					'question'    => 'Are heat pumps worth it in Austin, Texas?',
					'answer_html' => '<p>For most homes, yes.</p><p>They work well because:</p><ul><li>Winters are mild</li><li>Cooling demand is high</li><li>Efficiency stays strong year-round</li></ul><p>They replace both heating and cooling with one system.</p><p><strong>What it really means for you:</strong> It is about balance. You are not overpaying to heat a home that rarely gets cold, and you are staying cool during long summers. It is a smarter way to stay comfortable without overcomplicating things.</p>',
				),
				array(
					'question'    => 'How much should I invest in a heat pump system?',
					'answer_html' => '<p>Most homeowners should target:</p><p><strong>$10,000-$14,000</strong></p><p>This ensures:</p><ul><li>Reliable performance</li><li>Better efficiency</li><li>Fewer long-term issues</li></ul><p>Cheaper systems tend to cost more over time.</p><p><strong>What it really means for you:</strong> You are investing in consistency, a home that feels comfortable no matter the season, without spikes in cost or unexpected breakdowns.</p>',
				),
				array(
					'question'    => 'Do heat pumps hold up during 100-degree Austin summers?',
					'answer_html' => '<p>Yes, when properly installed and sized.</p><p>Performance depends on:</p><ul><li>System sizing</li><li>Airflow</li><li>Insulation</li></ul><p>Modern systems are built to handle extreme heat.</p><p><strong>What it really means for you:</strong> Even on the hottest days, your home stays a place to recharge. You are not fighting the heat. You are stepping into a space that feels controlled, comfortable, and yours.</p>',
				),
				array(
					'question'    => 'At what temperature do heat pumps stop working efficiently?',
					'answer_html' => '<p>Most systems begin to lose efficiency around:</p><p><strong>30-40 degrees Fahrenheit</strong></p><p>In Austin, that is rare and short-lived.</p><p><strong>What it really means for you:</strong> For the vast majority of the year, your system is running efficiently and keeping you comfortable without extra effort or cost.</p>',
				),
				array(
					'question'    => 'Are there situations where a heat pump is not a good fit in Texas?',
					'answer_html' => '<p>They may struggle in:</p><ul><li>Poorly insulated homes</li><li>Homes with bad ductwork</li><li>Airflow-restricted layouts</li></ul><p>Most of these issues can be corrected.</p><p><strong>What it really means for you:</strong> When your home is set up properly, your system works with you, not against you. That means better comfort, better efficiency, and a home environment that actually supports your lifestyle.</p>',
				),
			);
		}

		return alpine_get_sitewide_faq_default_items();
	}
}

if ( ! function_exists( 'alpine_get_sitewide_faq_default_items' ) ) {
	function alpine_get_sitewide_faq_default_items() {
		return array(
			array(
				'question' => 'How do I know if I need HVAC repair or a full system replacement?',
				'answer'   => 'A repair is often the right choice when the issue is isolated and the system is still performing well overall. If your equipment is older, breaking down often, or struggling to keep your home comfortable, we can help you compare repair costs against replacement value before you decide.',
			),
			array(
				'question' => 'What are the signs that my air conditioner needs service soon?',
				'answer'   => 'Common warning signs include weak airflow, warm air coming from the vents, unusual noises, higher energy bills, frequent cycling, or rooms that never seem to cool evenly. If you notice any of these issues, it is usually best to schedule service before the problem gets worse.',
			),
			array(
				'question' => 'Can you help me choose the right HVAC service if I am not sure what I need?',
				'answer'   => 'Yes. If you are unsure whether you need a repair, maintenance visit, indoor air quality upgrade, or a new estimate, our team can talk through the symptoms, the age of your system, and your comfort goals to point you in the right direction.',
			),
			array(
				'question' => 'Do you offer estimates before any work is scheduled?',
				'answer'   => 'Absolutely. We can provide an estimate for repairs, replacements, installations, and other HVAC projects so you understand the next step, expected scope, and pricing before moving forward.',
			),
		);
	}
}

if ( ! function_exists( 'alpine_render_faq_schema' ) ) {
	/**
	 * FAQPage JSON-LD for a set of question/answer pairs.
	 *
	 * Only call this for page-specific FAQ sets — emitting the same generic
	 * questions as schema on every URL reads as boilerplate to search engines.
	 */
	function alpine_render_faq_schema( $faqs ) {
		if ( empty( $faqs ) ) {
			return;
		}

		$entities = array();

		foreach ( $faqs as $faq ) {
			$answer = isset( $faq['answer_html'] ) ? wp_kses_post( $faq['answer_html'] ) : esc_html( $faq['answer'] );

			$entities[] = array(
				'@type'          => 'Question',
				'name'           => wp_strip_all_tags( $faq['question'] ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $answer,
				),
			);
		}

		$schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $entities,
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}

if ( ! function_exists( 'alpine_render_sitewide_faq_section' ) ) {
	function alpine_render_sitewide_faq_section() {
		$faqs = alpine_get_sitewide_faq_items();

		// Bespoke sets (front page, city pages) get FAQPage structured data;
		// the shared default set intentionally does not.
		if ( $faqs !== alpine_get_sitewide_faq_default_items() ) {
			alpine_render_faq_schema( $faqs );
		}
		?>
		<section class="site-faq-band">
			<div class="container">
				<div class="site-faq-shell">
					<div class="site-faq-intro">
						<div class="site-faq-media-card">
							<img loading="lazy" decoding="async" src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/faq-img.webp' ) ); ?>" alt="Alpine Heating & Air support specialist answering customer questions" />
							<div class="site-faq-media-copy">
								<span class="section-tag">Questions & Support</span>
								<h2 class="site-faq-title">Need help choosing the right HVAC service?</h2>
								<p class="site-faq-copy">Our team can walk you through repairs, maintenance, replacements, and estimate options without the back and forth.</p>
								<div class="site-faq-actions">
									<a href="tel:+15127594247" class="site-faq-primary-link">Call (512) 759-4247</a>
									<a href="<?php echo esc_url( alpine_get_site_page_url( 'estimate' ) ); ?>" class="site-faq-secondary-link">Request Estimate</a>
								</div>
							</div>
						</div>
					</div>

					<div class="site-faq-panel">
						<div class="site-faq-panel-head">
							<span class="site-faq-panel-badge">Popular Questions</span>
							<h3>Quick answers before you schedule</h3>
							<p>Here are the questions we hear most often from homeowners and businesses across Austin.</p>
						</div>

						<div class="accordion site-faq-accordion" id="siteFaqAccordion">
							<?php foreach ( $faqs as $index => $faq ) : ?>
								<?php $is_first = 0 === $index; ?>
								<div class="accordion-item">
									<h3 class="accordion-header" id="<?php echo esc_attr( 'site-faq-heading-' . $index ); ?>">
										<button
											class="accordion-button<?php echo $is_first ? '' : ' collapsed'; ?>"
											type="button"
											data-bs-toggle="collapse"
											data-bs-target="<?php echo esc_attr( '#site-faq-item-' . $index ); ?>"
											aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
											aria-controls="<?php echo esc_attr( 'site-faq-item-' . $index ); ?>"
										>
											<?php echo esc_html( $faq['question'] ); ?>
										</button>
									</h3>
									<div
										id="<?php echo esc_attr( 'site-faq-item-' . $index ); ?>"
										class="accordion-collapse collapse<?php echo $is_first ? ' show' : ''; ?>"
										aria-labelledby="<?php echo esc_attr( 'site-faq-heading-' . $index ); ?>"
										data-bs-parent="#siteFaqAccordion"
									>
										<div class="accordion-body">
											<?php
											if ( isset( $faq['answer_html'] ) ) {
												echo wp_kses_post( $faq['answer_html'] );
											} else {
												echo esc_html( $faq['answer'] );
											}
											?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
