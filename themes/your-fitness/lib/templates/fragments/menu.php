<?php
/**
 * Echo menu fragments.
 *
 * @package Fragments\Menu
 */

yourfitness_add_smart_action( 'yourfitness_header', 'yourfitness_primary_menu', 15 );

/**
 * Echo primary menu.
 *
 * @since 1.0.0
 */
function yourfitness_primary_menu() {

	$nav_visibility = current_theme_supports( 'offcanvas-menu' ) ? 'uk-visible-large' : '';

	echo yourfitness_open_markup( 'yourfitness_primary_menu', 'nav', array(
		'class' => 'tm-primary-menu uk-float-right uk-navbar'
	) );

		/**
		 * Filter the primary menu arguments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Nav menu arguments.
		 */
		$args = apply_filters( 'yourfitness_primary_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'yourfitness_no_menu_notice',
			'container' => '',
			'menu_class' => $nav_visibility, // Automatically escaped.
			'echo' => false,
			'yourfitness_type' => 'navbar'
		) );

		// Navigation.
		echo yourfitness_output( 'yourfitness_primary_menu', wp_nav_menu( $args ) );

	echo yourfitness_close_markup( 'yourfitness_primary_menu', 'nav' );

}


yourfitness_add_smart_action( 'yourfitness_primary_menu_append_markup', 'yourfitness_primary_menu_offcanvas_button', 5 );

/**
 * Echo primary menu offcanvas button.
 *
 * @since 1.0.0
 */
function yourfitness_primary_menu_offcanvas_button() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_primary_menu_offcanvas_button', 'a', array(
		'href' => '#offcanvas_menu',
		'class' => 'uk-button uk-hidden-large',
		'data-uk-offcanvas' => ''
	) );

		echo yourfitness_open_markup( 'yourfitness_primary_menu_offcanvas_button_icon', 'i', array(
			'class' => 'uk-icon-navicon uk-margin-small-right',
		) );

		echo yourfitness_close_markup( 'yourfitness_primary_menu_offcanvas_button_icon', 'i' );

		echo yourfitness_output( 'yourfitness_offcanvas_menu_button', esc_html__( 'Menu', 'your-fitness' ) );

	echo yourfitness_close_markup( 'yourfitness_primary_menu_offcanvas_button', 'a' );

}


yourfitness_add_smart_action( 'yourfitness_widget_area_offcanvas_bar_offcanvas_menu_prepend_markup', 'yourfitness_primary_offcanvas_menu' );

/**
 * Echo off-canvas primary menu.
 *
 * @since 1.0.0
 */
function yourfitness_primary_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_primary_offcanvas_menu', 'nav', array(
		'class' => 'tm-primary-offcanvas-menu uk-margin uk-margin-top'
	) );

		/**
		 * Filter the off-canvas primary menu arguments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Off-canvas nav menu arguments.
		 */
		$args = apply_filters( 'yourfitness_primary_offcanvas_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'yourfitness_no_menu_notice',
			'container' => '',
			'echo' => false,
			'yourfitness_type' => 'offcanvas'
		) );

		echo yourfitness_output( 'yourfitness_primary_offcanvas_menu', wp_nav_menu( $args ) );

	echo yourfitness_close_markup( 'yourfitness_primary_offcanvas_menu', 'nav' );

}


/**
 * Echo no menu notice.
 *
 * @since 1.0.0
 */
function yourfitness_no_menu_notice() {

	echo yourfitness_open_markup( 'yourfitness_no_menu_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo yourfitness_output( 'yourfitness_no_menu_notice_text', esc_html__( 'Whoops, your site does not have a menu!', 'your-fitness' ) );

	echo yourfitness_close_markup( 'yourfitness_no_menu_notice', 'p' );

}