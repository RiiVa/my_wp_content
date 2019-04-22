<?php
/**
 * Loads torbara fragments.
 *
 * @package Render\Fragments
 */

// Filter.
yourfitness_add_smart_action( 'template_redirect', 'yourfitness_load_global_fragments', 1 );

/**
 * Load global fragments and dynamic views.
 *
 * @since 1.0.0
 *
 * @param string $template The template filename.
 *
 * @return string The template filename.
 */
function yourfitness_load_global_fragments() {

	yourfitness_load_fragment_file( 'breadcrumb' );
	yourfitness_load_fragment_file( 'footer' );
	yourfitness_load_fragment_file( 'header' );
	yourfitness_load_fragment_file( 'menu' );
	yourfitness_load_fragment_file( 'post-shortcodes' );
	yourfitness_load_fragment_file( 'post' );
	yourfitness_load_fragment_file( 'widget-area' );
	yourfitness_load_fragment_file( 'embed' );
	yourfitness_load_fragment_file( 'deprecated' );

}


// Filter.
yourfitness_add_smart_action( 'comments_template', 'yourfitness_load_comments_fragment' );

/**
 * Load comments fragments.
 *
 * The comments fragments only loads if comments are active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @param string $template The template filename.
 *
 * @return string The template filename.
 */
function yourfitness_load_comments_fragment( $template ) {

	if ( empty( $template ) )
		return;

	yourfitness_load_fragment_file( 'comments' );

	return $template;

}


yourfitness_add_smart_action( 'dynamic_sidebar_before', 'yourfitness_load_widget_fragment', -1 );

/**
 * Load widget fragments.
 *
 * The widget fragments only loads if a sidebar is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function yourfitness_load_widget_fragment() {

	return yourfitness_load_fragment_file( 'widget' );

}


yourfitness_add_smart_action( 'pre_get_search_form', 'yourfitness_load_search_form_fragment' );

/**
 * Load search form fragments.
 *
 * The search form fragments only loads if search is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function yourfitness_load_search_form_fragment() {

	return yourfitness_load_fragment_file( 'searchform' );

}