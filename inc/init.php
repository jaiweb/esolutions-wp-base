<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

define('ESOLUTIONS_TEMPLATE_DIR',get_bloginfo('template_directory'));

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
//require get_template_directory() . '/inc/custom-header.php';
require_once('custom-header.php');

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
//require get_template_directory() . '/inc/template-tags.php';
require_once('template-tags.php');

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
//require get_template_directory() . '/inc/customizer.php';
require_once( 'customizer.php');
require_once('bootstrap.php');
require_once('functions.php');
require_once('nav-menu.php');
require_once('sidebars.php');
require_once('getFacebookCommentsAndSharedPosts.php');
?>