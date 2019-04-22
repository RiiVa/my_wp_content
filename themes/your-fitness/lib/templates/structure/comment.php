<?php
/**
 * Echo the structural markup for each comment. It also calls the comment action hooks.
 *
 * @package Structure\Comment
 */

echo yourfitness_open_markup( 'yourfitness_comment', 'article', array(
	'id' => 'div-comment-' . get_comment_ID(), // Automatically escaped.
	'class' => 'uk-comment',
) );

	echo yourfitness_open_markup( 'yourfitness_comment_header', 'header', array( 'class' => 'uk-comment-header' ) );

		/**
		 * Fires in the comment header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_comment_header' );

	echo yourfitness_close_markup( 'yourfitness_comment_header', 'header' );

	echo yourfitness_open_markup( 'yourfitness_comment_body', 'div', array( 'class' => 'uk-comment-body' ) );

		/**
		 * Fires in the comment body.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_comment_content' );

	echo yourfitness_close_markup( 'yourfitness_comment_body', 'div' );

echo yourfitness_close_markup( 'yourfitness_comment', 'article' );
