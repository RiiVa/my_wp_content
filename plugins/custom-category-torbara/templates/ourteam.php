<div class="uk-grid uk-flex-center box-classes-color" data-uk-slider="{infinite: true, autoplay: true, autoplayInterval: '7000'}" >
    
    <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10">
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
    </div>
        
        <div class="uk-grid-width-small-1-1 uk-width-medium-6-10 uk-grid-width-large-6-10 uk-grid-width-xlarge-6-10">
    <div class="uk-slider-container uk-grid-width-small-1-1">
        <ul class="uk-slider uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-xlarge-1-4">
           <?php while ($q->have_posts()) {
                    $q->the_post(); ?>
                    <li class="uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1">
                    
                        <figure class="uk-overlay">
                          <div class="bw uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1">
                            <div>
                              <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" alt="Image"/>
                            </div>
                              <div class="uk-overlay-panel-our-team uk-overlay-background-our-team uk-overlay-bottom">
                                <h3 style="text-transform: uppercase; color: #ffffff;  font-size: 18px; font-weight: bold;"><?php echo $post->post_title; ?></h3>
                              </div>
                          </div>
                        </figure>	
           
                    </li>     
           <?php } ?> 
        </ul>
    </div> 
        </div> 
    <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden-small uk-width-medium-2-10 uk-grid-width-large-2-10 uk-grid-width-xlarge-2-10">
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
    </div>
</div>