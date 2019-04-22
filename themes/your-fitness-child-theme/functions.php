<?php
/**
 *
 * Your Fitness child theme functions and definitions
 * 
 * @package Your Fitness
 * @author  Torbara Team <support@torbara.com>
 * 
 * @link https://themeforest.net/user/torbara/portfolio?ref=torbara
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */

if ( defined('TT_WARP_PLUGIN_URL') ) {
  function yourfitness_child_scripts() {
      wp_enqueue_style( 'your-fitness-child-style',  get_stylesheet_directory_uri(). '/style.css' );
  }
  add_action( 'wp_enqueue_scripts', 'yourfitness_child_scripts', 60 );
}