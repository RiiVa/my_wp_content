<div class="uk-grid uk-flex-center" data-uk-slider="{small: <?php echo $instance['display_elements_small']; ?>, medium: <?php echo $instance['display_elements_medium']; ?>, large: <?php echo $instance['display_elements_large']; ?>, animation: '<?php echo $instance['animation']; ?>', duration: 400, autoplay: 'true'}" >
    
    <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10" >
        <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slider-item="previous"></a>
    </div>
        
    <div class="uk-grid-width-small-1-1 uk-width-medium-6-10 uk-grid-width-large-6-10 uk-grid-width-xlarge-6-10">
        <div class="uk-slider-container uk-grid-width-small-1-1">
            <ul class="uk-slider uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1">
               <?php 
               
               while ($q->have_posts()) {
                    $q->the_post(); ?>
                        <li class="uk-flex uk-flex-center"><?php echo the_content(); ?></li>     
               <?php } ?> 
            </ul>
        </div> 
    </div> 
    
    <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10">
                <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slider-item="next"></a>
    </div>
</div>