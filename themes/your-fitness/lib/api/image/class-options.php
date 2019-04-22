<?php
/**
 * torbara images options.
 *
 * @ignore
 *
 * @package API\Image
 */
final class yourfitness_tt_Image_Options {

	/**
	 * Constructor.
	 */
	public function __construct() {

		// Load in priority 15 so that we can check if other torbara metaboxes exists.
		add_action( 'admin_init', array( $this, 'register' ), 15 );
		add_action( 'admin_init', array( $this, 'flush' ) , -1 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'yourfitness_field_flush_edited_images', array( $this, 'option' ) );

	}


	/**
	 * Register options.
	 */
	public function register() {

		global $wp_meta_boxes;

		$fields = array(
			array(
				'id' => 'yourfitness_edited_images_directories',
				'type' => 'flush_edited_images',
				'description' => esc_html__( 'Clear all edited images. New images will be created on page load.', 'your-fitness' )
			)
		);

		yourfitness_register_options( $fields, 'yourfitness_settings', 'images_options', array(
			'title' => esc_html__( 'Images options', 'your-fitness' ),
			'context' => yourfitness_get( 'yourfitness_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check of other torbara boxes.
		) );

	}


	/**
	 * Flush images for all folders set.
	 */
	public function flush() {

		if ( !yourfitness_post( 'yourfitness_flush_edited_images' ) )
			return;

		yourfitness_remove_dir( yourfitness_get_images_dir() );

	}


	/**
	 * Image editor notice notice.
	 */
	public function admin_notice() {

		if ( !yourfitness_post( 'yourfitness_flush_edited_images' ) )
			return;

		echo '<div id="message" class="updated"><p>' . esc_html__( 'Images flushed successfully!', 'your-fitness' ) . '</p></div>' . "\n";

	}


	/**
	 * Add button used to flush images.
	 */
	public function option( $field ) {

		if ( $field['id'] !== 'yourfitness_edited_images_directories' )
			return;

		echo '<input type="submit" name="yourfitness_flush_edited_images" value="' . esc_html__( 'Flush images', 'your-fitness' ) . '" class="button-secondary" />';

	}

}

new yourfitness_tt_Image_Options();
