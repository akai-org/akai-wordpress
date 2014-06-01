<?php
/*
  Template Name: O nas
 */

get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('content', 'page'); ?>

		<?php endwhile; // end of the loop.  ?>

		<div class="team">
		<?php
		/** wyswietlamy AKAI Team **/
		
		// pobieramy liste pozycji, w odpowiednim porzadku
		$positions = get_categories(Array(
			'orderby' => 'order',
			'hide_empty' => false,
			'hierarchical' => false,
			'child_of' => 34 // #ID kategorii "Pozycje"
		));

		foreach ($positions as $position) { ?>
		
			<div class="team-position block clearfix">
				<h3><?php echo $position->cat_name; ?></h3>

				<?php
				// pobieramy osoby na danej pozycji
				query_posts(Array(
					'cat' => $position->cat_ID,
					'posts_per_page' => -1,
					'post_type' => 'person'
				));
				while (have_posts()) {
					the_post();
					get_template_part('content', 'person');
				}
				?>
			</div>
			
		<?php } ?>
		</div>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>