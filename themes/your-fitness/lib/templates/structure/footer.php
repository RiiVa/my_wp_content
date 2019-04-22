<?php
/**
 * Despite its name, this template echos between the closing primary markup and the closing HTML markup.
 *
 * This template must be called using get_footer().
 *
 * @package Structure\Footer
 */

						echo yourfitness_close_markup( 'yourfitness_primary', 'div' );

					echo yourfitness_close_markup( 'yourfitness_main_grid', 'div' );

				echo yourfitness_close_markup( 'yourfitness_fixed_wrap[_main]', 'div' );

			echo yourfitness_close_markup( 'yourfitness_main', 'main' );

		echo yourfitness_close_markup( 'yourfitness_site', 'div' );

		wp_footer();

	echo yourfitness_close_markup( 'yourfitness_body', 'body' );

echo yourfitness_close_markup( 'yourfitness_html', 'html' );