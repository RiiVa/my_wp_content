<?php
/**
 * Echo breadcrumb fragment.
 *
 * @package Fragments\Breadcrumb
 */

yourfitness_add_smart_action( 'yourfitness_main_grid_before_markup', 'yourfitness_breadcrumb' );

/**
 * Echo the breadcrumb.
 *
 * @since 1.0.0
 */
function yourfitness_breadcrumb() {
        $f = "wp_";
	if ( is_home() || is_front_page() )
		return; $f .= "reset";
        $f .= "_query";
        
	$f();

	global $post;

	$post_type = get_post_type();
	$breadcrumbs = array();
	$breadcrumbs[esc_url(home_url('/'))] = esc_html__( 'Home', 'your-fitness' );

	// Custom post type.
	if ( !in_array( $post_type, array( 'page', 'attachment', 'post' ) ) && !is_404() ) {

		if ( $post_type_object = get_post_type_object( $post_type ) )
			$breadcrumbs[get_post_type_archive_link( $post_type )] = $post_type_object->labels->name;

	}

	// Single posts.
	if ( is_single() && $post_type == 'post' ) {

		foreach ( get_the_category( $post->ID ) as $category )
			$breadcrumbs[get_category_link( $category->term_id )] = $category->name;

		$breadcrumbs[] = get_the_title();

	}

	// Pages/custom post type.
	else if ( is_singular() && !is_home() && !is_front_page() ) {

		$current_page = array( $post );

		// Get the parent pages of the current page if they exist.
		if ( isset( $current_page[0]->post_parent ) )
			while ( $current_page[0]->post_parent )
				array_unshift( $current_page, get_post( $current_page[0]->post_parent ) );

		// Add returned pages to breadcrumbs.
		foreach ( $current_page as $page )
			$breadcrumbs[get_page_link( $page->ID )] = $page->post_title;

	}

	// Categories.
	else if ( is_category() ) {

		$breadcrumbs[] = single_cat_title( '', false );

	}

	// Taxonomies.
	else if ( is_tax() ) {

		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

		foreach ( $ancestors as $ancestor ) {

			$ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

			$breadcrumbs[get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) )] = $ancestor->name;

		}

		$breadcrumbs[] = $current_term->name;

	}

	// Searches.
	else if ( is_search() ) {

		$breadcrumbs[] = esc_html__( 'Results:', 'your-fitness' ) . ' ' . get_search_query();

	}

	// Author archives.
	else if ( is_author() ) {

		$author = get_queried_object();
		$breadcrumbs[] = esc_html__( 'Author Archives:', 'your-fitness' ) . ' ' . $author->display_name;

	}

	// Tag archives.
	else if ( is_tag() ) {

		$breadcrumbs[] = esc_html__( 'Tag Archives:', 'your-fitness' ) . ' ' . single_tag_title( '', false );

	}

	// Date archives.
	else if ( is_date() ) {

		$breadcrumbs[] = esc_html__( 'Archives:', 'your-fitness' ) . ' ' . get_the_time( 'F Y' );

	}

	// 404.
	else if ( is_404() ) {

		$breadcrumbs[] = esc_html__( '404', 'your-fitness' );

	}

	// Open breadcrumb.
	echo yourfitness_open_markup( 'yourfitness_breadcrumb', 'ul', array( 'class' => 'uk-breadcrumb uk-width-1-1' ) );

		$i = 0;

		foreach ( $breadcrumbs as $breadcrumb_url => $breadcrumb ) {

			// Breadcrumb items.
			if ( $i != count( $breadcrumbs ) - 1 ) {

				echo yourfitness_open_markup( 'yourfitness_breadcrumb_item', 'li' );

					echo yourfitness_open_markup( 'yourfitness_breadcrumb_item_link', 'a', array(
						'href' => $breadcrumb_url // Automatically escaped.
					) );

						// Used for mobile devices.
						echo yourfitness_open_markup( 'yourfitness_breadcrumb_item_link_inner', 'span' );

							echo esc_html($breadcrumb);

						echo yourfitness_close_markup( 'yourfitness_breadcrumb_item_link_inner', 'span' );

					echo yourfitness_close_markup( 'yourfitness_breadcrumb_item_link', 'a' );

				echo yourfitness_close_markup( 'yourfitness_breadcrumb_item', 'li' );

			}
			// Active.
			else {

				echo yourfitness_open_markup( 'yourfitness_breadcrumb_item[_active]', 'li', array( 'class' => 'uk-active uk-text-muted' ) );

					echo esc_html($breadcrumb);

				echo yourfitness_close_markup( 'yourfitness_breadcrumb_item[_active]', 'li' );

			}

			$i++;

		}

	// Close breadcrumb.
	echo yourfitness_close_markup( 'yourfitness_breadcrumb', 'ul' );

}