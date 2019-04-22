<?php
/**
 * Echo the widget area and widget loop structural markup. It also calls the widget area and widget loop
 * action hooks.
 *
 * @package Structure\Widget_Area
 */

// This includes everything added to wp hooks before the widgets.
echo yourfitness_get_widget_area( 'before_widgets' );

	if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'grid' )
		echo yourfitness_open_markup( 'yourfitness_widget_area_grid' . yourfitness_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

	if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'offcanvas' ) {

		echo yourfitness_open_markup( 'yourfitness_widget_area_offcanvas_wrap' . yourfitness_tt_widget_area_subfilters(), 'div', array(
			'id' => yourfitness_get_widget_area( 'id' ), // Automatically escaped.
			'class' => 'uk-offcanvas'
		) );

			echo yourfitness_open_markup( 'yourfitness_widget_area_offcanvas_bar' . yourfitness_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-offcanvas-bar' ) );

	}

		// Widgets.
		if ( yourfitness_have_widgets() ) :

			/**
			 * Fires before widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'yourfitness_before_widgets_loop' );

				while ( yourfitness_have_widgets() ) : yourfitness_setup_widget();

					if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'grid' )
						echo yourfitness_open_markup( 'yourfitness_widget_grid' . yourfitness_tt_widget_subfilters(), 'div', yourfitness_widget_shortcodes( 'class=uk-width-medium-1-{count}' ) );

						echo yourfitness_open_markup( 'yourfitness_widget_panel' . yourfitness_tt_widget_subfilters(), 'div', yourfitness_widget_shortcodes( 'class=tm-widget uk-panel widget_{type} {id}' ) );

							/**
							 * Fires in each widget panel structural HTML.
							 *
							 * @since 1.0.0
							 */
							do_action( 'yourfitness_widget' );

						echo yourfitness_close_markup( 'yourfitness_widget_panel' . yourfitness_tt_widget_subfilters(), 'div' );

					if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'grid' )
						echo yourfitness_close_markup( 'yourfitness_widget_grid' . yourfitness_tt_widget_subfilters(), 'div' );

				endwhile;

			/**
			 * Fires after the widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'yourfitness_after_widgets_loop' );

		else :

			/**
			 * Fires if no widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'yourfitness_no_widget' );

		endif;

	if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'offcanvas' ) {

			echo yourfitness_close_markup( 'yourfitness_widget_area_offcanvas_bar' . yourfitness_tt_widget_area_subfilters(), 'div' );

		echo yourfitness_close_markup( 'yourfitness_widget_area_offcanvas_wrap' . yourfitness_tt_widget_area_subfilters(), 'div' );

	}

	if ( yourfitness_get_widget_area( 'yourfitness_type' ) == 'grid' )
		echo yourfitness_close_markup( 'yourfitness_widget_area_grid' . yourfitness_tt_widget_area_subfilters(), 'div' );

// This includes everything added to wp hooks after the widgets.
echo yourfitness_get_widget_area( 'after_widgets' );