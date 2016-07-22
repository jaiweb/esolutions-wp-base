<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_single() ) :
		// Post thumbnail.
		_esc_post_thumbnail();
	endif;
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->
	<div class="entry-meta">
		<?php _esc_entry_meta('header'); ?>
		<?php edit_post_link( __( 'Edit', 'esc' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' ); ?>
	</div>
	<div class="entry-content">
		<?php
		if ( is_single() ) :
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'esc' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'esc' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'esc' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		else :
			the_excerpt();
		endif;
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer entry-meta">
		<?php _esc_entry_meta(); ?>
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
