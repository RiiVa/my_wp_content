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

return array(

    'helper' => array(
        'asset'       => 'Warp\Helper\AssetHelper',
        'assetfilter' => 'Warp\Helper\AssetfilterHelper',
        'check'       => 'Warp\Helper\CheckHelper',
        'checksum'    => 'Warp\Helper\ChecksumHelper',
        'dom'         => 'Warp\Helper\DomHelper',
        'event'       => 'Warp\Helper\EventHelper',
        'field'       => 'Warp\Helper\FieldHelper',
        'http'        => 'Warp\Helper\HttpHelper',
        'menu'        => 'Warp\Helper\MenuHelper',
        'path'        => 'Warp\Helper\PathHelper',
        'template'    => 'Warp\Helper\TemplateHelper',
        'useragent'   => 'Warp\Helper\UseragentHelper'
    ),

    'path' => array(
        'warp'    => array(__DIR__),
        'config'  => array(__DIR__.'/config'),
        'js'      => array(__DIR__.'/js', __DIR__.'/vendor/uikit/js'),
        'layouts' => array(__DIR__.'/layouts')
    ),

    'menu' => array(
        'pre'    => 'Warp\Menu\Menu',
        'post'   => 'Warp\Menu\Post',
        'nav'    => 'Warp\Menu\Nav',
        'navbar' => 'Warp\Menu\Navbar',
        'subnav' => 'Warp\Menu\Subnav'
    ),

    'branding' => 'Powered with &#9825; by <a target="_blank" href="http://torbara.com">Torbara</a>'

);
