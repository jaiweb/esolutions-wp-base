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
				/**
				 * Fires before the Twenty Fifteen footer text for footer customization.
				 *
				 * @since Twenty Fifteen 1.0
				 */
				do_action( '_esc_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'esolutions' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'esolutions' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div><!-- .site -->
<a href="#0" class="gotop btn"><span class="glyphicon glyphicon-chevron-up"></span></a>
<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
<?php wp_footer(); ?>
</body>
</html>