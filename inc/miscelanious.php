<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

add_filter('body_class','_esc_filter_body_class_browser_body_class');
function _esc_filter_body_class_browser_body_class($classes) {
  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

  if($is_lynx) $classes[] = 'lynx';
  elseif($is_gecko) $classes[] = 'gecko';
  elseif($is_opera) $classes[] = 'opera';
  elseif($is_NS4) $classes[] = 'ns4';
  elseif($is_safari) $classes[] = 'safari';
  elseif($is_chrome) $classes[] = 'chrome';
  elseif($is_IE) $classes[] = 'ie';
  else $classes[] = 'unknown';

  if($is_iphone) $classes[] = 'iphone';
  return $classes;
}



    add_filter('manage_posts_columns', '_esc_posts_columns_id', 5);
    add_action('manage_posts_custom_column', '_esc_posts_custom_id_columns', 5, 2);
    add_filter('manage_pages_columns', '_esc_posts_columns_id', 5);
    add_action('manage_pages_custom_column', '_esc_posts_custom_id_columns', 5, 2);

function _esc_posts_columns_id($columns){
	if ( !is_array( $columns ) )
		$columns = array();
	
	$new = array();	
	foreach( $columns as $key => $title ) {
		if ( $key == 'title' ) // Put the Thumbnail column before the Title column
			$new['featured-image'] = __( 'Featured<br>Image' );
		
		$new[$key] = $title;
	}
	return $new;
}
function _esc_posts_custom_id_columns($column_name, $post_id){
	if ( 'featured-image' != $column_name )
		return;			
	
	$image_src = _esc_get_the_image( $post_id );
				
	if ( empty( $image_src ) ) {
		echo "&nbsp;"; // This helps prevent issues with empty cells
		return;
	}
	
	echo '<img alt="' . esc_attr( get_the_title() ) . '" src="' . esc_url( $image_src ) . '" width="48" height="48" />';
			
	/*if($column_name === 'featured-image'){
        	echo $id;
    }*/
}
/**
 * Function to get the image
 *
 * @since		0.1
 * @updated	0.1.3 - Added wp_cache_set()
 * @updated 	0.1.9 - fixed persistent cache per post_id
 * @ref			http://www.ethitter.com/slides/wcmia-caching-scaling-2012-02-18/#slide-11
 */
function _esc_get_the_image( $post_id = false ) {
	
	$post_id	= (int) $post_id;
	$cache_key	= "featured_image_post_id-{$post_id}-_thumbnail";
	$cache		= wp_cache_get( $cache_key, null );
	
	if ( !is_array( $cache ) )
		$cache = array();

	if ( !array_key_exists( $cache_key, $cache ) ) {
		if ( empty( $cache) || !is_string( $cache ) ) {
			$output = '';
				
			if ( has_post_thumbnail( $post_id ) ) {
				$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), array( 36, 32 ) );
				
				if ( is_array( $image_array ) && is_string( $image_array[0] ) )
					$output = $image_array[0];
			}
			
			if ( empty( $output ) ) {
				//$output = plugins_url( 'images/default.png', __FILE__ );
				$output = apply_filters( 'featured_image_column_default_image', $output );
			}
			
			$output = esc_url( $output );
			$cache[$cache_key] = $output;
			
			wp_cache_set( $cache_key, $cache, null, 60 * 60 * 24 /* 24 hours */ );
		}
	}
	
	// Make sure we're returning the cached image HT: https://wordpress.org/support/topic/do-not-display-image-from-cache?replies=1#post-6773703
	return isset( $cache[$cache_key] ) ? $cache[$cache_key] : $output;
}

add_filter( 'manage_pages_columns', 'page_column_views' );
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
function page_column_views( $defaults )
{
   $defaults['page-layout'] = __('Template');
   return $defaults;
}
function page_custom_column_views( $column_name, $id )
{
   if ( $column_name === 'page-layout' ) {
       $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
       if ( $set_template == 'default' ) {
           echo 'Default';
       }
       $templates = get_page_templates();
       ksort( $templates );
       foreach ( array_keys( $templates ) as $template ) :
           if ( $set_template == $templates[$template] ) echo $template;
       endforeach;
   }
}
/*
enable Contact form 7 only on specified pages
*/
add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 100 );
function deregister_cf7_javascript() {
    if ( !is_page(array(8,10)) ) {
		wp_dequeue_script( 'contact-form-7' );
        wp_deregister_script( 'contact-form-7' );
    }
}
add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
function deregister_cf7_styles() {
    if ( !is_page(array(8,10)) ) {
		wp_dequeue_style( 'contact-form-7' );
        wp_deregister_style( 'contact-form-7' );
		
    }
}

function wps_login_error() {
	remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'wps_login_error');
function  custom_login_title() {
        return get_option('blogname');
}
add_filter('login_headertitle', 'custom_login_title');
function loginLogo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/logo.gif) !important; }
    </style>';
}
add_action('login_head', 'loginLogo');

/*
When developing in wordpress you may have a need for 
the hook_suffix that can later be used to register a 
hook called on a particular page load-hook_suffix. 
 enable and disable as needed when working on a project.
*/

add_action( 'admin_notices', 'wps_print_admin_pagehook' );
function wps_print_admin_pagehook(){
    global $hook_suffix;
    if( !current_user_can( 'manage_options') )
        return;
    ?>
    <div class="updated notice notice-success is-dismissible"><p><?php echo $hook_suffix; ?></p></div>
    <?php
}



/*
hide the update nag within the wordpress admin.
*/
function remove_upgrade_nag() {
   echo '<style type="text/css">
           .update-nag {display: none}
         </style>';
}






function wp_custom_archive($args = '') {
    global $wpdb, $wp_locale;

    $defaults = array(
        'limit' => '',
        'format' => 'html', 'before' => '',
        'after' => '', 'show_post_count' => false,
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    if ( '' != $limit ) {
        $limit = absint($limit);
        $limit = ' LIMIT '.$limit;
    }

    // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
    $archive_date_format_over_ride = 0;

    // options for daily archive (only if you over-ride the general date format)
    $archive_day_date_format = 'Y/m/d';

    // options for weekly archive (only if you over-ride the general date format)
    $archive_week_start_date_format = 'Y/m/d';
    $archive_week_end_date_format   = 'Y/m/d';

    if ( !$archive_date_format_over_ride ) {
        $archive_day_date_format = get_option('date_format');
        $archive_week_start_date_format = get_option('date_format');
        $archive_week_end_date_format = get_option('date_format');
    }

    //filters
    $where = apply_filters('customarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
    $join = apply_filters('customarchives_join', "", $r);

    $output = '<ul>';

        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
        $key = md5($query);
        $cache = wp_cache_get( 'wp_custom_archive' , 'general');
        if ( !isset( $cache[ $key ] ) ) {
            $arcresults = $wpdb->get_results($query);
            $cache[ $key ] = $arcresults;
            wp_cache_set( 'wp_custom_archive', $cache, 'general' );
        } else {
            $arcresults = $cache[ $key ];
        }
        if ( $arcresults ) {
            $afterafter = $after;
            foreach ( (array) $arcresults as $arcresult ) {
                $url = get_month_link( $arcresult->year, $arcresult->month );
                /* translators: 1: month name, 2: 4-digit year */
                $text = sprintf(__('%s'), $wp_locale->get_month($arcresult->month));
                $year_text = sprintf('<li>%d</li>', $arcresult->year);
                if ( $show_post_count )
                    $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                $output .= ( $arcresult->year != $temp_year ) ? $year_text : '';
                $output .= get_archives_link($url, $text, $format, $before, $after);

                $temp_year = $arcresult->year;
            }
        }

    $output .= '</ul>';

    if ( $echo )
        echo $output;
    else
        return $output;
}

/*
will remove the HTML p tag from around images in the_content.
function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

will prevent direct file access to the functions.php 
file via the URL “http://wpsnipp.com/wp-content/themes/themename/functions.php”

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'functions.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
die ('No access!');
}
*/



function _esc_get_carousel(){
	$args	=	array(	'posts_per_page'   => 5,
						'post_type'        => 'banners'
					);
	$banners	=	get_posts($args);
	if(!$banners)
		return ;
	$indicators = '';
	$items='';
	$_indicators_first=true;
	$_items_first=true;
	global $post;
	foreach ( $banners as $key=>$post ) : setup_postdata( $post );
		$class_indicators='';
		if($_indicators_first){
			$_indicators_first=false;
			$class_indicators = ' class="active"';
		}
		$indicators .= '<li data-target="#home-carousel" data-slide-to="' . $key . '"' . $class_indicators . '></li>';
		$class_items='';
		if($_items_first){
			$_items_first=false;
			$class_items = ' active';
		}
		$feat_image = get_the_post_thumbnail($post-> ID,'large');
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );		
		$items .= '<div class="item' . $class_items . '" style="background-image:url(' . $feat_image . ');">
	<div class="container">
		<div class="carousel-caption">
			<p>'. get_the_excerpt() .'</p>
		</div>
	</div>
</div>';
	endforeach; 
	wp_reset_postdata();
	$_esc_banner_slide = trim(get_option('_esc_banner_slide'));
	if(!$_esc_banner_slide)
		$_esc_banner_slide	=	5;
	$_esc_banner_slide	=	$_esc_banner_slide * 1000;
	
	$_esc_banner_pause_in_hover = get_option('_esc_banner_pause_in_hover');
	if(!$_esc_banner_pause_in_hover)
		$_esc_banner_pause_in_hover	=	' data-pause="false"';
?>
	<div id="home-carousel" class="carousel slide carousel-fade" data-interval="<?php echo $_esc_banner_slide ?>" data-ride="carousel"<?php echo $_esc_banner_pause_in_hover ?>>
		<ol class="carousel-indicators"><?php echo $indicators	?></ol>
		<div class="carousel-inner"><?php	echo $items	?></div>
		<a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev"><span class="arrow-circle left"></span></a>
		<a class="right carousel-control" href="#home-carousel" role="button" data-slide="next"><span class="arrow-circle right"></span></a>
	</div><!-- /.carousel -->
<?php
}

/*
 filter to replace the widget title with custom title and or html.
*/
add_filter('widget_title', 'change_widget_title', 10, 3);
function change_widget_title($title, $instance, $wid){
    return $title = str_replace('Widget Title', '<span style="color: red">Custom</span>', $title);
}
/*

*/
function wps_highlight_results($text){
	if(is_search()){
		$sr = get_query_var('s');
		$keys = explode(" ",$sr);
		$text = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">'.$sr.'</strong>', $text);
	}
	return $text;
}
add_filter('the_excerpt', 'wps_highlight_results');
add_filter('the_title', 'wps_highlight_results');
/*
 * will set the default avatar.
*/
add_filter( 'avatar_defaults', '_esc_avatar_defaults' );
function _esc_avatar_defaults ($avatar_defaults) {
     $myavatar = get_template_directory_uri() . '/images/default.jpg';
     $avatar_defaults[$myavatar] = "Default Gravatar";
     return $avatar_defaults;
}
/*
 * will remove the automatic linking of URLs in comments.
*/
remove_filter('comment_text', 'make_clickable', 9);
/*
 * Adding this to your HTACCESS 
 * will help keep bots from posting comments 
 * on your wordpress blog, 
 * be sure to change yourdomain.com 
 * to your website address.

RewriteEngine On
RewriteCond %{REQUEST_METHOD} POST
RewriteCond %{REQUEST_URI} .wp-comments-post\.php*
RewriteCond %{HTTP_REFERER} !.*yourdomain.com.* [OR]
RewriteCond %{HTTP_USER_AGENT} ^$
RewriteRule (.*) http://%{REMOTE_ADDR}/$ [R=301,L]
*/
?>