<?php
/*
 *
 * @encoding     UTF-8
 * @author       Torbara (support@torbara.com)
 * @copyright    Copyright (C) 2016 torbara (http://torbara.com/). All rights reserved.
 * @license      Copyrighted Commercial Software
 * @support      support@torbara.com
 *
 */


/*
 *  add scripts
 */
if ( ! function_exists( 'yourfitness_add_scripts' ) ) {
    function yourfitness_add_scripts(){

        $js_path = WP_PLUGIN_URL . '/tt-warp7/warp/vendor/uikit/js';
        $js_path_custom = get_template_directory_uri();

        wp_enqueue_script('uikit', $js_path . '/uikit.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-autocomplete', $js_path . '/components/autocomplete.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-accordion', $js_path . '/components/accordion.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-search', $js_path . '/components/search.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-tooltip', $js_path . '/components/tooltip.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-slideshow', $js_path . '/components/slideshow.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-slider', $js_path . '/components/slider.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-slideset', $js_path . '/components/slideset.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-lightbox', $js_path . '/components/lightbox.js', array('jquery'), '', true);
        wp_enqueue_script('uikit-grid', $js_path . '/components/grid.js', array('jquery'), '', true);


        wp_enqueue_script('waypoints', $js_path_custom . '/js/waypoints.min.js', array('jquery'), '', true);
        wp_enqueue_script('counterup', $js_path_custom . '/js/counterup.min.js', array('jquery'), '', true);
        wp_enqueue_script('circleprogress', $js_path_custom . '/js/circle-progress.js', array('jquery'), '', true);
        wp_enqueue_script('yourfitness-comments', $js_path_custom . '/js/comments.js', array('jquery'), '', true);
        wp_enqueue_script('yourfitness-js', $js_path_custom . '/js/theme.js', array('jquery'), '', true);

        wp_enqueue_script("comment-reply");
    }
}
add_action('wp_enqueue_scripts', 'yourfitness_add_scripts');



/*
 *  add css
 */
if ( ! function_exists( 'yourfitness_add_css' ) ) {
    function yourfitness_add_css(){
        global $warp;

        if ($warp['config']->get('style') == "default") {

            if (file_exists(get_template_directory() . '/css/theme.css')) {
                wp_enqueue_style('yourfitness-theme', get_template_directory_uri() . '/css/theme.css');
            }
            if (file_exists(get_template_directory() . '/css/custom.css')) {
                wp_enqueue_style('yourfitness-custom', get_template_directory_uri() . '/css/custom.css');
            }

        } else {

            if (file_exists(get_template_directory() . '/styles/' . $warp['config']->get('style') . '/css/theme.css')) {
                wp_enqueue_style('yourfitness-theme', get_template_directory_uri() . '/styles/' . $warp['config']->get('style') . '/css/theme.css');
            } else {
                if (file_exists(get_template_directory() . '/css/theme.css')) {
                    wp_enqueue_style('yourfitness-theme', get_template_directory_uri() . '/css/theme.css');
                }
            }


            if (file_exists(get_template_directory() . '/styles/' . $warp['config']->get('style') . '/css/custom.css')) {
                wp_enqueue_style('yourfitness-custom', get_template_directory_uri() . '/styles/' . $warp['config']->get('style') . '/css/custom.css');
            } else {
                if (file_exists(get_template_directory() . '/css/custom.css')) {
                    wp_enqueue_style('yourfitness-custom', get_template_directory_uri() . '/css/custom.css');
                }
            }

        }

        $FolderPlugin = WP_PLUGIN_URL . '/tt-warp7/warp/vendor';

        wp_enqueue_style('highlight', $FolderPlugin . '/highlight/highlight.css');

    }
}
add_action('wp_enqueue_scripts', 'yourfitness_add_css',50);

