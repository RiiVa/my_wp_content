<?php
/**
 *
 * Load components.
 *
 * @ignore
 *
 * @package torbara
 */

// Stop here if the API was already loaded.
if ( defined( 'yourfitness_API' ) )
	return;

// Declare torbara API.
define( 'yourfitness_API', true );

// Mode.
if ( !defined( 'SCRIPT_DEBUG' ) )
	define( 'SCRIPT_DEBUG', false );

// Assets.
define( 'yourfitness_MIN_CSS', SCRIPT_DEBUG ? '' : '.min' );
define( 'yourfitness_MIN_JS', SCRIPT_DEBUG ? '' : '.min' );

// Path.
if ( !defined( 'yourfitness_API_PATH' ) )
	define( 'yourfitness_API_PATH', wp_normalize_path( trailingslashit( get_template_directory().'/lib/api/' ) ) );

define( 'yourfitness_API_ADMIN_PATH', yourfitness_API_PATH . 'admin/' );

// Load dependencies here as it is used further down.
load_template( yourfitness_API_PATH . 'utilities/functions.php', true );
load_template( yourfitness_API_PATH . 'utilities/deprecated.php', true );
load_template( yourfitness_API_PATH . 'components.php', true );

// Url.
if ( !defined( 'yourfitness_API_URL' ) )
	define( 'yourfitness_API_URL', yourfitness_path_to_url( yourfitness_API_PATH ) );

// Backwards compatibility constants.
define( 'yourfitness_API_COMPONENTS_PATH', yourfitness_API_PATH );
define( 'yourfitness_API_COMPONENTS_ADMIN_PATH', yourfitness_API_PATH . 'admin/' );
define( 'yourfitness_API_COMPONENTS_URL', yourfitness_API_URL );