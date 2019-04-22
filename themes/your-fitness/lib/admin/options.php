<?php
/**
 * Add torbara admin options.
 *
 * @package Admin
 */

yourfitness_add_smart_action( 'admin_init', 'yourfitness_do_register_term_meta' );

/**
 * Add torbara term meta.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_term_meta() {

	// Get layout option without default for the count.
	$options = yourfitness_get_layouts_for_options();

	// Stop here if there is less than two layouts options.
	if ( count( $options ) < 2 )
		return;

	$fields = array(
		array(
			'id' => 'yourfitness_layout',
			'label' => esc_attr_x( 'Layout', 'term meta', 'your-fitness' ),
			'type' => 'radio',
			'default' => 'default_fallback',
			'options' => yourfitness_get_layouts_for_options( true )
		)
	);

	yourfitness_register_term_meta( $fields, array( 'category', 'post_tag' ), 'your-fitness' );

}


yourfitness_add_smart_action( 'admin_init', 'yourfitness_do_register_post_meta' );

/**
 * Add torbara post meta.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_post_meta() {

	// Get layout option without default for the count.
	$options = yourfitness_get_layouts_for_options();

	// Stop here if there is less than two layouts options.
	if ( count( $options ) < 2 )
		return;

	$fields = array(
		array(
			'id' => 'yourfitness_layout',
			'label' => esc_attr_x( 'Layout', 'post meta', 'your-fitness' ),
			'type' => 'radio',
			'default' => 'default_fallback',
			'options' => yourfitness_get_layouts_for_options( true )
		)
	);

	yourfitness_register_post_meta( $fields, array( 'post', 'page' ), 'your-fitness', array( 'title' => esc_html__( 'Post Options', 'your-fitness' ) ) );

}