<?php	
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
/*
* Toolpress - Theme Options Wordpress
* V1.0
* By E-Solutions consulting
* http://solutionswebonline.com/tools/toolpress
*/
function _esc_admin_print_scripts() {
    $_THEME_URL = get_template_directory_uri();
    wp_enqueue_script( 'jquery' );
    /*wp_enqueue_script( 'jquery-ui-core' );*/
    /*wp_enqueue_script(	'jquery-ui',	'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' );*/
	wp_enqueue_style(	'jquery-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css');
    /*wp_enqueue_script(	'jquery-ui-core');*/
    /*wp_enqueue_script(	'jquery-ui-widget');
    wp_enqueue_script(	'jquery-ui-dialog');*/
	wp_enqueue_script ('jquery-ui-tabs');
	wp_enqueue_script ('esc-js-codemirror', $_THEME_URL . '/js/admin/codemirror.js' );
	wp_enqueue_style  ('esc-css-codemirror', $_THEME_URL . '/css/admin/codemirror.css' );
	wp_enqueue_script ('esc-js-codemirror-css', $_THEME_URL . '/js/admin/css.js');
	wp_enqueue_script ('esc-js-theme-options', $_THEME_URL . '/js/admin/theme-options.js' );
	/*_print($_THEME_URL . '/js/admin/theme-options.js');*/
}
add_action('admin_print_scripts-appearance_page_theme_options', '_esc_admin_print_scripts');
add_action('admin_menu', 'mi_add_pages');
function mi_add_pages() {
	add_theme_page( __( 'Theme Options', 'esctheme' ), __( 'Theme Options', 'esc' ), 'edit_theme_options', 'theme_options', 'customize_theme_page' );
}
function customize_theme_page(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	if($_POST['save_changes']){
		update_option('_esc_ga', stripcslashes($_POST['esc_ga']));
		update_option('_esc_custom_css', stripcslashes($_POST['esc_custom_css']));
		update_option('_esc_mode_maintenance', isset($_POST['esc_mode_maintenance']))? '1':'0';
	}
	$_esc_ga	=	esc_textarea(get_option('_esc_ga'));
	$_esc_custom_css	=	esc_textarea(get_option('_esc_custom_css'));
	$_esc_mode_maintenance	=	esc_textarea(get_option('_esc_mode_maintenance'));
?>
<div class="wrap esc"> 
    <div class="icon32" id="icon-themes"><br></div> 
    <h2>Theme Options</h2> 
	<form id="result" name="result" method="post"> 
		<div id="tabs"> 
			<ul> 
				<li><a href="#tabs-1"><span class="dashicons dashicons-admin-settings"></span> General Setting</a></li> 
				<li><a href="#tabs-2"><span class="dashicons dashicons-admin-settings"></span> Setting</a></li>  
				<li><a href="#tabs-3"><span class="dashicons dashicons-admin-settings"></span> Custom CSS</a></li>  
			</ul> 
            <div id="tabs-1"> 
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="esc_ga">JavaScript code</label>
							<span class="description">Paste your tracking code or any script you need.
							This will be loaded in the footer.</span>
						</th>
						<td><textarea id="esc_ga" name="esc_ga" cols="50" rows="3"><?php echo  $_esc_ga ?></textarea></td>
					</tr>
                </table> 
			</div> 
            <div id="tabs-2"> 
				<h3 class="subtitle">Setting</h3>				
				<table class="form-table"> 
					<tr>
						<th scope="row"><label for="esc_mode_maintenance">Maintenance</label></th>
						<td><input id="esc_mode_maintenance" name="esc_mode_maintenance" type="checkbox" <?php echo  $_esc_mode_maintenance? 'checked':'' ?> /></td>
					</tr>
                </table> 
			</div> 
			<div id="tabs-3">				
				<h3 class="subtitle">Custom CSS</h3>
				<textarea id="esc_custom_css" name="esc_custom_css" cols="50" rows="3"><?php echo  $_esc_custom_css ?></textarea></td>
				<table class="form-table"> 
					<tr>
						<td>
							
						</td>
					</tr>
				</table>
			</div>
		</div> 
		<div id="savesettings-bottom"> 
			<input type="hidden" name="save_changes" value="true" /> 
			<input type="submit" name="Submit" value="Save All Changes" class="button-primary" /> 
			<div class="clear"></div> 
		</div> 
	</form> 
</div>

<?php 
}
function sccss_maybe_print_css() {
	$raw_content     = get_option( '_esc_custom_css' );
	$content     = wp_kses( $raw_content, array( '\'', '\"' ) );
	$content     = str_replace( '&gt;', '>', $content );
	echo '<style type="text/css">' . $content . '</style>'; //xss okay
}
add_action( 'wp_print_styles', 'sccss_maybe_print_css', 100 );

?>