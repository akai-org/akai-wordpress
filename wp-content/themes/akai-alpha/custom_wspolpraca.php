<?php
/*
  Template Name: Współpraca
 */

get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		
		<div class="entry-left">
			<?php while (have_posts()) : the_post(); ?>

				<?php 
				get_template_part('content', 'page'); 

				// musimy ten field pobrac tutaj, bo nizej pobieramy kolejne posty (osoby), a get_field jest tylko dla obecnego globalnego the_post();
				$paragraph = get_field('paragraph');
				?>

			<?php endwhile; // end of the loop.  ?>
		</div>

		<div class="team-leaders block entry-right">
			<h3>To się będzie wyświetlać na równi z treścią artykułu powyżej</h3>
			<?php
			// pobieramy przewodniczacych
			query_posts(Array(
				'category_name' => 'przewodniczacy',
				'posts_per_page' => -1,
				'post_type' => 'person'
			));
			while (have_posts()) {
				the_post();
				get_template_part('content', 'person');
			}
			?>
		</div>
		
		<!-- krotki tekst zapraszajcy do kontaktu -->
		<div class="hentry">
			<?php echo $paragraph; ?>
		</div>
		
		<!-- loga firm, wiecej niz na glownej -->
		<div class="home-companies block">
			<?php akai_list_companies(); ?>
		</div>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>