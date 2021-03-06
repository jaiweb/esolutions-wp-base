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
				/*if($sidebar=='sidebar-right' || 'posts' == $_show_on_front && !is_page() )*/
				if($sidebar=='sidebar-right' || 'posts' == $_show_on_front || _esc_is_blog() )
					$class	=	$_esc_config['content-area'];
				else
					$class	=	'container-fluid';
				break;
			case 'sidebar':
				$class	=	'sidebar ' . $_esc_config['sidebar'];
				break;
		}
		if($class)
			$class	=	' ' . $class;

		return $class;
	}
	add_filter('_esc_layout', '_esc_layout_class', 100, 2);
endif;
if ( ! function_exists( '_esc_is_blog' ) ) :
	function _esc_is_blog () {
		return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
	}
endif;
add_action('admin_enqueue_scripts', '_esc_admin_enqueue_scripts');
function _esc_admin_enqueue_scripts() {
    wp_enqueue_style('esc-admin-css', get_template_directory_uri() . '/css/admin/admin.css');
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
add_action( 'admin_notices', 'wps_print_admin_pagehook' );
function wps_print_admin_pagehook(){
    global $hook_suffix;
    if( !current_user_can( 'manage_options') )
        return;
    ?>
    <div class="updated notice notice-success is-dismissible"><p><?php echo $hook_suffix; ?></p></div>
    <?php
}
add_filter( 'navigation_markup_template', '_esc_navigation_markup_template', 10, 2);
function _esc_navigation_markup_template($template, $class ){
	$template = '
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<ul class="pagination pagination-lg">%3$s</ul>
	</nav>';
	return $template;
}
function _esc_get_the_posts_pagination( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		$args = wp_parse_args( $args, array(
			'mid_size'			=>	1,
			'prev_text' => __('&laquo;'),
			'next_text' => __('&raquo;'),
			'screen_reader_text'=>	__( 'Posts navigation' ),
			'type' 				=>	'array'
		) );
		// Set up paginated links.
		$links = paginate_links( $args );
		if ( $links ) {
			$_links	=	'';
			foreach($links as $link){
				$active	=	'';
				if ( preg_match('/current/', $link) )
					$active	=	' class="active"';
				$_links	.=	'<li' . $active . '>' . $link . '</li>';
			}
			$navigation = _navigation_markup( $_links, 'pagination', $args['screen_reader_text'] );
		}
	}
	echo $navigation;
}
?>