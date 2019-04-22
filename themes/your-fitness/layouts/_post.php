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

if($this['config']->get('post_layouts') == 0){
    get_template_part('layouts/post', 'default');
}elseif($this['config']->get('post_layouts') == 1){
    get_template_part('layouts/post', 'videosblog');
}elseif($this['config']->get('post_layouts') == 2){
    get_template_part('layouts/post', 'firstblog');
}elseif($this['config']->get('post_layouts') == 3){
    get_template_part('layouts/post', 'secondblog');
}

?>