<?php
/**
 * Homepage
 *
 * @package akai
 * @since akai 1.0
 */
get_header();
?>
<div id="primary" class="content-area">

	<div class="promoslider block">
		<ul class="nolist clearfix">
			<?php
			the_post();
			for ($i = 1; $slide = get_field("slider{$i}"); $i++) {
				echo "<li>{$slide}</li>";
			}
			?>
		</ul>
	</div>

	<div class="home-companies block">
		<?php akai_list_companies(5); ?>
	</div>

	<?php dynamic_sidebar('front-mailchimp'); ?>
	<!--<div class="home-subscribe block">
		<label>Chcesz dowiadywać się jako pierwszy o naszych eventach i projektach?</label>
		<input type="text">
		<button type="submit">Zapisz się</button>
	</div>-->

	<div id="content" role="main">

	<?php query_posts('category_name=eventy'); ?>
	<?php if ( have_posts() ) : ?>

		<?php include('category-eventy-container.php');  ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>

	</div><!-- #content .site-content -->
	
</div><!-- #primary .content-area -->

<?php get_footer(); ?>