<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

define('_ESC_TEMPLATE_DIR', get_bloginfo('template_directory'));
define('_ESC_IMAGES', _ESC_TEMPLATE_DIR . '/images/');
define('_ESC_SIDEBAR_DEFAULT', 'sidebar-page');
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
/*remove_action( 'wp_print_styles', 'print_emoji_styles', 100 );
remove_action( 'admin_print_styles', 'print_emoji_styles', 100 );*/
remove_action( 'wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_styles', 'print_emoji_styles');
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
require_once( 'security.php');

require_once('bootstrap.php');
require_once('functions.php');
require_once('shortcodes.php');
require_once('nav-menu.php');
require_once('sidebars.php');
/*
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action('_before_navigation', '_esc_before_navigation_1', 5);
function _esc_before_navigation_1(){
	echo '
	<div class="row">
		<div class="col-sm-6">';
}
add_action('_before_navigation', '_esc_before_navigation_2', 15);
function _esc_before_navigation_2(){
	echo '</div>
		<div class="col-sm-6">
			<nav class="clearfix pull-right">
				<ul class="nav navbar-nav col-sm-np">
					<li><a href="#">item 1</a></li>
					<li><a href="#">item 2</a></li>
				</ul>
			</nav>
			 <div id="custom-search-input" class="clearfix">
				<div class="input-group col-sm-6 col-sm-offset-6">
					<input type="text" placeholder="Search" class="search-query form-control">
					<span class="input-group-btn">
						<button type="button" class="btn btn-danger">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>';
}
add_action('_before_navigation', '_esc_before_navigation_3', 15);
function _esc_before_navigation_3(){
	echo '
		</div>
	</div>';
}
*/
/*
 Theme Name:   City Home Collective
 Theme URI:    http:/ /example.com/twenty-fifteen-child/
 Description:  esolutions-wp-base Child Theme
 Author:       Jaime Isidro
 Author URI:   http://example.com
 Template:     esolutions-wp-base
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  esolutions-wp-base-child
*/
#custom-search-input {
	margin:0;
	margin-top: 10px;
	padding: 0;
}

#custom-search-input .search-query {
	padding-right: 3px;
	padding-right: 4px \9;
	padding-left: 3px;
	padding-left: 4px \9;
	/* IE7-8 doesn't have border-radius, so don't indent the padding */

	margin-bottom: 0;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

#custom-search-input button {
	border: 0;
	background: none;
	/** belows styles are working good */
	padding: 2px 5px;
	margin-top: 2px;
	position: relative;
	left: -28px;
	/* IE7-8 doesn't have border-radius, so don't indent the padding */
	margin-bottom: 0;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	color:#D9230F;
}

.search-query:focus + button {
	z-index: 3;   
}
?>
