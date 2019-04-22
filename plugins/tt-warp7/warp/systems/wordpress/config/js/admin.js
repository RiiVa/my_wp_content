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

!function(e,a){e(function(){e("main.tm-main > .tm-form").append('<div class="tm-form-save"><button type="submit" class="uk-button uk-button-primary js-save-settings">Save changes</button> <span></span></div>');var a=e('input:checkbox[name$="[title]"]');e.each(a,function(){e(this).after(e(this).clone().attr("type","hidden").val(e(this).is(":checked")?"1":"0"))}),a.on("change",function(){e(this).next().val(e(this).is(":checked")?"1":"0")}),e('[data-warp="theme"] .js-save-settings').on("click",function(e){e.preventDefault(),t.save(this)})});var t={save:function(a){var t={},s=e(a);s.attr("disabled",!0).next().attr("class","uk-icon-spinner uk-icon-spin"),parse_str(e(":input","#theme-options").serialize(),t),e.ajax({url:ajaxurl,type:"post",data:{action:"warp_save",config:JSON.stringify(t,null,"	")},success:function(a){var t=!1;try{a=e.parseJSON(a),"success"==a.message&&(t=!0)}catch(n){}t||alert("Save failed!"),setTimeout(function(){s.attr("disabled",!1).next().attr("class","")},300)}})},saveFiles:function(a){var t=e.Deferred(),s=new FormData;return s.append("action","warp_save_files"),s.append("files",new Blob([window.btoa(unescape(encodeURIComponent(JSON.stringify(a))))],{type:"text/plain"})),e.ajax({url:ajaxurl,type:"POST",data:s,processData:!1,contentType:!1}).always(function(a,s,n){var r=!1;if("error"==s)r=n;else try{a=e.parseJSON(a),"success"!=a.message&&(r=a.message)}catch(i){r="Saving failed!"}t[r?"reject":"resolve"](r)}),t.promise()},data:function(){var a=e.Deferred();return e.ajax({url:ajaxurl,type:"post",data:{action:"warp_get_styles"}}).always(function(t,s,n){var r=!1;if("error"==s)r=n;else try{if(t=e.parseJSON(t),"error"!=t.message)return void a.resolve(t);r=t.message}catch(i){r="Retrieving styles data failed!"}a.reject(r)}),a.promise()}};a.System=t}(jQuery,this);

/**
 * Show window with text with text in input
 */
function tt_copyToClipboard (text){
    UIkit.modal.prompt("Copy to clipboard: Ctrl+C, Enter", text, function(newvalue){ });
}

/**
 * Widget assignments
 */
jQuery(function($) {
    "use strict";
    
    // Modal window
    var ttAssignmentsModal = UIkit.modal("#tm-assign-modal", {center:true});
    
    jQuery("#tm-assign-modal").on({
        'show.uk.modal': function(){
            
        },
        'hide.uk.modal': function(){
            // Set old window scroll position
            jQuery(window).scrollTop(scrollTop)
        }
    });
    
    /**
     * Open modal
     */
    var assignInput;
    //var height;
    var scrollTop;
    jQuery(".tm-assign-btn").click(function (e){
        e.preventDefault();
        
        // Save window scroll position
        scrollTop = jQuery(window).scrollTop();
        
        // Set Modal Window Name
        var widgetName = jQuery(this).next().data("widget-name");
        assignInput = jQuery(this).next();// INPUT which will save the settings
        jQuery("#tm-assign-modal .uk-modal-header h2").html(widgetName);
        
        // Get assignments from field
        var aConf = '';
        try {
            
            var aConfJson = jQuery(assignInput).val();
            aConfJson = aConfJson.replace(/\|/g, '"');
            aConf = JSON.parse(aConfJson);
            
            // Same as other widget
            var mirrorWidget = aConf.mirrorWidget;
            var widgetID = aConf.widgetID;
            jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .uk-button").removeClass("uk-active");
            if(mirrorWidget == 0){ jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-no").addClass("uk-active"); }
            if(mirrorWidget == 1){ jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-yes").addClass("uk-active"); }
            if(mirrorWidget == 2){ jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-opposite").addClass("uk-active"); }
            if(widgetID != '') { jQuery("#tm-assign-modal .tt-mirror-widget select.mirror-widget-id").val(widgetID).trigger("chosen:updated"); }
            
            // Matching Method
            var matchingMethod = aConf.matchingMethod;
            jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .uk-button").removeClass("uk-active");
            if(matchingMethod == 0){ jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .tt-all").addClass("uk-active"); }
            if(matchingMethod == 1){ jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .tt-any").addClass("uk-active"); }
            
            // WordPress Content
            var WPContent = aConf.WPContent;
            var WPContentVal = aConf.WPContentVal + '';
            jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .uk-button").removeClass("uk-active");
            if(WPContent == 0){ jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(WPContent == 1){ jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-include").addClass("uk-active"); }
            if(WPContent == 2){ jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-exclude").addClass("uk-active"); }
            var WPContentArray = WPContentVal.split(",");
            if(WPContentVal != '') { jQuery("#tm-assign-modal .tt-wp-content select.wp-content").val(WPContentArray).trigger("chosen:updated"); }
            
            // Home Page
            var homePage = aConf.homePage;
            jQuery("#tm-assign-modal .tt-home-page .tt-button-group .uk-button").removeClass("uk-active");
            if(homePage == 0){ jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(homePage == 1){ jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-include").addClass("uk-active"); }
            if(homePage == 2){ jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-exclude").addClass("uk-active"); }
            
            // Menu Items
            var menuItems = aConf.menuItems;
            var menuItemsVal = aConf.menuItemsVal + '';
            jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .uk-button").removeClass("uk-active");
            if(menuItems == 0){ jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(menuItems == 1){ jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-include").addClass("uk-active"); }
            if(menuItems == 2){ jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-exclude").addClass("uk-active"); }
            var menuItemsArray = menuItemsVal.split(",");
            if(menuItemsVal != '') { jQuery("#tm-assign-modal .tt-menu-items select.menuitems").val(menuItemsArray).trigger("chosen:updated"); }
            
            // Date & Time
            var dateTime = aConf.dateTime;
            var dateTimeStart = aConf.dateTimeStart;
            var dateTimeEnd = aConf.dateTimeEnd;
            jQuery("#tm-assign-modal .tt-date-time .tt-button-group .uk-button").removeClass("uk-active");
            if(dateTime == 0){ jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(dateTime == 1){ jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-include").addClass("uk-active"); }
            if(dateTime == 2){ jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-exclude").addClass("uk-active"); }
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-start").val(dateTimeStart);
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-end").val(dateTimeEnd);
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-start").periodpicker('change');
            
            // User Roles
            var userRoles = aConf.userRoles;
            var userRolesVal = aConf.userRolesVal + '';
            jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .uk-button").removeClass("uk-active");
            if(userRoles == 0){ jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(userRoles == 1){ jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-include").addClass("uk-active"); }
            if(userRoles == 2){ jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-exclude").addClass("uk-active"); }
            var userRolesArray = userRolesVal.split(",");
            if(userRolesVal != '') { jQuery("#tm-assign-modal .tt-user-roles select.user-roles").val(userRolesArray).trigger("chosen:updated"); }
                        
            // URL
            var URL = aConf.URL;
            var URLVal = aConf.URLVal;
            jQuery("#tm-assign-modal .tt-url .tt-button-group .uk-button").removeClass("uk-active");
            if(URL == 0){ jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-ignore").addClass("uk-active"); }
            if(URL == 1){ jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-include").addClass("uk-active"); }
            if(URL == 2){ jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-exclude").addClass("uk-active"); }
            jQuery("#tm-assign-modal .tt-url textarea.tt-url-field").val(URLVal);
            
        } catch (e) {
            
            // Reset all controls to default state
            jQuery("#tm-assign-modal .tt-button-group .uk-button").removeClass("uk-active");
            
            // Same as other widget
            jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-no").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-mirror-widget select.mirror-widget-id").val("").trigger("chosen:updated");
            
            // Matching Method
            jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .tt-all").addClass("uk-active");
            
            // WordPress Content
            jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-ignore").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-wp-content select.wp-content").val("").trigger("chosen:updated");
            
            // Home Page
            jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-ignore").addClass("uk-active");
            
            // Menu Items
            jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-ignore").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-menu-items select.menuitems").val("").trigger("chosen:updated");
            
            // Date & Time
            jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-ignore").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-start").val("");
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-end").val("");
            jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-start").periodpicker('change');
            
            // User Roles
            jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-ignore").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-user-roles select.user-roles").val("").trigger("chosen:updated");
                        
            // URL
            jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-ignore").addClass("uk-active");
            jQuery("#tm-assign-modal .tt-url textarea.tt-url-field").val("");
            
            console.log(e);
            
        }
        
        awesomeAssignmentIni();
        // Show Modal
        ttAssignmentsModal.show();
    });
        
    /**
     * Save modal
     */
    jQuery("#tm-assign-modal .tt-save-btn").click(function (e){
        e.preventDefault();
        
        /** Get new values */
        
        // Same as other widget
        var mirrorWidget = 0;
        if(jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-no").hasClass("uk-active")) { mirrorWidget = 0 }
        if(jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-yes").hasClass("uk-active")) { mirrorWidget = 1 }
        if(jQuery("#tm-assign-modal .tt-mirror-widget .tt-button-group .tt-opposite").hasClass("uk-active")) { mirrorWidget = 2 }        
        
        var widgetID = '';
        if(mirrorWidget){
            widgetID = jQuery("#tm-assign-modal .tt-mirror-widget select.mirror-widget-id").val();
        }
        
        // Matching Method
        var matchingMethod = 0;
        if(jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .tt-all").hasClass("uk-active")) { matchingMethod = 0 }
        if(jQuery("#tm-assign-modal .tt-matching-method .tt-button-group .tt-any").hasClass("uk-active")) { matchingMethod = 1 }
        
        // WordPress Content
        var WPContent = 0;
        if(jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-ignore").hasClass("uk-active")) { WPContent = 0 }
        if(jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-include").hasClass("uk-active")) { WPContent = 1 }
        if(jQuery("#tm-assign-modal .tt-wp-content .tt-button-group .tt-exclude").hasClass("uk-active")) { WPContent = 2 }
        
        var WPContentVal = '';
        if(WPContent){
            WPContentVal = jQuery("#tm-assign-modal .tt-wp-content select.wp-content").val();
        }
        
        // Home Page
        var homePage = 0;
        if(jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-ignore").hasClass("uk-active")) { homePage = 0 }
        if(jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-include").hasClass("uk-active")) { homePage = 1 }
        if(jQuery("#tm-assign-modal .tt-home-page .tt-button-group .tt-exclude").hasClass("uk-active")) { homePage = 2 }
        
        // Menu Items
        var menuItems = 0;
        if(jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-ignore").hasClass("uk-active")) { menuItems = 0 }
        if(jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-include").hasClass("uk-active")) { menuItems = 1 }
        if(jQuery("#tm-assign-modal .tt-menu-items .tt-button-group .tt-exclude").hasClass("uk-active")) { menuItems = 2 }
        
        var menuItemsVal = '';
        if(menuItems){
            menuItemsVal = jQuery("#tm-assign-modal .tt-menu-items select.menuitems").val();
        }
        
        // Date & Time
        var dateTime = 0;
        if(jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-ignore").hasClass("uk-active")) { dateTime = 0 }
        if(jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-include").hasClass("uk-active")) { dateTime = 1 }
        if(jQuery("#tm-assign-modal .tt-date-time .tt-button-group .tt-exclude").hasClass("uk-active")) { dateTime = 2 }
        
        var dateTimeStart = '';
        var dateTimeEnd = '';
        if(dateTime){
            dateTimeStart = jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-start").val();
            dateTimeEnd = jQuery("#tm-assign-modal .tt-date-time input.tt-period-picker-end").val();
        }
        
        // User Roles
        var userRoles = 0;
        if(jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-ignore").hasClass("uk-active")) { userRoles = 0 }
        if(jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-include").hasClass("uk-active")) { userRoles = 1 }
        if(jQuery("#tm-assign-modal .tt-user-roles .tt-button-group .tt-exclude").hasClass("uk-active")) { userRoles = 2 }
        
        var userRolesVal = '';
        if(userRoles){
            userRolesVal = jQuery("#tm-assign-modal .tt-user-roles select.user-roles").val();
        }
        
        // URL
        var URL = 0;
        if(jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-ignore").hasClass("uk-active")) { URL = 0 }
        if(jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-include").hasClass("uk-active")) { URL = 1 }
        if(jQuery("#tm-assign-modal .tt-url .tt-button-group .tt-exclude").hasClass("uk-active")) { URL = 2 }
        
        var URLVal = '';
        if(URL){
            URLVal = jQuery("#tm-assign-modal .tt-url textarea.tt-url-field").val();
        }        
        
        var aConf = {
            mirrorWidget: mirrorWidget, 
            widgetID: widgetID,
            matchingMethod: matchingMethod,
            WPContent: WPContent,
            WPContentVal: WPContentVal,
            homePage: homePage,
            menuItems: menuItems,
            menuItemsVal: menuItemsVal,
            dateTime: dateTime,
            dateTimeStart: dateTimeStart,
            dateTimeEnd: dateTimeEnd,
            userRoles: userRoles,
            userRolesVal: userRolesVal,
            URL: URL,
            URLVal: URLVal
        };
        
        var aConfJson = JSON.stringify(aConf);
        aConfJson = aConfJson.replace(/\"/g, '|');// Input truncate quotes, so made some replacments
        
        assignInput.val(aConfJson);// Set setting to input
        
        // Hide Modal
        ttAssignmentsModal.hide();
        
        // Mark widgets with settings
        ttMarkAssignButtons();
        
        // Save window scroll position
        setTimeout(function(){
            jQuery(window).scrollTop(scrollTop)
        }, 500);
        console.log(scrollTop);
    });
    
    /**
     * Close modal
     */
    jQuery("#tm-assign-modal .tt-cancel-btn").click(function (e){
        e.preventDefault();
        ttAssignmentsModal.hide();
    });
    
    /**
     * Any button click
     */
    jQuery("#tm-assign-modal .uk-button").click(function (e){
        e.preventDefault();
    });
    
    /**
     * Same as other widget NO click
     */
    jQuery("#tm-assign-modal .tt-mirror-widget .uk-button-group .tt-no").click(function (e){
        jQuery("#tm-assign-modal .tt-mirror-widget .tt-widget-mirror-widget-id").hide(200);
        jQuery("#tm-assign-modal .tt-all-fields").show(200);
    });
    
    /**
     * Same as other widget YES click
     */
    jQuery("#tm-assign-modal .tt-mirror-widget .uk-button-group .tt-yes").click(function (e){
        jQuery("#tm-assign-modal .tt-mirror-widget .tt-widget-mirror-widget-id").show(200);
        jQuery("#tm-assign-modal .tt-all-fields").hide(200);
    });
    
    /**
     * Same as other widget Opposite click
     */
    jQuery("#tm-assign-modal .tt-mirror-widget .uk-button-group .tt-opposite").click(function (e){
        jQuery("#tm-assign-modal .tt-mirror-widget .tt-widget-mirror-widget-id").show(200);
        jQuery("#tm-assign-modal .tt-all-fields").hide(200);
    });
    
    /**
     * Menu Items Ignore click
     */
    jQuery("#tm-assign-modal .tt-menu-items .uk-button-group .tt-ignore").click(function (e){
        jQuery("#tm-assign-modal .tt-menu-items .tt-menuitems-selection").hide(200);
        jQuery(this).closest(".tt-menu-items").removeClass("tt-red tt-green");
    });
    
    /**
     * Menu Items Include click
     */
    jQuery("#tm-assign-modal .tt-menu-items .uk-button-group .tt-include").click(function (e){
        jQuery("#tm-assign-modal .tt-menu-items .tt-menuitems-selection").show(200);
        jQuery(this).closest(".tt-menu-items").removeClass("tt-red").addClass("tt-green");
    });
    
    /**
     * Menu Items Exclude click
     */
    jQuery("#tm-assign-modal .tt-menu-items .uk-button-group .tt-exclude").click(function (e){
        jQuery("#tm-assign-modal .tt-menu-items .tt-menuitems-selection").show(200);
        jQuery(this).closest(".tt-menu-items").removeClass("tt-green").addClass("tt-red");
    });
    
    
    /**
     * Home Page IGNORE click
     */
    jQuery("#tm-assign-modal .tt-home-page .uk-button-group .tt-ignore").click(function (e){
        jQuery(this).closest(".tt-home-page").removeClass("tt-green tt-red");
    });
    
    /**
     * Home Page INCLUDE click
     */
    jQuery("#tm-assign-modal .tt-home-page .uk-button-group .tt-include").click(function (e){
        jQuery(this).closest(".tt-home-page").removeClass("tt-red").addClass("tt-green");
    });
    
    /**
     * Home Page EXCLUDE click
     */
    jQuery("#tm-assign-modal .tt-home-page .uk-button-group .tt-exclude").click(function (e){
        jQuery(this).closest(".tt-home-page").removeClass("tt-green").addClass("tt-red");
    });
    
    /**
     * Date & Time IGNORE click
     */
    jQuery("#tm-assign-modal .tt-date-time .uk-button-group .tt-ignore").click(function (e){
        jQuery(this).closest(".tt-date-time").removeClass("tt-green tt-red");
        jQuery("#tm-assign-modal .tt-date-time .tt-period-picker-box").hide(200);
    });
    
    /**
     * Date & Time INCLUDE click
     */
    jQuery("#tm-assign-modal .tt-date-time .uk-button-group .tt-include").click(function (e){
        jQuery(this).closest(".tt-date-time").removeClass("tt-red").addClass("tt-green");
        jQuery("#tm-assign-modal .tt-date-time .tt-period-picker-box").show(200);
    });
    
    /**
     * Date & Time EXCLUDE click
     */
    jQuery("#tm-assign-modal .tt-date-time .uk-button-group .tt-exclude").click(function (e){
        jQuery(this).closest(".tt-date-time").removeClass("tt-green").addClass("tt-red");
        jQuery("#tm-assign-modal .tt-date-time .tt-period-picker-box").show(200);
    });
    
    /**
     * User Roles IGNORE click
     */
    jQuery("#tm-assign-modal .tt-user-roles .uk-button-group .tt-ignore").click(function (e){
        jQuery(this).closest(".tt-user-roles").removeClass("tt-green tt-red");
        jQuery("#tm-assign-modal .tt-user-roles .user-roles-box").hide(200);
    });
    
    /**
     * User Roles INCLUDE click
     */
    jQuery("#tm-assign-modal .tt-user-roles .uk-button-group .tt-include").click(function (e){
        jQuery(this).closest(".tt-user-roles").removeClass("tt-red").addClass("tt-green");
        jQuery("#tm-assign-modal .tt-user-roles .user-roles-box").show(200);
    });
    
    /**
     * User Roles EXCLUDE click
     */
    jQuery("#tm-assign-modal .tt-user-roles .uk-button-group .tt-exclude").click(function (e){
        jQuery(this).closest(".tt-user-roles").removeClass("tt-green").addClass("tt-red");
        jQuery("#tm-assign-modal .tt-user-roles .user-roles-box").show(200);
    });
    
    /**
     * User URL IGNORE click
     */
    jQuery("#tm-assign-modal .tt-url .uk-button-group .tt-ignore").click(function (e){
        jQuery(this).closest(".tt-url").removeClass("tt-green tt-red");
        jQuery("#tm-assign-modal .tt-url .tt-url-box").hide(200);
    });
    
    /**
     * User URL INCLUDE click
     */
    jQuery("#tm-assign-modal .tt-url .uk-button-group .tt-include").click(function (e){
        jQuery(this).closest(".tt-url").removeClass("tt-red").addClass("tt-green");
        jQuery("#tm-assign-modal .tt-url .tt-url-box").show(200);
    });
    
    /**
     * User URL EXCLUDE click
     */
    jQuery("#tm-assign-modal .tt-url .uk-button-group .tt-exclude").click(function (e){
        jQuery(this).closest(".tt-url").removeClass("tt-green").addClass("tt-red");
        jQuery("#tm-assign-modal .tt-url .tt-url-box").show(200);
    });
    
    /**
     * User WordPress Content IGNORE click
     */
    jQuery("#tm-assign-modal .tt-wp-content .uk-button-group .tt-ignore").click(function (e){
        jQuery(this).closest(".tt-wp-content").removeClass("tt-green tt-red");
        jQuery("#tm-assign-modal .tt-wp-content .tt-wp-content-box").hide(200);
    });
    
    /**
     * User WordPress Content INCLUDE click
     */
    jQuery("#tm-assign-modal .tt-wp-content .uk-button-group .tt-include").click(function (e){
        jQuery(this).closest(".tt-wp-content").removeClass("tt-red").addClass("tt-green");
        jQuery("#tm-assign-modal .tt-wp-content .tt-wp-content-box").show(200);
    });
    
    /**
     * User WordPress Content EXCLUDE click
     */
    jQuery("#tm-assign-modal .tt-wp-content .uk-button-group .tt-exclude").click(function (e){
        jQuery(this).closest(".tt-wp-content").removeClass("tt-green").addClass("tt-red");
        jQuery("#tm-assign-modal .tt-wp-content .tt-wp-content-box").show(200);
    });
    
    awesomeAssignmentIni();
    
    /**
     * Initialization
     */
    function awesomeAssignmentIni() {
        
        // Show/Hide unused controls
        jQuery("#tm-assign-modal .uk-button.uk-active").click();
        
        // periodpicker
        jQuery("#tm-assign-modal .tt-date-time .tt-period-picker-start").periodpicker({
            end: jQuery("#tm-assign-modal .tt-date-time .tt-period-picker-end"),
            todayButton: true,
            formatDate: 'D.MM.YYYY',
            timepicker: true,
            timepickerOptions: {
                   twelveHoursFormat:false,
                   hours: true,
                   minutes: true,
                   seconds: false,
                   ampm: false
            }
        });
        
        // Make select boxes more user-friendly - Chosen
        jQuery("#tm-assign-modal select.chosen-select").chosen({
            width:'100%',
            search_contains: true,
            disable_search_threshold: 7,
            inherit_select_classes: true,
            no_results_text: "Oops, nothing found"
        });
        
    }
    
    ttMarkAssignButtons();
    
});

/**
 * Mark all widgets with settings
 */
function ttMarkAssignButtons() {
    
    jQuery(".tm-assign-btn + input.tt-assignments-val").each(function(index) {
        try {
            var inputEl = jQuery(this);
            var aConfJson = jQuery(this).val();
            aConfJson = aConfJson.replace(/\|/g, '"');
            var aConf = JSON.parse(aConfJson);
            if(
                aConf.mirrorWidget == 0 && 
                aConf.WPContent == 0 && 
                aConf.homePage == 0 && 
                aConf.menuItems == 0 && 
                aConf.dateTime  == 0 && 
                aConf.userRoles  == 0 && 
                aConf.URL == 0
            ){
        
                jQuery(inputEl).prev().removeClass("uk-button-success");
                
            }else{
                jQuery(inputEl).prev().addClass("uk-button-success");
            }
        } catch (e) {

        }
    });
}