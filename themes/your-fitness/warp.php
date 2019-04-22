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

use Warp\Warp;
use Warp\Autoload\ClassLoader;
use Warp\Config\Repository;

if (!function_exists('yourfitness_warp_init')) {
    function yourfitness_warp_init () {
        global $warp;
        
        if (!$warp) {

            load_template(TT_WARP_PLUGIN_DIR.'warp/src/Warp/Autoload/ClassLoader.php', true);

            // set loader
            $loader = new ClassLoader;
            $loader->add('Warp', TT_WARP_PLUGIN_DIR.'/warp/src');
            $loader->add('Warp\Wordpress', TT_WARP_PLUGIN_DIR.'/warp/systems/wordpress/src');
            $loader->register();

            // set config
            $config = new Repository;
            $config->load(TT_WARP_PLUGIN_DIR.'/warp/config.php');
            $config->load(TT_WARP_PLUGIN_DIR.'/warp/systems/wordpress/config.php');
            $config->load(TT_WARP_PLUGIN_DIR.'/config.php');

            // set warp
            $warp = new Warp(compact('loader', 'config'));
            $warp['system']->init();
        }
        return $warp;
    }
}

return yourfitness_warp_init();