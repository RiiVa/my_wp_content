<?php
/**
 * Echo widget fragments.
 *
 * @package Fragments\Widget
 */

yourfitness_add_smart_action( 'yourfitness_widget', 'yourfitness_widget_badge', 5 );

/**
 * Echo widget badge.
 *
 * @since 1.0.0
 */
function yourfitness_widget_badge() {

	if ( !yourfitness_get_widget( 'badge' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_widget_badge' . yourfitness_tt_widget_subfilters(), 'div', 'class=uk-panel-badge uk-badge' );

		echo yourfitness_widget_shortcodes( yourfitness_get_widget( 'badge_content' ) );

	echo yourfitness_close_markup( 'yourfitness_widget_badge' . yourfitness_tt_widget_subfilters(), 'div' );

}


yourfitness_add_smart_action( 'yourfitness_widget', 'yourfitness_widget_title' );

/**
 * Echo widget title.
 *
 * @since 1.0.0
 */
function yourfitness_widget_title() {

	if ( !( $title = yourfitness_get_widget( 'title' ) ) || !yourfitness_get_widget( 'show_title' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_widget_title' . yourfitness_tt_widget_subfilters(), 'h3', 'class=uk-panel-title' );

		echo yourfitness_output( 'yourfitness_widget_title_text', $title );

	echo yourfitness_close_markup( 'yourfitness_widget_title' . yourfitness_tt_widget_subfilters(), 'h3' );

}


yourfitness_add_smart_action( 'yourfitness_widget', 'yourfitness_widget_content', 15 );

/**
 * Echo widget content.
 *
 * @since 1.0.0
 */
function yourfitness_widget_content() {

	echo yourfitness_open_markup( 'yourfitness_widget_content' . yourfitness_tt_widget_subfilters(), 'div' );

		echo yourfitness_output( 'yourfitness_widget_content' . yourfitness_tt_widget_subfilters(), yourfitness_get_widget( 'content' ) );

	echo yourfitness_close_markup( 'yourfitness_widget_content' . yourfitness_tt_widget_subfilters(), 'div' );

}


yourfitness_add_smart_action( 'yourfitness_no_widget', 'yourfitness_no_widget' );

/**
 * Echo no widget content.
 *
 * @since 1.0.0
 */
function yourfitness_no_widget() {

	// Only apply this notice to sidebar-a and sidebar_secondary.
	if ( !in_array( yourfitness_get_widget_area( 'id' ), array( 'sidebar-a', 'sidebar_secondary' ) ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_no_widget_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo yourfitness_output( 'yourfitness_no_widget_notice_text', sprintf( esc_html__( '%s does not have any widget assigned!', 'your-fitness' ), yourfitness_get_widget_area( 'name' ) ) );

	echo yourfitness_close_markup( 'yourfitness_no_widget_notice', 'p' );

}


yourfitness_add_filter( 'yourfitness_widget_content_rss_output', 'yourfitness_widget_rss_content' );

/**
 * Modify RSS widget content.
 *
 * @since 1.0.0
 *
 * @return The RSS widget content.
 */
function yourfitness_widget_rss_content() {

	$options = yourfitness_get_widget( 'options' );

	return '<p><a class="uk-button" href="' . yourfitness_get( 'url', $options ) . '" target="_blank">' . esc_html__( 'Read feed', 'your-fitness' ) . '</a><p>';

}


yourfitness_add_filter( 'yourfitness_widget_content_attributes', 'yourfitness_modify_widget_content_attributes' );

/**
 * Modify core widgets content attributes, so they use the default UIKit styling.
 *
 * @since 1.0.0
 *
 * @param array $attributes The current widget attributes.
 *
 * @return array The modified widget attributes.
 */
function yourfitness_modify_widget_content_attributes( $attributes ) {

	$type = yourfitness_get_widget( 'type' );

	$target = array(
		'archives',
		'categories',
		'links',
		'meta',
		'pages',
		'recent-posts',
		'recent-comments'
	);

	$current_class = isset( $attributes['class'] ) ? $attributes['class'] . ' ' : '';

	if ( in_array( yourfitness_get_widget( 'type' ), $target ) )
		$attributes['class'] = $current_class . 'uk-list'; // Automatically escaped.

	if ( $type == 'calendar' )
		$attributes['class'] = $current_class . 'uk-table uk-table-condensed'; // Automatically escaped.

	return $attributes;

}


yourfitness_add_filter( 'yourfitness_widget_content_categories_output', 'yourfitness_modify_widget_count' );
yourfitness_add_filter( 'yourfitness_widget_content_archives_output', 'yourfitness_modify_widget_count' );

/**
 * Modify widget count.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function yourfitness_modify_widget_count( $content ) {

	$count = yourfitness_output( 'yourfitness_widget_count', '$1' );

	if ( yourfitness_get( 'dropdown', yourfitness_get_widget( 'options' ) ) == true ) {

		$output = $count;

	} else {

		$output = yourfitness_open_markup( 'yourfitness_widget_count', 'span', 'class=tm-count' );

			$output .= $count;

		$output .= yourfitness_close_markup( 'yourfitness_widget_count', 'span' );

	}

	// Keep closing tag to avoid overwriting the inline JavaScript.
	return preg_replace( '#>((\s|&nbsp;)\((.*)\))#', '>' . $output, $content );

}


yourfitness_add_filter( 'yourfitness_widget_content_categories_output', 'yourfitness_remove_widget_dropdown_label' );
yourfitness_add_filter( 'yourfitness_widget_content_archives_output', 'yourfitness_remove_widget_dropdown_label' );

/**
 * Modify widget dropdown label.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function yourfitness_remove_widget_dropdown_label( $content ) {

	return preg_replace( '#<label([^>]*)class="screen-reader-text"(.*?)>(.*?)</label>#', '', $content ) ;

}