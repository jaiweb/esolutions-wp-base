<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

if ( ! function_exists( '_esc_layout_class' ) ) :
	function _esc_layout_class($layout, $sidebar=''){
		global $_esc_config;
		$class	=	'';
		$_show_on_front	=	get_option( 'show_on_front' );
		switch($layout){
			case 'content-area-sidebar-right':
				$class	=	$_esc_config['content-area'];
				break;
			case 'content-area':
				if($sidebar=='sidebar-right' || 'posts' == $_show_on_front && !is_page() )
					$class	=	$_esc_config['content-area'];
				else
					$class	=	'container-fluid';
				break;
			case 'sidebar':
				$class	=	$_esc_config['sidebar'];
				break;
		}
		if($class)
			$class	=	' ' . $class;

		return $class;
	}
	add_filter('_esc_layout', '_esc_layout_class', 100, 2);
endif;
function _esc_admin_enqueue_scripts() {
    wp_enqueue_style('esc-admin-css', get_template_directory_uri() . '/css/admin.css');
}
/*
Disqus outputting JS on parts of your wordpress website you don’t want?
only output JS on is_singular posts or pages where comments are available.
*/
add_action( 'wp_head', 'tgm_tame_disqus_comments' );
function tgm_tame_disqus_comments() {
	if ( is_singular( array( 'post', 'page' ) ) && comments_open() )
			return;
	remove_action( 'loop_end', 'dsq_loop_end' );
	remove_action( 'wp_footer', 'dsq_output_footer_comment_js' );
}
/*
will remove the HTML p tag from around images in the_content.
*/
function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
/*
converts URI, www, ftp, and email addresses into clickable links within the_content and or the_excerpt.
*/
add_filter('the_content', 'make_clickable');
add_filter('the_excerpt', 'make_clickable');
?>