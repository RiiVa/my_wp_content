<div class="uk-container uk-container-center">
<ul class="uk-grid uk-grid-collapse category-module"  data-uk-grid-margin="">

    <?php while ($q->have_posts()) {
                    $q->the_post();  ?>
        <li class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2 uk-flex uk-flex-center">
        
            
            <figure class="uk-overlay view view-eighth">
        
             <?php
                    $intro_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                    
                    ?>
                    <div class="uk-cover-background uk-position-relative" style="background-image: url(<?php echo $intro_img; ?>); height: 400px;">
                        <img class="uk-invisible" src="<?php echo $intro_img; ?>" width="600" height="400" alt="<?php echo $post->post_title; ?>" />
                    </div>  
       
    
  <figcaption class="uk-overlay-panel-news uk-overlay-background-news uk-overlay-center mask">
    
                    <p style="font-size: 24px; text-align: left; padding-top: 40px; padding-left: 30px; padding-right: 30px; text-transform: uppercase; line-height: 1.5;  font-weight: bold;">
                        <a  href="<?php echo get_post_permalink(); ?>" style="color: white;">
                            <?php echo $post->post_title; ?>
                        </a>
                    </p>
                   
                    <p style="font-size: 14px; font-weight: lighter; text-transform: uppercase; text-align: left; padding-left: 30px; color: white; font-family: roboto;">
                        <img src="/wp-content/themes/your-fitness/images/icon/calendar-white.png" style="margin-right: 5px; margin-top: 2px; float: left;" alt="calendar-white.png"/>
                        <?php the_date('d M, Y'); ?>  
                        <span style="color: white;">                  
                         BY <?php the_author(); ?>
                        </span>
                    </p>

                    <p class="tt-shome-box">
                     <?php the_excerpt(); ?>
                    </p>

                   
                <p style="padding-top: 5px;  text-transform: uppercase; font-size: 14px;  text-align: left;">
                <a href="<?php echo get_post_permalink(); ?>" 
                style="font-family: roboto; 
                       color: white;
                       border: 1px solid white; 
                       border-radius: 3px; 
                       padding-top: 10px;
                       padding-bottom: 10px;
                       padding-left: 20px;
                       padding-right: 20px;
                       margin-left: 30px;
                       display: inline-block;
                       text-decoration: none;">Read more</a>
                 </p>
    
  </figcaption>
    
</figure>	


        </li>
<?php } ?>

</ul>
</div>
