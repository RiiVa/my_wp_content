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

//Custom admin styles
if ( ! function_exists( 'yourfitness_admin_style' ) ) {
    function yourfitness_admin_style(){
        $src = get_template_directory_uri() . '/css/admin.css';
        $handle = 'yourfitness-admin-style';
        wp_register_script($handle, $src);
        wp_enqueue_style($handle, $src, array(), false, false);
    }
}
add_action( 'admin_head', 'yourfitness_admin_style' );
