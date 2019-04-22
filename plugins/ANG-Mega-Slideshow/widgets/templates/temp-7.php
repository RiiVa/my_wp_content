<?php
    echo get_the_post_thumbnail ($post->ID, 'full', array('class' => 'ang-slider-bg'));
?>
<div class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-height-1-1 uk-vertical-align uk-padding-remove">
    
    <div class="uk-vertical-align-middle uk-text-center uk-width-1-1">
        <div class="uk-container uk-container-center uk-text-left">
            <div class="uk-width-small-1-2">

                <?php if($p_title1 != true){ ?>
                <div class="uk-clearfix">
                    <h3 class="uk-h3 slide-head-2 tm-slide-style-2 uk-float-left" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
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
                </div>
                <?php  } ?>
                <?php   if ($p_excerpt1 != true){ ?>
                    <div class="uk-clearfix">
                        <div class="ang-slider-excerpt uk-display-inline-block tm-slide-style-2  uk-float-left ang-anim-duration-1-5" style="max-width:750px" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
                            <p>
                            <?php if ( $post->post_excerpt != '' ){ ?>
                                    <?php echo $post->post_excerpt; ?>
                            <?php } else { ?>
                                    <?php echo wp_trim_words($post->post_content, $instance['p_number_words1'], ''); ?>
                            <?php } ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
                <?php   if($p_address1 != true && in_array($post->post_type, $epl_posts)){ ?>
                    <div class="uk-clearfix">
                        <h5 class="ang-slider-address uk-h6 slide-head-2 tm-slide-style-2 uk-float-left ang-anim-duration-1-5" data-uk-scrollspy="{cls:'uk-animation-slide-right'}"><i class="uk-icon-map-marker"></i><?php do_action('epl_property_address'); ?></h5>
                    </div>
                <?php } ?>
                <?php   if($p_price1 != true && in_array($post->post_type, $epl_posts)){ ?>
                    <div class="uk-clearfix">
                        <h5 class="ang-slider-price uk-float-left slide-head-2 tm-slide-style-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}"><?php do_action('epl_property_price'); ?></h5>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

 