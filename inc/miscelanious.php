<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
/*
 * will set the default avatar.
*/
add_filter( 'avatar_defaults', '_esc_avatar_defaults' );
function _esc_avatar_defaults ($avatar_defaults) {
     $myavatar = get_bloginfo('template_directory') . '/images/default.jpg';
     $avatar_defaults[$myavatar] = "Default Gravatar";
     return $avatar_defaults;
}
/*
 * will remove the automatic linking of URLs in comments.
*/
remove_filter('comment_text', 'make_clickable', 9);
/*
 * Adding this to your HTACCESS 
 * will help keep bots from posting comments 
 * on your wordpress blog, 
 * be sure to change yourdomain.com 
 * to your website address.

RewriteEngine On
RewriteCond %{REQUEST_METHOD} POST
RewriteCond %{REQUEST_URI} .wp-comments-post\.php*
RewriteCond %{HTTP_REFERER} !.*yourdomain.com.* [OR]
RewriteCond %{HTTP_USER_AGENT} ^$
RewriteRule (.*) http://%{REMOTE_ADDR}/$ [R=301,L]
*/
?>