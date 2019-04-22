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

if(!function_exists('yourfitness_render_comments')){

    /**
     * Render comments template
     * @global type $warp
     */
    function yourfitness_render_comments(){
        global $warp;

        // get warp
        load_template( get_template_directory().'/warp.php', true );

        // load template file, located in /warp/systems/wordpress/layouts/comments.php
        echo $warp['template']->render('comments');
    }
}

// Detect Warp 7 plugin. It is required plugin.
if ( defined('TT_WARP_PLUGIN_URL') ) {
    yourfitness_render_comments();
} else {
    // Otherwise, we work in legacy mode.
    // Template situated in /lib/templates/structure/comments.php
    get_template_part('lib/templates/structure/comments');
}