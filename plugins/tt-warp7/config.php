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

    'path' => array(
        'theme'   => array(get_template_directory()),
        'js'      => array(get_template_directory().'/js'),
        'css'     => array(get_template_directory().'/css'),
        'less'    => array(get_template_directory().'/less'),
        'layouts' => array(get_template_directory().'/layouts')
    ),

    'less' => array(

        'vars' => array(
            'less:theme.less'
        ),

        'files' => array(
            '/css/theme.css' => 'less:theme.less',
            '/css/woocommerce.css' => 'less:woocommerce.less'
        )

    ),

    'cookie' => $cookie = md5(get_template_directory()),

    'customizer' => isset($_COOKIE[$cookie])

);
