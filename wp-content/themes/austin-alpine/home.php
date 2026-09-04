<?php
/**
 * Blog posts index (the page set as "Posts page" in Settings > Reading).
 *
 * WordPress uses this file for the blog listing. Previously there was no
 * home.php and index.php was empty, so /blog rendered a blank page.
 */

get_header();

$alpine_blog_page_id = (int) get_option( 'page_for_posts' );
$alpine_blog_title   = $alpine_blog_page_id ? get_the_title( $alpine_blog_page_id ) : 'Blog';
$alpine_blog_fallback_img = home_url( '/wp-content/uploads/2026/03/ac-maintenance.jpg' );
?>
<div class="service-page blog-page">

  <section class="page-hero">
    <div class="container hero-content">
      <div>
        <span class="hero-chip">Learning Center</span>
        <h1><?php echo esc_html( $alpine_blog_title ); ?></h1>
        <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => $alpine_blog_title),
          )); ?>
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

        <?php if ( have_posts() ) : ?>

          <div class="row g-4">
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="col-md-6 col-lg-4">
                <article <?php post_class( 'blog-card' ); ?>>
                  <a href="<?php the_permalink(); ?>" class="blog-card-thumb">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'large', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
                    <?php else : ?>
                      <img loading="lazy" decoding="async" src="<?php echo esc_url( $alpine_blog_fallback_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                    <?php endif; ?>
                  </a>
                  <div class="service-content">
                    <p class="blog-card-meta"><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?></p>
                    <h2 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html( wp_trim_words( strip_shortcodes( wp_strip_all_tags( get_the_content() ) ), 20, '…' ) ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn-main">Read More<span class="visually-hidden"> about <?php the_title(); ?></span> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                  </div>
                </article>
              </div>
            <?php endwhile; ?>
          </div>

          <div class="blog-pagination mt-5">
            <?php
            the_posts_pagination( array(
              'mid_size'  => 1,
              'prev_text' => '&laquo; Previous',
              'next_text' => 'Next &raquo;',
            ) );
            ?>
          </div>

        <?php else : ?>

          <div class="text-center py-5">
            <h2 class="section-title">No posts yet</h2>
            <p class="service-intro">Check back soon for HVAC tips, guides, and news from Alpine Heating &amp; Air Conditioning.</p>
          </div>

        <?php endif; ?>

      </div>
    </section>

    <section class="service-strip">
      <div class="container">
        <strong>Quality heating &amp; air conditioning solutions</strong>
        <a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>" class="btn service-cta-btn">Schedule Appointment</a>
      </div>
    </section>
  </main>
</div>

<?php get_footer(); ?>
