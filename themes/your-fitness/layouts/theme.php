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
* Generate 3-column layout
*/
$config          = $this['config'];
$sidebars        = $config->get('sidebars', array());
$columns         = array('main' => array('width' => 60, 'alignment' => 'right'));
$sidebar_classes = '';

$gcf = function($a, $b = 60) use(&$gcf) {
return (int) ($b > 0 ? $gcf($b, $a % $b) : $a);
};

$fraction = function($nominator, $divider = 60) use(&$gcf) {
return $nominator / ($factor = $gcf($nominator, $divider)) .'-'. $divider / $factor;
};

foreach ($sidebars as $name => $sidebar) {
if (!$this['widgets']->count($name)) {
unset($sidebars[$name]);
continue;
}

$columns['main']['width'] -= @$sidebar['width'];
$sidebar_classes .= " tm-{$name}-".@$sidebar['alignment'];
}

if ($count = count($sidebars)) {
$sidebar_classes .= ' tm-sidebars-'.$count;
}

$columns += $sidebars;
foreach ($columns as $name => &$column) {

$column['width']     = isset($column['width']) ? $column['width'] : 0;
$column['alignment'] = isset($column['alignment']) ? $column['alignment'] : 'left';

$shift = 0;
foreach (($column['alignment'] == 'left' ? $columns : array_reverse($columns, true)) as $n => $col) {
if ($name == $n) break;
if (@$col['alignment'] != $column['alignment']) {
$shift += @$col['width'];
}
}
$column['class'] = sprintf('tm-%s uk-width-medium-%s%s', $name, $fraction($column['width']), $shift ? ' uk-'.($column['alignment'] == 'left' ? 'pull' : 'push').'-'.$fraction($shift) : '');
}

/*
* Add grid classes
*/
$positions = array_keys($config->get('grid', array()));
$displays  = array('small', 'medium', 'large');
$grid_classes = array();
$display_classes = array();
foreach ($positions as $position) {

$grid_classes[$position] = array();
$grid_classes[$position][] = "tm-{$position} uk-grid";
$display_classes[$position][] = '';

if ($this['config']->get("grid.{$position}.divider", false)) {
$grid_classes[$position][] = 'uk-grid-divider';
}

$widgets = $this['widgets']->load($position);

foreach($displays as $display) {
if (!array_filter($widgets, function($widget) use ($config, $display) { return (bool) $config->get("widgets.{$widget->id}.display.{$display}", true); })) {
$display_classes[$position][] = "uk-hidden-{$display}";
}
}

$display_classes[$position] = implode(" ", $display_classes[$position]);
$grid_classes[$position] = implode(" ", $grid_classes[$position]);

}

/*
* Add body classes
*/

$body_classes  = $sidebar_classes;
$body_classes .= $this['system']->isBlog() ? ' tm-isblog' : ' tm-noblog';
$body_classes .= ' '.$config->get('page_class');

$config->set('body_classes', trim($body_classes));

/*
* Add social buttons
*/

$body_config = array();
$body_config['twitter']  = (int) $config->get('twitter', 0);
$body_config['plusone']  = (int) $config->get('plusone', 0);
$body_config['facebook'] = (int) $config->get('facebook', 0);
$body_config['style']    = $config->get('style');

$config->set('body_config', json_encode($body_config));

/*
* Add assets
*/

// add css
$this['asset']->addFile('css', 'css:theme.css');
$this['asset']->addFile('css', 'css:custom.css');

// add scripts

if (isset($head)) {
$this['template']->set('head', implode("\n", $head));
}

/*
* =====================================================================================================================
*/

class YourFitness_Add_Positions{
public $menu_alias;         // Slug menu


/*
* Add positions array
*/
function yourfitness_array_positions($top){
$argv = explode(',', $top);

foreach ($argv as $pos){
$top = str_replace(" ", "", $pos);
$this->yourfitness_top_position($top);
}
}

function yourfitness_top_position($top){

global $warp;
$menu_alias = $this->menu_alias; // Slug menu


/*
* Option full width
*/
if ($warp['config']->get('grid.' . $top . '.fullwidth') == 1) {
$full_width = "tm-full-width";
}else{
$full_width = "";
}


/*
* Option padding top and bottom
*/
$section_padding = $warp['config']->get('grid.' . $top . '.section_padding');


/*
* Option collapse
*/
if ($warp['config']->get('grid.' . $top . '.collapse') == 1) {
$collapse = "data-uk-grid-margin";
} else {
$collapse = "";
}


/*
* File exists
*/
if (!function_exists('get_home_path')) {
load_template(ABSPATH . 'wp-admin/includes/file.php', true);
}

$home_path = get_home_path();
$path_background = $home_path . 'wp-content/uploads/' . $menu_alias . "/" . $top . ".jpg";

$site_url = get_site_url();
$url_background = $site_url . '/wp-content/uploads/' . $menu_alias . "/" . $top . ".jpg";


/*
* Add positions site
*/
if ($warp['widgets']->count($top)) {
echo "<div ";
if (file_exists($path_background) and $warp['config']->get('grid.' . $top . '.section_border') == null) {
echo ' class="' . esc_attr($top) . '-box ';
echo esc_attr($full_width) . ' ';
echo esc_attr($section_padding);
echo '" ' . 'st' . 'y' . 'le="background-repeat: no-repeat; background-position: center top; background-size: cover; background-image:url(' . esc_url($url_background) . ')"';
} else {
echo ' class="' . esc_attr($top) . '-box ';
echo esc_attr($full_width) . ' ';
echo $warp['config']->get('grid.' . esc_attr($top) . '.section_border') . ' ';
echo esc_attr($section_padding) . '" ';
}

if ((is_numeric($menu_alias) or is_single($menu_alias)) and $top == 'bottom-b') {
echo ' class="' . esc_attr($top) . '-box ';
echo esc_attr($full_width) . ' ';
echo esc_attr($section_padding) . '" ';
echo 'st' . 'y' . 'le="background-repeat: no-repeat; background-position: center top; background-size: cover; background-image:url(' . esc_url($site_url) . '/wp-content/uploads/blog/bottom-b.jpg' . ')"';
} elseif ((is_category($menu_alias) or is_single($menu_alias)) and $top == 'bottom-b') {
echo ' class="' . esc_attr($top) . '-box ';
echo esc_attr($full_width) . ' ';
echo esc_attr($section_padding) . '" ';
echo 'st' . 'y' . 'le="background-repeat: no-repeat; background-position: center top; background-size: cover; background-image:url(' . esc_url($site_url) . '/wp-content/uploads/blog/bottom-b.jpg' . ')"';
}elseif ( is_author() and $top == 'bottom-b' ) {
echo ' class="' . esc_attr($top) . '-box ';
echo esc_attr($full_width) . ' ';
echo esc_attr($section_padding) . '" ';
echo 'st' . 'y' . 'le="background-repeat: no-repeat; background-position: center top; background-size: cover; background-image:url(' . esc_url($site_url) . '/wp-content/uploads/blog/bottom-b.jpg' . ')"';
}
echo ">";
echo '<div class="uk-container uk-container-center">';
    echo '<section id="tm-' . esc_attr($top) . '" class = "tm-' . esc_attr($top) . ' uk-grid" ';
    echo "data-uk-grid-match=\"{target:'> div > .uk-panel'}\" data-uk-grid-margin " . esc_attr($collapse) . " >";
    echo $warp['widgets']->render(esc_attr($top), array('layout' => $warp['config']->get('grid.' . esc_attr($top) . '.layout')));
    echo "</section></div></div>";
}
}
}

/*
* Pages slug
*/
$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_path = parse_url($url, PHP_URL_PATH);
$menu_alias = pathinfo($url_path, PATHINFO_BASENAME);

if ($menu_alias == null){
$menu_alias = "home";
}

/*
* Create object
*/
$AddPositions = new YourFitness_Add_Positions();
$AddPositions->menu_alias = $menu_alias;

/*
* =====================================================================================================================
*/
?>

<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>
    <?php echo $this['template']->render('head'); ?>
    <?php wp_head(); ?>
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">
<div class="uk-container uk-container-center">

    <?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
        <div class="tm-toolbar uk-clearfix uk-hidden-small">

            <?php if ($this['widgets']->count('toolbar-l')) : ?>
                <div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('toolbar-r')) : ?>
                <div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
            <?php endif; ?>

        </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('headerbar')) : ?>
        <div class="tm-headerbar uk-clearfix uk-hidden-small">
            <?php echo $this['widgets']->render('headerbar'); ?>
        </div>
    <?php endif; ?>
</div>


<div class="<?php  if( $this['config']->get('indent_menu', true)  == 1){ echo "tt-menu-margin-top-none"; }else{ echo "tt-menu-margin-top";} ?>">
    <div class="uk-container uk-container-center uk-position-relative tt-padding-menu">

        <?php if ($this['widgets']->count('logo')) { ?>
            <a class="tm-logo"
               href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
        <?php } else { ?>
            <a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><span class="tt-logo"></span></a>
        <?php } ?>

        <?php if ($this['widgets']->count('menu + search')) : ?>

            <nav class="tm-navbar uk-navbar tt-menu-blog tt-navbar">
                <?php if ($this['widgets']->count('menu')) : ?>
                    <?php echo $this['widgets']->render('menu'); ?>
                <?php endif; ?>
                <?php if ($this['widgets']->count('offcanvas')) : ?>
                    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                <?php endif; ?>
                <?php if ($this['widgets']->count('search')) : ?>
                    <div class="uk-navbar-flip">
                        <div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($this['widgets']->count('logo-small')) : ?>
                    <div class="uk-navbar-content uk-navbar-center uk-visible-small">
                        <a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>">
                            <?php echo $this['widgets']->render('logo-small'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </div>
</div>
<?php if ($this['widgets']->count('breadcrumbs-yourfitness')) : ?>

    <div class="tt-breadcrumbs-yourfitness tm-full-width">
        <?php echo $this['widgets']->render('breadcrumbs-yourfitness'); ?>
    </div>

<?php endif;

/*
* Add top positions site
*/
$AddPositions->yourfitness_array_positions('top-a, top-b, top-c, top-d, top-e, top-f, top-g, top-h, top-i, top-j');?>

<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>

    <?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b')) {
        echo '<div class="uk-container uk-container-center">';
    }else{
        echo "<div>";
    }
    ?>
        <div class="tt-middle uk-grid" data-uk-grid-match data-uk-grid-margin>
            <?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
                <div class="<?php echo esc_attr($columns['main']['class']); ?>">

                    <?php if ($this['widgets']->count('main-top')) : ?>
                        <section class="<?php echo esc_attr($grid_classes['main-top']); echo esc_attr($display_classes['main-top']); echo " ".esc_attr(implode(" ", $classes['block.main-top'])); ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
                            <?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?>
                        </section>
                    <?php endif; ?>

                    <?php if ($this['config']->get('system_output', true)) : ?>
                        <main id="tm-content" class="tm-content">
                            <?php if ($this['widgets']->count('breadcrumbs')) : ?>
                                <?php echo $this['widgets']->render('breadcrumbs'); ?>
                            <?php endif; ?>

                            <?php echo $this['template']->render('content'); ?>
                        </main>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('main-bottom')) : ?>
                        <section class="<?php echo esc_attr($grid_classes['main-bottom']); echo esc_attr($display_classes['main-bottom']); echo " ".esc_attr(implode(" ", $classes['block.main-bottom'])); ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
                            <?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?>
                        </section>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php foreach($columns as $name => &$column) : ?>
                <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
                    <aside class="<?php echo esc_attr($column['class']); ?>" <?php if (!$this['config']->get('system_output', true)){ echo 'style="left:auto;"';} ?>><?php echo $this['widgets']->render($name) ?></aside>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
<?php endif; ?>
<?php
/*
* Add bottom positions site
*/
$AddPositions->yourfitness_array_positions('bottom-a, bottom-b');
?>
<div class="uk-container uk-container-center">
    <footer id="tm-footer" class="tm-footer" >
        <?php if ($this['widgets']->count('footer')) { ?>
            <?php echo $this['widgets']->render('footer'); ?>
        <?php }else{  ?>
            <div class="tt-footer-created"><?php $this->output('branding'); ?></div>
        <?php } ?>
    </footer>

    <?php if ($this['config']->get('totop_scroller', true)) : ?>
        <a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
    <?php endif; ?>

</div>

<?php echo $this->render('footer'); ?>

<?php if ($this['widgets']->count('offcanvas')) : ?>
    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
    </div>
<?php endif; ?>
</body>
</html>