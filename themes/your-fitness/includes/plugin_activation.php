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
 *  Load TGM plugin activation
 */

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
    load_template( get_template_directory().'/includes/class-tgm-plugin-activation.php', true );
}

/*  TGM plugin activation
/*----------------------------------------------------------------------------------- */

if (!function_exists('yourfitness_recommended_plugins')) {

    function yourfitness_recommended_plugins() {

        $plugins = array(
            // Plugins from Wordpress.org
            
            array(
                'name'     => esc_html__('Contact form 7', 'your-fitness'),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name'     => esc_html__('Custom category template', 'your-fitness'),
                'slug'     => 'custom-category-template',
                'required' => false,
            ),
            array(
                'name'     => esc_html__('Google maps easy', 'your-fitness'),
                'slug'     => 'google-maps-easy',
                'required' => false,
            ),
            array(
                'name'     => esc_html__('Widget shortcode', 'your-fitness'),
                'slug'     => 'widget-shortcode',
                'required' => false,
            ),
            array(
                'name'     => esc_html__('WP post templatee', 'your-fitness'),
                'slug'     => 'wp-post-template',
                'required' => false,
            ),
            // Custom Plugins
            array(
                'name'     => esc_html__('ANG Mega Slideshow', 'your-fitness'),
                'slug'     => 'ANG-Mega-Slideshow',
                'source'   => get_template_directory() . '/plugins/ANG-Mega-Slideshow.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
            array(
                'name'     => esc_html__('BMI calculator Torbara', 'your-fitness'),
                'slug'     => 'bmi-calculator-torbara',
                'source'   => get_template_directory() . '/plugins/bmi-calculator-torbara.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
             array(
                'name'     => esc_html__('Custom category Torbara', 'your-fitness'),
                'slug'     => 'custom-category-torbara',
                'source'   => get_template_directory() . '/plugins/custom-category-torbara.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
            array(
                'name'     => esc_html__('Dynamic grid Torbara', 'your-fitness'),
                'slug'     => 'dynamic-grid-torbara',
                'source'   => get_template_directory() . '/plugins/dynamic-grid-torbara.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
            array(
                'name'     => esc_html__('Photos dynamic grid Torbara', 'your-fitness'),
                'slug'     => 'photos-dynamic-grid-torbara',
                'source'   => get_template_directory() . '/plugins/photos-dynamic-grid-torbara.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
            array(
                'name'     => esc_html__('TT Warp 7 Framework', 'your-fitness'),
                'slug'     => 'tt-warp7',
                'source'   => get_template_directory() . '/plugins/tt-warp.7.3.54.tar',
                'required' => true,
                'version'  => '7.3.54'
            ),
            array(
                'name'     => esc_html__('Envato market', 'your-fitness'),
                'slug'     => 'ANG-Mega-Slideshow',
                'source'   => get_template_directory() . '/plugins/envato-market.1.0.0-RC2.tar',
                'required' => false,
                'version'  => '1.0.0-RC2'
            ),
            array(
                'name'     => esc_html__('Hooks Ocean', 'your-fitness'),
                'slug'     => 'HooksOcean',
                'source'   => get_template_directory() . '/plugins/HooksOcean.1.0.0.tar',
                'required' => false,
                'version'  => '1.0.0'
            ),
            
        );
        $config  = array('is_automatic' => true);
        tgmpa($plugins, $config);
    }
}
add_action('tgmpa_register', 'yourfitness_recommended_plugins');