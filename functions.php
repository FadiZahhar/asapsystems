<?php
/**
 * Bootstrap to WordPress functions and definitions
 *
 * @package Bootstrap to WordPress
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'aspaservices_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aspaservices_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Bootstrap to WordPress, use a find and replace
	 * to change 'aspaservices' to the name of your theme in all the template files
	 */
	//load_theme_textdomain( 'aspaservices', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aspaservices' ),
		'footer' => __( 'Footer Menu', 'aspaservices' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aspaservices_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // aspaservices_setup
add_action( 'after_setup_theme', 'aspaservices_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aspaservices_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'aspaservices' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Extra Sidebar', 'aspaservices' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'aspaservices_widgets_init' );





/**
 * Enqueue scripts and styles.
 */
function aspaservices_scripts() {
	
	if( !is_admin()){
 wp_deregister_script('jquery');
 wp_register_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false);
 wp_enqueue_script('jquery');
}
	wp_enqueue_style( 'aspaservices-style', get_stylesheet_uri() );
	wp_enqueue_style( 'aspaservices-bxslider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css' );
	
	wp_enqueue_script( 'aspaservices-bxslider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '20120205', false );
	wp_enqueue_script( 'aspaservices-slides', 'http://www.slidesjs.com/examples/basic-fade/js/jquery.slides.min.js', array('jquery'), '20120206', false );

	wp_enqueue_script( 'aspaservices-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('jquery'), '20120207', true );

	wp_enqueue_script( 'aspaservices-tabs', get_template_directory_uri() . '/assets/js/tabs.js', array('jquery'), '20120208', true );

	/*if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}*/
}
add_action( 'wp_enqueue_scripts', 'aspaservices_scripts' );



/**
 * Replaces the excerpt "more" text by a link.
 */
function new_excerpt_more($more) {
    global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '"> continue reading &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

