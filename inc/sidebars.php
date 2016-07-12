<?php
/*
* Custom Sidebars 
* Version: 1.0
*/
class _esc_sidebars {
	public function __construct(){
		add_action("admin_enqueue_scripts", array(&$this, '_esc_sidebars_load_script'));
		add_action("init",array(&$this, '_esc_sidebars_register_post_type'));
		add_action("init",array(&$this, '_esc_sidebars_register_sidebars'));
		add_action('wp_ajax_create_sidebar',array(&$this, '_esc_sidebars_ajax_new_sidebar'));
		add_action('add_meta_boxes', array(&$this, '_esc_sidebars_add_metabox'));
		add_action('save_post', array(&$this, '_esc_sidebars_save_metabox'));
	}
	public function _esc_sidebars_load_script() {
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-sortable");
		
		wp_enqueue_script("esolutions_sidebars_js", _ESC_JS . "sidebars.js");
		wp_enqueue_style("esolutions_sidebars_style", _ESC_CSS . "sidebars.css");
	}
	public function _esc_sidebars_register_sidebars (){
		global $wpdb;
		$_esc_sidebars = $wpdb -> get_results("SELECT ID,post_content,post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'esc-sidebars'");
		if (!empty($_esc_sidebars)) {
			foreach ((array) $_esc_sidebars as $sidebar) {
				register_sidebar(	array(	'name'			=>	get_the_title($sidebar -> ID),
											'id'			=>	"esc_sidebars_" . $sidebar -> ID,
											'description'	=>	apply_filters("the_content", $sidebar -> post_content),
											'before_widget'	=>	'<aside id="%1$s" class="widget-container esc-sidebars widget %2$s">',
											'after_widget'	=>	'</aside>',
											'before_title'	=>	'<h3 class="widget-title">', 'after_title' => '</h3>'
										)
								);
			}
		}
	}
	public function _esc_sidebars_register_post_type(){
		if (function_exists("register_post_type")) {
			$labels = array(	'name' => __('Sidebars', 'esc'), 
							'singular_name' => __('Sidebar', 'esc'), 
							'add_new' => __('Agregar sidebar', 'esc'), 
							'add_new_item' => __('Agregar nuevo sidebar', 'esc'), 
							'edit_item' => __('Editar sidebar', 'esc'), 
							'new_item' => __('Nuevo sidebar', 'esc'), 
							'all_items' => __('Todos los sidebars', 'esc'), 
							'view_item' => __('Ver sidebar', 'esc'), 
							'search_items' => __('Buscar sidebars', 'esc'), 
							'not_found' => __('No se encontraron sidebar', 'esc'), 
							'not_found_in_trash' => __('No se encontraron sidebars en la papelera', 'esc'), 
							'parent_item_colon' => '', 'menu_name' => __('Sidebars', 'esc')
						);
			$args = array(	'labels' => $labels,
							'public' => true, 
							'publicly_queryable' => true, 
							'show_ui' => true, 
							'show_in_menu' => false, 
							'query_var' => true, 
							'rewrite' => true, 
							'capability_type' => 'post', 
							'has_archive' => false, 
							'hierarchical' => false, 
							'menu_position' => 83, 
							'supports' => array('title')
						);			
			register_post_type('esc-sidebars', $args);
		}
	}
	public function _esc_sidebars_ajax_new_sidebar(){
		if (isset($_POST['new_sidebar']) && $_POST['new_sidebar'] != '') {
			if (wp_verify_nonce($_POST['esc_sidebars_create_sidebar'], "esc-sidebars")) {
				$post = array('post_content' => '', 'post_status' => 'publish', 'post_title' => $_POST['new_sidebar'], 'post_type' => "esc-sidebars", );
				$id_post = wp_insert_post($post);
				if($id_post){
					$dev = array("ID"=>$id_post,"post_title"=>$_POST['new_sidebar']);
					echo json_encode($dev);
				}else{
					echo false;
				}
				exit();
				die();
			}
		}
		echo false;
		exit();
		die();
	}
	public function _esc_sidebars_add_metabox(){
		$post_types = get_post_types('');
		foreach ($post_types as $post_type) {
			/*if ($post_type != "esc-sidebars") {*/
			if ($post_type == 'page') {
				add_meta_box('custom_sidebar_metabox', __('Custom Sidebar(s)', 'esc'), array(&$this, '_esc_sidebars_view_metabox'), $post_type, 'side', 'default');
			}
		}
	}
	public function _esc_sidebars_view_metabox(){
		wp_nonce_field(plugin_basename(__FILE__), 'esolutions_sidebars_noncename');
		if(isset($_GET['post'])){
			$sidebars = get_post_meta($_GET['post'], "esc_sidebars", true);
		}else{
			$sidebars = '';
		}
		$this -> _esc_sidebars_view_sidebars($sidebars);
	}
	public function _esc_sidebars_save_metabox($post_id){
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;

		if (!isset($_POST['esolutions_sidebars_noncename']) || !wp_verify_nonce($_POST['esolutions_sidebars_noncename'], plugin_basename(__FILE__)))
			return;

		$sidebarsDefault='';
		if ($_POST['esc-sidebars'] == '' && $sidebarsDefault == '') {
			$sidebars = '';
		} elseif($_POST['esc-sidebars'] == '' && $sidebarsDefault != ''){
			$sidebars = $sidebarsDefault;
		} else {
			$sidebars = $_POST['esc-sidebars'];
		}
		update_post_meta($post_id, "esc_sidebars", $sidebars);
	}	
	function _esc_sidebars_view_sidebars($sidebars,$opcion=''){
		$inactives = $actives = $todos = '';
		$id_sidebar = "esc-sidebars-default";
		if (preg_match("#^" . $id_sidebar . "|\," . $id_sidebar . "\,|" . $id_sidebar . "$#", $sidebars)) {
			$a = explode(",", $sidebars);
			for ($i = 0; $i < count($a); $i++) {
				if ($a[$i] == $id_sidebar) {
					$actives[$i] = '<div id="esc-sidebars-default">Default<a href="javascript:return false;" class="add"></a><a href="javascript:return false;" class="remove"></a><a href="javascript:return false;" class="up"><a href="javascript:return false;" class="down"></a></div>';
				}
			}
		} else {
			$inactives .= '<div id="esc-sidebars-default">Default<a href="javascript:return false;" class="add"></a><a href="javascript:return false;" class="remove"></a><a href="javascript:return false;" class="up"><a href="javascript:return false;" class="down"></a></div>';
		}
		global $wpdb;
		$_esc_sidebars = $wpdb -> get_results("SELECT ID,post_content,post_title FROM $wpdb->posts WHERE post_status = 'publish'	AND post_type = 'esc-sidebars'");
		if (!empty($_esc_sidebars)) {
			foreach ($_esc_sidebars as $sidebar) {
				$id_sidebar = "esc_sidebars_" . $sidebar -> ID;
				$nombre_sidebar = $sidebar -> post_title;
				if (preg_match("#^" . $id_sidebar . "|\," . $id_sidebar . "\,|" . $id_sidebar . "$#", $sidebars)) {
					$a = explode(",", $sidebars);
					for ($i = 0; $i < count($a); $i++) {
						if ($a[$i] == $id_sidebar) {
							$actives[$i] = '<div id="' . $id_sidebar . '">' . $nombre_sidebar . '<a href="javascript:return false;" class="add"></a><a href="javascript:return false;" class="remove"></a><a href="javascript:return false;" class="up"><a href="javascript:return false;" class="down"></a></div>';
						}
					}
				} else {
					$inactives .= '<div id="' . $id_sidebar . '">' . $nombre_sidebar . '<a href="javascript:return false;" class="add"></a><a href="javascript:return false;" class="remove"></a><a href="javascript:return false;" class="up"><a href="javascript:return false;" class="down"></a></div>';
				}
			}
		}
		echo "<div class='esc_sidebars_block _esc_sidebars".$opcion."' id='esolutions_sidebars".$opcion."'>";
		echo '<h5>' . __('Drag and Drop from "inactive" to  "active"', 'esc') . '</h5>';
		echo '<input type="hidden" class="esc-sidebars" name="esc-sidebars'.$opcion.'" value="' . $sidebars . '" id="esc-sidebars"/>';
		echo __('Inactive', 'esc') . '<br/><div id="inactives" class="'.$opcion.' sidebars-sortable inactives">' . $inactives . '</div>';
		echo __('Active', 'esc') . '<br/><div id="actives" class="'.$opcion.' sidebars-sortable actives">';
		$sidebars = preg_replace("/,$/",'',$sidebars);
		$a = explode(",", $sidebars);
		for ($i = 0; $i < count($a); $i++) {
			if(isset($actives[$i])){
				echo $actives[$i];
			}
		}
		echo '</div>';		
		echo '<a class="buttons btadd" href="javascript:return false;" title="'.__("Add new sidebar",'esc').'"><img src="'. _ESC_IMAGES .'admin/mas2.png" /></a>';
		echo '<a class="buttons btmodificar" href="'.admin_url().'/widgets.php" target="_blank" title="'.__("Edit widgets sidebars",'esc').'"><img src="'. _ESC_IMAGES .'admin/editar.png" /></a>';
		wp_nonce_field("esc-sidebars", 'esc_sidebars_create_sidebar');
		echo '<div class="clear"></div>';
		echo '<div class="new_sidebar"><b>'.__("Add new sidebar",'esc').'</b><br/><input placeholder="'.__("Name sidebar",'esc').'" type="text" name="new_sidebar" /><input onclick="javascript:return false;" type="submit" class="create_sidebar" value="'.__("Crear",'esc').'" class="button-primary" /><img src="'. _ESC_IMAGES .'admin/loading.gif" class="loading" /></div>';
		echo '<div class="clear"></div></div>';
	}
	public function dynamic_sidebar($post_id='', $default) {
		if(!$post_id){
			global $post;
			$post_id	=	$post -> ID;
		}
		$default	=	array($default);
		$sidebars	=	get_post_meta($post_id, "esc_sidebars", true);
		$success	=	false;
		$sidebars	=	empty($sidebars) ? $default : explode(',', $sidebars);
		foreach ($sidebars as $sidebar) {
			if($sidebar=='esc-sidebars-default')
				$sidebar	=	_ESC_SIDEBAR_DEFAULT;
			/*if (is_active_sidebar($sidebar)) {
				$success	=	dynamic_sidebar($sidebar) ? true : $success;
			}*/
			if (is_active_sidebar($sidebar)) {
				dynamic_sidebar($sidebar);
			}
		}
		/*return $success;*/
		return true;
	}
}
$_esc_sidebars = new _esc_sidebars();
function _esc_sidebars_dynamic_sidebar($default='sidebar-page'){
	global $_esc_sidebars,$is_blog_page, $current_post_id;
	if($is_blog_page)
		return $_esc_sidebars->dynamic_sidebar($current_post_id, $default);

	if(is_single() || is_category() || is_tag() || is_author() || is_date() ){
		$page_for_posts	=	get_option( 'page_for_posts' );
		$return	=	$_esc_sidebars->dynamic_sidebar($page_for_posts, $default);
	}else
		$return	=	$_esc_sidebars->dynamic_sidebar('', $default);

	return $return;
}

function _esc_sidebars_is_active_sidebar($default='sidebar-page'){
	global $post;
	$post_id	=	$post -> ID;
	$sidebars	=	get_post_meta($post_id, "esc_sidebars", true);
	/*_print($sidebars);*/
	$sidebars	=	empty($sidebars) ? array($default) : explode(',', $sidebars);
	foreach ($sidebars as $sidebar) {
		if($sidebar=='esc-sidebars-default')
			$sidebar	=	_ESC_SIDEBAR_DEFAULT;

		if (is_active_sidebar($sidebar))
			return true;
	}
	return false;
}
?>