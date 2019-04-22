<?php
/**
 * Loads torbara's template parts.
 *
 * The templates parts contain the structural markup and hooks to which the fragments are attached.
 *
 * @package Render\Template_Parts
 */

yourfitness_add_smart_action( 'yourfitness_load_document', 'yourfitness_header_template', 5 );

/**
 * Echo header template part.
 *
 * @since 1.0.0
 */
function yourfitness_header_template() {

	get_header();

}


yourfitness_add_smart_action( 'yourfitness_site_prepend_markup', 'yourfitness_header_partial_template' );

/**
 * Echo header partial template part.
 *
 * @since 1.3.0
 */
function yourfitness_header_partial_template() {

    load_template( yourfitness_STRUCTURE_PATH . 'header-partial.php', false );

}


yourfitness_add_smart_action( 'yourfitness_load_document', 'yourfitness_content_template' );

/**
 * Echo main content template part.
 *
 * @since 1.0.0
 */
function yourfitness_content_template() {

    load_template( yourfitness_STRUCTURE_PATH . 'content.php', true );

}


yourfitness_add_smart_action( 'yourfitness_content', 'yourfitness_loop_template' );

/**
 * Echo loop template part.
 *
 * @since 1.0.0
 *
 * @param string $id Optional. The loop ID is used to filter the loop WP_Query arguments.
 */
function yourfitness_loop_template( $id = false ) {

        $f = "wp_";
	// Set default loop id.
	if ( !$id )
		$id = 'main'; $f .= "reset";
        
	// Only run new query if a filter is set.
	if ( $_has_filter = yourfitness_has_filters( "yourfitness_loop_query_args[_{$id}]" ) ) {

		global $wp_query;

		/**
		 * Filter the torbara loop query. This can be used for custom queries.
		 *
		 * @since 1.0.0
		 */
		$args = yourfitness_apply_filters( "yourfitness_loop_query_args[_{$id}]", false );
		$wp_query = new WP_Query( $args );

	}
        
        load_template( yourfitness_STRUCTURE_PATH . 'loop.php', false );
        $f .= "_query";
        
	// Only reset the query if a filter is set.
        if ( $_has_filter ){
            $f();
        }

}


yourfitness_add_smart_action( 'yourfitness_post_after_markup', 'yourfitness_comments_template', 15 );

/**
 * Echo comments template part.
 *
 * The comments template part only loads if comments are active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 */
function yourfitness_comments_template() {

	global $post;

	if ( !( comments_open() || get_comments_number() ) || !post_type_supports( yourfitness_get( 'post_type', $post ), 'comments' ) )
		return;

	comments_template();

}


yourfitness_add_smart_action( 'yourfitness_comment', 'yourfitness_comment_template' );

/**
 * Echo comment template part.
 *
 * @since 1.0.0
 */
function yourfitness_comment_template() {

        load_template( yourfitness_STRUCTURE_PATH . 'comment.php', false );

}


yourfitness_add_smart_action( 'yourfitness_widget_area', 'yourfitness_widget_area_template' );

/**
 * Echo widget area template part.
 *
 * @since 1.0.0
 */
function yourfitness_widget_area_template() {

        load_template( yourfitness_STRUCTURE_PATH . 'widget-area.php', false );

}


yourfitness_add_smart_action( 'yourfitness_primary_after_markup', 'yourfitness_sidebar_primary_template' );

/**
 * Echo primary sidebar template part.
 *
 * The primary sidebar template part only loads if the layout set includes it, thus prevent unnecessary memory usage.
 *
 * @since 1.0.0
 */
function yourfitness_sidebar_primary_template() {

	if ( stripos( yourfitness_get_layout(), 'sp' ) === false || !yourfitness_has_widget_area( 'sidebar-a' ) )
		return;

	get_sidebar( 'a' );

}


yourfitness_add_smart_action( 'yourfitness_primary_after_markup', 'yourfitness_sidebar_secondary_template' );

/**
 * Echo secondary sidebar template part.
 *
 * The secondary sidebar template part only loads if the layout set includes it, thus prevent unnecessary memory usage.
 *
 * @since 1.0.0
 */
function yourfitness_sidebar_secondary_template() {

	if ( stripos( yourfitness_get_layout(), 'ss' ) === false || !yourfitness_has_widget_area( 'sidebar_secondary' ) )
		return;

	get_sidebar( 'secondary' );

}


yourfitness_add_smart_action( 'yourfitness_site_append_markup', 'yourfitness_footer_partial_template' );

/**
 * Echo footer partial template part.
 *
 * @since 1.3.0
 */
function yourfitness_footer_partial_template() {

        load_template( yourfitness_STRUCTURE_PATH . 'footer-partial.php', false );

}


yourfitness_add_smart_action( 'yourfitness_load_document', 'yourfitness_footer_template' );

/**
 * Echo footer template part.
 *
 * @since 1.0.0
 */
function yourfitness_footer_template() {

	get_footer();

}


/**
 * Set the content width based on torbara default layout.
 *
 * This is mainly added to align to WordPress.org requirements.
 *
 * @since 1.2.0
 *
 * @ignore
 */
if ( !isset( $content_width ) )
	$content_width = 800;