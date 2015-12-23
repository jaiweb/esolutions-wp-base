<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
	</div><!-- .site-content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="social-icons">
				<a href="#"><i class="fa fa-instagram"></i></a>
				<a href="#"><i class="fa fa-linkedin-square"></i></a>
				<a href="#"><i class="fa fa-google-plus-square"></i></a>
				<a href="#"><i class="fa fa-facebook-square"></i></a>
				<a href="#"><i class="fa fa-youtube-square"></i></a>
			</div>
			<?php
						wp_nav_menu( array(
							'theme_location'	=>	'footer',
							'container_id'		=>	'navbar',
							'menu_class'      	=>	'nav navbar-nav',
							'depth'				=>	1,
							'fallback_cb'       =>	'wp_bootstrap_navwalker::fallback',
							'walker'			=>	new wp_bootstrap_navwalker()
						) );
					?>
			<a href="<?php echo esc_url( __( 'https://solutionswebonline.com/toolpress/themes/#base', 'esc' ) ); ?>"><?php printf( __( 'By %s', 'esc' ), 'E-Solutions Consulting Bolivia' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div><!-- .site -->
<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
<?php wp_footer(); ?>
</body>
</html>