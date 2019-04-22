<?php
/**
 * @package API\Fields
 */

yourfitness_add_smart_action( 'yourfitness_field_wrap_prepend_markup', 'yourfitness_field_label' );

/**
 * Echo field label.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      Array of data.
 *
 *      @type string $label The field label. Default false.
 * }
 */
function yourfitness_field_label( $field ) {

	if ( !$label = yourfitness_get( 'label', $field ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_field_label[_' . $field['id'] . ']', 'label' );

		echo esc_html($field['label']);

	echo yourfitness_close_markup( 'yourfitness_field_label[_' . $field['id'] . ']', 'label' );

}


yourfitness_add_smart_action( 'yourfitness_field_wrap_append_markup', 'yourfitness_field_description' );

/**
 * Echo field description.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      Array of data.
 *
 *      @type string $description The field description. The description can be truncated using <!--more-->
 *            					  as a delimiter. Default false.
 * }
 */
function yourfitness_field_description( $field ) {

	if ( !$description = yourfitness_get( 'description', $field ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_field_description[_' . $field['id'] . ']', 'div', array( 'class' => 'bs-field-description' ) );

		if ( preg_match( '#<!--more-->#', $description, $matches ) )
			list( $description, $extended ) = explode( $matches[0], $description, 2 );

		echo esc_html($description);

	echo yourfitness_close_markup( 'yourfitness_field_description[_' . $field['id'] . ']', 'div' );

}