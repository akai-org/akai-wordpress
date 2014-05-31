<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="events" data-page="<?php echo (int) get_query_var('paged') ? : 1; ?>">
  <?php if ( have_posts() ) : ?>
    <div class="events-container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'event' ); ?>
      <?php endwhile; ?>
    </div>

    <?php if (get_next_posts_link()) : ?>
      <div class="events-more block nav-below">
        <span class="nav-next"><a href="<?php echo get_next_posts_page_link(); ?>">Załaduj więcej</a></span>
      </div>
    <?php endif; ?>

  <?php else: ?>

    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif ?>
</div>

<?php
get_footer();
