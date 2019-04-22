<?php
/**
 * Echo the structural markup for the main content. It also calls the content action hooks.
 *
 * @package Structure\Content
 */

$content_attributes = array(
	'class' => 'tm-content',
	'role' => 'main'
);

echo yourfitness_open_markup( 'yourfitness_content', 'div', $content_attributes );

	/**
	 * Fires in the main content.
	 *
	 * @since 1.0.0
	 */
	do_action( 'yourfitness_content' );

echo yourfitness_close_markup( 'yourfitness_content', 'div' );
