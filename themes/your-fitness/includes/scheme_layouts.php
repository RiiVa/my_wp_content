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
 *  widgets scheme layouts
 */
if ( ! function_exists( 'yourfitness_widgets_scheme_layouts_info' ) ) {
    function yourfitness_widgets_scheme_layouts_info() { ?>
        <?php add_thickbox(); ?>
        <div class="updated">
            <p><?php echo wp_get_theme(); ?><?php esc_html_e('Theme comes with a broad range of layout options', 'your-fitness'); ?></p>
            <p><a href="#TB_inline?width=730&height=590&inlineId=tm-widgets-layout-scheme"
                  title="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme', 'your-fitness'); ?>"
                  class="thickbox"><span
                        class="dashicons dashicons-welcome-widgets-menus"></span> <?php esc_html_e('Show Widgets layout scheme', 'your-fitness'); ?>
                </a></p>
            <div id="tm-widgets-layout-scheme" style="display:none;">

                <h3><?php esc_html_e('Widget Layouts', 'your-fitness'); ?></h3>
                <p><?php esc_html_e('The blue widget positions allow to choose a widget layout which defines the widget alignment and proportions: parallel, stacked, first doubled, last doubled and center doubled. You can easily add your own widget layouts.', 'your-fitness'); ?></p>

                <h3><?php esc_html_e('Sidebar Layouts', 'your-fitness'); ?></h3>
                <p><?php esc_html_e('The two available sidebars, highlighted in red, can be switched to the left or right side and their widths can easily be set in the theme administration.', 'your-fitness'); ?></p>

                <h3><?php esc_html_e('Widget Style', 'your-fitness'); ?></h3>
                <p><?php esc_html_e('For widgets in the blue and red positions you can choose different widget styles.', 'your-fitness'); ?></p>
                <?php $theme_url = get_template_directory_uri(); ?>
                <img src="<?php echo esc_attr($theme_url); ?>/images/scheme_layouts.png"
                     alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme', 'your-fitness'); ?>"/>
                <img src="<?php echo esc_attr($theme_url); ?>/images/sidebar_layouts.png"
                     alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme-2', 'your-fitness'); ?>"/>
                <img src="<?php echo esc_attr($theme_url); ?>/images/widget_layouts.png"
                     alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme-3', 'your-fitness'); ?>"/>

            </div>
        </div>
        <?php
    }
}

if( !function_exists("yourfitness_widgets_scheme_layouts")){
    function yourfitness_widgets_scheme_layouts (){
        global $pagenow;
        if ( $pagenow == 'widgets.php' ) { add_action('admin_notices', 'yourfitness_widgets_scheme_layouts_info'); }
    }
}
yourfitness_widgets_scheme_layouts();

