<div class="uk-grid" style="margin-top: 50px; margin-bottom: 100px;">
    <?php while ($q->have_posts()) {
            $q->the_post(); ?>
        
            
            <div class="uk-width-small-1-2 uk-width-medium-1-4 bw" style="position: relative;  margin-top: 35px;">
                <div class="uk-panel">
                    <?php
                    $intro_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                    if ($intro_img == "") {
                        $intro_img = "/templates/your-fitness/images/noimg/600x400.jpg";
                    }
                    ?>
                    <div class="uk-cover-background" style="background-image: url(<?php echo $intro_img; ?>);">
                        <img class="uk-invisible" src="<?php echo $intro_img; ?>"  width="600" height="400" alt="<?php echo $post->post_title; ?>"/>
                    </div>  
       
                    
                            <div class="trainers-hover">
                           
                                     <a href="<?php echo $post->guid; ?>" style="color: white; text-decoration: none">
                                            <?php echo $post->post_title; ?>
                                     </a>
                                    
                                    <div class="show-intro">
                                        <?php the_content(); ?>
                                            <a href="<?php echo $post->guid; ?>" style="color: white;
                                                                                        font-size: 14px;
                                                                                        margin-top: 50px;
                                                                                        display: inline-block;
                                                                                        border: 1px solid white;
                                                                                        padding: 10px 20px;
                                                                                        border-radius: 2px;
                                                                                        text-decoration: none;">
                                            Read More
                                     </a>
                                    </div>
                           </div>
                   
            </div>
    </div> 
	

<?php }; ?>
</div>
       