<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	<div id="sidebar" class="sidebar<?php	esolutions_layout_class('sidebar')	?>">

		<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
			<div class="widget-area" role="complementary">
				<?php //dynamic_sidebar( 'sidebar-page' ); ?>
				<?php	esolutions_sidebars_dynamic_sidebar( 'sidebar-page');	?>
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div><!-- .sidebar -->