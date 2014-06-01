<?php
/**
 * @package akai
 * @since akai 1.0
 */
?>

<div class="team-person person clearfix">
	<div class="person-image">
		<?php the_post_thumbnail(); ?>
	</div>
	<div class="person-description">
		<h4><?php the_title(); ?></h4>
		<span class="person-position"><?php the_field('position'); ?></span>
		<span class="person-email"><?php the_field('email'); ?></span>
		<span class="person-phone"><?php the_field('phone'); ?></span>
	</div>
</div>
