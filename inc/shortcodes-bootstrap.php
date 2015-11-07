<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

/*
*    Grid Bootstrap
*/
add_shortcode('_col_1', 'esolutions_shortcode_col_1');
add_shortcode('_col_2', 'esolutions_shortcode_col_2');
add_shortcode('_col_3', 'esolutions_shortcode_col_3');
add_shortcode('_col_4', 'esolutions_shortcode_col_4');
add_shortcode('_col_5', 'esolutions_shortcode_col_5');
add_shortcode('_col_6', 'esolutions_shortcode_col_6');
add_shortcode('_col_7', 'esolutions_shortcode_col_7');
add_shortcode('_col_8', 'esolutions_shortcode_col_8');
add_shortcode('_col_9', 'esolutions_shortcode_col_9');
add_shortcode('_col_10','esolutions_shortcode_col_10');
add_shortcode('_col_11','esolutions_shortcode_col_11');
add_shortcode('_col_12','esolutions_shortcode_col_12');
add_shortcode('_row',	'esolutions_shortcode_row');
add_shortcode('_block', 'esolutions_shortcode_block');
function esolutions_shortcode_col($atts, $content=null){
	$a	=	esolutions_shortcode_atts($atts);
    return '<div' . $a['atts'] . '>' . do_shortcode($content) . '</div>';
}
function esolutions_shortcode_col_1($atts, $content=null){    
    $atts['class']    .=    ' col-sm-1';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_2($atts, $content=null){    
    $atts['class']    .=    ' col-sm-2';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_3($atts, $content=null){    
    $atts['class']    .=    ' col-sm-3';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_4($atts, $content=null){    
    $atts['class']    .=    ' col-sm-4';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_5($atts, $content=null){    
    $atts['class']    .=    ' col-sm-5';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_6($atts, $content=null){    
    $atts['class']    .=    ' col-sm-6';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_7($atts, $content=null){    
    $atts['class']    .=    ' col-sm-7';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_8($atts, $content=null){    
    $atts['class']    .=    ' col-sm-8';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_9($atts, $content=null){    
    $atts['class']    .=    ' col-sm-9';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_10($atts, $content=null){    
    $atts['class']    .=    ' col-sm-10';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_11($atts, $content=null){    
    $atts['class']    .=    ' col-sm-11';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_col_12($atts, $content=null){    
    $atts['class']    .=    ' col-sm-12';
    return do_shortcode(esolutions_shortcode_col($atts, $content));
}
function esolutions_shortcode_row($atts, $content){
	$a	=	esolutions_shortcode_atts($atts);
    $content    =    esc_remove_br_p($content);
    return '<div class="row' . $a['class'] . '">' . do_shortcode($content) . '</div>';
}
function esolutions_shortcode_block($atts, $content){
	$a	=	esolutions_shortcode_atts($atts);
    $content    =    esc_remove_br_p($content);
    return '<div' . $a['atts'] . '>' . do_shortcode($content) . '</div>';
}
function esolutions_shortcode_atts_defaults(){
	$_defaults	=	array(					
					'id'		=>	'',
					'class'		=>	'',
					'style'		=>	'',
					'pd'		=>	'',
					'margin'	=>	'',
					'effect'	=>	'',
					'delay'		=>	'',					
					'bg_color'	=>	'',
					'color'		=>	'',
					'col'		=>	12,
					'data'		=>	''
				);
	return $_defaults;
}
function esolutions_shortcode_atts($atts, $additionals=array()){
	$_defaults	=	esolutions_shortcode_atts_defaults();
	$_defaults	=	array_merge($_defaults, $additionals);
	$a			=	shortcode_atts( $_defaults, $atts );
	$a	=	array_map('trim',$a);
	global $_shortcode_styles, $_shortcode_styles_index;
	$_custom_class	=	'class_custom_' . $_shortcode_styles_index;
	if($a['effect']){
		$a['effect']	=	' wow ' . $a['effect'];
		if($a['delay'])
			$a['delay']	=	' data-wow-delay="' . $a['delay'] . '" ';
	}else
		$a['delay']	=	'';
	
	$input = 'font-size';
	$data = explode(' ', $a['class']);//array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');
	$_has_font_size_class = array_filter($data, function ($item) use ($input) {
												if (stripos($item, $input) !== false) {
													return true;
												}
												return false;
											});
	if($_has_font_size_class){
		$_custom_font_size	=	'';
		foreach($_has_font_size_class as $key=>$font_size){
			$size	=	explode('-', $font_size);
			$value	=	$size[2];
			$_number	=	preg_replace('/[^0-9]/','',$value);
			$_unit 	=	preg_replace('/[0-9]/','',$value);
			if(!in_array($_unit,array('px', 'em')))
				$_unit	=	'px';
				
			$_custom_font_size	=	'font-size:' . $_number . $_unit . ';';
		}
		$a['font-size']	.=	$_custom_font_size;
		$_shortcode_styles['desktop']['font-size-' . $_number][]	=	$a['font-size'];
	}
//	_print($_has_font_size_class);
	if($a['id'])	$a['id']	=	' id="' . $a['id'] . '"';	
	if($a['class'])	$a['class']	=	' ' . $a['class'];
/*	Style	*/
	/*if($a['font-size']){		
		$_shortcode_styles['desktop'][$_custom_class][]	=	$a['font-size'];
	}*/
	if(strlen($a['margin'])>0){
		$a['style']	.=	'margin:' . $a['margin'] . ';';
		$_shortcode_styles['desktop'][$_custom_class][]	=	'margin:' . $a['margin'] . ';';
	}
	if(strlen($a['pd'])>0){
		$a['style']	.=	'padding:' . $a['pd'] . ';';
		$_shortcode_styles['desktop'][$_custom_class][]	=	'padding:' . $a['pd'] . ';';
	}
	if($a['bg_color']){
		$a['style']	.=	'background-color:' . $a['bg_color'] . ';';
		$_shortcode_styles['global'][$_custom_class][]	=	'background-color:' . $a['bg_color'] . ';';
	}
	if($a['color']){
		$a['style']	.=	'color:' . $a['color'] . ';';
		$_shortcode_styles['global'][$_custom_class][]	=	'color:' . $a['color'] . ';';
	}
	
	if($a['style']){
		//$_shortcode_styles[''][$_custom_class]	=	$a['style'];		
		$a['class']	.= ' ' . $_custom_class;
		$_shortcode_styles_index++;
		$a['style']	=	' style="' . $a['style'] . '"';		
	}
	if($a['class'])
		$a['_class']	=	' class="' . $a['class'] . $a['effect'] . '"';
	//$a['atts']	=	$a['_class'] . $a['style'] . $a['delay'];
	$a['atts']	=	$a['_class'] . $a['delay'];
	return $a;
}
function esolutions_shortcode_wp_footer(){
	global $_shortcode_styles;//_print($_shortcode_styles);
?>
<style type="text/css">
<?php	foreach($_shortcode_styles['global'] as $key=>$value)	:	?>
		.<?php	echo $key ?>{<?php echo implode('',$value) ?>}
<?php	endforeach;	?>
	@media (min-width:1096px){
	<?php	foreach($_shortcode_styles['desktop'] as $key=>$value)	:	?>
		.<?php	echo $key ?>{<?php echo implode('',$value) ?>}
	<?php	endforeach;	?>
	}
</style>
<?php	
}
add_action('wp_footer', 'esolutions_shortcode_wp_footer',100);
//add_action('wp_head', 'esolutions_shortcode_wp_footer',100);
add_action('pre_get_posts','esolutions_shortcode_pre_get_posts');
function esolutions_shortcode_pre_get_posts(){
	global $_shortcode_styles, $_shortcode_styles_index;
	$_shortcode_styles_index	=	1;
}
/*
*    Custom shortcodes
*/
add_shortcode('_entry_title','esolutions_shortcode_title');
function esolutions_shortcode_title($atts, $content=null){
    extract( shortcode_atts( array(
            'class'    =>    ''
        ), $atts ) );    
    if($class)
        $class = ' class="' . $class . '"';
    $content = '<h2 class="entry-title'. $class . '">' . $content . '</h2>';
    return do_shortcode($content);
}
?>
