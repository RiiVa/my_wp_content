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

// add css
$this['asset']->addFile('css', 'css:theme.css');

?>

<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>" class="uk-height-1-1 tm-error">

<head>
<?php wp_head(); ?>
<?php echo $this->render('head', compact('error', 'title')); ?>
</head>

<body class="uk-height-1-1 uk-vertical-align uk-text-center body-background-error">
    
	<div class="uk-width-large-1-1 uk-vertical-align-middle tt-error-height">

        <div class="logo-error"></div>
        
        
    		<h1 class="tm-error-headline"><?php echo esc_attr($error); ?></h1>
    		<h2 class="uk-h3 uk-text-muted"><?php echo esc_attr($title); ?></h2>

    <div class="uk-text-center uk-flex uk-flex-center uk-container-center feautures-conteiner uk-width-large-3-10 padding-bot"> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><button class="btn btn-1 btn-1e"><?php echo esc_html__('back to homepage', 'your-fitness'); ?></button></a>
    </div>
    
    <div class="uk-flex uk-container-center  uk-width-large-1-10 uk-width-small-2-10 uk-width-medium-2-10" >	
    <div class="uk-width-large-1-3 uk-width-small-1-3 uk-width-medium-1-3">
      <a href="" target="_parent"><div class="facebook-square"></div></a>
    </div>
    <div class="uk-width-large-1-3 uk-width-small-1-3 uk-width-medium-1-3">
      <a href="" target="_parent"><div class="twitter-square"></div></a>
  	</div>
  	<div class="uk-width-large-1-3 uk-width-small-1-3 uk-width-medium-1-3">
      <a href="" target="_parent"><div class="youtube-square"></div></a>
  	</div>
</div>
        
	</div>

</body>
</html>