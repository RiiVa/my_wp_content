<?php
/**
 * Echo footer fragments.
 *
 * @package Fragments\Footer
 */

yourfitness_add_smart_action( 'yourfitness_footer', 'yourfitness_footer_content' );

/**
 * Echo the footer content.
 *
 * @since 1.0.0
 */
function yourfitness_footer_content() {

	echo yourfitness_open_markup( 'yourfitness_footer_credit', 'div', array( 'class' => 'uk-clearfix uk-text-small uk-text-muted' ) );

		echo yourfitness_open_markup( 'yourfitness_footer_credit_left', 'span', array(
			'class' => 'uk-align-medium-left uk-margin-small-bottom'
		) );

			echo yourfitness_output( 'yourfitness_footer_credit_text', sprintf(
				esc_html__( '&#x000A9; %1$s - %2$s. All rights reserved.', 'your-fitness' ),
				date( "Y" ),
				get_bloginfo( 'name' )
			) );

		echo yourfitness_close_markup( 'yourfitness_footer_credit_left', 'span' );

		$framework_link = yourfitness_open_markup( 'yourfitness_footer_credit_framework_link', 'a', array(
			'href' => 'http://torbara.com', // Automatically escaped.
		) );

			$framework_link .= yourfitness_output( 'yourfitness_footer_credit_framework_link_text', 'your-fitness' );

		$framework_link .= yourfitness_close_markup( 'yourfitness_footer_credit_framework_link', 'a' );

		echo yourfitness_open_markup( 'yourfitness_footer_credit_right', 'span', array(
			'class' => 'uk-align-medium-right uk-margin-bottom-remove'
		) );

			echo yourfitness_output( 'yourfitness_footer_credit_right_text', sprintf(
				esc_html__( '%1$s theme for WordPress.', 'your-fitness' ),
				$framework_link
			) );

		echo yourfitness_close_markup( 'yourfitness_footer_credit_right', 'span' );


	echo yourfitness_close_markup( 'yourfitness_footer_credit', 'div' );

}