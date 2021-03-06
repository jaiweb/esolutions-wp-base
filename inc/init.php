<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

define('_ESC_THEME_DIR', get_template_directory_uri());
define('_ESC_IMAGES', _ESC_THEME_DIR . '/images/');
define('_ESC_CSS', _ESC_THEME_DIR . '/css/');
define('_ESC_JS', _ESC_THEME_DIR . '/js/');
define('_ESC_SIDEBAR_DEFAULT', 'sidebar-page');
global $_esc_config;
$_esc_config	=	array(
						'content-area'	=>	'col-sm-8 col-md-9 col-sm-npl',
						'sidebar'	=>	'col-sm-4 col-md-3 col-sm-npr',	
					);

if ( ! function_exists( '_print' ) ) :
    function _print($data,$hide=false){
        $class='';
        if($hide)
            $class=' class="esc-hide"';        
        echo '<pre'.$class.'>' . print_r($data,true) . '</pre>';
    }
endif;

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script', 100 );
remove_action( 'wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_styles', 'print_emoji_styles');

require_once('template-tags.php');
require_once( 'customizer.php');

require_once('config.php');
require_once('bootstrap.php');
require_once('nav-menu.php');

require_once('functions.php');

require_once('woocommerce.php');

require_once('sidebars.php');
require_once('additional-post-thumbnails.php');
require get_template_directory() . '/inc/widgets.php';

require_once('theme-options.php');
require_once('shortcodes.php');
return ;

require_once( 'security.php');

/*require_once('posttypes.php');*/


?>