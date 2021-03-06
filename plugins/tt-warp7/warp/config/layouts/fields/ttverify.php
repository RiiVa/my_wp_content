<?php
/**
 * Torbara Maxx-Fitness Theme for WordPress, exclusively on Envato Market: http://themeforest.net/user/torbara
 * @encoding     UTF-8
 * @version      1.0
 * @copyright    Copyright (C) 2015 Torbara (http://torbara.com). All rights reserved.
 * @license      GNU General Public License version 2 or later, see http://www.gnu.org/licenses/gpl-2.0.html
 * @author       Alexandr Khmelnytsky (support@torbara.com)
 */

$html = array();

//Create checksum file
if(isset($_GET['checksums'])){
    if(@$_GET['checksums']=="update"){ $this['checksum']->create(get_template_directory(), $filename = 'checksums'); }
}

if (($checksums = $this['path']->path('theme:checksums')) && filesize($checksums)) {
	$this['checksum']->verify($this['path']->path('theme:'), $log);

	if ($count = count($log)) {

		$html[] = '<p>Some template files have been modified.</p>';
		$html[] = '<div class="uk-scrollable-box tm-width">';
		$html[] = '<ul class="uk-list uk-text-small uk-text-info">';
		foreach (array('modified', 'missing') as $type) {
			if (isset($log[$type])) {
				foreach ($log[$type] as $file) {
					$html[] = '<li class="'.$type.'">'.$file.($type == 'missing' ? ' (missing)' : null).'</li>';
				}
			}
		}
		$html[] = '</ul>';
		$html[] = '</div>';
		$html[] = '<p>To prevent modified files when using FTP, make sure the transfer mode is set to binary.</p>';

	} else {
		$html[] = '<p>Verification successful, no file modifications detected.</p>';
	}

} else {
	$html[] = '<p class="uk-text-danger">Checksum file is missing! Your template is maybe compromised.</p>';
}

// Current URL
$curUrl = "";
if( !isset($_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] != 'on') ){
    $curUrl = 'http://'.$_SERVER["SERVER_NAME"];
}else{
    $curUrl = 'https://'.$_SERVER["SERVER_NAME"];
}
$curUrl .= $_SERVER["REQUEST_URI"];
$curUrl = str_replace("&checksums=update", "", $curUrl);

//href="'.$curUrl.'&checksums=update"
$html[] = '<span ondblclick="if(confirm(\'Reset Checksums?\')){ window.location.href = \''.$curUrl.'&checksums=update\';}" style="position: absolute; cursor: cell; right: 7px; margin-top: -33px; width: 7px; height: 7px; background: #cccccc; border-radius: 5px;"></span>';

echo implode("\n", $html);
