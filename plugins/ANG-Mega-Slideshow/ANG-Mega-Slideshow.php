<?php
/*
 * The plugin bootstrap file
 * 
 * Plugin Name: ANG Mega Slideshow
 * Plugin URI: http://themeforest.net/user/torbara/?ref=torbara
 * Description: Displays random posts in slideshow with thumbnail navigation and multiple select
 * Author: Aleksandr Glovatskyy
 * Author URI: http://themeforest.net/user/torbara/portfolio/?ref=torbara
 * Author e-mail: alex1278@list.ru
 * Version: 1.0.0
 * Date: 26.11.2015
 * License: GPL2+
 * @package     Esta
 * @subpackage  Widget/Slideshow
 */


// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Script version, used to add version for scripts and styles
define( 'ANGS_VER', '1.1.0' );


/****************************  ang  ************************/

// Defines plugin base name // my-plugin/my-plugin.php.

$esta_plugin_path = untrailingslashit(plugin_dir_path( __FILE__ ));
if ( ! defined( 'ANGS_PLUGIN_BASE_NAME' ) )
define('ANGS_PLUGIN_BASE_NAME', plugin_basename(__FILE__));

// Define plugin URLs, for fast enqueuing scripts and styles
if ( ! defined( 'ANGS_PLUGIN_URL' ) )
	define( 'ANGS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ANGS_WGT_URL', trailingslashit( ANGS_PLUGIN_URL . 'widgets' ) );

// Define Plugin paths, for esta function files
if ( ! defined( 'ANGS_PLUGIN_DIR' ) )
	define( 'ANGS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ANGS_WGT_DIR', trailingslashit( ANGS_PLUGIN_DIR . 'widgets' ) );

// Registering widgets
foreach ( glob( ANGS_WGT_DIR . '*.php' ) as $widget )
{       require_once $widget;    }


/*********** 
 ******* apply for style dir
  *****/ 

function wp_load_ang_mega_slideshow_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style('css-ang-mega-slideshow', $plugin_url . 'widgets/css/ang-mega-slideshow.css' );
}
add_action('wp_enqueue_scripts', 'wp_load_ang_mega_slideshow_css' );
// add category support for pages



/**************** 
 ********** Register taxpnomy for custom post type "Timeline"
 ****************/

if ( ! function_exists( 'custom_taxonomy_slideset' ) ) {

// Register Custom Taxonomy
function custom_taxonomy_slideset() {

	$labels = array(
		'name'                       => _x( 'Slidesets', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Slideset', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Slidesets', 'text_domain' ),
		'all_items'                  => __( 'All Slidesets', 'text_domain' ),
		'parent_item'                => __( 'Parent Slideset', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Slideset:', 'text_domain' ),
		'new_item_name'              => __( 'New Slideset Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Slideset', 'text_domain' ),
		'edit_item'                  => __( 'Edit Slideset', 'text_domain' ),
		'update_item'                => __( 'Update Slideset', 'text_domain' ),
		'view_item'                  => __( 'View Slideset', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Slidesets with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Slidesets ', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Slidesets', 'text_domain' ),
		'search_items'               => __( 'Search Slidesets', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'items_list'                 => __( 'Slidesets list', 'text_domain' ),
		'items_list_navigation'      => __( 'Slidesets list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'slideset', array( 'slideshow' ), $args );

}
add_action( 'init', 'custom_taxonomy_slideset', 0 );

}


/**************** 
 **********register new custom post type "Slideshow"
 ****************/

if ( ! function_exists('custom_post_type_slideshow') ) {

// Register Custom Post Type
function custom_post_type_slideshow() {

	$labels = array(
		'name'                  => _x( 'Slideshows', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Slideshow', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Slideshow', 'text_domain' ),
		'name_admin_bar'        => __( 'Slideshow', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Slides', 'text_domain' ),
		'add_new_item'          => __( 'Add New Slide', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'Slide', 'text_domain' ),
		'edit_item'             => __( 'Edit Slide', 'text_domain' ),
		'update_item'           => __( 'Update Slide', 'text_domain' ),
		'view_item'             => __( 'View Slide', 'text_domain' ),
		'search_items'          => __( 'Search Slide', 'text_domain' ),
		'not_found'             => __( 'Slide Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Slide Not found in Trash', 'text_domain' ),
		'items_list'            => __( 'Slides list', 'text_domain' ),
		'items_list_navigation' => __( 'Slides list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Slides list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Slideshow', 'text_domain' ),
		'description'           => __( 'Every post will be displayed like slideshow', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'slideset'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 13,
                'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'slideshow', $args );

}
add_action( 'init', 'custom_post_type_slideshow', 0 );
}



    /*
     * add theme support post thumbnails in slideshow listing for admin
     */
add_filter('manage_edit-slideshow_columns', 'slideshow_listing', 5);
function slideshow_listing($default1) {
    $default1['post_thumbnails'] = 'Slide';
    return $default1;
}
 
//image size
add_action('manage_slideshow_posts_custom_column', 'slideshow_custom_columns', 5, 2);
function slideshow_custom_columns($row_label, $id) {
    if ($row_label === 'post_thumbnails') :
        print the_post_thumbnail(array(100,100));
    endif;
}

// sortable columns
add_filter('manage_edit-slideshow_sortable_columns', 'add_slideshow_sortable_column');
function add_slideshow_sortable_column($sortable_columns){
	$sortable_columns['post_thumbnails'] = 'Slide';

	return $sortable_columns;
}

// Additional links in plugin settings: Torbara.com | Portfolio
$tt_f_plugin_links = function($links) {
    array_push($links, '<a title="We are developing beautiful themes and applications for the web!" href="http://torbara.com" target="_blank" style="font-weight: bold; font-size: 14px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NTMuNSA0NTMuNSI+PHBhdGggZD0iTTM5NC43IDIzOC4zOTJjLTEuNSAwLTMgLjMtNC40LjdsLTUwLjEtMTEwYzMuOS0yLjQgNi41LTYuNyA2LjUtMTEuNiAwLTYuNi00LjctMTIuMS0xMC45LTEzLjQtLjYtLjEtMS4xLS4yLTEuNy0uMmgtMWMtNC43IDAtOC44IDIuMy0xMS4zIDUuOWwtNzcuNi0zMi41Yy4xLS43LjItMS40LjItMi4xIDAtNy42LTYuMS0xMy43LTEzLjctMTMuN3MtMTMuNyA2LjEtMTMuNyAxMy43di4zbC04OS40IDMwLjNjLTIuMS00LjktNi45LTguMy0xMi42LTguMy03LjUgMC0xMy43IDYuMS0xMy43IDEzLjcgMCA0LjkgMi42IDkuMiA2LjUgMTEuNmwtNDUuNiA4NS45Yy0uNS0uMS0xLS4xLTEuNi0uMS00LjUgMC04LjQgMi4xLTEwLjkgNS41LTEgMS4zLTEuNyAyLjctMi4yIDQuMy0uNCAxLjItLjYgMi42LS42IDMuOSAwIDcuNiA2LjEgMTMuNyAxMy43IDEzLjdoLjJsNDIuNiA5NS43Yy0yLjYgMi41LTQuMyA2LTQuMyA5LjkgMCA3LjUgNi4xIDEzLjcgMTMuNyAxMy43IDQuNyAwIDguOC0yLjMgMTEuMy01LjlsODYuNSAzOS41Yy41IDcuMSA2LjQgMTIuNiAxMy42IDEyLjYgNy41IDAgMTMuNi02IDEzLjctMTMuNWw5NC44LTMxLjJjMi40IDMuOSA2LjcgNi41IDExLjcgNi41IDcuNSAwIDEzLjctNi4xIDEzLjctMTMuNyAwLTUuNS0zLjMtMTAuMy04LTEyLjVsMzguNi03M2MxLjguOSAzLjkgMS41IDYuMiAxLjUgNy41IDAgMTMuNy02LjEgMTMuNy0xMy43LS4yLTcuNC02LjMtMTMuNS0xMy45LTEzLjV6bS03NC45LTEyNC4zYy0uMyAxLjEtLjQgMi4yLS40IDMuNCAwIDQuNCAyLjEgOC40IDUuNCAxMC45bC0xNi41IDQzLjNjLS44LS4yLTEuNy0uMi0yLjYtLjItMi4xIDAtNCAuNS01LjggMS4zbC01Ni42LTkwLjYgNzYuNSAzMS45em02MS40IDEzOS45bC02MS40IDMxLjhjLTIuNC0yLjEtNS42LTMuNC05LTMuNGgtMWwtMy4zLTgzLjZjMy4zLS4yIDYuMy0xLjYgOC42LTMuN2w2Ni4xIDU1LjNjLS4xLjUtLjEgMS4xLS4xIDEuNiAwIC43IDAgMS4zLjEgMnptLTI1NC45LTEzLjVsMTEtNTguN2guMmMyIDAgNC0uNSA1LjctMS4zbDU0LjggMTA1LjguMi0uMWMtLjEuMS0uMS4yLS4yLjNsLTYwLjctMjcuNi0yLjQtMS4xYy4xLS4zLjItLjcuMy0xIC4zLTEuMS40LTIuMy40LTMuNC4yLTYtMy44LTExLjEtOS4zLTEyLjl6bTIwLjktNjIuOGMxLjQtMS40IDIuNS0zLjEgMy4yLTVsNTkuNyAyLjNjLjYgNS43IDQuNyAxMC40IDEwLjIgMTEuOGwtMTEuNCA5MS45Yy0yLjkuMy01LjUgMS42LTcuNSAzLjRsLTU0LjItMTA0LjR6bTY2LjUgMTAxLjNsMTEuNC05MS44YzQuOS0uNSA5LjEtMy42IDExLThsNTYuMSAzLjJjLS4yLjktLjMgMS44LS4zIDIuNyAwIDQgMS43IDcuNyA0LjUgMTAuMmwtODIuNSA4My44LS40LjQuMi0uNXptODUuMi03OS4ybDEuOC0xLjkuOS4zLjEgMi42IDMuMiA4Mi44Yy0zLjQgMS42LTYuMSA0LjYtNy4yIDguMmgtNzMuNWMtLjEtNC40LTIuMy04LjItNS42LTEwLjZsODAuMy04MS40em0tNjguNS0xMTAuOWguMmMzLjQgMCA2LjYtMS4zIDktMy40bDU2LjMgOTAuMWMtLjYuNy0xLjIgMS40LTEuNyAyLjJsLTU2LjgtMy4zdi0uOGMwLTUuMy0zLjEtOS45LTcuNS0xMi4ybC41LTcyLjZ6bS01LjYtMS4zYy4yLjEuNS4yLjguM2wtLjUgNzIuMWMtLjQgMC0uOS0uMS0xLjMtLjEtNi40IDAtMTEuOCA0LjQtMTMuMyAxMC4zbC01OS4zLTIuM2MtLjEtMy41LTEuNC02LjctMy42LTlsNzcuMi03MS4zem0tOTYuMSAyMy42di0uN2w4OS4zLTMwLjNjLjcgMS43IDEuNyAzLjIgMi45IDQuNWwtNzcuMiA3MS4yYy0xLjgtLjktMy45LTEuNS02LjItMS41LTEuMSAwLTIuMS4xLTMuMS40bC0xMS0zMi44YzMuMi0yLjUgNS4zLTYuNCA1LjMtMTAuOHptLTE2LjQgMTMuNGMuOS4yIDEuOC4zIDIuNy4zIDEuNCAwIDIuOC0uMiA0LjEtLjZsMTAuOSAzMi40Yy0zLjcgMi40LTYuMSA2LjYtNi4xIDExLjQgMCA1LjggMy42IDEwLjcgOC43IDEyLjdsLTExIDU5Yy00LjEuMi03LjggMi4xLTEwLjEgNS4xbC0zNy43LTE4LjhjLjQtMS4yLjUtMi41LjUtMy44IDAtNS4zLTMtOS45LTcuNC0xMi4xbDQ1LjQtODUuNnptMiAyMDMuNWMtLjUgMC0uOS0uMS0xLjQtLjEtMS45IDAtMy43LjQtNS4zIDEuMWwtNDEuOS05NGMyLjQtLjkgNC40LTIuNSA1LjktNC42bDM3LjUgMTguN2MtLjQgMS4zLS43IDIuOC0uNyA0LjMgMCA2LjEgNCAxMS4yIDkuNCAxM2wtMy41IDYxLjZ6bTkuMyA1LjFjLTEuMi0xLjYtMi44LTIuOS00LjYtMy43bDMuNi02Mi4zYzQtLjIgNy42LTIuMSAxMC01bDY0LjMgMjkuMXYxYzAgMS4yLjIgMi40LjUgMy41bC03My44IDM3LjR6bTg3LjYgNTAuN2wtODUtMzguOGMuMy0xLjEuNC0yLjIuNC0zLjQgMC0xLjUtLjItMi45LS43LTQuMmw3My41LTM3LjNjMi41IDMuNSA2LjYgNS44IDExLjIgNS44aDFsOC4zIDY5Yy00LjIgMS4zLTcuNSA0LjctOC43IDguOXptMTE5LjgtMzEuNmwtOTMuOCAzMC45Yy0xLjgtNS4yLTYuNy04LjktMTIuNS05bC04LjQtNjkuNWMxLjgtLjggMy41LTIuMSA0LjgtMy42bDExMS4yIDQyLjNjLTEgMS45LTEuNSA0LTEuNSA2LjMtLjEuOSAwIDEuOC4yIDIuNnptLTEwNy41LTU1LjRsLS40LS4yaDc0LjFjLjQgNy4yIDYuMyAxMyAxMy43IDEzIDEuNCAwIDIuNy0uMiAzLjktLjZsMTguOCAyOS42LTExMC4xLTQxLjh6bTEyMS43IDM5LjJoLS44Yy0yLjIgMC00LjIuNS02IDEuNGwtMTkuNC0zMC42YzMuMy0yLjUgNS40LTYuNCA1LjQtMTAuOSAwLTIuMy0uNi00LjUtMS42LTYuNGw1OS45LTMxYy41IDEgMS4yIDEuOSAyIDIuN2wtMzkuNSA3NC44em0zNy41LTkwLjZsLTY0LjgtNTQuM2MuOS0xLjggMS40LTMuOSAxLjQtNi4xIDAtLjQgMC0uOC0uMS0xLjItLjEtMS44LS42LTMuNC0xLjQtNC45LTEuMi0yLjMtMy00LjMtNS4yLTUuNmwxNi40LTQyLjhjMS4zLjQgMi42LjYgNCAuNi45IDAgMS44LS4xIDIuNy0uM2w1MC40IDExMC42Yy0xLjQgMS4xLTIuNSAyLjQtMy40IDR6Ii8+PC9zdmc+" alt="" style="width: 24px; vertical-align: middle; position: relative; top: -1px;"> Torbara.com</a>');
    array_push($links, '<a title="Our portfolio on Envato Market" href="http://themeforest.net/user/torbara/portfolio?ref=torbara" target="_blank"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDkuMjY3IDMwOS4yNjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMwOS4yNjcgMzA5LjI2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNEMDk5NEI7IiBkPSJNMjYwLjk0NCw0My40OTFIMTI1LjY0YzAsMC0xOC4zMjQtMjguOTk0LTI4Ljk5NC0yOC45OTRINDguMzIzYy0xMC42NywwLTE5LjMyOSw4LjY1LTE5LjMyOSwxOS4zMjkgICB2MjIyLjI4NmMwLDEwLjY3LDguNjU5LDE5LjMyOSwxOS4zMjksMTkuMzI5aDIxMi42MjFjMTAuNjcsMCwxOS4zMjktOC42NTksMTkuMzI5LTE5LjMyOVY2Mi44MiAgIEMyODAuMjczLDUyLjE1LDI3MS42MTQsNDMuNDkxLDI2MC45NDQsNDMuNDkxeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0U0RTdFNzsiIGQ9Ik0yOC45OTQsNzIuNDg0aDI1MS4yNzl2NzcuMzE3SDI4Ljk5NFY3Mi40ODR6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRjRCNDU5OyIgZD0iTTE5LjMyOSw5MS44MTRoMjcwLjYwOWMxMC42NywwLDE5LjMyOSw4LjY1LDE5LjMyOSwxOS4zMjlsLTE5LjMyOSwxNjQuMjk4ICAgYzAsMTAuNjctOC42NTksMTkuMzI5LTE5LjMyOSwxOS4zMjlIMzguNjU4Yy0xMC42NywwLTE5LjMyOS04LjY1OS0xOS4zMjktMTkuMzI5TDAsMTExLjE0M0MwLDEwMC40NjMsOC42NTksOTEuODE0LDE5LjMyOSw5MS44MTR6ICAgIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" alt="" style="width: 16px; vertical-align: middle; position: relative; top: -2px;"> Portfolio</a>');
    return $links;
};
add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), $tt_f_plugin_links );