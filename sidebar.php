<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	<div id="sidebar" class="<?php echo	apply_filters('_esc_layout', 'sidebar')	?>">

		<?php if ( _esc_sidebars_is_active_sidebar( 'sidebar-page' ) ) : ?>
			<div class="widget-area" role="complementary">
				<?php //dynamic_sidebar( 'sidebar-page' ); ?>
				<?php	_esc_sidebars_dynamic_sidebar( 'sidebar-page');	?>
			</div><!-- .widget-area -->
			
		<?php else : ?>
		
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<div class="widget-area" role="complementary">
					<ul class="list-group">
						 <li class="list-group-item"><a href="<?php echo admin_url( 'nav-menus.php' ) ?>">Add a menu</a></li>
					</ul>
				</div><!-- .widget-area -->
			<?php endif; ?>
		<?php endif; ?>

	</div><!-- .sidebar -->