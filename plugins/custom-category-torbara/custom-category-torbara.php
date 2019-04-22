<?php
/*
 * Plugin Name: Custom Category Torbara
 * Plugin URI: http://themeforest.net/user/torbara/?ref=torbara
 * Description: Displays random posts in slideshow with thumbnail navigation and multiple select
 * Author: Nemirovskiy Vitaliy
 * Author URI: http://themeforest.net/user/torbara/portfolio/?ref=torbara
 * Author e-mail: nemirovskiyvitaliy@gmail.com
 * Version: 1.0.0
 * Date: 04.04.2016
 * License: GPL2+
 */

class CustomCategoryTorbara extends WP_Widget {

    function __construct() {
        parent::__construct("text_widget", "Custom Category Torbara", array("description" => "Components slider uikit."));
    }

    function widget($args, $instance) {
        global $post;
        extract($args, EXTR_SKIP);
        echo $before_widget;
        
        $title = apply_filters('widget_title', $instance['title']);
        
        if (!empty($title)) { echo $before_title . $title . $after_title; }
        
            $plugin_dir = plugin_dir_path(__FILE__); //plagin path
        
            
        $QueryArgs = array(
            'post_type' => $instance['p_post_type'],
            //'cat'  => $instance['TaxEvent'],
            'posts_per_page' => $instance['posts_per_page'],
            'post_status' => 'publish',
            'suppress_filters' => true,
            'order' => 'ASC',
        );
        
        
        if ($instance['p_post_type'] == 'slideshow' && $instance['TaxEvent'] != '') {
            /*
             * Check Post type slideshow and taxonomy
             */
            $QueryArgs['tax_query'][] = array(
                'taxonomy' => 'slideset',
                'field' => 'term_id',
                'terms' => $instance['TaxEvent'],
                'order' => 'ASC ',
            );
        } elseif ($instance['p_post_type'] == 'post') {
            /*
             * Check Post type post and category
             */
             
            $QueryArgs['cat'] = $instance['CatID'];
            
        } else {
            $QueryArgs['cat'] = '';
            
        }

        
        $q = new WP_Query($QueryArgs);
        
        if ($q->have_posts()){
            
        include $plugin_dir . 'templates/' . $instance['view_template'];
                        
        } 
        
    }

    function form($instance) {
        $instance['title'] = "";
        $title = @ $instance['title'] ? : 'Custom Category Torbara';
        $instance['p_post_type'] = "";
        $instance['view_template'] = "";
        $instance['CatID'] = "";
        $instance['animation'] = "";
        ?>
        <!--        Select view type, template  -->

        <?php
        // define plugin pathes
        $plugin_dir = plugin_dir_path(__FILE__); //plagin path
        $temp_dir_path = $plugin_dir . 'templates/'; // path to templates folder
        $templates = array();
        // Open existing dir and scan it.
        if (is_dir($temp_dir_path)) {
            if ($dh = opendir($temp_dir_path)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        $templates[] = $file;
                    }
                }
                closedir($dh);
            }
        }
        sort($templates);
        ?>

        <?php $p_post_type = isset($instance['p_post_type']) ? $instance['p_post_type'] : 'post'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_post_type'); ?>">
        <?php esc_html_e('Select post type:', 'ang-plugins'); ?>
        <?php
        $args = array(
            'public' => true,
        );
        $post_types = get_post_types($args, 'names');
        ?><select class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('p_post_type')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('p_post_type')); ?>" >
                <?php foreach ($post_types as $post_type) { ?>
                        <option value="<?php echo esc_attr($post_type); ?>" <?php if ($post_type == $instance['p_post_type']) {
                echo 'selected=""';
            } ?>><?php echo $post_type; ?></option>
                            <?php } ?>
                </select>
            </label>
        </p>

        <?php $TaxEvent = isset($instance['TaxEvent']) ? $instance['TaxEvent'] : ''; ?>
        <?php
        $args = array(
            'type' => 'slideshow',
            'child_of' => 0,
            'parent' => '',
            'orderby' => 'name',
            'order' => 'DESC',
            'hide_empty' => 1,
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'number' => '',
            'taxonomy' => 'slideset',
            'pad_counts' => false
        );

        $tax_events = get_categories($args);
        if ($tax_events) {
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('TaxEvent'); ?>">
                    Slideshow tax: 
                    <select class="widefat" 
                            id="<?php echo esc_attr($this->get_field_id('TaxEvent')); ?>" 
                            name="<?php echo esc_attr($this->get_field_name('TaxEvent')); ?>" >
                        <option value="" <?php if ('' == $instance['TaxEvent']) {
                echo 'selected=""';
            } ?>>--All Slidsets--</option>
                        <?php
                        foreach ($tax_events as $tax_event) {
                            ?><option value="<?php echo esc_attr($tax_event->term_id); ?>" <?php if ($tax_event->term_id == $instance['TaxEvent']) {
                    echo 'selected=""';
                } ?>><?php echo $tax_event->name; ?></option><?php
                        }
                        ?>
                    </select>

                </label>
            </p>
        <?php } ?>

        <?php $view_template = isset($instance['view_template']) ? $instance['view_template'] : 'default.php'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('view_template'); ?>">
        <?php _e('View Type:', 'ang-plugins'); ?>
                <select id="<?php echo $this->get_field_id('view_template'); ?>"
                        name="<?php echo $this->get_field_name('view_template'); ?>">
                            <?php foreach ($templates as $key => $template) { ?>
                        <option value="<?php echo esc_attr($template); ?>" <?php if ($template == $instance['view_template']) {
                        echo 'selected=""';
                    } ?>>
                            <?php
                            $p_tag = strrpos($template, '.');
                            if ($p_tag > 0) {
                                echo ucfirst(str_replace('-', ' ', substr($template, 0, $p_tag)));
                            } else {
                                echo ucfirst(str_replace('-', ' ', $template));
                            }
                            ?>
                        </option>
        <?php } ?>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('CatID'); ?>">
                Post Category:<?php
                $args = array(
                    'type' => 'post',
                    'child_of' => 0,
                    'parent' => '',
                    'orderby' => 'name',
                    'order' => 'DESC',
                    'hide_empty' => 1,
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'number' => '',
                    'taxonomy' => 'category',
                    'pad_counts' => false
                );

                $cats = get_categories($args);
                ?><select class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('CatID')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('CatID')); ?>" ><?php
                            foreach ($cats as $cat) {
                                ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if ($cat->term_id == $instance['CatID']) {
                echo 'selected=""';
            } ?>><?php echo $cat->name; ?></option><?php
        }
        ?>
                </select>
            </label>
        </p>

        <?php $animation = isset($instance['animation']) ? esc_attr($instance['animation']) : ''; ?>
        <p>
            <label for="animation">
                Animations: 
            </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('animation')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
                <option value="fade" <?php echo ($instance['animation'] == 'fade') ? 'selected' : ''; ?>>Fade</option>
                <option value="scale" <?php echo ($instance['animation'] == 'scale') ? 'selected' : ''; ?>>Scale</option>
                <option value="slide-horizontal" <?php echo ($instance['animation'] == 'slide-horizontal') ? 'selected' : ''; ?>>Slide horizontal</option>
                <option value="slide-vertical" <?php echo ($instance['animation'] == 'slide-vertical') ? 'selected' : ''; ?>>Slide vertical</option>
                <option value="slide-top" <?php echo ($instance['animation'] == 'slide-top') ? 'selected' : ''; ?>>Slide top</option>
                <option value="slide-bottom" <?php echo ($instance['animation'] == 'slide-bottom') ? 'selected' : ''; ?>>Slidebottom</option>
            </select>   
        </p>

        <?php $posts_per_page = isset($instance['posts_per_page']) ? esc_attr($instance['posts_per_page']) : ''; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>">
                Number of items: 
                <input class="widefat" 
                       id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" 
                       name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" 
                       type="text" 
                       value="<?php echo esc_attr($posts_per_page); ?>" />
            </label>
        </p>

        <?php $display_elements_small = isset($instance['display_elements_small']) ? esc_attr($instance['display_elements_small']) : ''; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_elements_small')); ?>">
                Display elements small: 
                <input class="widefat" 
                       id="<?php echo esc_attr($this->get_field_id('display_elements_small')); ?>" 
                       name="<?php echo esc_attr($this->get_field_name('display_elements_small')); ?>" 
                       type="text" 
                       value="<?php echo esc_attr($display_elements_small); ?>" />
            </label>
        </p>

        <?php $display_elements_medium = isset($instance['display_elements_medium']) ? esc_attr($instance['display_elements_medium']) : ''; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_elements_medium')); ?>">
                Display elements medium: 
                <input class="widefat" 
                       id="<?php echo esc_attr($this->get_field_id('display_elements_medium')); ?>" 
                       name="<?php echo esc_attr($this->get_field_name('display_elements_medium')); ?>" 
                       type="text" 
                       value="<?php echo esc_attr($display_elements_medium); ?>" />
            </label>
        </p>

        <?php $display_elements_large = isset($instance['display_elements_large']) ? esc_attr($instance['display_elements_large']) : ''; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_elements_large')); ?>">
                Display elements large: 
                <input class="widefat" 
                       id="<?php echo esc_attr($this->get_field_id('display_elements_large')); ?>" 
                       name="<?php echo esc_attr($this->get_field_name('display_elements_large')); ?>" 
                       type="text" 
                       value="<?php echo esc_attr($display_elements_large); ?>" />
            </label>
        </p>

        <?php $slidenav_type = isset($instance['slidenav_type']) ? $instance['slidenav_type'] : "2"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('slidenav_type')); ?>">
                Navigation type:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type') . "_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="1" <?php if ($slidenav_type == "1") {
            echo "checked";
        } ?>/>Arrow &nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type') . "_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="2" <?php if ($slidenav_type == "2") {
            echo "checked";
        } ?>/>Square &nbsp;&nbsp;&nbsp;
        </p>

        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['p_post_type'] = $new_instance['p_post_type'];
        $instance['view_template'] = $new_instance['view_template'];
        $instance['TaxEvent'] = $new_instance['TaxEvent'];
        $instance['CatID'] = $new_instance['CatID'];
        $instance['animation'] = $new_instance['animation'];
        $instance['posts_per_page'] = $new_instance['posts_per_page'];
        $instance['display_elements_small'] = $new_instance['display_elements_small'];
        $instance['display_elements_medium'] = $new_instance['display_elements_medium'];
        $instance['display_elements_large'] = $new_instance['display_elements_large'];
        $instance['slidenav_type'] = $new_instance['slidenav_type'];
        return $instance;
    }

}

add_action("widgets_init", function () {
    register_widget("CustomCategoryTorbara");
});

// Additional links in plugin settings: Torbara.com | Portfolio
$tt_f_plugin_links = function($links) {
    array_push($links, '<a title="We are developing beautiful themes and applications for the web!" href="http://torbara.com" target="_blank" style="font-weight: bold; font-size: 14px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NTMuNSA0NTMuNSI+PHBhdGggZD0iTTM5NC43IDIzOC4zOTJjLTEuNSAwLTMgLjMtNC40LjdsLTUwLjEtMTEwYzMuOS0yLjQgNi41LTYuNyA2LjUtMTEuNiAwLTYuNi00LjctMTIuMS0xMC45LTEzLjQtLjYtLjEtMS4xLS4yLTEuNy0uMmgtMWMtNC43IDAtOC44IDIuMy0xMS4zIDUuOWwtNzcuNi0zMi41Yy4xLS43LjItMS40LjItMi4xIDAtNy42LTYuMS0xMy43LTEzLjctMTMuN3MtMTMuNyA2LjEtMTMuNyAxMy43di4zbC04OS40IDMwLjNjLTIuMS00LjktNi45LTguMy0xMi42LTguMy03LjUgMC0xMy43IDYuMS0xMy43IDEzLjcgMCA0LjkgMi42IDkuMiA2LjUgMTEuNmwtNDUuNiA4NS45Yy0uNS0uMS0xLS4xLTEuNi0uMS00LjUgMC04LjQgMi4xLTEwLjkgNS41LTEgMS4zLTEuNyAyLjctMi4yIDQuMy0uNCAxLjItLjYgMi42LS42IDMuOSAwIDcuNiA2LjEgMTMuNyAxMy43IDEzLjdoLjJsNDIuNiA5NS43Yy0yLjYgMi41LTQuMyA2LTQuMyA5LjkgMCA3LjUgNi4xIDEzLjcgMTMuNyAxMy43IDQuNyAwIDguOC0yLjMgMTEuMy01LjlsODYuNSAzOS41Yy41IDcuMSA2LjQgMTIuNiAxMy42IDEyLjYgNy41IDAgMTMuNi02IDEzLjctMTMuNWw5NC44LTMxLjJjMi40IDMuOSA2LjcgNi41IDExLjcgNi41IDcuNSAwIDEzLjctNi4xIDEzLjctMTMuNyAwLTUuNS0zLjMtMTAuMy04LTEyLjVsMzguNi03M2MxLjguOSAzLjkgMS41IDYuMiAxLjUgNy41IDAgMTMuNy02LjEgMTMuNy0xMy43LS4yLTcuNC02LjMtMTMuNS0xMy45LTEzLjV6bS03NC45LTEyNC4zYy0uMyAxLjEtLjQgMi4yLS40IDMuNCAwIDQuNCAyLjEgOC40IDUuNCAxMC45bC0xNi41IDQzLjNjLS44LS4yLTEuNy0uMi0yLjYtLjItMi4xIDAtNCAuNS01LjggMS4zbC01Ni42LTkwLjYgNzYuNSAzMS45em02MS40IDEzOS45bC02MS40IDMxLjhjLTIuNC0yLjEtNS42LTMuNC05LTMuNGgtMWwtMy4zLTgzLjZjMy4zLS4yIDYuMy0xLjYgOC42LTMuN2w2Ni4xIDU1LjNjLS4xLjUtLjEgMS4xLS4xIDEuNiAwIC43IDAgMS4zLjEgMnptLTI1NC45LTEzLjVsMTEtNTguN2guMmMyIDAgNC0uNSA1LjctMS4zbDU0LjggMTA1LjguMi0uMWMtLjEuMS0uMS4yLS4yLjNsLTYwLjctMjcuNi0yLjQtMS4xYy4xLS4zLjItLjcuMy0xIC4zLTEuMS40LTIuMy40LTMuNC4yLTYtMy44LTExLjEtOS4zLTEyLjl6bTIwLjktNjIuOGMxLjQtMS40IDIuNS0zLjEgMy4yLTVsNTkuNyAyLjNjLjYgNS43IDQuNyAxMC40IDEwLjIgMTEuOGwtMTEuNCA5MS45Yy0yLjkuMy01LjUgMS42LTcuNSAzLjRsLTU0LjItMTA0LjR6bTY2LjUgMTAxLjNsMTEuNC05MS44YzQuOS0uNSA5LjEtMy42IDExLThsNTYuMSAzLjJjLS4yLjktLjMgMS44LS4zIDIuNyAwIDQgMS43IDcuNyA0LjUgMTAuMmwtODIuNSA4My44LS40LjQuMi0uNXptODUuMi03OS4ybDEuOC0xLjkuOS4zLjEgMi42IDMuMiA4Mi44Yy0zLjQgMS42LTYuMSA0LjYtNy4yIDguMmgtNzMuNWMtLjEtNC40LTIuMy04LjItNS42LTEwLjZsODAuMy04MS40em0tNjguNS0xMTAuOWguMmMzLjQgMCA2LjYtMS4zIDktMy40bDU2LjMgOTAuMWMtLjYuNy0xLjIgMS40LTEuNyAyLjJsLTU2LjgtMy4zdi0uOGMwLTUuMy0zLjEtOS45LTcuNS0xMi4ybC41LTcyLjZ6bS01LjYtMS4zYy4yLjEuNS4yLjguM2wtLjUgNzIuMWMtLjQgMC0uOS0uMS0xLjMtLjEtNi40IDAtMTEuOCA0LjQtMTMuMyAxMC4zbC01OS4zLTIuM2MtLjEtMy41LTEuNC02LjctMy42LTlsNzcuMi03MS4zem0tOTYuMSAyMy42di0uN2w4OS4zLTMwLjNjLjcgMS43IDEuNyAzLjIgMi45IDQuNWwtNzcuMiA3MS4yYy0xLjgtLjktMy45LTEuNS02LjItMS41LTEuMSAwLTIuMS4xLTMuMS40bC0xMS0zMi44YzMuMi0yLjUgNS4zLTYuNCA1LjMtMTAuOHptLTE2LjQgMTMuNGMuOS4yIDEuOC4zIDIuNy4zIDEuNCAwIDIuOC0uMiA0LjEtLjZsMTAuOSAzMi40Yy0zLjcgMi40LTYuMSA2LjYtNi4xIDExLjQgMCA1LjggMy42IDEwLjcgOC43IDEyLjdsLTExIDU5Yy00LjEuMi03LjggMi4xLTEwLjEgNS4xbC0zNy43LTE4LjhjLjQtMS4yLjUtMi41LjUtMy44IDAtNS4zLTMtOS45LTcuNC0xMi4xbDQ1LjQtODUuNnptMiAyMDMuNWMtLjUgMC0uOS0uMS0xLjQtLjEtMS45IDAtMy43LjQtNS4zIDEuMWwtNDEuOS05NGMyLjQtLjkgNC40LTIuNSA1LjktNC42bDM3LjUgMTguN2MtLjQgMS4zLS43IDIuOC0uNyA0LjMgMCA2LjEgNCAxMS4yIDkuNCAxM2wtMy41IDYxLjZ6bTkuMyA1LjFjLTEuMi0xLjYtMi44LTIuOS00LjYtMy43bDMuNi02Mi4zYzQtLjIgNy42LTIuMSAxMC01bDY0LjMgMjkuMXYxYzAgMS4yLjIgMi40LjUgMy41bC03My44IDM3LjR6bTg3LjYgNTAuN2wtODUtMzguOGMuMy0xLjEuNC0yLjIuNC0zLjQgMC0xLjUtLjItMi45LS43LTQuMmw3My41LTM3LjNjMi41IDMuNSA2LjYgNS44IDExLjIgNS44aDFsOC4zIDY5Yy00LjIgMS4zLTcuNSA0LjctOC43IDguOXptMTE5LjgtMzEuNmwtOTMuOCAzMC45Yy0xLjgtNS4yLTYuNy04LjktMTIuNS05bC04LjQtNjkuNWMxLjgtLjggMy41LTIuMSA0LjgtMy42bDExMS4yIDQyLjNjLTEgMS45LTEuNSA0LTEuNSA2LjMtLjEuOSAwIDEuOC4yIDIuNnptLTEwNy41LTU1LjRsLS40LS4yaDc0LjFjLjQgNy4yIDYuMyAxMyAxMy43IDEzIDEuNCAwIDIuNy0uMiAzLjktLjZsMTguOCAyOS42LTExMC4xLTQxLjh6bTEyMS43IDM5LjJoLS44Yy0yLjIgMC00LjIuNS02IDEuNGwtMTkuNC0zMC42YzMuMy0yLjUgNS40LTYuNCA1LjQtMTAuOSAwLTIuMy0uNi00LjUtMS42LTYuNGw1OS45LTMxYy41IDEgMS4yIDEuOSAyIDIuN2wtMzkuNSA3NC44em0zNy41LTkwLjZsLTY0LjgtNTQuM2MuOS0xLjggMS40LTMuOSAxLjQtNi4xIDAtLjQgMC0uOC0uMS0xLjItLjEtMS44LS42LTMuNC0xLjQtNC45LTEuMi0yLjMtMy00LjMtNS4yLTUuNmwxNi40LTQyLjhjMS4zLjQgMi42LjYgNCAuNi45IDAgMS44LS4xIDIuNy0uM2w1MC40IDExMC42Yy0xLjQgMS4xLTIuNSAyLjQtMy40IDR6Ii8+PC9zdmc+" alt="" style="width: 24px; vertical-align: middle; position: relative; top: -1px;"> Torbara.com</a>');
    array_push($links, '<a title="Our portfolio on Envato Market" href="http://themeforest.net/user/torbara/portfolio?ref=torbara" target="_blank"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDkuMjY3IDMwOS4yNjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMwOS4yNjcgMzA5LjI2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNEMDk5NEI7IiBkPSJNMjYwLjk0NCw0My40OTFIMTI1LjY0YzAsMC0xOC4zMjQtMjguOTk0LTI4Ljk5NC0yOC45OTRINDguMzIzYy0xMC42NywwLTE5LjMyOSw4LjY1LTE5LjMyOSwxOS4zMjkgICB2MjIyLjI4NmMwLDEwLjY3LDguNjU5LDE5LjMyOSwxOS4zMjksMTkuMzI5aDIxMi42MjFjMTAuNjcsMCwxOS4zMjktOC42NTksMTkuMzI5LTE5LjMyOVY2Mi44MiAgIEMyODAuMjczLDUyLjE1LDI3MS42MTQsNDMuNDkxLDI2MC45NDQsNDMuNDkxeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0U0RTdFNzsiIGQ9Ik0yOC45OTQsNzIuNDg0aDI1MS4yNzl2NzcuMzE3SDI4Ljk5NFY3Mi40ODR6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRjRCNDU5OyIgZD0iTTE5LjMyOSw5MS44MTRoMjcwLjYwOWMxMC42NywwLDE5LjMyOSw4LjY1LDE5LjMyOSwxOS4zMjlsLTE5LjMyOSwxNjQuMjk4ICAgYzAsMTAuNjctOC42NTksMTkuMzI5LTE5LjMyOSwxOS4zMjlIMzguNjU4Yy0xMC42NywwLTE5LjMyOS04LjY1OS0xOS4zMjktMTkuMzI5TDAsMTExLjE0M0MwLDEwMC40NjMsOC42NTksOTEuODE0LDE5LjMyOSw5MS44MTR6ICAgIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" alt="" style="width: 16px; vertical-align: middle; position: relative; top: -2px;"> Portfolio</a>');
    return $links;
};
add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), $tt_f_plugin_links );