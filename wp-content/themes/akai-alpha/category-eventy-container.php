<div class="events" data-page="<?php echo (int) get_query_var('paged') ? : 1; ?>">
	<div class="events-container site-content">

		<?php while (have_posts()) : the_post(); ?>
			<div class="event">
				<?php the_post_thumbnail('post-thumbnail', 'class=event-image'); ?>
				<div class="event-caption">
					<time class="event-date" datetime="<?php the_date('c'); ?>"><?php the_date('d-m-Y'); ?></time>
					<h4 class="event-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
				</div>
				<div class="event-caption hoveronly">
					<time class="event-date event-fulldate" datetime="<?php the_date('c'); ?>"><?php the_date('d-m-Y H:i'); ?></time>
					<h4 class="event-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
					<span class="event-location">CW9, PP</span>
				</div>
			</div>
		<?php endwhile; ?>

	</div>
	<?php if (get_next_posts_link()) : ?>
		<div class="events-more block nav-below">
			<span class="nav-next"><a href="<?php echo get_next_posts_page_link(); ?>">Załaduj więcej eventów</a></span>
		</div>
	<?php endif; ?>
</div>
