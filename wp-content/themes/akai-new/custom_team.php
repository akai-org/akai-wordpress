<?php
/*
  Template Name: Zespół
 */

get_header();
?>

<section class="team">
  <?php while (have_posts()) : the_post(); ?>

    <?php akai_the_horizontal_photo(); ?>
    <?php // get_template_part('content', 'page'); ?>

  <?php endwhile; ?>

  <?php
  // Get list of person categories (they should be ordered automatically by "Category Order and Taxonomy Terms Order" plugin)
  $person_categories = get_categories(Array(
  	'hide_empty' => true,
  	'hierarchical' => false,
    'taxonomy' => 'person_category'
  ));

  foreach ($person_categories as $person_category) { ?>

  	<section class="people">
  		<h3><?php echo $person_category->cat_name; ?></h3>
      
      <div class="person-list">
        <?php
        // Get all people on this person_category
        query_posts(Array(
          'person_category' => $person_category->slug,
          'posts_per_page' => -1,
          'post_type' => 'person',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        ));
        while (have_posts()) {
          the_post();
          get_template_part('content', 'person');
        }
        ?>
      </div>
  	</section>
  	
  <?php } ?>
</section>

<?php get_footer(); ?>
