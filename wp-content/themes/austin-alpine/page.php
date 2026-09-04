<?php
get_header();
?>
<main class="default-page-template py-5">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'default-page-entry' ); ?>>
          <header class="default-page-header mb-4">
            <h1><?php the_title(); ?></h1>
          </header>

          <section class="default-page-content">
            <?php the_content(); ?>
          </section>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>
<?php
get_footer();
?>
