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


if ( ! class_exists( 'yourfitness_widgets_init' ) ) {
    function yourfitness_widgets_init(){
        $positions = array(
            "sidebar-a" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "sidebar-b" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "logo" => esc_html__("This is special sidebar for logo widget. In theme settings you can set up use it or not.", "your-fitness"),
            "logo-small" => esc_html__("This is special sidebar for sendeavor logo widget. In theme settings you can set up use it or not.", "your-fitness"),
            "menu" => esc_html__("This is special sidebar for main menu. All widgets in this position will be dropdown.", "your-fitness"),
            "toolbar-l" => esc_html__("Widgets in this sidebar don't have title. Use it for side information.", "your-fitness"),
            "toolbar-r" => esc_html__("Widgets in this sidebar don't have title. Use it for side information.", "your-fitness"),
            "headerbar" => esc_html__("This is special sidebar for extra theme information or addition options. Widgets in this sidebar don't have title.", "your-fitness"),
            "breadcrumbs" => esc_html__("This is special sidebar for Breadcrumbs. Use it for display your site navigation.", "your-fitness"),
            "search" => esc_html__("This is special sidebar for Search widget.", "your-fitness"),
            "breadcrumbs-yourfitness" => esc_html__("This is special sidebar for Breadcrumbs. Use it for display your site navigation.", "your-fitness"),
            "top-a" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-b" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-c" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-d" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-e" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-f" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-g" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-h" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-i" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "top-j" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "bottom-a" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "bottom-b" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "main-top" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "main-bottom" => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", "your-fitness"),
            "footer" => esc_html__("Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings. Use it for copyrights.", "your-fitness"),
            "offcanvas" => esc_html__("This is special sidebar for mobile menu.", "your-fitness"),
            "debug" => esc_html__("This is special sidebar for debugging your widgets.", "your-fitness")
        );

        foreach ($positions as $name => $desc) {
            register_sidebar(array(
                'name' => $name,
                'id' => $name,
                'description' => $desc,
                'before_widget' => '<!--widget-%1$s<%2$s>-->',
                'after_widget' => '<!--widget-end-->',
                'before_title' => '<!--title-start-->',
                'after_title' => '<!--title-end-->',
            ));
        }
    }
}
// Register sidebars
add_action('widgets_init', 'yourfitness_widgets_init');