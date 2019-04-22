<?php
    echo get_the_post_thumbnail ($post->ID, 'full', array('class' => 'ang-slider-bg'));
?>
<div class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-height-1-1 uk-vertical-align uk-padding-remove">
    
    <div class="uk-vertical-align-middle uk-text-center uk-width-1-1">
        <div class="uk-container uk-container-center tm-slide-style-1">
            <?php if($p_title1 != true){ ?>
                <h3 class="uk-h3 tm-slide-head ang-anim-duration-1-5" data-uk-scrollspy="{cls:'uk-animation-scale-up'}">
                    <?php if($p_link1 != true){ ?>
                    <a class="" href="<?php echo get_permalink($post->ID); ?>">
                        <?php if (in_array($post->post_type, $epl_posts)) {
                            echo get_post_meta( $post->ID, 'property_heading', true );
                                //do_action('epl_property_heading');
                            }else{
                                echo $post->post_title;
                            } ?>
                    </a>
                    <?php }else{
                            if (in_array($post->post_type, $epl_posts)) {
                                echo get_post_meta( $post->ID, 'property_heading', true );
                                //do_action('epl_property_heading');
                            }else{
                                echo $post->post_title;
                            }
                    } ?>
                </h3>
            <?php  } ?>
            <?php   if ($p_excerpt1 != true){ ?>
                    <div class="ang-slider-excerpt ang-anim-duration-3" data-uk-scrollspy="{cls:'uk-animation-fade'}">
                        <p>
                        <?php if ( $post->post_excerpt != '' ){ ?>
                                <?php echo $post->post_excerpt; ?>
                        <?php } else { ?>
                                <?php echo wp_trim_words($post->post_content, $instance['p_number_words1'], ''); ?>
                        <?php } ?>
                        </p>
                    </div>
            <?php } ?>
            <?php   if($p_address1 != true && in_array($post->post_type, $epl_posts)){ ?>
                    <h5 class="ang-slider-address uk-h6 ang-anim-duration-3" data-uk-scrollspy="{cls:'uk-animation-fade'}"><i class="uk-icon-map-marker"></i><?php do_action('epl_property_address'); ?></h5>
            <?php } ?>
            <?php   if($p_price1 != true && in_array($post->post_type, $epl_posts)){ ?>
                    <h5 class="ang-slider-price ang-anim-duration-3" data-uk-scrollspy="{cls:'uk-animation-scale-down'}"><?php do_action('epl_property_price'); ?></h5>
            <?php } ?>
        </div>
    </div>
</div>

 