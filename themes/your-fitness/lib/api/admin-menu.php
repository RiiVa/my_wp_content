<?php
/**
 * torbara admin page.
 *
 * @ignore
 */
final class yourfitness_tt_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 150 );
		add_action( 'admin_init', array( $this, 'register' ), 20 );

	}


	/**
	 * Add torbara menu.
	 */
	public function admin_menu() {

		add_theme_page( esc_html__( 'Settings', 'your-fitness' ), esc_html__( 'Settings', 'your-fitness' ), 'manage_options', 'yourfitness_settings', array( $this, 'display_screen' ) );

	}


	/**
	 * torbara options page content.
	 */
	public function display_screen() {

		echo '<div class="wrap">';

			echo '<h2>' . esc_html__( 'torbara Settings', 'your-fitness' ) . esc_html__( 'Version ', 'your-fitness' ) . yourfitness_VERSION . '</h2>';

			echo yourfitness_options( 'yourfitness_settings' );

		echo '</div>';

	}


	/**
	 * Register options.
	 */
	public function register() {

		global $wp_meta_boxes;

		$fields = array(
			array(
				'id' => 'yourfitness_dev_mode',
				'checkbox_label' => esc_html__( 'Enable development mode', 'your-fitness' ),
				'type' => 'checkbox',
				'description' => esc_html__( 'This option should be enabled while your website is in development.', 'your-fitness' )
			)
		);

		yourfitness_register_options( $fields, 'yourfitness_settings', 'mode_options', array(
			'title' => esc_html__( 'Mode options', 'your-fitness' ),
			'context' => yourfitness_get( 'yourfitness_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check for other torbara boxes.
		) );

	}

}

new yourfitness_tt_Admin();
