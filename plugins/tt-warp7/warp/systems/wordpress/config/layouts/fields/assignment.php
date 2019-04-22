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


?>
<div class="uk-text-center">
    
    <?php 
    
    // TODO: Remove in future
    // Backward compatibility
    
    if(is_array($value)){

        //Show on all pages
        $newValue = "";
        if(in_array("*", $value)){
            $newValue = "{|mirrorWidget|:0,|widgetID|:||,|matchingMethod|:0,|WPContent|:0,|WPContentVal|:||,|homePage|:0,|menuItems|:0,|menuItemsVal|:||,|dateTime|:0,|dateTimeStart|:||,|dateTimeEnd|:||,|userRoles|:0,|userRolesVal|:||,|URL|:0,|URLVal|:||}";
        }else{ 

            // Show on Home
            if(in_array("front_page", $value)){
                $newValue = "{|mirrorWidget|:0,|widgetID|:||,|matchingMethod|:0,|WPContent|:1,x123eqyu,|homePage|:1,|menuItems|:0,|menuItemsVal|:||,|dateTime|:0,|dateTimeStart|:||,|dateTimeEnd|:||,|userRoles|:0,|userRolesVal|:||,|URL|:0,|URLVal|:||}";
            }else{
                $newValue = "{|mirrorWidget|:0,|widgetID|:||,|matchingMethod|:0,|WPContent|:1,x123eqyu,|homePage|:0,|menuItems|:0,|menuItemsVal|:||,|dateTime|:0,|dateTimeStart|:||,|dateTimeEnd|:||,|userRoles|:0,|userRolesVal|:||,|URL|:0,|URLVal|:||}";
            }
            
            // Cleen up array
            foreach ($value as $k => $v) {
                if( ($v=="*")||($v=="front_page")||($v=="") ){ 
                    unset($value[$k]);
                }
            }

            // New value format WPContentVal
            if(count($value) > 0){
                $WPContentVal = "|WPContentVal|:[";
                foreach ($value as $z) {
                    $WPContentVal .= "|" . $z . "|,";
                }
                $WPContentVal .= "||]";
                $newValue = str_replace("x123eqyu", $WPContentVal, $newValue);
            }else {
                $newValue = str_replace("x123eqyu", "|WPContentVal|:||", $newValue);
                $newValue = str_replace("|WPContent|:1", "|WPContent|:0", $newValue);
            }
        }

        $value = $newValue;
    }
    
    ?>
    
    <button class="uk-button uk-icon-sliders tm-assign-btn"></button>
    <input type="hidden"
           class="tt-assignments-val"
           name="<?php echo $name ?>"
           data-widget-name="<?php echo (isset($widget->params['title']) && $widget->params['title'] ? $widget->params['title'] : $widget->name) ?>" 
           value="<?php echo $value; ?>">
</div>