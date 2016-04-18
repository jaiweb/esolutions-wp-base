<?php	
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
/*
* Toolpress - Theme Options Wordpress
* V1.0
* By E-Solutions consulting
* http://solutionswebonline.com/tools/toolpress
*/
function esctheme_admin_scripts_styles() {
    $_THEME_URL = get_template_directory_uri();
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script(	'jquery-ui',	'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' );
	wp_enqueue_style(	'jquery-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css' );
	/*wp_enqueue_script( 'jquery-ui', $_THEME_URL . '/js/jquery-ui-1.10.3.custom.js' );
    wp_enqueue_style( 'jquery-ui-css', $_THEME_URL . '/css/jquery-ui-1.10.3.custom.css' );
    wp_enqueue_style( 'admin-css', $_THEME_URL . '/css/admin.css' );*/
}

add_action('admin_head', 'esctheme_admin_scripts_styles');
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
<style type="text/css">
/*  Style for  tabs  main in  theme options */
.ui-tabs.ui-tabs-vertical {padding: 0;width: 98%}
.ui-tabs.ui-tabs-vertical .ui-widget-header {border: none;}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav {float: left;background: #F3F3F3;border-right: 1px solid #DFDFDF;min-height:525px;padding: 0;width: 10%}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active,.ui-tabs.ui-tabs-vertical .ui-tabs-nav li,.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a{border-top-left-radius: 4px !important;border-top-right-radius: 0 !important;}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li {clear: left;width: 100%;margin: 0 !important;border: 0;border-bottom: 1px solid #DFDFDF;border-radius:0;overflow: hidden;position: relative;z-index: 2;background: #EEEEEE;}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a {display: block;width: 100%;padding: 14px;border-top-left-radius: 4px;font-family: Arial;font-size: 12px;color: #333;font-weight: bold}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a:hover {cursor: pointer;background: #f9f9f9;}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active {margin-bottom: 0.2em;padding-bottom: 0;border-right: 1px solid #fff;background: #fff;}
.ui-tabs.ui-tabs-vertical .ui-tabs-nav li:last-child {margin-bottom: 10px;}
.ui-tabs.ui-tabs-vertical .ui-tabs-panel {border-radius: 0 0 0 0;float: left;padding: 1% 1% 1% 2%;position: relative;width: 75%;}
/* wrap style */
.wrap.custom #message{display:none}
.wrap.custom #savesettings-bottom{margin-top:10px}
.wrap.custom h2{margin-bottom:10px}
.wrap.custom h3.subtitle {color: #464646;font-size: 23px;line-height: 1em;padding: 0;}
.wrap.custom th {color: #777777;width: 15%;}

.custom input[type="text"], .custom textarea {width: 98%;margin:1% 0;padding:1%}
.custom textarea:focus,.custom input[type=text]:focus{background:#FFFFCC;border:1px solid #333333}
.upload > img {max-width: 200px;}
.radio-container { border: 1px solid rgb(128, 128, 128);border-radius: 3px; float: left; padding: 5px; width: 50%;}

.radio-container input { float: left;height: 17px; margin-right: 5px;} 
.radio-container label { float: left; margin-right: 5px;} 
</style>
	<script>
// script  for tabs main form theme options
jQuery(document).ready(function(){
    jQuery('#tabs')
    .tabs({
        show: function(event, ui) {
            var _time = '5000';
                var lastOpenedPanel = jQuery(this).data("lastOpenedPanel");
                if (!jQuery(this).data("topPositionTab")) {
                    jQuery(this).data("topPositionTab", jQuery(ui.panel).position().top)
                }
                jQuery(ui.panel).hide().fadeIn(_time);
                if (lastOpenedPanel) {
                    lastOpenedPanel
                        .toggleClass("ui-tabs-hide")
                        .css("position", "absolute")
                        .css("top", jQuery(this).data("topPositionTab") + "px")
                        .fadeOut(_time, function() {
                            jQuery(this)
                            .css("position", "");
                        });
                }
                //Saving the last tab has been opened
                jQuery(this).data("lastOpenedPanel", jQuery(ui.panel));
            }
    })
    .addClass('ui-tabs-vertical ui-helper-clearfix');
});
</script>    
	 
<div class="wrap custom"> 
    <div class="icon32" id="icon-themes"><br></div> 
    <h2>Theme Options</h2> 
	<form id="result" name="result" method="post"> 
		<div id="tabs"> 
			<ul> 
				<li><a href="#tabs-1">General</a></li> 
				<li><a href="#tabs-2">Setting</a></li>  
			</ul> 
            <div id="tabs-1"> 
				<table class="form-table custom">
					<tr>
						<th scope="row"><label for="esc_ga">Google Analitycs</label></th>
						<td><textarea id="esc_ga" name="esc_ga" cols="50" rows="3"><?php echo  $_esc_ga ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label for="esc_custom_css">Custom CSS</label></th>
						<td><textarea id="esc_custom_css" name="esc_custom_css" cols="50" rows="3"><?php echo  $_esc_custom_css ?></textarea></td>
					</tr>
                </table> 
			</div> 
            <div id="tabs-2"> 
				<h3 class="subtitle">Setting</h3>				
				<table class="form-table custom"> 
					<tr>
						<th scope="row"><label for="esc_mode_maintenance">Maintenance</label></th>
						<td><input id="esc_mode_maintenance" name="esc_mode_maintenance" type="checkbox" <?php echo  $_esc_mode_maintenance? 'checked':'' ?> /></td>
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
?>