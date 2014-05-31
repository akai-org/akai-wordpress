<?php
/*
  Template Name: Współpraca
 */

get_header();
?>

  <section class="cooperation">
  <?php akai_the_horizontal_photo(); ?>

  <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('column full'); ?>>
      <h1 class="entry-title"><?php the_title(); ?></h1>

      <div class="entry-content">
        <?php
          the_content();
        ?>
      </div>
    </article>
  <?php endwhile; ?>

  <section class="partners">
    <h2>Obecni partnerzy</h2>
    
    <div class="images">
      <?php
      query_posts(Array(
        'posts_per_page' => -1,
        'post_type' => 'partner',
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));
      while (have_posts()): the_post(); ?>
        <a href="<?php esc_attr_e( get_field('homepage_url') ) ?>" class="partner">
          <?php the_post_thumbnail('medium'); ?>
        </a>
      <?php endwhile; ?>
    </div>
  </section>
</section>

<?php get_footer(); ?>
