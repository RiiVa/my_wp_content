<?php
/**
 * Add post shortcodes.
 *
 * @package Fragments\Post_Shortcodes
 */

yourfitness_add_smart_action( 'yourfitness_post_meta_date', 'yourfitness_post_meta_date_shortcode' );

/**
 * Echo post meta date shortcode.
 *
 * @since 1.0.0
 */
function yourfitness_post_meta_date_shortcode() {

	echo yourfitness_output( 'yourfitness_post_meta_date_prefix', esc_html__( 'Posted on ', 'your-fitness' ) );

	echo yourfitness_open_markup( 'yourfitness_post_meta_date', 'time', array(
		'datetime' => get_the_time( 'c' )
	) );

		echo yourfitness_output( 'yourfitness_post_meta_date_text', get_the_time( get_option( 'date_format' ) ) );

	echo yourfitness_close_markup( 'yourfitness_post_meta_date', 'time' );

}


yourfitness_add_smart_action( 'yourfitness_post_meta_author', 'yourfitness_post_meta_author_shortcode' );

/**
 * Echo post meta author shortcode.
 *
 * @since 1.0.0
 */
function yourfitness_post_meta_author_shortcode() {

	yourfitness_output( 'yourfitness_post_meta_author_prefix', esc_html__( 'By ', 'your-fitness' ) ) ;

	echo yourfitness_open_markup( 'yourfitness_post_meta_author', 'a', array(
		'href' => get_author_posts_url( get_the_author_meta( 'ID' ) ), // Automatically escaped.
	) );

		echo yourfitness_output( 'yourfitness_post_meta_author_text', get_the_author() );

	echo yourfitness_close_markup( 'yourfitness_post_meta_author', 'a' );

}


yourfitness_add_smart_action( 'yourfitness_post_meta_comments', 'yourfitness_post_meta_comments_shortcode' );

/**
 * Echo post meta comments shortcode.
 *
 * @since 1.0.0
 */
function yourfitness_post_meta_comments_shortcode() {

	global $post;

	if ( post_password_required() || !comments_open() )
		return;

	$comments_number = (int) get_comments_number( $post->ID );

	if ( $comments_number < 1 )
		$comment_text = yourfitness_output( 'yourfitness_post_meta_empty_comment_text', esc_html__( 'Leave a comment', 'your-fitness' ) );
	else if ( $comments_number === 1 )
		$comment_text = yourfitness_output( 'yourfitness_post_meta_comments_text_singular', esc_html__( '1 comment', 'your-fitness' ) );
	else
		$comment_text = yourfitness_output( 'yourfitness_post_meta_comments_text_plurial', esc_html__( '%s comments', 'your-fitness' ) );

	echo yourfitness_open_markup( 'yourfitness_post_meta_comments', 'a', array(
		'href' => get_comments_link() // Automatically escaped.
	) );

		printf( $comment_text, (int) get_comments_number( $post->ID ) );

	echo yourfitness_close_markup( 'yourfitness_post_meta_comments', 'a' );

}


yourfitness_add_smart_action( 'yourfitness_post_meta_tags', 'yourfitness_post_meta_tags_shortcode' );

/**
 * Echo post meta tags shortcode.
 *
 * @since 1.0.0
 */
function yourfitness_post_meta_tags_shortcode() {

	$tags = get_the_tag_list( null, ', ' );

	if ( !$tags || is_wp_error( $tags ) )
		return;

	echo yourfitness_output( 'yourfitness_post_meta_tags_prefix', esc_html__( 'Tagged with: ', 'your-fitness' ) ) . $tags;

}


yourfitness_add_smart_action( 'yourfitness_post_meta_categories', 'yourfitness_post_meta_categories_shortcode' );

/**
 * Echo post meta categories shortcode.
 *
 * @since 1.0.0
 */
function yourfitness_post_meta_categories_shortcode() {

	$categories = get_the_category_list( ', ' );

	if ( !$categories || is_wp_error( $categories ) )
		return;

	echo yourfitness_output( 'yourfitness_post_meta_categories_prefix', esc_html__( 'Filed under: ', 'your-fitness' ) ) . $categories;

}
