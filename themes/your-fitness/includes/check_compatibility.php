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



//Check compatibility
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300) {
    function yourfitness_admin_php_notice() { ?>
        <div class="error">
            <p>
                <b>
                    <?php echo wp_get_theme(); ?>
                    <?php echo esc_html__( "Theme error:", "your-fitness" ); ?>
                </b>
                <?php echo esc_html__( "This theme requires PHP version 5.3 or higher.", "your-fitness" ); ?>
            </p>
        </div>
        <?php
    }
    add_action('admin_notices', 'yourfitness_admin_php_notice');

    return;
}

//Bootstrap Warp 7 Framework
get_template_part('warp');