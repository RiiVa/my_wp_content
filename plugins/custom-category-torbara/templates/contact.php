<div class="uk-grid uk-flex-center" data-uk-slider="{infinite: true, autoplay: true, autoplayInterval: '7000'}" >
            
    <div class="uk-grid-width-small-1-1 uk-width-medium-1-1 uk-grid-width-large-1-1 uk-grid-width-xlarge-1-1 hover-img-classes">
        <div class="uk-slider-container uk-grid-width-small-1-1">
            <ul class="uk-slider uk-grid-width-small-1-4 uk-grid-width-medium-1-4 uk-grid-width-xlarge-1-4">
               <?php while ($q->have_posts()) {
                     $q->the_post(); ?>
                        <li class="uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1">
                            <figure class="uk-overlay">
                                  <div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-1 uk-grid-width-xlarge-1-1">
                                      <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" style="width: 100%;" alt="" />
                                      <div class="uk-overlay-panel-our-team uk-overlay-background-our-team uk-overlay-bottom">
                                        <h3 style="text-transform: uppercase; color: #ffffff;  font-size: 24px; font-weight: bold; text-align: right; padding-right: 20px;"><?php echo $post->post_title; ?></h3>
                                      </div>
                                  </div>
                            </figure>	
                        </li>     
               <?php } ?> 
            </ul>
        </div> 
    </div>
        
</div>