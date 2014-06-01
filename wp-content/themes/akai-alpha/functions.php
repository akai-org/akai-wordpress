<?php
/**
 * akai functions and definitions
 *
 * @package akai
 * @since akai 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since akai 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since akai 1.0
 */
function akai_theme_setup() {
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on akai, use a find and replace
	 * to change 'akai' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'akai', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'akai' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'akai_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since akai 1.0
 */
function akai_theme_widgets_init() {
//	register_sidebar( array(
//		'name' => __( 'Sidebar', 'akai' ),
//		'id' => 'sidebar-1',
//		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//		'after_widget' => '</aside>',
//		'before_title' => '<h1 class="widget-title">',
//		'after_title' => '</h1>',
//	) );
	register_sidebar( array(
		'name' =>'Frontpage - Mailchimp container',
		'id' => 'front-mailchimp',
		'before_widget' => '<div class="home-subscribe block">',
		'after_widget' => '</div>',
		'before_title' => '<label>',
		'after_title' => '</label>',
	) );
	
//	register_sidebar( array(
//		'name' =>'O nas - członkowie AKAI',
//		'id' => 'persons',
//		'before_widget' => '<div class="persons block">',
//		'after_widget' => '</div>',
//		'before_title' => '<h4>',
//		'after_title' => '</h4>',
//	) );
}
add_action( 'widgets_init', 'akai_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function akai_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'frontend', get_template_directory_uri() . '/js/frontend.js', array( 'jquery' ), '20130106', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

//	if ( is_singular() && wp_attachment_is_image() ) {
//		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
//	}
}
add_action( 'wp_enqueue_scripts', 'akai_theme_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

add_action('init', 'akai_post_types');
function akai_post_types() {
//	register_taxonomy('position', null, Array(
//		'labels' => Array(
//			'name' => 'Pozycje',
//			'singular_name' => 'Pozycja'
//		),
//		'public' => false,
//		'show_ui' => true,
//		'hierarchical' => true
//	));

	register_post_type('person', Array(
		'labels' => Array(
			'name' => 'Osoby',
			'singular_name' => 'Osoba'
		),
		'public' => false,
		'show_ui' => true,
		'supports' => Array('title', 'thumbnail', 'page-attributes'),
		'taxonomies' => Array('category')
	));
	
	register_post_type('company', Array(
		'labels' => Array(
			'name' => 'Firmy',
			'singular_name' => 'Firma'
		),
		'public' => false,
		'show_ui' => true,
		'supports' => Array('title', 'thumbnail', 'page-attributes')
	));
}
