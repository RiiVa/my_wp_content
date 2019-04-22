<div class="uk-grid uk-flex-center" data-uk-slider="{small: <?php echo $instance['display_elements_small']; ?>, medium: <?php echo $instance['display_elements_medium']; ?>, large: <?php echo $instance['display_elements_large']; ?>, animation: '<?php echo $instance['animation']; ?>', duration: 400, autoplay: 'true'}">
    
    <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10 box-classes">
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
    </div>
        
        <div class="uk-grid-width-small-6-10 uk-width-medium-6-10 uk-grid-width-large-6-10 uk-grid-width-xlarge-6-10 box-classes hover-img-classes">
    <div class="uk-slider-container">
        <ul class="uk-slider uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-xlarge-1-2">
          <?php 
          
            while ($q->have_posts()) {
            $q->the_post();
            ?>
            
                <li class="uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1 uk-cover-background" style="background-image: url(<?php echo $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>);">
                <a href="/sign-up/" style="text-transform: uppercase; color: #303030;">
                <figure class="tt-overlay hover-img-classes">
                <img src="<?php echo $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" class="uk-invisible" width="600" height="400" alt="Image"/>
                  <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">
                    <h3 class="tt-title-classes-home"><?php echo the_content(); ?></h3>
                  </figcaption>
                </figure>
                </a>
                </li>
           <?php } ?>
           
        </ul>
    </div> 
        </div> 
         <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10 box-classes">
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
    </div>
</div>      