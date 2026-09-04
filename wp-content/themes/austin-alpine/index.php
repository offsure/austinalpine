<?php
/**
 * Fallback template for any request without a more specific template
 * (archives, taxonomies, and anything else the hierarchy drops through).
 */

get_header();
?>
</header>

<main class="container py-5">
  <?php if ( have_posts() ) : ?>
    <h1 class="section-title mb-4">
      <?php
      if ( is_home() ) {
          echo esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ?: 'Blog' );
      } else {
          the_archive_title();
      }
      ?>
    </h1>

    <div class="row g-4">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-6 col-lg-4">
          <article <?php post_class( 'h-100' ); ?>>
            <h2 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
            <a class="btn-main" href="<?php the_permalink(); ?>">Read More<span class="visually-hidden"> about <?php the_title(); ?></span></a>
          </article>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="mt-4">
      <?php the_posts_pagination(); ?>
    </div>
  <?php else : ?>
    <h1 class="section-title">Nothing found here</h1>
    <p>Try one of our main pages instead, or reach out and we can point you in the right direction.</p>
    <p>
      <a class="btn service-cta-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
      <a class="btn service-cta-btn" href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>">Contact Us</a>
    </p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
