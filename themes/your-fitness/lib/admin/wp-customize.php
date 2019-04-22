<?php
/**
 * Add torbara options to the WordPress Customizer.
 *
 * @package Admin
 */

yourfitness_add_smart_action( 'customize_preview_init', 'yourfitness_do_enqueue_wp_customize_assets' );

/**
 * Enqueue torbara assets for the WordPress Customizer.
 *
 * @since 1.0.0
 */
function yourfitness_do_enqueue_wp_customize_assets() {

	wp_enqueue_script( 'torbara-wp-customize-preview', yourfitness_ADMIN_JS_URL . 'wp-customize-preview.js', array( 'jquery', 'customize-preview' ), yourfitness_VERSION, true );

}


yourfitness_add_smart_action( 'customize_register', 'yourfitness_do_register_wp_customize_options' );

/**
 * Add torbara options to the WordPress Customizer.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_wp_customize_options() {

	$fields = array(
		array(
			'id' => 'yourfitness_logo_image',
			'label' => esc_html__( 'Logo Image', 'your-fitness' ),
			'type' => 'WP_Customize_Image_Control',
			'transport' => 'refresh'
		)
	);

	yourfitness_register_wp_customize_options( $fields, 'title_tagline', array( 'title' => esc_html__( 'Branding', 'your-fitness' ) ) );

	// Get layout option without default for the count.
	$options = yourfitness_get_layouts_for_options();

	// Only show the layout options if more than two layouts are registered.
	if ( count( $options ) > 2 ) {

		$fields = array(
			array(
				'id' => 'yourfitness_layout',
				'label' => esc_html__( 'Default Layout', 'your-fitness' ),
				'type' => 'radio',
				'default' => yourfitness_get_default_layout(),
				'options' => $options,
				'transport' => 'refresh'
			)
		);

		yourfitness_register_wp_customize_options( $fields, 'yourfitness_layout', array( 'title' => esc_html__( 'Default Layout', 'your-fitness' ), 'priority' => 1000 ) );

	}

	$fields = array(
		array(
			'id' => 'yourfitness_viewport_width_group',
			'label' => esc_html__( 'Viewport Width', 'your-fitness' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'yourfitness_enable_viewport_width',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'yourfitness_viewport_width',
					'type' => 'slider',
					'default' => 1000,
					'min' => 300,
					'max' => 2500,
					'interval' => 10,
					'unit' => 'px'
				),
			)
		),
		array(
			'id' => 'yourfitness_viewport_height_group',
			'label' => esc_html__( 'Viewport Height', 'your-fitness' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'yourfitness_enable_viewport_height',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'yourfitness_viewport_height',
					'type' => 'slider',
					'default' => 1000,
					'min' => 300,
					'max' => 2500,
					'interval' => 10,
					'unit' => 'px'
				),
			)
		)
	);

	yourfitness_register_wp_customize_options( $fields, 'yourfitness_preview', array( 'title' => esc_html__( 'Preview Tools', 'your-fitness' ), 'priority' => 1010 ) );

}