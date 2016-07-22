<?php
add_action( 'in_widget_form', '_esc_in_widget_form', 10, 3 );
function _esc_in_widget_form( $widget, $return, $instance ) {
	if ( !isset( $instance['classes'] ) ) $instance['classes'] = null;
	$fields = '';
	// show id field
	if ( !isset( $instance['ids'] ) ) $instance['ids'] = null;
	/*$fields .= "\t<p><label for='widget-{$widget->id_base}-{$widget->number}-ids'>".apply_filters( 'widget_css_classes_id', esc_html__( 'CSS ID', 'widget-css-classes' ) ).":</label>
	<input type='text' name='widget-{$widget->id_base}[{$widget->number}][ids]' id='widget-{$widget->id_base}-{$widget->number}-ids' value='{$instance['ids']}' class='widefat' /></p>\n";*/
	// show text field only
	$fields .= "\t<p><label for='widget-{$widget->id_base}-{$widget->number}-classes'>".apply_filters( 'widget_css_classes_class', esc_html__( 'CSS Classes', 'widget-css-classes' ) ).":</label>
	<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' value='{$instance['classes']}' class='widefat' /></p>\n";
	do_action( 'widget_css_classes_form', $fields, $instance );
	echo $fields;
	return $instance;
}
add_filter( 'widget_update_callback', '_esc_widget_update_callback', 10, 2 );
function _esc_widget_update_callback( $instance, $new_instance ) {
	$instance['classes'] = $new_instance['classes'];
	/*$instance['ids']     = $new_instance['ids'];*/
	return $instance;
}
add_filter( 'dynamic_sidebar_params', '_esc_dynamic_sidebar_params' );
function _esc_dynamic_sidebar_params( $params ) {
	/*if ( is_admin() )
		return ;*/
	global $wp_registered_widgets, $widget_number;
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	$this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
	$widget_id              = $params[0]['widget_id'];
	$widget_obj             = $wp_registered_widgets[$widget_id];
	$widget_num             = $widget_obj['params'][0]['number'];
	$widget_opt             = null;
	// Default callback
	if ( isset( $widget_obj['callback'][0]->option_name ) ) {
		$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	}
	// Add classes
	if ( isset( $widget_opt[$widget_num]['classes'] ) && !empty( $widget_opt[$widget_num]['classes'] ) ) {
		// Add all classes
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
	}
	// Add id
	if ( isset( $widget_opt[$widget_num]['ids'] ) && !empty( $widget_opt[$widget_num]['ids'] ) )
		$params[0]['before_widget'] = preg_replace( '/id="[^"]*/', "id=\"{$widget_opt[$widget_num]['ids']}", $params[0]['before_widget'], 1 );
	// Add first, last, even, and odd classes
	if ( !$widget_number ) {
		$widget_number = array();
	}
	if ( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) {
		return $params;
	}
	if ( isset( $widget_number[$this_id] ) ) {
		$widget_number[$this_id]++;
	} else {
		$widget_number[$this_id] = 1;
	}
	$class	=	'class="';
	/*show_id*/
	$class	.=	esc_attr__( 'widget-', 'esc' ) .$widget_number[$this_id].' ';
	/*show_location*/
	$widget_first	=	apply_filters( 'widget_css_classes_first', esc_attr__( 'widget-first', 'widget-css-classes' ) );
	$widget_last	=	apply_filters( 'widget_css_classes_last', esc_attr__( 'widget-last', 'widget-css-classes' ) );
	if ( $widget_number[$this_id] == 1 ) {
		$class	.=	$widget_first.' ';
	}
	if ( $widget_number[$this_id] == count( $arr_registered_widgets[$this_id] ) ) {
		$class	.=	$widget_last.' ';
	}
	/*show_evenodd*/
	$widget_even	=	apply_filters( 'widget_css_classes_even', esc_attr__( 'widget-even', 'widget-css-classes' ) );
	$widget_odd		=	apply_filters( 'widget_css_classes_odd', esc_attr__( 'widget-odd', 'widget-css-classes' ) );
	$class	.=	( ( $widget_number[$this_id] % 2 ) ? $widget_odd.' ' : $widget_even.' ' );
	$params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] );
	return $params;
}
	
?>