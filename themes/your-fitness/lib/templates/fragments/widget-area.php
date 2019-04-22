<?php
/**
 * Echo widget areas.
 *
 * @package Fragments\Widget_Area
 */

yourfitness_add_smart_action( 'yourfitness_sidebar_primary', 'yourfitness_widget_area_sidebar_primary' );

/**
 * Echo primary sidebar widget area.
 *
 * @since 1.0.0
 */
function yourfitness_widget_area_sidebar_primary() {

	echo yourfitness_widget_area( 'sidebar-a' );

}


yourfitness_add_smart_action( 'yourfitness_sidebar_secondary', 'yourfitness_widget_area_sidebar_secondary' );

/**
 * Echo secondary sidebar widget area.
 *
 * @since 1.0.0
 */
function yourfitness_widget_area_sidebar_secondary() {

	echo yourfitness_widget_area( 'sidebar_secondary' );

}


yourfitness_add_smart_action( 'yourfitness_site_after_markup', 'yourfitness_widget_area_offcanvas_menu' );

/**
 * Echo off-canvas widget area.
 *
 * @since 1.0.0
 */
function yourfitness_widget_area_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo yourfitness_widget_area( 'offcanvas_menu' );

}