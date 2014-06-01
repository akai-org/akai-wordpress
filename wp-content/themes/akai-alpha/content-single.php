<?php
/**
 * @package akai
 * @since akai 1.0
 */
?>

<?php
$date = date_create( get_field('date') . ' ' . get_field('time') );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<div class="entry-left">
		
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
	
		<div class="entry-date">
			<?php echo $date->format('d/m/y H:i'); ?>
		</div>
		<div class="entry-calendar">
			<?php akai_add_to_calendar( @date_create( get_field('date') . get_field('time') )); ?>
		</div>
		
		<div class="entry-address">
			<?php the_address(); ?>
		</div>
		
		<div class="entry-presentation">
			<?php the_field('presentation_url'); ?>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<div class="entry-registration">
			<?php the_field('registration'); ?>
		</div>
	</div>
	
	<div class="entry-right">
		<div class="entry-share">
			sharing (fb/tweet)
		</div>
		
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		
		<div class="entry-map">
			<?php the_map(); ?>
		</div>
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
