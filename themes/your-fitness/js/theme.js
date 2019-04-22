/*
 *
 * @encoding     UTF-8
 * @author       Nemirovskiy Vitaliy (support@torbara.com)
 * @copyright    Copyright (C) 2016 torbara (http://torbara.com/). All rights reserved.
 * @license      Copyrighted Commercial Software
 * @support      support@torbara.com
 *
 */

"use strict";

jQuery(function($) {

    //displays inview Achievements
    jQuery(".tt-animation-up").one("init.uk.scrollspy", function(isVisible) {
        // counter up for Achievements
        jQuery('.tt-box-span').counterUp({
            delay: 10,
            time: 1200
        });

    });
    
    //Draw animated circular progress bars
    jQuery('div[data-circle-value]').each(function() {

        jQuery(this).circleProgress({
            value: jQuery(this).attr('data-circle-value'),
            size: 116,
            fill: {gradient: ["#ff3030", "#ff6a6a"]},
            animation: { duration: 3200, easing: 'circleProgressEasing' }
        });
        
    });


    
    
});
