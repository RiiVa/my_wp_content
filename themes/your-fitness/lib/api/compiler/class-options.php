<?php
/**
 * Options and Actions used by torbara Compiler.
 *
 * @ignore
 *
 * @package API\Compiler
 */
final class yourfitness_tt_Compiler_Options {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'register' ) );
		add_action( 'admin_init', array( $this, 'flush' ) , -1 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'yourfitness_field_flush_cache', array( $this, 'option' ) );
		add_action( 'yourfitness_field_descriptionyourfitness_tt_compile_all_styles_append_markup', array( $this, 'maybe_disable_style_notice' ) );
		add_action( 'yourfitness_field_descriptionyourfitness_tt_compile_all_scripts_group_append_markup', array( $this, 'maybe_disable_scripts_notice' ) );

	}


	/**
	 * Register options.
	 */
	public function register() {

		$fields = array(
			array(
				'id' => 'yourfitness_compiler_items',
				'type' => 'flush_cache',
				'description' => esc_html__( 'Clear CSS and Javascript cached files. New cached versions will be compiled on page load.', 'your-fitness' )
			)
		);

		// Add styles compiler option only if supported
		if ( yourfitness_get_component_support( 'wp_styles_compiler' ) )
			$fields = array_merge( $fields, array(
				array(
					'id' => 'yourfitness_compile_all_styles',
					'label' => false,
					'checkbox_label' => esc_html__( 'Compile all WordPress styles', 'your-fitness' ),
					'type' => 'checkbox',
					'default' => false,
					'description' => esc_html__( 'Compile and cache all the CSS files that have been enqueued to the WordPress head.', 'your-fitness' )
				)
			) );

		// Add scripts compiler option only if supported
		if ( yourfitness_get_component_support( 'wp_scripts_compiler' ) )
			$fields = array_merge( $fields, array(
				array(
					'id' => 'yourfitness_compile_all_scripts_group',
					'label' => esc_html__( 'Compile all WordPress scripts', 'your-fitness' ),
					'type' => 'group',
					'fields' => array(
						array(
							'id' => 'yourfitness_compile_all_scripts',
							'type' => 'activation',
							'default' => false
						),
						array(
							'id' => 'yourfitness_compile_all_scripts_mode',
							'type' => 'select',
							'default' => array( 'aggressive' ),
							'attributes' => array( 'style' => 'margin: -3px 0 0 -8px;' ),
							'options' => array(
								'aggressive' => esc_html__( 'Aggressive', 'your-fitness' ),
								'standard' => esc_html__( 'Standard', 'your-fitness' )
							)
						),
					),
					'description' => esc_html__( 'Compile and cache all the Javascript files that have been enqueued to the WordPress head.<!--more-->JavaSript is outputted in the footer if the level is set to <strong>Aggressive</strong> and might conflict with some third party plugins which are not following WordPress standards.', 'your-fitness' )
				)
			) );

		yourfitness_register_options( $fields, 'yourfitness_settings', 'compiler_options', array(
			'title' => esc_html__( 'Compiler options', 'your-fitness' ),
			'context' => 'normal'
		) );

	}


	/**
	 * Flush images for all folders set.
	 */
	public function flush() {

		if ( !yourfitness_post( 'yourfitness_flush_compiler_cache' ) )
			return;

		yourfitness_remove_dir( yourfitness_get_compiler_dir() );

	}


	/**
	 * Cache cleaner notice.
	 */
	public function admin_notice() {

		if ( !yourfitness_post( 'yourfitness_flush_compiler_cache' ) )
			return;

		echo '<div id="message" class="updated"><p>' . esc_html__( 'Cache flushed successfully!', 'your-fitness' ) . '</p></div>' . "\n";

	}


	/**
	 * Add button used to flush cache.
	 */
	public function option( $field ) {

		if ( $field['id'] !== 'yourfitness_compiler_items' )
			return;

		echo '<input type="submit" name="yourfitness_flush_compiler_cache" value="' . esc_html__( 'Flush assets cache', 'your-fitness' ) . '" class="button-secondary" />';

	}


	/**
	 * Maybe show disabled notice.
	 */
	public function maybe_disable_style_notice() {

		if ( get_option( 'yourfitness_compile_all_styles' ) && yourfitness_tt_is_compiler_dev_mode() )
			echo '<br /><span>' . esc_html__( 'Styles are not compiled in development mode.', 'your-fitness' ) . '</span>';

	}

	/**
	 * Maybe show disabled notice.
	 */
	public function maybe_disable_scripts_notice() {

		if ( get_option( 'yourfitness_compile_all_scripts' ) && yourfitness_tt_is_compiler_dev_mode() )
			echo '<br /><span>' . esc_html__( 'Scripts are not compiled in development mode.', 'your-fitness' ) . '</span>';

	}

}

new yourfitness_tt_Compiler_Options();
