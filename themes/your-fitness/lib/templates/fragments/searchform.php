<?php
/**
 * Modify the search from.
 *
 * @package Fragments\Search_Form
 */

// Filter.
yourfitness_add_smart_action( 'get_search_form', 'yourfitness_search_form' );

/**
 * Modify the search form.
 *
 * @since 1.0.0
 *
 * @return string The form.
 */
function yourfitness_search_form() {

	$output = yourfitness_open_markup( 'yourfitness_search_form', 'form', array(
		'class' => 'uk-form uk-form-icon uk-form-icon-flip uk-width-1-1',
		'method' => 'get',
		'action' => esc_url( home_url('/') )
	) );

		$output .= yourfitness_selfclose_markup( 'yourfitness_search_form_input', 'input', array(
			'class' => 'uk-width-1-1',
			'type' => 'search',
			'placeholder' => esc_html__( 'Search', 'your-fitness' ), // Automatically escaped.
			'value' => esc_attr( get_search_query() ),
			'name' => 's'
		) );

		$output .= yourfitness_open_markup( 'yourfitness_search_form_input_icon', 'i', 'class=uk-icon-search' );

		$output .= yourfitness_close_markup( 'yourfitness_search_form_input_icon', 'i' );

	$output .= yourfitness_close_markup( 'yourfitness_search_form', 'form' );

	return $output;

}