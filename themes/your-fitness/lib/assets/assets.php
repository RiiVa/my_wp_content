<?php
/**
 * Add torbara assets.
 *
 * @package Assets
 */

yourfitness_add_smart_action( 'yourfitness_uikit_enqueue_scripts', 'yourfitness_enqueue_uikit_components', 5 );

/**
 * Enqueue UIKit components and torbara style.
 *
 * torbara style is enqueued with the UIKit components to have access to UIKit LESS variables.
 *
 * @since 1.0.0
 */
function yourfitness_enqueue_uikit_components() {

	$core = array(
		'base',
		'block',
		'grid',
		'article',
		'comment',
		'panel',
		'nav',
		'navbar',
		'subnav',
		'table',
		'breadcrumb',
		'pagination',
		'list',
		'form',
		'button',
		'badge',
		'alert',
		'dropdown',
		'offcanvas',
		'text',
		'utility',
		'icon'
	);

	yourfitness_uikit_enqueue_components( $core, 'core', false );

	// Include uikit default theme.
	yourfitness_uikit_enqueue_theme( 'default' );

	// Enqueue uikit overwrite theme folder.
	yourfitness_uikit_enqueue_theme( 'your-fitness', yourfitness_ASSETS_PATH . 'less/uikit-overwrite' );

	// Add the theme style as a uikit fragment to have access to all the variables.
	yourfitness_compiler_add_fragment( 'uikit', yourfitness_ASSETS_PATH . 'less/style.less', 'less' );

	// Add the theme default style as a uikit fragment only if the theme supports it.
	if ( current_theme_supports( 'torbara-default-styling' ) )
		yourfitness_compiler_add_fragment( 'uikit', yourfitness_ASSETS_PATH . 'less/default.less', 'less' );

}


yourfitness_add_smart_action( 'wp_enqueue_scripts', 'yourfitness_enqueue_assets', 5 );

/**
 * Enqueue torbara assets.
 *
 * @since 1.0.0
 */
function yourfitness_enqueue_assets() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}


yourfitness_add_smart_action( 'after_setup_theme', 'yourfitness_add_editor_assets' );

/**
 * Add torbara editor assets.
 *
 * @since 1.2.5
 */
function yourfitness_add_editor_assets() {

	add_editor_style( yourfitness_ASSETS_URL . 'css/editor' . yourfitness_MIN_CSS . '.css' );

}