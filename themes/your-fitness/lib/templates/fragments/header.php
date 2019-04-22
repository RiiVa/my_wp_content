<?php
/**
 * Echo header fragments.
 *
 * @package Fragments\Header
 */

yourfitness_add_smart_action( 'yourfitness_head', 'yourfitness_head_meta', 0 );

/**
 * Echo head meta.
 *
 * @since 1.0.0
 */
function yourfitness_head_meta() {

	echo '<meta charset="' . get_bloginfo( 'charset' ) . '" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";

}


yourfitness_add_smart_action( 'wp_head', 'yourfitness_head_pingback' );

/**
 * Echo head pingback.
 *
 * @since 1.0.0
 */
function yourfitness_head_pingback() {

	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '">' . "\n";

}


yourfitness_add_smart_action( 'wp_head', 'yourfitness_header_image' );

/**
 * Print the header image css inline in the header.
 *
 * @since 1.0.0
 */
function yourfitness_header_image() {

	if ( !current_theme_supports( 'custom-header' ) || !( $header_image = get_header_image() ) || empty( $header_image ) )
		return;
}


yourfitness_add_smart_action( 'yourfitness_header', 'yourfitness_site_branding' );

/**
 * Echo header site branding.
 *
 * @since 1.0.0
 */
function yourfitness_site_branding() {

	echo yourfitness_open_markup( 'yourfitness_site_branding', 'div', array(
		'class' => 'tm-site-branding uk-float-left' . ( !get_bloginfo( 'description' ) ? ' uk-margin-small-top' : null ),
	) );

		echo yourfitness_open_markup( 'yourfitness_site_title_link', 'a', array(
			'href' => esc_url(home_url('/')), // Automatically escaped.
			'rel' => 'home'
		) );

			if ( $logo = get_theme_mod( 'yourfitness_logo_image', false ) )
				echo yourfitness_selfclose_markup( 'yourfitness_logo_image', 'img', array(
					'class' => 'tm-logo',
					'src' => $logo, // Automatically escaped.
					'alt' => get_bloginfo( 'name' ), // Automatically escaped.
				) );
			else
				echo yourfitness_output( 'yourfitness_site_title_text', get_bloginfo( 'name' ) );

		echo yourfitness_close_markup( 'yourfitness_site_title_link', 'a' );

	echo yourfitness_close_markup( 'yourfitness_site_branding', 'div' );

}


yourfitness_add_smart_action( 'yourfitness_site_branding_append_markup', 'yourfitness_site_title_tag' );

/**
 * Echo header site title tag.
 *
 * @since 1.0.0
 */
function yourfitness_site_title_tag() {

	// Stop here if there isn't a description.
	if ( !$description = get_bloginfo( 'description' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_site_title_tag', 'span', array(
		'class' => 'tm-site-title-tag uk-text-small uk-text-muted uk-display-block'
	) );

		echo yourfitness_output( 'yourfitness_site_title_tag_text', $description );

	echo yourfitness_close_markup( 'yourfitness_site_title_tag', 'span' );

}