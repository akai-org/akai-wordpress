<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package akai
 * @since akai 1.0
 */

if ( ! function_exists( 'akai_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since akai 1.0
 */
function akai_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'akai' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'akai' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'akai' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'akai' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'akai' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // akai_content_nav

if ( ! function_exists( 'akai_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since akai 1.0
 */
function akai_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'akai' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'akai' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'akai' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'akai' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'akai' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'akai' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for akai_comment()

if ( ! function_exists( 'akai_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since akai 1.0
 */
function akai_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'akai' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'akai' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since akai 1.0
 */
function akai_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so akai_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so akai_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in akai_categorized_blog
 *
 * @since akai 1.0
 */
function akai_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'akai_category_transient_flusher' );
add_action( 'save_post', 'akai_category_transient_flusher' );

/**
 * wyswietla zdjecia firm wspolpracujacych
 * @param int $limit
 */
function akai_list_companies($limit = -1) {
	query_posts(Array(
		'posts_per_page' => $limit,
		'post_type' => 'company'
	));
	while(have_posts()) {
		the_post();
		$url = get_field('website_url');
		$title = get_field('description');
		$image = get_the_post_thumbnail(null, 'post-thumbnail', Array('title' => $title));
		
		if ($url)
			echo "<a href='$url'>$image</a>";
		else
			echo $image;
	}
}

/**
 * prints Google Add to calendar link
 * @param DateTime $date
 * @param int $duration in seconds
 * @param array $params title, location, description, website_name, website_url
 */
function akai_add_to_calendar($date = false, $duration = 5400, $params = Array()) {
	if (!$date)
		return;
	
	// @todo czy to ma byc link Add to calendar, czy moze jakis obiekt, ktory mozna dodawac takze do innych kalendarzy?
	// np. plik .iCal 
	// http://www.phpclasses.org/package/873-PHP-Class-for-creating-iCalendar-files.html 
	// http://stackoverflow.com/questions/1661478/add-an-outlook-calendar-event-from-a-link-on-a-web-page
	// http://www.myhow2guru.com/archives/php-generate-calendar-file-ics/
	// lub plik .vcs od outlooka (buehehehe; u're kidding right?) http://www.terminally-incoherent.com/blog/2008/04/14/generate-outlook-calendar-events-with-php-and-icalendar/
	echo '<a href="http://www.google.com/calendar/event?action=TEMPLATE&text=tytul&dates=20060101T034500Z/20100404T014500Z&details=opis&location=miejsce&trp=false&sprop=akai.org.pl&sprop=name:AKAI" target="_blank"><img src="//www.google.com/calendar/images/ext/gc_button1.gif" border=0></a>';
	
	echo ' lub <a href="'. home_url('/ical.ics') .'">Zapisz do swego kalendarza</a>';
}