<div class="uk-grid">
<div class="uk-container-center uk-width-medium-6-10 uk-width-large-6-10">
<ul class="category-module uk-grid uk-grid-collapse"  data-uk-grid-margin="">

    <?php  while ($q->have_posts()) {
            $q->the_post(); 
    ?>
        <li class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2 uk-flex uk-flex-center">
            <figure class="uk-overlay view2 view-eighth2 section-box">
        
             <?php
                    $intro_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                  
                    ?>
                    <div class="uk-cover-background uk-position-relative" style="background-image: url(<?php echo $intro_img; ?>); height: 400px; position: relative;">
                        <img class="uk-invisible" src="<?php echo $intro_img; ?>" width="600" height="400" alt="<?php //echo $item->title; ?>" />
                        <div class="all-hover-bottom"><a href="/sign-up" style="text-decoration: none;"><span class="text-title-bottom">sign up</span></a></div>
                        <div class="out-box">
                            <div class="triangle-box-inner"><span class="babos"><?php the_excerpt(); ?></span></div>
                            <div class="triangle-bottomleft"></div>
                        </div>
                    </div>  
            
    
  <figcaption class="uk-overlay-panel-news uk-overlay-background-all-classes uk-overlay-center mask2">
    
                    <p style="font-size: 24px; text-align: left; padding-top: 45px; padding-left: 40px; padding-right: 30px; text-transform: uppercase; line-height: 1.5;  font-weight: bold;">
                        <span  style="color: white;">
                            <?php echo $post->post_title; ?>
                        </span>
                    </p>

                    <p class="tt-content-all-classes">
                        <?php echo the_content(); ?>
                    </p>
                   
                <p style="margin-top: 1%; text-align: left; padding-left: 40px; text-transform: uppercase; font-size: 14px; color: #ffffff;">
                
                 TRAINER <span class="tt-autor-classes"><?php the_author(); ?></span>
                
                 </p>
    
  </figcaption>
    
</figure>	
              
        </li>
<?php } ?>

</ul>
</div>

</div>