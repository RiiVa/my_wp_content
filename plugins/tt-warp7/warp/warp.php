<?php
/**
 * 
 * Warp 7 Framework by Torbara, based on YOOtheme Warp 7 http://www.yootheme.com  
 * Exclusively on Envato Market: https://themeforest.net/user/torbara/portfolio?ref=torbara
 * @encoding     UTF-8
 * @copyright    Copyright (C) 2016 Torbara (http://torbara.com). All rights reserved.
 * @license      Envato Standard License http://themeforest.net/licenses/standard?ref=torbara
 * @author       Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 * @support      support@torbara.com
 * 
 */

/**
 * Do not remove this file. It used for ttdemo field
 */
use Warp\Warp;
use Warp\Autoload\ClassLoader;
use Warp\Config\Repository;

if (!function_exists('torbara_warp_init')) {
    function torbara_warp_init () {
        global $warp;
        
        if (!$warp) {
        
            require_once(WP_PLUGIN_DIR.'/tt-warp7/warp/src/Warp/Autoload/ClassLoader.php');

            // set loader
            $loader = new ClassLoader;
            $loader->add('Warp', WP_PLUGIN_DIR.'/tt-warp7/warp/src');
            $loader->add('Warp\Wordpress', WP_PLUGIN_DIR.'/tt-warp7/warp/systems/wordpress/src');
            $loader->register();

            // set config
            $config = new Repository;
            $config->load(WP_PLUGIN_DIR.'/tt-warp7/warp/config.php');
            $config->load(WP_PLUGIN_DIR.'/tt-warp7/warp/systems/wordpress/config.php');
            $config->load(WP_PLUGIN_DIR.'/config.php');

            // set warp
            $warp = new Warp(compact('loader', 'config'));
            $warp['system']->init();
        }
        return $warp;
    }
}

return torbara_warp_init(); 
