<?php
/**
 * Echo the structural markup that wraps around comments. It also calls the comments action hooks.
 *
 * This template will return empty if the post which is called is password protected.
 *
 * @package Structure\Comments
 */

// Stop here if the post is password protected.
if (post_password_required()) {
    return;
}

echo yourfitness_open_markup( 'yourfitness_comments', 'div', array( 'id' => 'comments', 'class' => 'tm-comments' . ( current_theme_supports( 'torbara-default-styling' ) ? ' uk-panel-box' : null ) ) );

	if ( comments_open() || get_comments_number() ) :

		if ( have_comments() ) :

			echo yourfitness_open_markup( 'yourfitness_comments_list', 'ol', array( 'class' => 'uk-comment-list' ) );

				wp_list_comments( array(
					'avatar_size' => 50,
					'callback' => 'yourfitness_comment_callback'
				) );

			echo yourfitness_close_markup( 'yourfitness_comments_list', 'ol' );

		else :

			/**
			 * Fires if no comments exist.
			 *
			 * This hook only fires if comments are open.
			 *
			 * @since 1.0.0
			 */
			do_action( 'yourfitness_no_comment' );

		endif;

		/**
		 * Fires after the comments list.
		 *
		 * This hook only fires if comments are open.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_after_open_comments' );

	endif;

	if ( !comments_open() ) :

		/**
		 * Fires if comments are closed.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_comments_closed' );

	endif;

echo yourfitness_close_markup( 'yourfitness_comments', 'div' );