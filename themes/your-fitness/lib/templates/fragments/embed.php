<?php
/**
 * Extends WordPress Embed.
 *
 * @package Fragments\Embed
 */

// Filter.
yourfitness_add_smart_action( 'embed_oembed_html', 'yourfitness_embed_oembed' );

/**
 * Add markup to embed.
 *
 * @since 1.0.0
 *
 * @param string $html The embed HTML.
 *
 * @return string The modified embed HTML.
 */
function yourfitness_embed_oembed( $html ) {

	$output = yourfitness_open_markup( 'yourfitness_embed_oembed', 'div', 'class=tm-oembed' );

		$output .= $html;

	$output .= yourfitness_close_markup( 'yourfitness_embed_oembed', 'div' );

	return $output;

}