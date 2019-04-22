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
 * Create tree view form menu items array
 * @param type $nav_menu_items_array
 * @return type
 */
function ttwarp_nav_menu_object_tree($nav_menu_items_array) {
    foreach ($nav_menu_items_array as $key => $value) {
        $value->children = array();
        $nav_menu_items_array[$key] = $value;
    }

    $nav_menu_levels = array();
    $index = 0;
    if (!empty($nav_menu_items_array))
        do {
            if ($index == 0) {
                foreach ($nav_menu_items_array as $key => $obj) {
                    if ($obj->menu_item_parent == 0) {
                        $nav_menu_levels[$index][] = $obj;
                        unset($nav_menu_items_array[$key]);
                    }
                }
            } else {
                foreach ($nav_menu_items_array as $key => $obj) {
                    if (in_array($obj->menu_item_parent, $last_level_ids)) {
                        $nav_menu_levels[$index][] = $obj;
                        unset($nav_menu_items_array[$key]);
                    }
                }
            }
            $last_level_ids = wp_list_pluck($nav_menu_levels[$index], 'db_id');
            $index++;
        } while (!empty($nav_menu_items_array));

    $nav_menu_levels_reverse = array_reverse($nav_menu_levels);

    $nav_menu_tree_build = array();
    $index = 0;
    if (!empty($nav_menu_levels_reverse))
        do {
            if (count($nav_menu_levels_reverse) == 1) {
                $nav_menu_tree_build = $nav_menu_levels_reverse;
            }
            $current_level = array_shift($nav_menu_levels_reverse);
            if (isset($nav_menu_levels_reverse[$index])) {
                $next_level = $nav_menu_levels_reverse[$index];
                foreach ($next_level as $nkey => $nval) {
                    foreach ($current_level as $ckey => $cval) {
                        if ($nval->db_id == $cval->menu_item_parent) {
                            $nval->children[] = $cval;
                        }
                    }
                }
            }
        } while (!empty($nav_menu_levels_reverse));

    $nav_menu_object_tree = $nav_menu_tree_build[0];
    return $nav_menu_object_tree;
}

/**
 * Output options list for select
 */
function ttwarp_printMenuTree($arr, $menuslug, $level = 0) {
    foreach ($arr as $item) {
        ?><option value="<?php echo $menuslug."+".$item->ID; ?>"><?php echo str_repeat("-", $level) . " " . $item->title . " (" . $item->type_label . ")"; ?></option><?php
        if (count($item->children)) {
            ttwarp_printMenuTree($item->children, $menuslug, $level + 1);
        }
    }
}

$options  = array();
$defaults = array(
    'search'     => 'Search'
);

$selected = is_array($value) ? $value : array('*');

if (count($selected) > 1 && in_array('*', $selected)) {
    $selected = array('*');
}

// set default options
foreach ($defaults as $val => $label) {
    $attributes = in_array($val, $selected) ? array('value' => $val, 'selected' => 'selected') : array('value' => $val);
    $options[]  = sprintf('<option %s>%s</option>', $control->attributes($attributes), $label);
}

// set pages
if ($pages = get_pages()) {
    $options[] = '<optgroup label="Pages">';

    array_unshift($pages, (object) array('post_title' => 'Pages (All)'));

    foreach ($pages as $page) {
        $val = isset($page->ID) ? 'page-'.$page->ID : 'page';
        $attributes = in_array($val, $selected) ? array('value' => $val, 'selected' => 'selected') : array('value' => $val);
        $options[]  = sprintf('<option %s>%s</option>', $control->attributes($attributes), $page->post_title);
    }

    $options[] = '</optgroup>';
}

// set posts
$options[] = '<optgroup label="Post">';
foreach (array('home', 'single', 'archive') as $view) {
    $val = $view;
    $attributes = in_array($val, $selected) ? array('value' => $val, 'selected' => 'selected') : array('value' => $val);
    $options[] = sprintf('<option %s>%s (%s)</option>', $control->attributes($attributes), 'Post', ucfirst($view));
}
$options[] = '</optgroup>';

// set custom post types
foreach (array_keys(get_post_types(array('_builtin' => false))) as $posttype) {
    $obj = get_post_type_object($posttype);
    $label = ucfirst($posttype);

    if ($obj->publicly_queryable) {
        $options[] = '<optgroup label="'.$label.'">';

        foreach (array('single', 'archive', 'search') as $view) {
            $val = $posttype.'-'.$view;
            $attributes = in_array($val, $selected) ? array('value' => $val, 'selected' => 'selected') : array('value' => $val);
            $options[] = sprintf('<option %s>%s (%s)</option>', $control->attributes($attributes), $label, ucfirst($view));
        }

        $options[] = '</optgroup>';
    }
}

// set categories
foreach (array_keys(get_taxonomies()) as $tax) {

    if(in_array($tax, array("post_tag", "nav_menu"))) continue;

    if ($categories = get_categories(array( 'taxonomy' => $tax ))) {
        $options[] = '<optgroup label="Categories ('.ucfirst(str_replace(array("_","-")," ",$tax)).')">';

        foreach ($categories as $category) {
            $val        = 'cat-'.$category->cat_ID;
            $attributes = in_array($val, $selected) ? array('value' => $val, 'selected' => 'selected') : array('value' => $val);
            $options[]  = sprintf('<option %s>%s</option>', $control->attributes($attributes), $category->cat_name);
        }

        $options[] = '</optgroup>';
    }
}




?>

<div id="tm-assign-modal" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <div class="uk-modal-header">
            <h2 class="uk-margin-remove">Headline</h2>
            <button class="uk-modal-close uk-close uk-float-right" type="button"></button>
        </div>

        <div>

            <div class="uk-alert">By selecting the specific assignments you can limit where this Widget should or shouldn't be published. To have it published on all pages, simply do not specify any assignments.</div>

            <div class="uk-panel uk-panel-box tt-mirror-widget uk-margin uk-margin-top-remove">
                <h3 class="uk-panel-title">Same as other widget</h3>
                <p>Select this to use the assignment settings of another widget.<br>If Opposite is selected, the widget will show up on all pages where the selected widget will not show up.</p>
                <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                    <button class="uk-button uk-button-danger tt-no uk-active">No</button>
                    <button class="uk-button uk-button-success tt-yes">Yes</button>
                    <button class="uk-button uk-button-success tt-opposite">Opposite</button>
                </div>

                <div class="tt-widget-mirror-widget-id">
                    <p class="uk-margin-bottom-remove uk-margin-top">Select the widget you want to follow. This widget will use the Assignment settings of the selected widget.</p>
                    <select class="uk-margin-small-top mirror-widget-id chosen-select" data-placeholder="Select the widget...">
                        <option value=""></option>
                        <?php
                        // List widgets grouped by sidebars
                        $sidebars = wp_get_sidebars_widgets();
                        foreach ($sidebars as $key => $widgets) :
                            // Scip empty sidebars
                            if (empty($widgets)) { continue; } ?>
                            <optgroup label="<?php echo esc_attr($key); ?>">
                                <?php foreach ($widgets as $widget) :
                                    $wdgtvar = 'widget_' . _get_widget_id_base($widget);
                                    $idvar = _get_widget_id_base($widget);
                                    $widgetInstance = get_option($wdgtvar);
                                    $idbs = str_replace($idvar . '-', '', $widget); ?>
                                    <option value="<?php echo esc_attr($widget); ?>"><?php 
                                        if(isset($widgetInstance[$idbs]['title'])){
                                            echo $widgetInstance[$idbs]['title'] . " [" . $widget . "]";
                                        }else{ // Widget witout title
                                            echo "[" . $widget . "]"; 
                                        }
                                    ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="tt-all-fields">

                <div class="uk-panel uk-panel-box tt-matching-method uk-margin">
                    <h3 class="uk-panel-title">Matching Method</h3>
                    <p>Should all or any assignments be matched?</p>
                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-success tt-all uk-active">All</button>
                        <button class="uk-button uk-button-success tt-any">ANY</button>
                    </div>
                    <p>
                        <strong>All</strong> — Will be published if <strong>ALL</strong> of below assignments are matched.<br>
                        <strong>ANY</strong> — Will be published if <strong>ANY</strong> (one or more) of below assignments are matched.<br>
                    </p>
                </div>
                
                <div class="uk-panel uk-panel-box tt-wp-content uk-margin">

                    <h3 class="uk-panel-title">WordPress Content</h3>
                    
                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore">Ignore</button>
                        <button class="uk-button uk-button-success tt-include uk-active">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>

                    <div class="tt-wp-content-box">
                        <p class="uk-margin-bottom-remove uk-margin-top">
                            Select on what page types or categories the assignment should be active.
                        </p>
                        <select class="wp-content chosen-select" multiple="multiple">
                            <option value=""></option>
                            <?php echo implode("", $options) ?>
                        </select>
                    </div>

                </div>

                <div class="uk-panel uk-panel-box tt-home-page uk-margin">

                    <h3 class="uk-panel-title">Home Page</h3>

                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore uk-active">Ignore</button>
                        <button class="uk-button uk-button-success tt-include">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>

                </div>

                <div class="uk-panel uk-panel-box tt-menu-items uk-margin">
                    <h3 class="uk-panel-title">Menu Items</h3>
                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore uk-active">Ignore</button>
                        <button class="uk-button uk-button-success tt-include">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>
                    
                    <div class="tt-menuitems-selection">
                        <p class="uk-margin-bottom-remove uk-margin-top">Select the menu items to assign to.</p>
                        <select class="menuitems chosen-select" multiple="">
                                <option value=""></option>
                                <?php
                                // Get all menus
                                $menus = get_terms('nav_menu');
                                foreach ($menus as $menu) {
                                    ?><optgroup label="<?php echo $menu->name; ?>"><?php
                                        $navMenuItems = wp_get_nav_menu_items($menu->slug);
                                        $menuTree = ttwarp_nav_menu_object_tree($navMenuItems);
                                        ttwarp_printMenuTree($menuTree, $menu->slug, 0);
                                    ?></optgroup><?php
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="uk-panel uk-panel-box tt-date-time uk-margin">

                    <h3 class="uk-panel-title">Date & Time</h3>

                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore uk-active">Ignore</button>
                        <button class="uk-button uk-button-success tt-include">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>

                    <div class="tt-period-picker-box">
                        <p class="tt-period-picker uk-margin-top">
                            <input class="tt-period-picker-start" id="tt-period-picker-start" type="text" value="" />
                            <input class="tt-period-picker-end" id="tt-period-picker-end" type="text" value="" />
                        </p>
                        <!-- TODO: Add Recurring by Year, Month, Day -->
                        
                        <p>
                            The date and time assignments use the date/time of your servers, not that of the visitors system.<br>
                            Current date/time: <strong><?php echo date("d.m.Y H:i"); ?></strong>
                        </p>
                    </div>

                </div>

                <div class="uk-panel uk-panel-box tt-user-roles uk-margin">

                    <h3 class="uk-panel-title">User Roles</h3>

                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore uk-active">Ignore</button>
                        <button class="uk-button uk-button-success tt-include">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>

                    <div class="user-roles-box">
                        <p class="uk-margin-bottom-remove uk-margin-top">Select the user roles to assign to.</p>
                        <select class="user-roles chosen-select" multiple="">
                            <option value=""></option>
                            <?php // Get user roles
                            $roles = get_editable_roles();
                            foreach ($roles as $k => $role) {
                                ?><option value="<?php echo $k; ?>"><?php echo $role['name']; ?></option><?php
                            } ?>
                        </select>
                    </div>

                </div>

                <div class="uk-panel uk-panel-box tt-url uk-margin">

                    <h3 class="uk-panel-title">URL</h3>

                    <div class="uk-button-group tt-button-group" data-uk-button-radio="">
                        <button class="uk-button uk-button-primary tt-ignore uk-active">Ignore</button>
                        <button class="uk-button uk-button-success tt-include">Include</button>
                        <button class="uk-button uk-button-danger tt-exclude">Exclude</button>
                    </div>

                    <div class="tt-url-box">
                        <p class="uk-margin-bottom-remove uk-margin-top">
                            Enter (part of) the URLs to match.<br>
                            Use a new line for each different match.
                        </p>
                        
                        <textarea class="tt-url-field"></textarea>                       
                        
                        <!-- TODO: ADD Regular Expressions Support -->
                    </div>

                </div>

            </div>

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button tt-cancel-btn">Cancel</button>
            <button type="button" class="uk-button uk-button-primary tt-save-btn">Save</button>
        </div>
    </div>
</div>