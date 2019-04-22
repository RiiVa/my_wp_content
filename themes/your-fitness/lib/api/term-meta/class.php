<?php
/**
 * Handle the torbara Term Meta workflow.
 *
 * @ignore
 *
 * @package API\Term_meta
 */
final class yourfitness_tt_Term_Meta {

	/**
	 * Fields section.
	 *
	 * @type string
	 */
	private $section;

	/**
	 * Constructor.
	 */
	public function __construct( $section ) {

		$this->section = $section;
		$this->do_once();

		add_action( yourfitness_get( 'taxonomy' ). '_edit_form_fields', array( $this, 'fields' ) );

	}


	/**
	 * Trigger actions only once.
	 */
	private function do_once() {

		static $once = false;

		if ( !$once ) :

			add_action( yourfitness_get( 'taxonomy' ). '_edit_form', array( $this, 'nonce' ) );
			add_action( 'edit_term', array( $this, 'save' ) );
			add_action( 'delete_term', array( $this, 'delete' ), 10, 3 );

			$once = true;

		endif;

	}


	/**
	 * Post meta nonce.
	 */
	public function nonce( $tag ) {

		echo '<input type="hidden" name="yourfitness_term_meta_nonce" value="' . esc_attr( wp_create_nonce( 'yourfitness_term_meta_nonce' ) ) . '" />';

	}


	/**
	 * Fields content.
	 */
	public function fields( $tag ) {

		yourfitness_remove_action( 'yourfitness_field_label' );
		yourfitness_modify_action_hook( 'yourfitness_field_description', 'yourfitness_field_wrap_after_markup' );
		yourfitness_modify_markup( 'yourfitness_field_description', 'p' );
		yourfitness_add_attribute( 'yourfitness_field_description', 'class', 'description' );

		foreach ( yourfitness_get_fields( 'term_meta', $this->section ) as $field ) {

			echo '<tr class="form-field">';
				echo '<th scope="row">';
					yourfitness_field_label( $field );
				echo '</th>';
				echo '<td>';
					yourfitness_field( $field );
				echo '</td>';
			echo '</tr>';

		}

	}


	/**
	 * Save Term Meta.
	 */
	public function save( $term_id ) {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			return $term_id;

		if ( !wp_verify_nonce( yourfitness_post( 'yourfitness_term_meta_nonce' ), 'yourfitness_term_meta_nonce' ) )
			return $term_id;

		if ( !$fields = yourfitness_post( 'yourfitness_fields' ) )
			return $term_id;

		foreach ( $fields as $field => $value )
			update_option( "yourfitness_term_{$term_id}_{$field}", stripslashes_deep( $value ) );

	}


	/**
	 * Dummy Delete Term Meta. 
	 */
	public function delete( $term, $term_id, $taxonomy ) {
            
	}

}