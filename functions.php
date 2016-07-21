<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}
/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
if ( ! function_exists( '_esc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function _esc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'esc' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'esc', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main'	=>	__( 'Main Menu',   'esc' ),
		'footer'=>	__( 'Footer Menu', 'esc' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	/*add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );*/
	/*$color_scheme  = _esc_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_esc_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );*/
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', _esc_fonts_url() ) );
}
endif; // _esc_setup
add_action( 'after_setup_theme', '_esc_setup' );
/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _esc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area Blog', 'esc' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'esc' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Widget Area Pages', 'esc' ),
		'id'            => 'sidebar-page',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'esc' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_esc_widgets_init' );
if ( ! function_exists( '_esc_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function _esc_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'esc' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}
	/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'esc' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}
	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'esc' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}
	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'esc' );
	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;
/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function _esc_scripts() {
	// Add custom fonts, used in the main stylesheet.
	/*wp_enqueue_style( 'esc-fonts', _esc_fonts_url(), array(), null );*/
	wp_enqueue_style( 'esc-genericons', get_template_directory_uri() . '/css/genericons.css', array(), '3.2' );
	wp_enqueue_style( 'esc-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '' );
	wp_enqueue_style( 'esc-fonts', get_template_directory_uri() . '/css/fonts.css', array(), '' );	
	
	wp_enqueue_style( 'esc-wp', get_template_directory_uri() . '/css/wp.css', array(), '' );	
	wp_enqueue_style( 'esc-bs-min', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '' );
	wp_enqueue_style( 'esc-bs', get_template_directory_uri() . '/css/bs.css', array(), '' );
	wp_enqueue_style( 'esc-style', get_stylesheet_uri() );
	
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'esc-ie', get_template_directory_uri() . '/css/ie.css', array( 'esc-style' ), '' );
	wp_style_add_data( 'esc-ie', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'esc-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'esc-style' ), '' );
	wp_style_add_data( 'esc-ie7', 'conditional', 'lt IE 8' );
	wp_enqueue_script( 'esc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'esc-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '' );
	}
	wp_enqueue_script( 'esc-script-bs', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'esc-script-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '', true );
	wp_localize_script( 'esc-script-functions', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'esc' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'esc' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', '_esc_scripts' );
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function _esc_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', '_esc_search_form_modify' );
require get_template_directory() . '/inc/init.php';