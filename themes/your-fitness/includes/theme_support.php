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


if ( !isset( $content_width ) ) { $content_width = 1200; }
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));


if ( ! function_exists( 'yourfitness_breadcrumbs' ) ) {
    function yourfitness_breadcrumbs(){
        if (class_exists('Warp_Breadcrumbs')) {
            unregister_widget('Warp_Breadcrumbs');
            load_template(get_template_directory() . '/widgets/BreadcrumbsYourFitness.php', true);
            register_widget('yourfitness_breadcrumbs');
        }
    }
}
yourfitness_breadcrumbs();

if ( ! function_exists( 'yourfitness_excerpt_length' ) ) {
    function yourfitness_excerpt_length(){
        return 30;
    }
}

add_filter( 'excerpt_length', 'yourfitness_excerpt_length');


if ( ! function_exists( 'yourfitness_max_title_length' ) ) {
    function yourfitness_max_title_length($title){
        $max = 30;
        if (strlen($title) > $max) {
            return substr($title, 0, $max) . " &hellip;";
        } else {
            return $title;
        }
    }
}

add_filter( 'the_title', 'yourfitness_max_title_length');