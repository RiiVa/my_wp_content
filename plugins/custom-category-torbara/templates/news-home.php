<ul class="category-module uk-grid"  data-uk-grid-margin="">

    <?php while ($q->have_posts()) {
                    $q->the_post(); ?>
        <li class="uk-width-medium-1-1 line-opacity">

            <div class="uk-grid uk-container-center uk-grid-width-small-2-10 uk-width-medium-6-10 uk-grid-width-large-6-10 uk-grid-width-xlarge-6-10"
                style="padding-left: 7px;">
                <div class="uk-width-medium-1-1 uk-width-large-1-1 uk-width-xlarge-1-2 uk-cover-background"
                     style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>);">
                    <?php
                    $intro_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                    ?>
                        <a href="<?php echo get_post_permalink(); ?>"> 
                            <img class="uk-invisible news-page1-img grow" src="<?php echo $intro_img; ?>"  alt="<?php echo $post->post_title; ?>"/>
                        </a>
                </div>
                <div class="uk-width-medium-1-1 uk-width-large-1-1 uk-width-xlarge-1-2 tt-text-home">
                   <p class="header-title-p">
                        <a class="text-heading" href="<?php echo get_post_permalink(); ?>">
                            <?php echo $post->post_title; ?>
                        </a>
                   </p>
                   
                    <p class="text-data">
                        <img src="wp-content/themes/your-fitness/images/icon/calendar.png" class="img-calendar" alt="calendar.png"/>
                        <?php the_date('d M, Y'); ?> BY 
                        <span class="text-user">                  
                        <?php the_author(); ?>
                        </span>
                    </p>
                        <?php the_content(); ?>
                    <div class="padding-botton">
                        <input type="button" class="read-more-button" onclick="location.href='<?php echo get_post_permalink(); ?>';" value="Read more" />
                    </div>
                </div>
               
            </div>


        </li>
<?php } ?>

</ul>