<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

namespace Warp\Wordpress\Helper;

use Warp\Helper\AbstractHelper;
use Warp\Warp;

/*
 *  Wordpress widget helper class, provides simplyfied access to wordpress widgets
 */
class WidgetsHelper extends AbstractHelper
{
    /**
     * @var array
     */
    public $widgets;

    /**
     * @var array
     */
    protected $loaded;

    /**
     * Class constructor.
     *
     * @param Warp $warp
     */
    public function __construct(Warp $warp)
    {
        parent::__construct($warp);
    }

    /**
     * Retrieve a widget by id
     *
     * @global array $wp_registered_widgets
     * @param string $id Widget ID
     * @return \stdClass
     */
    public function get($id)
    {
        global $wp_registered_widgets;

        $widget = null;

        if (isset($wp_registered_widgets[$id]) && ($data = $wp_registered_widgets[$id])) {
            $widget = new \stdClass;

            foreach (array('id', 'name', 'classname', 'description') as $var) {
                $widget->$var = isset($data[$var]) ? $data[$var] : null;
            }

            if (isset($data['callback']) && is_array($data['callback']) && ($object = current($data['callback']))) {
                if (is_a($object, 'WP_Widget')) {

                    $widget->type = $object->id_base;

                    if (isset($data['params'][0]['number'])) {

                        $number = $data['params'][0]['number'];
                        $params = get_option($object->option_name);

                        if (false === $params && isset($object->alt_option_name)) {
                            $params = get_option($object->alt_option_name);
                        }

                        if (isset($params[$number])) {
                            $widget->params = $params[$number];
                        }
                    }
                }
            } elseif ($id == 'nav_menu-0') {
                $widget->type = 'nav_menu';
            }

            if (empty($widget->name)) {
                $widget->name = ucfirst($widget->type);
            }

            if (empty($widget->params)) {
                $widget->params = array();
            }

            $widget->display = $this->display($widget);
        }

        return $widget;
    }

    /**
     * Retrieve widgets
     *
     * @param string $position
     * @return stdClass[]
     */
    public function getWidgets($position = null)
    {
        if (empty($this->widgets)) {
            foreach (wp_get_sidebars_widgets() as $pos => $ids) {

                if (!is_array($ids) || empty($ids)) {
                    continue;
                }

                $this->widgets[$pos] = array();

                foreach ($ids as $id) {
                    if ($widget = $this->get($id)) {
                        $this->widgets[$pos][$id] = $widget;
                    }
                }
            }
        }

        if (!is_null($position)) {
            return isset($this->widgets[$position]) ? $this->widgets[$position] : array();
        }

        return $this->widgets;
    }

    /**
     * Retrieve the active module count at a position
     *
     * @param string[] $positions
     * @return int
     */
    public function count($positions)
    {
        $positions = explode('+', $positions);
        $widgets   = $this->getWidgets();
        $count     = 0;

        foreach ($positions as $pos) {
            $pos = trim($pos);

            if (isset($widgets[$pos])) {
                foreach ($widgets[$pos] as $widget) {
                    if ($widget->display) {
                        $count += 1;
                    }
                }
            }

            if (!$count && ($this['system']->isPreview($pos) || ($pos == 'menu' && has_nav_menu('main_menu')))) {
                $count += 1;
            }
        }

        return $count;
    }

    /**
     * Shortcut to render a position
     *
     * @param string $position
     * @param array $args
     * @return string
     */
    public function render($position, $args = array())
    {
        // set position in arguments
        $args['position'] = $position;

        return $this['template']->render('widgets', $args);
    }

    /**
     * Register a position
     *
     * @param string[] $positions
     */
    public function register($positions)
    {
        $positions = (array) $positions;

        foreach ($positions as $name) {
            register_sidebar(array(
                'name' => $name,
                'id' => $name,
                'description' => '',
                'before_widget' => '<!--widget-%1$s<%2$s>-->',
                'after_widget' => '<!--widget-end-->',
                'before_title' => '<!--title-start-->',
                'after_title' => '<!--title-end-->',
            ));
        }
    }
      
    /**
     * Widget assignments - WordPress Content
     */
    protected function ttWordPressContent($assignment){
        
        $result = -1;
        
        switch ($assignment->WPContent) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                if(!$assignment->WPContentVal){ $result = -1; return $result; } // If no menu items - ignore
                
                $query = $this['system']->getQuery();
                foreach ($query as $q) {
                    if (in_array($q, $assignment->WPContentVal)) {
                        $result = TRUE;
                        return $result;
                    }
                }
                break;
                
            case 2: // Exclude
                $result = TRUE;
                if(!$assignment->WPContentVal){ $result = -1; return $result; } // If no menu items - ignore
                
                $query = $this['system']->getQuery();
                foreach ($query as $q) {
                    if (in_array($q, $assignment->WPContentVal)) {
                        $result = FALSE;
                        return $result;
                    }
                }
                break;
        }
        
        return $result;
    }
    
    /**
     * Widget assignments - Home Page
     */
    protected function ttHomePage($assignment){
        switch ($assignment->homePage) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                if(is_front_page()){ $result = TRUE; }
                break;
                
            case 2: // Exclude
                $result = TRUE;
                if(is_front_page()){ $result = FALSE; }
                break;
        }
        return $result;
    }
    
    /**
     * Widget assignments - Menu Items
     */
    protected function ttMenuItems($assignment){
        
        $result = -1;
        
        // If wrong input array - Ignore
        if(!is_array($assignment->menuItemsVal)){
            $result = -1; 
            return $result; 
        }
        
        // Current URL
        $curUrl = "";
        if( !isset($_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] != 'on') ){
            $curUrl = 'http://'.$_SERVER["SERVER_NAME"];
        }else{
            $curUrl = 'https://'.$_SERVER["SERVER_NAME"];
        }
        $curUrl .= $_SERVER["REQUEST_URI"];
        
        switch ($assignment->menuItems) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                if(!$assignment->menuItemsVal){ $result = -1; return $result; } // If no menu items - ignore
                
                $menu_items_arr = array();// Assignments menu items
                foreach ($assignment->menuItemsVal as $val) {
                    if($val == "") { continue; }
                    list($menuSlug, $menuItemID) = explode("+", $val);
                    $menu_items = wp_get_nav_menu_items($menuSlug);
                    $menu_item = wp_filter_object_list($menu_items, array('ID' => $menuItemID));
                    $menu_items_arr[] = reset($menu_item);
                }

                foreach ($menu_items_arr as $mItem) {
                    if ($curUrl == $mItem->url){
                        $result = TRUE;
                        return $result;
                    }
                }
                break;
                
            case 2: // Exclude
                $result = TRUE;
                if(!$assignment->menuItemsVal){ $result = -1; return $result; } // If no menu items - ignore
                
                $menu_items_arr = array();// Assignments menu items
                
                foreach ($assignment->menuItemsVal as $val) {
                    list($menuSlug, $menuItemID) = explode("+", $val);
                    $menu_items = wp_get_nav_menu_items($menuSlug);
                    $menu_item = wp_filter_object_list($menu_items, array('ID' => $menuItemID));
                    $menu_items_arr[] = reset($menu_item);
                }

                foreach ($menu_items_arr as $mItem) {
                    if ($curUrl == $mItem->url){
                        $result = FALSE;
                        return $result;
                    }
                }
                break;
        }
        return $result;
    }
    
    /**
     * Widget assignments - Date & Time
     */
    protected function ttDateTime($assignment){
        
        // If no dateTime - ignore
        if($assignment->dateTimeStart == "" or $assignment->dateTimeEnd == ""){
            $result = -1;
            return $result;
        }      
        
        $time = time();
        $s = strtotime($assignment->dateTimeStart) - $time;
        $e = strtotime($assignment->dateTimeEnd) - $time;
        
        switch ($assignment->dateTime) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                if($s <= 0 AND $e >= 0 ) { $result = TRUE; }
                break;
                
            case 2: // Exclude
                $result = TRUE;
                if($s <= 0 AND $e >= 0 ) { $result = FALSE; }
                break;
        }
        return $result;
    }
    
    /**
     * Widget assignments - User Roles
     */
    protected function ttUserRoles($assignment){
        
        // If wrong input array - Ignore
        if(!is_array($assignment->userRolesVal)){
            $result = -1; 
            return $result; 
        }
        
        switch ($assignment->userRoles) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                $user = wp_get_current_user();
                foreach ($user->roles as $role) {
                    if( in_array($role, $assignment->userRolesVal) ){ $result = TRUE; }
                }
                break;
                
            case 2: // Exclude
                $result = TRUE;
                $user = wp_get_current_user();
                foreach ($user->roles as $role) {
                    if( in_array($role, $assignment->userRolesVal) ){ $result = FALSE; }
                }
                break;
        }
        return $result;
    }
    
    /**
     * Widget assignments - URL
     */
    protected function ttURL($assignment){
        
        // Current URL
        $curUrl = "";
        if( !isset($_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] != 'on') ){
            $curUrl = 'http://'.$_SERVER["SERVER_NAME"];
        }else{
            $curUrl = 'https://'.$_SERVER["SERVER_NAME"];
        }
        $curUrl .= $_SERVER["REQUEST_URI"];
        
        $URLVal = (array)preg_split('/\r\n|[\r\n]/', $assignment->URLVal);
        $URLVal = array_filter($URLVal, function($value) { if(trim($value) != ""){ return $value; } });
        
        switch ($assignment->URL) {
            case 0: // Ignore
                $result = -1;
                break;
            
            case 1: // Include
                $result = FALSE;
                if(count($URLVal)==0){ $result = FALSE; } // If no URLS to include - hide widget
                foreach($URLVal as $u){
                    if (strpos($curUrl, $u) !== false){
                        $result = TRUE;
                    }
                }
                
                break;
                
            case 2: // Exclude
                $result = TRUE;
                if(count($URLVal)==0){ $result = TRUE; } // If no URLS to exclude - show widget
                foreach($URLVal as $u){
                    if (strpos($curUrl, $u) !== false){
                        $result = FALSE;
                    }
                }
                break;
        }
        return $result;
    }
    
    /**
     * Widget assignments - Matching Method
     */
    protected function ttMatchingMethod($assignment, $wordPressContent, $homePage, $menuItems, $dateTime, $userRoles, $URL){
        
        $arrCond = array();// Add condition values
        
        // Ignore if -1 
        if($wordPressContent!=-1){$arrCond[]=$wordPressContent;}
        if($homePage!=-1){$arrCond[]=$homePage;}
        if($menuItems!=-1){$arrCond[]=$menuItems;}
        if($dateTime!=-1){$arrCond[]=$dateTime;}
        if($userRoles!=-1){$arrCond[]=$userRoles;}
        if($URL!=-1){$arrCond[]=$URL;}
        
        if(!count($arrCond)){ $arrCond[] = TRUE; } // If all rules are Ignore - Show widget
        
        // Initialization
        $anytrue = false;
        $alltrue = true;

        // Processing
        foreach($arrCond as $v){
            $anytrue |= $v;
            $alltrue &= $v;
        }
        
        // Result
        if($alltrue){
            // All elements are TRUE
            $result = TRUE;
        }elseif(!$anytrue){
            // All elements are FALSE
            $result = FALSE;
        }else{
            // Mixed values
            if($assignment->matchingMethod == 0){ // ALL RULES
                $result = FALSE;
            }else{ // ANY OF RULES
                $result = TRUE;
            }
        }

        return $result;
    }

    /**
     * Checks if a widget should be displayed
     *
     * @param stdClass $widget
     * @return boolean
     */
    protected function display($widget){
        
        // If first run, ignore all - Show widget Everywhere
        if(is_array($this['config']->get("widgets.{$widget->id}.assignment"))){ return true; }
        
        // Get assignments for widget
        $assignment = json_decode( str_replace('|', '"', $this['config']->get("widgets.{$widget->id}.assignment")) );
        
        if(!$assignment) { return true; }// If no settings - Show widget Everywhere
        
        /** Same as other widget */
        $currMirrorWidget = 0;
        if($assignment->mirrorWidget > 0){
            $mirrorWidgetAssignment = json_decode( str_replace('|', '"', $this['config']->get("widgets.{$assignment->widgetID}.assignment")) );
            if(!$mirrorWidgetAssignment) { return true; }// If no mirror Widget settings - Show widget Everywhere
            $currMirrorWidget = $assignment->mirrorWidget; // Save for future checks
            $assignment = $mirrorWidgetAssignment; // Replace
            
            // If Mirror by themselves
            if($widget->id == $assignment->widgetID){
                return true; // Show widget Everywhere
            }
        }
        
        /** WordPress Content */
        $wordPressContent = $this->ttWordPressContent($assignment);
        
        /** Home Page */
        $homePage = $this->ttHomePage($assignment);
        
        /** Menu Items */
        $menuItems = $this->ttMenuItems($assignment);
        
        /** Date & Time */
        $dateTime = $this->ttDateTime($assignment);
        
        /** User Roles */
        $userRoles = $this->ttUserRoles($assignment);
        
        /** URL */
        $URL = $this->ttURL($assignment);
        
        /** Matching Method */
        $result = $this->ttMatchingMethod($assignment, $wordPressContent, $homePage, $menuItems, $dateTime, $userRoles, $URL);
        
        /** Opposite to other widget */
        if($currMirrorWidget == 2 ){
            $result = !$result;
        }
        
        return $result;
    }

    /**
     * Retrieve module objects for a position
     *
     * @param  string $position
     * @return array
     */
    public function load($position)
    {
        if (!isset($this->loaded[$position])) {

            $widgets = array();

            if (!function_exists('dynamic_sidebar')) {
                return $widgets;
            }

            // get widgets
            ob_start();
            $result = dynamic_sidebar($position);
            $position_output = ob_get_clean();

            if ($position == 'menu') {
                $result = true;
                $position_output = $this['template']->render('menu').((string) $position_output);
            }

            // handle preview
            if (!$result && $this['system']->isPreview($position)) {
                $result = true;
                $position_output = $this['template']->render('preview', compact('position'));
            }

            if (!$result) {
                return $widgets;
            }

            $parts   = explode('<!--widget-end-->', $position_output);

            //prepare widgets
            foreach ($parts as $part) {

                if (!preg_match('/<!--widget-([a-z0-9-_]+)(?:<([^>]*)>)?-->/smU', $part, $matches)) continue;

                //monster-widget
                //monster-widget-placeholder-1...
                if(strripos($matches[1], "monster-widget") !== FALSE ) { 
                    $widget = new \stdClass;
                    $widget->id = $matches[1];
                    $widget->name = "Monster";
                    $widget->classname = "monster";
                    $widget->description = "Test multiple widgets at the same time.";
                    $widget->type = "monster";
                    $widget->params = array ();
                    $widget->display = TRUE;
                }else{
                    $widget  = $this->get($matches[1]);
                }

                $suffix  = isset($matches[2]) ? $matches[2] : '';
                $content = str_replace($matches[0], '', $part);
                $title   = '';

                // display it ?
                if (!($widget && $widget->display)) continue;

                // has title ?
                if (preg_match('/<!--title-start-->(.*)<!--title-end-->/smU', $content, $matches)) {
                    $content = str_replace($matches[0], '', $content);
                    $title = $matches[1];
                }

                $widget->title     = strip_tags($title);
                $widget->showtitle = $this['config']->get("widgets.{$widget->id}.title", 1);
                $widget->content   = $content;
                $widget->position  = $position;
                $widget->menu      = $widget->type == 'nav_menu';
                $widget->suffix    = $suffix;

                $widgets[] = $widget;
            }
            $this->loaded[$position] = $widgets;
        }
        return $this->loaded[$position];
    }
}
