<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

add_filter( 'get_search_form', '_esc_get_search_form' );
function _esc_get_search_form( $form ) {
	$search = 'input type="submit"';
	$form  = str_replace($search,$search . ' class="btn btn-primary"',$form);

    return $form;
}
add_filter( 'comment_form_default_fields', '_esc_comment_form_fields' );
function _esc_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5 = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    $fields = array(
		'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email' => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		'<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		'url' => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
		'<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );
    return $fields;
}
add_filter( 'comment_form_defaults', '_esc_comment_form' );
function _esc_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
    <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
    <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
    </div>';
    return $args;
}
add_action('comment_form', '_esc_comment_button' );
function _esc_comment_button() {
	echo '<button class="btn btn-primary" type="submit">' . __( 'Submit' ) . '</button>';
}
add_filter( 'the_password_form', '_esc_the_password_form' );
function _esc_the_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form role="form" class="form-inline protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
    ' . __( 'This content is password protected. To view it please enter your password below:' ) . '
    <label class="pass-label" for="' . $label . '">' . __( "PASSWORD:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" class="form-control" required /><input type="submit" name="Submit" class="btn btn-default" value="' . esc_attr__( "Submit" ) . '" />
    </form>';

    return $o;
}
function _esc_search_widget( $html ) {
    ob_start(); ?>
    <form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="search-form form-inline">
		<div class="input-group">
			<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'wig' ); ?>" class="form-control" />
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</span>
		</div>
    </form>
    <?php return ob_get_clean();
}
add_filter( 'get_search_form', '_esc_search_widget' );
?>