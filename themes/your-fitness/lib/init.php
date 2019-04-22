<?php
/**
 * Version: 1.0.9
 * Prepare and initialize the torbara framework.
 *
 * @package Initialize
 */


add_action( 'yourfitness_init', 'yourfitness_define_constants', -1 );

/**
 * Define constants.
 *
 * @ignore
 */
function yourfitness_define_constants() {

	// Define version.
	define( 'yourfitness_VERSION', '1.3.1' );

	// Define paths.
	if ( !defined( 'yourfitness_THEME_PATH' ) )
		define( 'yourfitness_THEME_PATH', wp_normalize_path( trailingslashit( get_template_directory() ) ) );

	define( 'yourfitness_PATH', yourfitness_THEME_PATH . 'lib/' );
	define( 'yourfitness_API_PATH', yourfitness_PATH . 'api/' );
	define( 'yourfitness_ASSETS_PATH', yourfitness_PATH . 'assets/' );
	define( 'yourfitness_RENDER_PATH', yourfitness_PATH . 'render/' );
	define( 'yourfitness_TEMPLATES_PATH', yourfitness_PATH . 'templates/' );
	define( 'yourfitness_STRUCTURE_PATH', yourfitness_TEMPLATES_PATH . 'structure/' );
	define( 'yourfitness_FRAGMENTS_PATH', yourfitness_TEMPLATES_PATH . 'fragments/' );

	// Define urls.
	if ( !defined( 'yourfitness_THEME_URL' ) )
		define( 'yourfitness_THEME_URL', trailingslashit( get_template_directory_uri() ) );

	define( 'yourfitness_URL', yourfitness_THEME_URL . 'lib/' );
	define( 'yourfitness_API_URL', yourfitness_URL . 'api/' );
	define( 'yourfitness_ASSETS_URL', yourfitness_URL . 'assets/' );
	define( 'yourfitness_LESS_URL', yourfitness_ASSETS_URL . 'less/' );
	define( 'yourfitness_JS_URL', yourfitness_ASSETS_URL . 'js/' );
	define( 'yourfitness_IMAGE_URL', yourfitness_ASSETS_URL . 'images/' );

	// Define admin paths.
	define( 'yourfitness_ADMIN_PATH', yourfitness_PATH . 'admin/' );

	// Define admin url.
	define( 'yourfitness_ADMIN_URL', yourfitness_URL . 'admin/' );
	define( 'yourfitness_ADMIN_ASSETS_URL', yourfitness_ADMIN_URL . 'assets/' );
	define( 'yourfitness_ADMIN_JS_URL', yourfitness_ADMIN_ASSETS_URL . 'js/' );

}


add_action( 'yourfitness_init', 'yourfitness_load_dependencies', -1 );

/**
 * Load dependencies.
 *
 * @ignore
 */
function yourfitness_load_dependencies() {

        load_template( yourfitness_API_PATH . 'init.php', true );

	// Load the necessary torbara components.
	yourfitness_load_api_components( array(
		'actions',
		'html',
		'term-meta',
		'post-meta',
		'image',
		'wp-customize',
		'compiler',
		'uikit',
		'template',
		'layout',
		'widget'
	) );

	// Add third party styles and scripts compiler support.
	yourfitness_add_api_component_support( 'wp_styles_compiler' );
	yourfitness_add_api_component_support( 'wp_scripts_compiler' );

	/**
	 * Fires after torbara API loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'yourfitness_after_load_api' );

}


add_action( 'yourfitness_init', 'yourfitness_add_theme_support' );

/**
 * Add theme support.
 *
 * @ignore
 */
function yourfitness_add_theme_support() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'custom-header', array(
		'width' => 2000,
		'height' => 500,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => false
	) );

	// torbara specific.
	add_theme_support( 'offcanvas-menu' );
	add_theme_support( 'torbara-default-styling' );

}


add_action( 'yourfitness_init', 'yourfitness_includes' );

/**
 * Include framework files.
 *
 * @ignore
 */
function yourfitness_includes() {

    // Include admin.
    if ( is_admin() ) {
        load_template( yourfitness_ADMIN_PATH . 'options.php', true );
        load_template( yourfitness_ADMIN_PATH . 'updater.php', true );
    }

    // Include assets.
    load_template( yourfitness_ASSETS_PATH . 'assets.php', true );

    // Include customizer.
    if (is_customize_preview()) {
        load_template(yourfitness_ADMIN_PATH . 'wp-customize.php', true);
    }

    // Include renderers.
    load_template( yourfitness_RENDER_PATH . 'template-parts.php', true );
    load_template( yourfitness_RENDER_PATH . 'fragments.php', true );
    load_template( yourfitness_RENDER_PATH . 'widget-area.php', true );
    load_template( yourfitness_RENDER_PATH . 'walker.php', true );
    load_template( yourfitness_RENDER_PATH . 'menu.php', true );

}

/**
 * Fires before torbara loads.
 *
 * @since 1.0.0
 */
do_action( 'yourfitness_before_init' );

	/**
	 * Load torbara framework.
	 *
	 * @since 1.0.0
	 */
	do_action( 'yourfitness_init' );

/**
 * Fires after torbara loads.
 *
 * @since 1.0.0
 */
do_action( 'yourfitness_after_init' );