<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

add_action('init', 'esc_register_post_type');
function esc_register_post_type(){
$posttypes	=	array(	'services'	=>	array(
												'singular'	=>	'Service',
												'plural'		=>	'Services',
												'supports' 	=> array('title', 'excerpt', 'page-attributes', 'thumbnail'),
												'rewrite' 			=> array(	'slug' => 'service','with_front' => false),
											),
						/*'banners'	=>	array(
											'singular'	=>	'Banner',
											'plural'		=>	'Banners',
											'supports' 	=> array('title', 'excerpt', 'page-attributes', 'thumbnail'),
											'rewrite' 			=> array(	'slug' => 'banners','with_front' => false),
										),*/
						);
	foreach($posttypes as $slug=>$values){
		register_post_type( $slug, array(	'labels' => array('name' 			=> __($values['plural'] ),
														'singular_name' => __($values['singular'] ),
														'add_new' 		=> __( 'Add New '.$values['singular'] ),
														'add_new_item' 	=> __( 'Add New '.$values['singular']  ),
														'not_found' 	=> __( 'There are no '.$values['plural'].' yet' ),
													),
									'public'				=>	true,
									'show_ui' 			=>	true,
									/*'menu_position' 		=> 6,*/
									'publicly_queryable' 	=>	true,
									'can_export' 			=>	true,
									'capability_type' 	=>	'page',
									'exclude_from_search' 	=>	false,
									'hierarchical'		=>	false,
									'supports' 			=>	$values['supports'],
									'rewrite' 			=>	$values['rewrite'],
									'has_archive'			=>	false
								)
						);
	}
	flush_rewrite_rules();
}
?>