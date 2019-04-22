<?php
/**
 * 
 * Warp 7 Framework by Torbara, based on YOOtheme Warp 7 http://www.yootheme.com
 * Custom Category Templates lets select a specific template for a category
 * Exclusively on Envato Market: https://themeforest.net/user/torbara/portfolio?ref=torbara
 * 
 * @encoding     UTF-8
 * @copyright    Copyright (C) 2016 Torbara (http://torbara.com). All rights reserved.
 * @license      Envato Standard License http://themeforest.net/licenses/standard?ref=torbara
 * @author       Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 * @support      support@torbara.com
 * 
 */

if (!defined('ABSPATH')){ exit; }// Exit if accessed directly

if (!class_exists('tt_CustomCategoryTemplates')) {
    
    /**
     *  Custom Category Templates
     *  
     */
    class tt_CustomCategoryTemplates {

        /**
         *  class constructor
         * 
         *  @return void
         */
        public function __construct() {
            //do the template selection
            add_filter( 'category_template', array($this,'get_custom_category_template' ));
            //add extra fields to category NEW/EDIT form hook
            add_action ( 'edit_category_form_fields', array($this,'category_template_meta_box'));
            add_action( 'category_add_form_fields', array( &$this, 'category_template_meta_box') );

            // save extra category extra fields hook
            add_action( 'created_category', array( &$this, 'save_category_template' ));
            add_action ( 'edited_category', array($this,'save_category_template'));
        }


        /**
         * category_template_meta_box add extra fields to category edit form callback function
         * 
         *  @param  (object) $tag
         *  @return void
         * 
         */
        public function category_template_meta_box( $tag ) {
            $t_id = NULL;
            
            $f_layout = 0; // Div layout
            if (isset($tag->term_id)) {
                $t_id = $tag->term_id;
                $f_layout = 1; // Table layout
            }
            $cat_meta = get_option("category_templates");
            $template = isset($cat_meta[$t_id]) ? $cat_meta[$t_id] : false; 
            
            if ($f_layout) { // Table layout ?>
                <tr class="form-field term-parent-wrap">
                    <th scope="row">
                        <label for="cat_template"><?php _e('Category Template'); ?></label>
                    </th>
                    <td>
                        <select name="cat_template" id="cat_template">
                            <option value='default'><?php _e('Default Template'); ?></option>
                            <?php page_template_dropdown($template); ?>
                        </select>
                        <p class="description"><?php _e('Select a specific template for this category'); ?></p>
                    </td>
                </tr><?php
            } else { // Div layout ?>
                <div class="form-field term-template-wrap">
                    <label for="cat_template"><?php _e('Category Template'); ?></label>
                    <select name="cat_template" id="cat_template">
                        <option value='default'><?php _e('Default Template'); ?></option>
                        <?php page_template_dropdown($template); ?>
                    </select>
                    <p><?php _e('Select a specific template for this category'); ?></p>
                </div><?php
            }
        }


        /**
         * save_category_template save extra category extra fields callback function		 
         *  
         *  @param  int $term_id 
         *  @return void
         */
        public function save_category_template( $term_id ) {
            if ( isset( $_POST['cat_template'] )) {
                $cat_meta = get_option( "category_templates");
                $cat_meta[$term_id] = $_POST['cat_template'];
                update_option( "category_templates", $cat_meta );
            }
        }

        /**
         * get_custom_category_template handle category template picking
         * 
         *  @param  string $category_template 
         *  @return string category template
         */
        function get_custom_category_template( $category_template ) {
            $cat_ID = absint( get_query_var('cat') );
            $cat_meta = get_option('category_templates');
            if (isset($cat_meta[$cat_ID]) && $cat_meta[$cat_ID] != 'default' ){
                $temp = locate_template($cat_meta[$cat_ID]);
                if (!empty($temp)){ // Нужно ли это?
                    return apply_filters("tt_CustomCategoryTemplates_found", $temp);
                }
            }
            return $category_template;
        }
    }
}

// Run
new tt_CustomCategoryTemplates();