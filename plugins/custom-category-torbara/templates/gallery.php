<div data-uk-slideset="{small: 2, medium: 4, large: 6}">
    <div class="uk-slidenav-position">
        <ul class="uk-grid uk-slideset">
             <?php while ($q->have_posts()) {
                    $q->the_post(); ?>
                <li class="uk-flex uk-flex-center">
                <figure class="uk-overlay">
                  <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" width="100%" height="393" alt="Gallery 1"/>
                  <figcaption class="uk-flex uk-flex-center uk-flex-middle uk-overlay-panel-gallery uk-overlay-background-gallery uk-overlay-center">
                    <span style="text-transform: uppercase; font-size: 24px; text-align: center; font-weight: bold;"><a href="/images" style="color: white;"><?php echo $post->post_title; ?></a></span>
                  </figcaption>
                </figure>
                </li>     
            <?php } ?>
        </ul>
         
    </div>
        <ul class="uk-slideset-nav uk-dotnav uk-flex-center" style="margin-top: 30px; margin-bottom: 0px;"></ul>
</div>