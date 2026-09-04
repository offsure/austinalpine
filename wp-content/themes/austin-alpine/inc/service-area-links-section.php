<?php
/**
 * Reusable service-area links section for service pages.
 */

require_once get_stylesheet_directory() . '/inc/service-area-template.php';

if (!function_exists('alpine_render_service_area_links_section')) {
    function alpine_render_service_area_links_section($args = array()) {
        $defaults = array(
            'title' => 'Service <span class="highlight">areas</span>',
            'intro' => 'Alpine Heating & Air Conditioning provides these HVAC services throughout the greater Austin area. Browse the local service-area pages below to confirm coverage in your city.',
            'cta_label' => 'View All Service Areas',
            'cta_url' => alpine_service_area_page_url('service-areas'),
            'wrapper_class' => 'service-area-links-section mt-5',
        );

        $config = wp_parse_args($args, $defaults);
        $service_areas = alpine_service_area_locations();

        if (empty($service_areas)) {
            return;
        }
        ?>
        <div class="<?php echo esc_attr($config['wrapper_class']); ?>">
          <div class="service-area-links-header">
            <h2 class="section-title"><?php echo wp_kses_post($config['title']); ?></h2>
            <p class="service-intro"><?php echo esc_html($config['intro']); ?></p>
          </div>

          <div class="service-area-links-grid">
            <?php foreach ($service_areas as $area_slug => $service_area) : ?>
              <a class="service-area-link-card" href="<?php echo esc_url(alpine_get_service_area_location_url($area_slug)); ?>">
                <span class="service-area-link-city"><?php echo esc_html($service_area['city']); ?></span>
                <span class="service-area-link-meta"><?php echo esc_html($service_area['state']); ?></span>
              </a>
            <?php endforeach; ?>
          </div>

          <?php
          // Specialist-service landing pages. Without this row they carry no
          // internal links at all (sitemap-only orphans), which search engines
          // treat as low-value pages.
          $specialist_pages = array(
              'hvac-contractor'                  => 'HVAC Contractor',
              'air-conditioning-contractor'      => 'AC Contractor',
              'heating-contractor'               => 'Heating Contractor',
              'air-conditioning-repair-service'  => 'AC Repair Service',
              'furnace-repair-service'           => 'Furnace Repair Service',
              'air-conditioning-system-supplier' => 'AC System Supplier',
              'heating-equipment-supplier'       => 'Heating Equipment Supplier',
              'furnace-parts-supplier'           => 'Furnace Parts Supplier',
              'furnace-store'                    => 'Furnace Store',
          );

          $specialist_links = array();
          foreach ($specialist_pages as $specialist_slug => $specialist_label) {
              if (function_exists('alpine_get_page_id_by_path') && alpine_get_page_id_by_path($specialist_slug) > 0) {
                  $specialist_links[$specialist_slug] = $specialist_label;
              }
          }
          ?>
          <?php if (!empty($specialist_links)) : ?>
            <div class="service-area-links-header mt-4">
              <h3 class="section-title">Specialist <span class="highlight">services</span></h3>
              <p class="service-intro">Looking for a specific kind of HVAC help? These pages cover the specialist services Austin homeowners search for most.</p>
            </div>
            <div class="service-area-links-grid">
              <?php foreach ($specialist_links as $specialist_slug => $specialist_label) : ?>
                <a class="service-area-link-card" href="<?php echo esc_url(alpine_get_page_url($specialist_slug, array(), '/' . $specialist_slug . '/')); ?>">
                  <span class="service-area-link-city"><?php echo esc_html($specialist_label); ?></span>
                  <span class="service-area-link-meta">Austin, TX</span>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
        <?php
    }
}
