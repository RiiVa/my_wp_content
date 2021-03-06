<?php
/**
 * Since WordPress force us to use the footer.php name to close the document, we add a footer-partial.php template for the actual footer.
 *
 * @package Structure\Footer
 */

echo yourfitness_open_markup( 'yourfitness_footer', 'footer', array(
	'class' => 'tm-footer uk-block',
) );

	echo yourfitness_open_markup( 'yourfitness_fixed_wrap[_footer]', 'div', 'class=uk-container uk-container-center' );

		/**
		 * Fires in the footer.
		 *
		 * This hook fires in the footer HTML section, not in wp_footer().
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_footer' );

	echo yourfitness_close_markup( 'yourfitness_fixed_wrap[_footer]', 'div' );

echo yourfitness_close_markup( 'yourfitness_footer', 'footer' );