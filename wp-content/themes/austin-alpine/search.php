<?php
/**
 * Search results template.
 */

get_header();
?>
</header>

<main class="container py-5">
  <h1 class="section-title mb-4"><?php printf( 'Search results for &ldquo;%s&rdquo;', esc_html( get_search_query() ) ); ?></h1>

  <?php if ( have_posts() ) : ?>
    <div class="row g-4">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-6">
          <article <?php post_class(); ?>>
            <h2 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
          </article>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="mt-4">
      <?php the_posts_pagination(); ?>
    </div>
  <?php else : ?>
    <p>No results for that search. Try a different phrase, or jump straight to <a href="<?php echo esc_url( alpine_get_site_page_url( 'services' ) ); ?>">our services</a> or the <a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>">contact page</a>.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
