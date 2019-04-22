<?php
/**
 * Sets up torbara's menus.
 *
 * @package Render\Menu
 */

yourfitness_add_smart_action( 'after_setup_theme', 'yourfitness_do_register_default_menu' );

/**
 * Register default menu.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_default_menu() {

	// Stop here if a menu already exists.
	if ( wp_get_nav_menus() )
		return;

	// Set up default menu.
	wp_update_nav_menu_item(
		wp_create_nav_menu( esc_html__( 'Navigation', 'your-fitness' ) ),
		0,
		array(
			'menu-item-title' =>  esc_html__( 'Home', 'your-fitness' ),
			'menu-item-classes' => 'home',
			'menu-item-url' => esc_url(home_url( '/' )),
			'menu-item-status' => 'publish'
		)
	);

}


yourfitness_add_smart_action( 'after_setup_theme', 'yourfitness_do_register_nav_menus' );

/**
 * Register nav menus.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_nav_menus() {

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'your-fitness' ),
	) );

}


// Filter.
yourfitness_add_smart_action( 'wp_nav_menu_args', 'yourfitness_modify_menu_args' );

/**
 * Modify wp_nav_menu arguments.
 *
 * This function converts the wp_nav_menu to UIKit format. It uses torbara custom walker and also makes
 * use of the torbara HTML API.
 *
 * @since 1.0.0
 *
 * @param array $args The wp_nav_menu arguments.
 *
 * @return array The modified wp_nav_menu arguments.
 */
function yourfitness_modify_menu_args( $args ) {

	// Get type.
	$type = yourfitness_get( 'yourfitness_type', $args );

	// Check if the menu is in a widget area and set the type accordingly if it is defined.
	if ( $widget_area_type = yourfitness_get_widget_area( 'yourfitness_type' ) )
		$type = ( $widget_area_type == 'stack' ) ? 'sidenav' : $widget_area_type;

	// Stop if it isn't a torbara menu.
	if ( !$type )
		return $args;

	// Default item wrap attributes.
	$attr = array(
		'id' => '%1$s',
		'class' => array( yourfitness_get( 'menu_class', $args ) )
	);

	// Add UIKit navbar item wrap attributes.
	if ( $type == 'navbar' )
		$attr['class'][] = 'uk-navbar-nav';

	// Add UIKit sidenav item wrap attributes.
	if ( $type == 'sidenav' ) {

		$attr['class'][] = 'uk-nav uk-nav-parent-icon uk-nav-side';
		$attr['data-uk-nav'] = '{multiple:true}';

	}

	// Add UIKit offcanvas item wrap attributes.
	if ( $type == 'offcanvas' ) {

		$attr['class'][] = 'uk-nav uk-nav-parent-icon uk-nav-offcanvas';
		$attr['data-uk-nav'] = '{multiple:true}';

	}

	// Implode to avoid empty spaces.
	$attr['class'] = implode( ' ', array_filter( $attr['class'] ) );

	// Set to null if empty to avoid outputing empty class html attribute.
	if ( !$attr['class'] )
		$attr['class'] = null;

	$location_subfilter = ( $location = yourfitness_get( 'theme_location', $args ) ) ? "[_{$location}]" : null;

	// Force torbara menu arguments.
	$force = array(
		'yourfitness_type' => $type,
		'items_wrap' => yourfitness_open_markup( "yourfitness_menu[_{$type}]{$location_subfilter}", 'ul', $attr, $args ) . '%3$s' . yourfitness_close_markup( "yourfitness_menu[_{$type}]{$location_subfilter}", 'ul', $args ),
	);

	// Allow walker overwrite.
	if ( !yourfitness_get( 'walker', $args ) )
		$args['walker'] = new yourfitness_tt_Walker_Nav_Menu;

	// Adapt level to walker depth.
	$force['yourfitness_start_level'] = ( $level = yourfitness_get( 'yourfitness_start_level', $args ) ) ? ( $level - 1 ) : 0;

	return array_merge( $args, $force );

}