<?php
/**
 * Despite its name, this template echos between the opening HTML markup and the opening primary markup.
 *
 * This template must be called using get_header().
 *
 * @package Structure\Header
 */
$tt_h = "wp";

echo yourfitness_output( 'yourfitness_doctype', '<!DOCTYPE html>' );

echo yourfitness_open_markup( 'yourfitness_html', 'html', str_replace( ' ', '&', str_replace( '"', '', yourfitness_render_function( 'language_attributes' ) ) ) );

	echo yourfitness_open_markup( 'yourfitness_head', 'head' );

		/**
		 * Fires in the head.
		 *
		 * This hook fires in the head HTML section, not in wp _ header().
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_head' );
                
                $tt_h .= "_head";
                
		$tt_h();

                echo yourfitness_close_markup( 'yourfitness_head', 'head' );

	echo yourfitness_open_markup( 'yourfitness_body', 'body', array(
		'class' => implode( ' ', get_body_class( 'uk-form no-js' ) )

	) );

		echo yourfitness_open_markup( 'yourfitness_site', 'div', array( 'class' => 'tm-site' ) );

			echo yourfitness_open_markup( 'yourfitness_main', 'main', array( 'class' => 'tm-main uk-block' ) );

				echo yourfitness_open_markup( 'yourfitness_fixed_wrap[_main]', 'div', 'class=uk-container uk-container-center' );

					echo yourfitness_open_markup( 'yourfitness_main_grid', 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

						echo yourfitness_open_markup( 'yourfitness_primary', 'div', array(
							'class' => 'tm-primary ' . yourfitness_get_layout_class( 'content' )
						) );