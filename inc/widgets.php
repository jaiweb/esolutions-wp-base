<?php 
class Tabs_Widget extends WP_Widget{
	
	function Tabs_Widget(){
		$_widget_id	=	'esc-tabs';
		// Widget settings
		$widget_ops = array('classname' => $_widget_id, 'description' => __('Display Tabs.', 'esc'));
		// Widget control settings
		$control_ops = array('id_base' => $_widget_id);
		// Create the widget
		$this->WP_Widget($_widget_id, 'Display Tabs', $widget_ops, $control_ops);
	}	
	function widget($args, $instance){
		extract($args);
		// User selected settings
		$custom_contact_form_title		=	$instance['custom_contact_form_title'];
		//$custom_contact_form_shortcode	=	$instance['custom_contact_form_shortcode'];
		$custom_contact_form_id			=	$instance['custom_contact_form_id'];
		
		echo $args['before_widget'];//.$args['before_title'].$custom_contact_form_title.$args['after_title'];
		//echo '<h3 class="widget-title">'.$instance['custom_contact_form_title'].'</h3>';
		?>  



<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
	<li class="col-sm-4 col-sm-np text-center active"><a href="#red" data-toggle="tab">Subscribe</a></li>
	<li class="col-sm-4 col-sm-np text-center"><a href="#orange" data-toggle="tab">Archive</a></li>
	<li class="col-sm-4 col-sm-np text-center"><a href="#yellow" data-toggle="tab">Tag</a></li>
</ul>
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="red">
                <h3>Subscribe</h3>
            </div>
            <div class="tab-pane" id="orange">
                <h3>Archive</h3>
            </div>
            <div class="tab-pane" id="yellow">
                <h3>Tag</h3>
            </div>
        </div>



		<?php echo apply_filters('the_content', $__shortcode); ?>
        <?php echo $args['after_widget']; ?>        
        <?php
	}	
	function update($new_instance, $old_instance){	// This function processes and updates the settings
		$instance = $old_instance;
		
		// Strip tags (if needed) and update the widget settings
		//$instance['custom_contact_form_shortcode']	=	strip_tags($new_instance['custom_contact_form_shortcode']);
		$instance['custom_contact_form_title']		=	strip_tags($new_instance['custom_contact_form_title']);
		$instance['custom_contact_form_id']			=	strip_tags($new_instance['custom_contact_form_id']);
		
		return $instance;
	}	
	function form($instance){
		$defaults = array(
						//'custom_contact_form_shortcode' => '',
						'custom_contact_form_title' 	=>	'',
						'custom_contact_form_id' 		=> '',
						);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <p>
        	<label for="<?php echo $this->get_field_id('custom_contact_form_title'); ?>"><?php _e('Title:', 'esc'); ?></label>
			<input id="<?php echo $this->get_field_id('custom_contact_form_title'); ?>" type="text" name="<?php echo $this->get_field_name('custom_contact_form_title'); ?>" value="<?php echo $instance['custom_contact_form_title']; ?>" class="widefat" />
        </p>
       <!-- <p>
        	<label for="<?php echo $this->get_field_id('custom_contact_form_shortcode'); ?>"><?php _e('shortcode:', 'esc'); ?></label>
			<textarea id="<?php echo $this->get_field_id('custom_contact_form_shortcode'); ?>" type="text" name="<?php echo $this->get_field_name('custom_contact_form_shortcode'); ?>" rows="5" class="widefat"><?php echo $instance['custom_contact_form_shortcode']; ?></textarea>
        </p> -->
		
        <p>
        	<label for="<?php echo $this->get_field_id('custom_contact_form_id'); ?>"><?php _e('Select a Contact Forms:', 'esc'); ?></label>
			<select id="<?php echo $this->get_field_id('custom_contact_form_id'); ?>" name="<?php echo $this->get_field_name('custom_contact_form_id'); ?>">
<?php
$args = array('post_type'=> 'wpcf7_contact_form');
$the_query = new WP_Query( $args );
if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
<?php endwhile; ?>
<?php endif; wp_reset_postdata(); ?>
</select>
        </p>
        <?php
	}
}
function _esc_load_widgets(){
	register_widget('Tabs_Widget');
}
add_action('widgets_init', '_esc_load_widgets');
?>