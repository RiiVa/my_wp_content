<?php
/**
 * Since WordPress force us to use the header.php name to open the document, we add a header-partial.php template for the actual header.
 *
 * @package Structure\Header
 */

echo yourfitness_open_markup( 'yourfitness_header', 'header', array(
	'class' => 'tm-header uk-block'
) );

	echo yourfitness_open_markup( 'yourfitness_fixed_wrap[_header]', 'div', 'class=uk-container uk-container-center' );

		/**
		 * Fires in the header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_header' );

	echo yourfitness_close_markup( 'yourfitness_fixed_wrap[_header]', 'div' );

echo yourfitness_close_markup( 'yourfitness_header', 'header' );