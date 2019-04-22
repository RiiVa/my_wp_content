<?php
/**
 * Echo the secondary sidebar structural markup. It also calls the secondary sidebar action hooks.
 *
 * @package Structure\Secondary_Sidebar
 */

echo yourfitness_open_markup( 'yourfitness_sidebar_secondary', 'aside', array(
	'class' => 'tm-tertiary ' . yourfitness_get_layout_class( 'sidebar_secondary' ) // Automatically escaped.
) );

	/**
	 * Fires in the secondary sidebar.
	 *
	 * @since 1.0.0
	 */
	do_action( 'yourfitness_sidebar_secondary' );

echo yourfitness_close_markup( 'yourfitness_sidebar_secondary', 'aside' );