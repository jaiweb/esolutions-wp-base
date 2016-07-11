<?php 
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'WooCommerce' ) ) 
	return ;

add_action( 'after_setup_theme', '_esc_woo_after_setup_theme' );
function _esc_woo_after_setup_theme() {
    add_theme_support( 'woocommerce' );
}

//add_filter( 'woocommerce_enqueue_styles', '_esc_woo_woocommerce_enqueue_styles' );
function _esc_woo_woocommerce_enqueue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}
// Or just remove them all in one line
/*add_filter( 'woocommerce_enqueue_styles', '__return_false' );*/

add_action('wp_enqueue_scripts', '_esc_woo_wp_enqueue_scripts', 50);
function _esc_woo_wp_enqueue_scripts(){
	/*wp_enqueue_style('esc-woo-layout-css', get_template_directory_uri() . '/css/woo/woocommerce-layout.css');
	wp_enqueue_style('esc-woo-smallscreen-css', get_template_directory_uri() . '/css/woo/woocommerce-smallscreen.css');
	wp_enqueue_style('esc-woo-css', get_template_directory_uri() . '/css/woo/woocommerce.css');*/
	wp_enqueue_style( 'esc-woo', _ESC_CSS . 'woo.css', array(), '' );
}

/*add_action( 'enqueue_embed_scripts', '_esc_woo_enqueue_embed_scripts' );*/
add_action( 'wp_footer', '_esc_woo_enqueue_embed_scripts' );
function _esc_woo_enqueue_embed_scripts(){
?>
<style type="text/css">
.woocommerce form .form-row .select2-container {height: auto;padding: 0;}
.woocommerce form .select2-container .select2-choice {border: medium none;}
</style>
<?php
}

add_action('woocommerce_checkout_before_customer_details', '_esc_woo_woocommerce_checkout_before_customer_details');
function _esc_woo_woocommerce_checkout_before_customer_details(){
	echo '<div class="col-sm-7">';
}
add_action('woocommerce_checkout_after_customer_details', '_esc_woo_woocommerce_checkout_after_customer_details');
function _esc_woo_woocommerce_checkout_after_customer_details(){
	echo '</div><div class="col-sm-5">';
}

add_action('woocommerce_checkout_after_order_review', '_esc_woo_woocommerce_checkout_after_order_review');
function _esc_woo_woocommerce_checkout_after_order_review(){
	echo '</div>';
}
/*add_filter( 'loop_shop_columns', '_esc_woo_loop_shop_columns' );*/
function _esc_woo_loop_shop_columns($columns){
	$columns	=	3;
	return $columns;
}
/*add_filter( 'post_class', '_esc_woo_post_class' );*/
function _esc_woo_post_class( $classes ) {
	global $product, $woocommerce_loop;
	if(!$woocommerce_loop)
		return $classes;
	switch($woocommerce_loop['columns']){
		case '3':
			$classes[]	=	'col-sm-4 col-xs-6';
			break;
		case '5':
			$classes[]	=	'col-sm-5 col-xs-6';
			break;
		default:
			$classes[]	=	'col-sm-3 col-xs-6';
	}
	return $classes;
}

add_filter('woocommerce_checkout_fields', '_esc_woo_woocommerce_checkout_fields' );
function _esc_woo_woocommerce_checkout_fields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            $field['class'][] = 'form-group';
            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}
/*
add_action('woocommerce_checkout_before_customer_details', '_esc_woo_woocommerce_checkout_before_customer_details');
function _esc_woo_woocommerce_checkout_before_customer_details(){
	echo '<div class="col-sm-7">';
}
add_action('woocommerce_checkout_after_customer_details', '_esc_woo_woocommerce_checkout_after_customer_details');
function _esc_woo_woocommerce_checkout_after_customer_details(){
	echo '</div><div class="col-sm-5">';
}

add_action('woocommerce_checkout_after_order_review', '_esc_woo_woocommerce_checkout_after_order_review');
function _esc_woo_woocommerce_checkout_after_order_review(){
	echo '</div>';
}*/
function yf_woocommerce_checkout_update_order_review( $post_data ) {
	global $woocommerce;
	parse_str( $post_data, $post_data );
	/*_print($post_data);
	_print($woocommerce->cart->cart_contents);*/
	if ( empty($post_data['_esc_field_amount_another'] ))
		return ;
	
	foreach ( $woocommerce->cart->cart_contents as $key => $value ) {
		$_pf = new WC_Product_Factory();
		$_product = $_pf->get_product($value['data']->id);
		$value['data']->price = $post_data['_esc_field_amount_another'];
	}	
	//exit;
}
/*add_action( 'woocommerce_checkout_update_order_review', 'yf_woocommerce_checkout_update_order_review' );*/

/*add_action('woocommerce_after_checkout_validation', '_esc_woocommerce_after_checkout_validation');*/
function _esc_woocommerce_after_checkout_validation(){
	/*_print($_REQUEST);*/
	
	/*$_REQUEST['_esc_field_amount'] => 500*/
    if(!empty($_REQUEST['_esc_field_amount_another'])){
		/*
		global $woocommerce;
		$woocommerce->session->donation_price = 666999;
		 // Recalc our totals
		WC()->cart->calculate_totals();
		woocommerce_cart_totals();*/
		return ;
		
	}
	
	
	/*
	if(isset($_REQUEST['donation_now_checked'])){
		
		global $woocommerce;
		$woocommerce->session->donation_price = 666999;	
		return ;
	}*/
		
	$result['result'] = 'success';
	if ( is_ajax() )
		wp_send_json( $result );
	
	exit;	
}
/**
 * Add the field to the checkout
 */
/*add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );*/
/*add_action( 'woocommerce_checkout_before_customer_details', 'my_custom_checkout_field' );*/

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field"><h2>' . __('My Field') . '</h2>';

    woocommerce_form_field( '_esc_confirm_order', array(
        'type'          => 'checkbox',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('do click for confirm'),
        ), $checkout->get_value( '_esc_confirm_order' ));
	
	$_esc_field_amount	=	500;/*$checkout->get_value( '_esc_field_amount' );*/
    woocommerce_form_field( '_esc_field_amount', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-first'),
        'label'         => __('Amount'),
        'required'         => true,
        'placeholder'   => __('Enter Amount'),
        ), $_esc_field_amount);
    woocommerce_form_field( '_esc_field_amount_another', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-last'),
        'label'         => __('Another Amount'),
        'placeholder'   => __('Enter Another Amount'),
        ), $checkout->get_value( '_esc_field_amount_another' ));

    echo '</div>';

}

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}