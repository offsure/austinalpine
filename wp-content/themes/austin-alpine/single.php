<?php
/**
 * Single blog post template.
 */

get_header();

$alpine_blog_page_id  = (int) get_option( 'page_for_posts' );
$alpine_blog_url      = $alpine_blog_page_id ? get_permalink( $alpine_blog_page_id ) : home_url( '/blog/' );
$alpine_blog_label    = $alpine_blog_page_id ? get_the_title( $alpine_blog_page_id ) : 'Blog';
$alpine_post_fallback = home_url( '/wp-content/uploads/2026/03/ac-maintenance.jpg' );
?>
<div class="service-page single-post-page">

  <?php while ( have_posts() ) : the_post(); ?>

  <section class="page-hero">
    <div class="container hero-content">
      <div>
        <span class="hero-chip"><?php echo esc_html( $alpine_blog_label ); ?></span>
        <h1><?php the_title(); ?></h1>
        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> . <a href="<?php echo esc_url( $alpine_blog_url ); ?>"><?php echo esc_html( $alpine_blog_label ); ?></a></p>
      </div>
      <strong>Air Conditioning and Heating Specialists</strong>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>

  <main>
    <section class="section-space">
      <div class="container">
        <div class="single-post-wrap">

          <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>

            <div class="single-post-meta">
              <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?></span>
              <span><i class="fa-regular fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
              <?php
              $alpine_cats = get_the_category_list( ', ' );
              if ( $alpine_cats ) : ?>
                <span><i class="fa-regular fa-folder" aria-hidden="true"></i> <?php echo wp_kses_post( $alpine_cats ); ?></span>
              <?php endif; ?>
            </div>

            <div class="single-post-featured">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
              <?php else : ?>
                <img loading="lazy" decoding="async" src="<?php echo esc_url( $alpine_post_fallback ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
              <?php endif; ?>
            </div>

            <div class="single-post-content">
              <?php the_content(); ?>
            </div>

            <?php
            $alpine_tags = get_the_tag_list( '<div class="single-post-tags"><span>Tags:</span>', '', '</div>' );
            if ( $alpine_tags ) {
              echo wp_kses_post( $alpine_tags );
            }
            ?>

            <?php
            $alpine_phone = function_exists( 'alpine_get_setting' ) ? alpine_get_setting( 'phone_number', '(512) 759-4247' ) : '(512) 759-4247';
            ?>
            <div class="single-post-cta-card">
              <div class="single-post-cta-text">
                <h3>Need HVAC service in the Austin area?</h3>
                <p>Talk to Alpine Heating &amp; Air Conditioning about repairs, replacements, and maintenance for your home.</p>
              </div>
              <div class="single-post-cta-actions">
                <a href="<?php echo esc_attr( alpine_tel_href( $alpine_phone ) ); ?>" class="btn single-post-cta-phone">
                  <i class="fa-solid fa-phone-volume" aria-hidden="true"></i> <?php echo esc_html( $alpine_phone ); ?>
                </a>
                <a href="<?php echo esc_url( alpine_get_site_page_url( 'estimate' ) ); ?>" class="btn single-post-cta-estimate">Request Estimate</a>
              </div>
            </div>

            <div class="single-post-nav">
              <div class="single-post-nav-prev">
                <?php previous_post_link( '%link', '&laquo; %title' ); ?>
              </div>
              <div class="single-post-nav-next">
                <?php next_post_link( '%link', '%title &raquo;' ); ?>
              </div>
            </div>

            <div class="single-post-back">
              <a href="<?php echo esc_url( $alpine_blog_url ); ?>">&laquo; Back to <?php echo esc_html( $alpine_blog_label ); ?></a>
            </div>

          </article>

        </div>
      </div>
    </section>

    <section class="service-strip">
      <div class="container">
        <strong>Quality heating &amp; air conditioning solutions</strong>
        <a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>" class="btn service-cta-btn">Schedule Appointment</a>
      </div>
    </section>
  </main>

  <?php endwhile; ?>

</div>

<?php get_footer(); ?>
