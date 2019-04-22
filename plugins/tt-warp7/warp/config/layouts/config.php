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

// get config
$config = $this['config'];

// get config xml
$xml = $this['dom']->create($this['path']->path('theme:config.xml'), 'xml');

// render nav & main
$nav  = array();
$main = array();

foreach ($xml->find('fields') as $fields) {

	// init vars
    $name    = $fields->attr('name');
    $icon    = $fields->attr('icon');

    $content = $this->render('config:layouts/fields', array('config' => $config, 'fields' => $fields, 'values' => $config, 'prefix' => '', 'attr' => array()));

	$nav[]  = sprintf('<li><a href=""><i class="%s"></i> %s</a></li>', $icon, $name);
	$main[] = sprintf('<div class="uk-form tm-form"><h1 class="uk-article-title">%s</h1>%s</div>', $name, $content);
}

?>

<div id="config" class="warp">

	<?php if ($messages = $this->get('messages')) : ?>
		<div class="uk-alert uk-alert-large uk-alert-warning" data-uk-alert>
			<h2>Notice</h2>
			<?php echo implode("<br>", $messages); ?>
		</div>
	<?php endif; ?>

	<div class="tm-content">

		<div class="tm-sidebar">

			<div class="tm-sidebar-logo uk-panel"></div>

			<div class="uk-panel">
				<ul class="uk-nav uk-nav-side">
					<?php echo implode("\n", $nav); ?>
				</ul>
			</div>

		</div>

		<main class="tm-main">
			<?php echo implode("\n", $main); ?>
		</main>

	</div>

</div>
