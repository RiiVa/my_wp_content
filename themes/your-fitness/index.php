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

// Detect Warp 7 plugin. It is required plugin.
if ( defined('TT_WARP_PLUGIN_URL') ) {
    // get warp
    load_template( get_template_directory().'/warp.php', true );

    // load main theme file, located in /layouts/theme.php
    echo $warp['template']->render('theme');
} else { 
    // Otherwise, we work in legacy mode.
    yourfitness_load_document();
}
