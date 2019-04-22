<?php
/**
 * Registers torbara's default widget areas.
 *
 * @package Render\Widgets
 */

yourfitness_add_smart_action( 'widgets_init', 'yourfitness_do_register_widget_areas', 5 );

/**
 * Register torbara's default widget areas.
 *
 * @since 1.0.0
 */
function yourfitness_do_register_widget_areas() {

	// Keep primary sidebar first for default widget asignment.
	yourfitness_register_widget_area( array(
		'name' => esc_html__( 'sidebar-a', 'your-fitness' ),
		'id' => 'sidebar-a'
	) );

	yourfitness_register_widget_area( array(
		'name' => esc_html__( 'Sidebar Secondary', 'your-fitness' ),
		'id' => 'sidebar_secondary'
	) );

	if ( current_theme_supports( 'offcanvas-menu' ) )
		yourfitness_register_widget_area( array(
			'name' => esc_html__( 'Off-Canvas Menu', 'your-fitness' ),
			'id' => 'offcanvas_menu',
			'yourfitness_type' => 'offcanvas',
		) );

}


/**
 * Call register sidebar.
 *
 * Because WordPress.org checker don't understand that we are using register_sidebar properly,
 * we have to add this useless call which only has to be declared once.
 *
 * @since 1.0.0
 *
 * @ignore
 */
add_action( 'widgets_init', 'yourfitness_register_widget_area' );