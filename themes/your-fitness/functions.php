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
    
    //Check compatibility
    require_once get_template_directory().'/includes/check_compatibility.php';
    
    //Add scripts and styles
    require_once get_template_directory().'/includes/enqueue_scripts.php';
    
    //Plugin activation
    require_once get_template_directory().'/includes/plugin_activation.php';
    
    //Register sidebars
    require_once get_template_directory().'/includes/widgets_init.php';
  
    //Widgets scheme layouts
    require_once get_template_directory().'/includes/scheme_layouts.php';
    
    //Theme Support
    require_once get_template_directory().'/includes/theme_support.php';
    
    require_once get_template_directory().'/includes/custom_admin.php';
    
} else { 
    // Otherwise, we work in legacy mode.
    require_once( get_template_directory() . '/lib/init.php' );
    require_once( get_template_directory() . '/includes/plugin_activation.php' );
} 