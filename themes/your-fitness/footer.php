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

if(!function_exists('yourfitness_render_footer')){

    /**
     * Render footer template
     * @global type $warp
     */
    function yourfitness_render_footer(){
        global $warp;

        // get warp
        load_template( get_template_directory().'/warp.php', true );

        // get content from output buffer and set a slot for the template renderer
        $warp['template']->set('content', ob_get_clean());

        // load main theme file, located in /layouts/theme.php
        echo $warp['template']->render('theme');
    }
}

// Detect Warp 7 plugin. It is required plugin.
if ( defined('TT_WARP_PLUGIN_URL') ) {
    yourfitness_render_footer();
} else {
    // Otherwise, we work in legacy mode.
    // Template situated in /lib/templates/structure/footer.php
    get_template_part('lib/templates/structure/footer');
}