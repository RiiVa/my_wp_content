<?php
/**
 * Handle the torbara Post Meta workflow.
 *
 * @ignore
 *
 * @package API\Post_meta
 */
final class yourfitness_tt_Post_Meta {

	/**
	 * Metabox arguments.
	 *
	 * @type array
	 */
	private $args = array();

	/**
	 * Fields section.
	 *
	 * @type string
	 */
	private $section;


	/**
	 * Constructor.
	 */
	public function __construct( $section, $args ) {

		$defaults = array(
			'title' => esc_html__( 'Undefined', 'your-fitness' ),
			'context' => 'normal',
			'priority' => 'high',
		);

		$this->section = $section;
		$this->args = array_merge( $defaults, $args );
		$this->do_once();

		add_action( 'add_meta_boxes', array( $this, 'register_metabox' ) );

	}


	/**
	 * Trigger actions only once.
	 */
	private function do_once() {

		static $once = false;

		if ( !$once ) :

			add_action( 'edit_form_top', array( $this, 'nonce' ) );
			add_action( 'save_post', array( $this, 'save' ) );
			add_filter( 'attachment_fields_to_save', array( $this, 'save_attachment' ) );

			$once = true;

		endif;

	}

	/**
	 * Post meta nonce.
	 */
	public function nonce() {

		echo '<input type="hidden" name="yourfitness_post_meta_nonce" value="' . esc_attr( wp_create_nonce( 'yourfitness_post_meta_nonce' ) ) . '" />';

	}


	/**
	 * Add the Metabox.
	 */
	public function register_metabox( $post_type ) {

		add_meta_box( $this->section, $this->args['title'], array( $this, 'metabox_content' ), $post_type, $this->args['context'], $this->args['priority'] );

	}


	/**
	 * Metabox content.
	 */
	public function metabox_content( $post ) {

		foreach ( yourfitness_get_fields( 'post_meta', $this->section ) as $field )
			yourfitness_field( $field );

	}


	/**
	 * Save Post Meta.
	 */
	public function save( $post_id ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return false;

		if ( !wp_verify_nonce( yourfitness_post( 'yourfitness_post_meta_nonce' ), 'yourfitness_post_meta_nonce' ) )
			return $post_id;

		if ( !$fields = yourfitness_post( 'yourfitness_fields' ) )
			return $post_id;

		foreach ( $fields as $field => $value )
			update_post_meta( $post_id, $field, $value );

	}


	/**
	 * Save Post Meta for attachment.
	 */
	public function save_attachment( $attachment ) {

		if ( !wp_verify_nonce( yourfitness_post( 'yourfitness_post_meta_nonce' ), 'yourfitness_post_meta_nonce' ) )
			return $post_id;

		if ( !current_user_can( 'edit_post', $attachment['ID'] ) )
			return $attachment;

		if ( !$fields = yourfitness_post( 'yourfitness_fields' ) )
			return $attachment;

		foreach ( $fields as $field => $value )
			update_post_meta( $attachment['ID'], $field, $value );

		return $attachment;

	}

}