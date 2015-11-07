<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

if ( ! function_exists( 'esolutions_remove_version' ) ) :
    //Remove WordPress Version Number
    add_filter('the_generator', 'esolutions_remove_version');
    function esolutions_remove_version() {
        return '';
    }    
endif;
if ( ! function_exists( 'esolutions_login_obscure' ) ) :
    // Obscure login screen error messages
    function esolutions_login_obscure(){
        return '<strong>Sorry</strong>: Think you have gone wrong somwhere!';
    }
    add_filter( 'login_errors', 'esolutions_login_obscure' );
endif;

//Kill the WordPress update nag
// kill the admin nag
if (!current_user_can('edit_users')) {
    add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
    add_filter('pre_option_update_core', create_function('$a', "return null;"));
}
//Remove superfluous info and HTML within the <head> tag

// remove unnecessary header info
function remove_header_info() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');         // for WordPress <  3.0
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // for WordPress >= 3.0
}
add_action('init', 'remove_header_info');
// Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );
// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action('wp_head', 'wp_generator');
//Remove Error Message on the Login Page
add_filter('login_errors',create_function('$a', "return null;"));
// Hide WordPress Update
function wp_hide_update() {
    remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_menu','wp_hide_update');
//Disable WordPress Automatic Updates
define('WP_AUTO_UPDATE_CORE', false);



//Enable shortcodes in widgets
// shortcode in widgets
if ( !is_admin() ){
    add_filter('widget_text', 'do_shortcode', 11);
}

?>