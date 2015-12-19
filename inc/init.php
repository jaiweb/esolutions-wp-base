<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

define('_ESC_TEMPLATE_DIR',get_bloginfo('template_directory'));
define('_ESC_SIDEBAR_DEFAULT', 'sidebar-page');

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require_once('template-tags.php');
/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require_once( 'customizer.php');

require_once('bootstrap.php');
require_once('functions.php');
require_once('shortcodes.php');
require_once('nav-menu.php');
require_once('sidebars.php');
?>
