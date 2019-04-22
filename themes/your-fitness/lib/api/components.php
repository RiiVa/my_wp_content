<?php
/**
 * The torbara Component defines which API components of the framework is loaded.
 *
 * It can be different on a per page bases. This keeps torbara as performant and lightweight as possible
 * by only loading what is needed.
 *
 * @package API
 */

/**
 * Load torbara API components.
 *
 * This function loads torbara API components. Components are only loaded once, even if they are called many times.
 * Admin components/functions are automatically wrapped in an is_admin() check.
 *
 * @since 1.0.0
 *
 * @param string|array $components Name of the API component(s) to include as and indexed array. The name(s) must be
 *                                 the torbara API component folder.
 *
 * @return bool Will always return true.
 */
function yourfitness_load_api_components( $components ) {

	static $loaded = array();

	$root = yourfitness_API_PATH;

	$common = array(
		'html' => array(
			$root . 'html/functions.php',
			$root . 'html/class.php'
		),
		'actions' => $root . 'actions/functions.php',
		'filters' => $root . 'filters/functions.php',
		'wp-customize' => $root . 'wp-customize/functions.php',
		'post-meta' => $root . 'post-meta/functions.php',
		'term-meta' => $root . 'term-meta/functions.php',
		'fields' => $root . 'fields/functions.php',
		'image' => $root . 'image/functions.php',
		'compiler' => array(
			$root . 'compiler/functions.php',
			$root . 'compiler/class-compiler.php',
			$root . 'compiler/class-page-compiler.php'
		),
		'uikit' => array(
			$root . 'uikit/functions.php',
			$root . 'uikit/class.php',
		),
		'layout' => $root . 'layout/functions.php',
		'template' => $root . 'template/functions.php',
		'widget' => $root . 'widget/functions.php'
	);

	// Only load admin fragments if is_admin() is true.
	if ( is_admin() )
		$admin = array(
			'options' => $root . 'options/functions.php',
			'post-meta' => $root . 'post-meta/functions-admin.php',
			'term-meta' => $root . 'term-meta/functions-admin.php',
			'compiler' => $root . 'compiler/class-options.php',
			'image' => $root . 'image/class-options.php',
			'_admin_menu' => $root . 'admin-menu.php'// Internal use.
		);
	else
		$admin = array();

	// Set dependencies.
	$dependencies = array(
		'html' => array(
			'_admin_menu',
			'filters'
		),
		'fields' => array(
			'actions',
			'html'
		),
		'options' => 'fields',
		'post-meta' => 'fields',
		'term-meta' => 'fields',
		'wp-customize' => 'fields',
		'layout' => 'fields',
		'image' => '_admin_menu',
		'compiler' => '_admin_menu',
		'uikit' => 'compiler',
		'_admin_menu' => 'options'
	);

	foreach ( (array) $components as $component ) {

		// Stop here if the component is already loaded or doesn't exists.
		if ( in_array( $component, $loaded ) || ( !isset( $common[$component] ) && !isset( $admin[$component] ) ) )
			continue;

		// Cache loaded component before calling dependencies.
		$loaded[] = $component;

		// Load dependencies.
		if ( array_key_exists( $component, $dependencies ) )
			yourfitness_load_api_components( $dependencies[$component] );

		$_components = array();

		// Add common components.
		if ( isset( $common[$component] ) )
			$_components = (array) $common[$component];

		// Add admin components.
		if ( isset( $admin[$component] ) )
			$_components = array_merge( (array) $_components, (array) $admin[$component] );

		// Load components.
                foreach ( $_components as $component_path  ){
                    load_template( $component_path, true );
                }

		/**
		 * Fires when an API component is loaded.
		 *
		 * The dynamic portion of the hook name, $component, refers to the name of the API component loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'yourfitness_loaded_api_component_' . $component );

	}

	return true;

}


/**
 * Register API component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to register.
 * @param mixed  $var     Additional variables passed to component support.
 *
 * @return bool Will always return true.
 */
function yourfitness_add_api_component_support( $feature ) {

	global $yourfitness_tt_api_components_support;

	$args = func_get_args();

	if ( func_num_args() == 1 )
		$args = true;
	else
		$args = array_slice( $args, 1 );

	$yourfitness_tt_api_components_support[$feature] = $args;

	return true;

}


/**
 * Gets the API component support argument(s).
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to check.
 *
 * @return mixed The argument(s) passed.
 */
function yourfitness_get_component_support( $feature ) {

	global $yourfitness_tt_api_components_support;

	if ( !isset( $yourfitness_tt_api_components_support[$feature] ) )
		return false;

	return $yourfitness_tt_api_components_support[$feature];

}


/**
 * Remove API component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to remove.
 *
 * @return bool Will always return true.
 */
function yourfitness_remove_api_component_support( $feature ) {

	global $yourfitness_tt_api_components_support;

	unset( $yourfitness_tt_api_components_support[$feature] );

	return true;

}


/**
 * Initialize API components support global.
 *
 * @ignore
 */
global $yourfitness_tt_api_components_support;

if ( !isset( $yourfitness_tt_api_components_support ) )
	$yourfitness_tt_api_components_support = array();