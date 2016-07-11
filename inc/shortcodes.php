<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

//Enable shortcodes in widgets
if ( !is_admin() )
    add_filter('widget_text', 'do_shortcode', 11);

if(is_woocommerce())	:
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	add_filter( 'the_content', 'shortcode_unautop',100 );

	add_filter('the_content', '_esc_filter_fix_shortcodes');
endif;

add_shortcode('_images', '_esc_shortcode__images');
function _esc_shortcode__images() {
	return get_template_directory_uri() . '/images';
}
function _esc_shortcode_section_title( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts);
	ob_start();
?>
	<header class="section-header text-center">
		<h2 class="section-title"><?php	echo do_shortcode($content)	?></h2>		
	</header><!-- .section-header -->
<?php
	return ob_get_clean();
}
add_shortcode('_section_title', '_esc_shortcode_section_title');
/*
 * remove extra P and BR tags around shortcodes 
 * that WordPress likes to add
*/
function _esc_filter_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']',
        ']<br>' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
?>