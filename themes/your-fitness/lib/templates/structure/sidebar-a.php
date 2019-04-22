<?php
/**
 * Echo the primary sidebar structural markup. It also calls the primary sidebar action hooks.
 *
 * @package Structure\Primary_Sidebar
 */

echo yourfitness_open_markup( 'yourfitness_sidebar_primary', 'aside', array(
	'class' => 'tm-secondary ' . yourfitness_get_layout_class( 'sidebar-a' ) // Automatically escaped.
) );

	/**
	 * Fires in the primary sidebar.
	 *
	 * @since 1.0.0
	 */
	do_action( 'yourfitness_sidebar_primary' );

echo yourfitness_close_markup( 'yourfitness_sidebar_primary', 'aside' );