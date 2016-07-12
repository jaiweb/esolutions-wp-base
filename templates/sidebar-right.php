<?php 
/*
Template Name: Page Sidebar Right
*/
get_header(); ?>
	<div id="primary" class="<?php	echo apply_filters('_esc_layout', 'content-area-sidebar-right')	?>">
		<main id="main" class="site-main" role="main">	
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			// Include the page content template.
			get_template_part( 'content', 'page' );
		// End the loop.
		endwhile;
		?>		
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<?php get_sidebar(); ?>
<?php get_footer(); ?>