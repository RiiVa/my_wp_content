<?php
/**
 * Echo the posts loop structural markup. It also calls the loop action hooks.
 *
 * @package Structure\Loop
 */


/**
 * Fires before the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
do_action( 'yourfitness_before_loop' );

	if ( have_posts() && !is_404() ) :

		/**
		 * Fires before posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_before_posts_loop' );

		while ( have_posts() ) : the_post();

			$article_attributes = array(
				'id' => get_the_ID(), // Automatically escaped.
				'class' => implode( ' ', get_post_class( array( 'uk-article', ( current_theme_supports( 'torbara-default-styling' ) ? 'uk-panel-box' : null ) ) ) ) // Automatically escaped.
			);

			echo yourfitness_open_markup( 'yourfitness_post', 'article', $article_attributes );

				echo yourfitness_open_markup( 'yourfitness_post_header', 'header' );

					/**
					 * Fires in the post header.
					 *
					 * @since 1.0.0
					 */
					do_action( 'yourfitness_post_header' );

				echo yourfitness_close_markup( 'yourfitness_post_header', 'header' );

				echo yourfitness_open_markup( 'yourfitness_post_body', 'div' );

					/**
					 * Fires in the post body.
					 *
					 * @since 1.0.0
					 */
					do_action( 'yourfitness_post_body' );

				echo yourfitness_close_markup( 'yourfitness_post_body', 'div' );

			echo yourfitness_close_markup( 'yourfitness_post', 'article' );

		endwhile;

		/**
		 * Fires after the posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_after_posts_loop' );

	else :

		/**
		 * Fires if no posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_no_post' );

	endif;

/**
 * Fires after the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
do_action( 'yourfitness_after_loop' );
