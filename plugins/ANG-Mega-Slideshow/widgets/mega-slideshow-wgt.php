<?php

class ANG_Mega_Slideshow extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ang-mega-slideshow', // Base ID
            __('ANG Mega Slideshow', 'ang-plugins'), // Name
            array( 'description' => __( 'Displays random posts with thumbnail navigation', 'ang-plugins' ), ) // Args
        );
    }
    
    function form($instance) {
        $instance['descr_disable'] = "";
        $instance['p_post_type'] = "";
        $instance['CatID'] = "";
        $instance['p_number_words1'] = "";
        $instance['fixed_bg'] = "";
        $instance['p_featured1'] = "";
        $instance['p_title1'] = "";
        $instance['pesc_html_excerpt1'] = "";

        $instance['p_link1'] = "";
        $instance['p_price1'] = "";
        $instance['p_address1'] = "";
        $instance['p_custom_tmp'] = "";
        $instance['p_order_by'] = "";

        ?>

<!--        Widget title -->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Property Slideshow"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                Title: 
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        
        <!--        Description textarea -->
        
        <?php $descr = isset( $instance['descr']) ?  $instance['descr'] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>">
                <?php esc_html_e('Description:', 'ang-plugins'); ?>
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
         <!--   Checkox Disable description output -->
         
         <?php $descr_disable = isset( $instance['descr_disable'] ) ? $instance['descr_disable'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('descr_disable'); ?>" name="<?php echo $this->get_field_name('descr_disable'); ?>" <?php if ($instance['descr_disable']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('descr_disable'); ?>"><?php esc_html_e('Disable description output', 'ang-plugins'); ?></label>
        </p>
            
        
        <!--   ADD Extra class -->
        
        <?php $extra_class = isset( $instance['extra_class']) ? esc_attr( $instance['extra_class'] ) : ''; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>">
                Extra class: 
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($extra_class); ?>" />
            </label>
        </p>
        
        <!--     Returns all registered post types-->
            
    <?php $p_post_type = isset( $instance['p_post_type'] ) ? $instance['p_post_type'] : 'post'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_post_type'); ?>">
                <?php esc_html_e('Select post type:', 'ang-plugins'); ?>
                    <?php
                    $args=array(
                                'public'   => true,
                              );
                $post_types = get_post_types($args,'names'); 
                
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('p_post_type')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('p_post_type')); ?>" >
                <?php foreach ($post_types as $post_type){ ?>
                    <option value="<?php echo esc_attr($post_type); ?>" <?php if($post_type==$instance['p_post_type']){echo 'selected=""';} ?>><?php echo $post_type; ?></option>
                <?php } ?>
                </select>
            </label>
        </p>
        
        <!--             Returns  Slideshow taxonomy -->
        
        <?php $TaxEvent = isset( $instance['TaxEvent'] ) ? $instance['TaxEvent'] : ''; ?>
        <?php
                $args = array(
                    'type'                     => 'slideshow',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hideesc_html_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'slideset',
                    'pad_counts'               => false 
                );
                
        $taxesc_html_events = get_categories( $args );
            if( $taxesc_html_events ){
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('TaxEvent'); ?>">
                Slideshow tax: 
                    <select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('TaxEvent')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('TaxEvent')); ?>" >
                     <option value="" <?php if('' == $instance['TaxEvent']){echo 'selected=""';} ?>>--All Slidsets--</option>
          <?php
                foreach ($taxesc_html_events as $taxesc_html_event){
                    ?><option value="<?php echo esc_attr($taxesc_html_event->term_id); ?>" <?php if($taxesc_html_event->term_id==$instance['TaxEvent']){echo 'selected=""';} ?>><?php echo $taxesc_html_event->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        <?php } ?>
        
<!--        Selecting category id-->
        
         <p>
            <label for="<?php echo $this->get_field_id('CatID'); ?>">
                Post Category:<?php
  
                $args = array(
                    'type'                     => 'post',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hideesc_html_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'category',
                    'pad_counts'               => false 
                );
                
                $cats = get_categories( $args );
                
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('CatID')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('CatID')); ?>" >
                <?php
                    foreach ($cats as $cat){
                        ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if($cat->term_id==$instance['CatID']){echo 'selected=""';} ?>><?php echo $cat->name; ?></option><?php
                    }
                ?>
                </select>
            </label>
        </p>
       

        <!--        Type a number of items-->

        <?php $PostsCount1 = isset( $instance['PostsCount1'] ) ? $instance['PostsCount1'] : 6; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('PostsCount1')); ?>">
                Number of items:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('PostsCount1')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('PostsCount1')); ?>" 
                        type="number"
                        min ="-1"
                        value="<?php echo esc_attr($PostsCount1); ?>" />
            </label>
        </p>
        
        <!--        Number of words per post -->
        
        <?php $p_number_words1 = isset( $instance[ 'p_number_words1' ] ) ? $instance[ 'p_number_words1' ] : 30; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_number_words1'); ?>">
                <?php esc_html_e('Words per each post:', 'ang-plugins'); ?>
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('p_number_words1'); ?>" 
                        name="<?php echo $this->get_field_name('p_number_words1'); ?>" 
                        type="number"
                        min="5"
                        value="<?php echo $instance['p_number_words1']; ?>" />
            </label>
        </p>
        
        <!--   Checkox fixed background -->
        
        <?php $fixed_bg = isset( $instance['fixed_bg'] ) ? $instance['fixed_bg'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('fixed_bg'); ?>" name="<?php echo $this->get_field_name('fixed_bg'); ?>" <?php if ($instance['fixed_bg']) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('fixed_bg'); ?>"><?php esc_html_e('Fixed background', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Show only featured or sticky -->
        
        <?php $p_featured1 = isset( $instance['p_featured1'] ) ? $instance['p_featured1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_featured1'); ?>" name="<?php echo $this->get_field_name('p_featured1'); ?>" <?php if ($instance['p_featured1']) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('p_featured1'); ?>"><?php esc_html_e('Only Show Featured or Sticky', 'ang-plugins'); ?></label>
        </p>
         
        <!--   Checkox Hide the post title -->
         
         <?php $p_title1 = isset( $instance['p_title1'] ) ? $instance['p_title1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_title1'); ?>" name="<?php echo $this->get_field_name('p_title1'); ?>" <?php if ($instance['p_title1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_title1'); ?>"><?php esc_html_e('Hide the post title', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Hide the post excerpt -->
         
         <?php $pesc_html_excerpt1 = isset( $instance['pesc_html_excerpt1'] ) ? $instance['pesc_html_excerpt1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('pesc_html_excerpt1'); ?>" name="<?php echo $this->get_field_name('pesc_html_excerpt1'); ?>" <?php if ($instance['pesc_html_excerpt1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('pesc_html_excerpt1'); ?>"><?php esc_html_e('Hide the post excerpt', 'ang-plugins'); ?></label>
        </p>
        
        
         <!--   Checkox Hide the post link -->
         
        <?php $p_link1 = isset( $instance['p_link1'] ) ? $instance['p_link1'] : false ; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_link1'); ?>" name="<?php echo $this->get_field_name('p_link1'); ?>" <?php if ($instance['p_link1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_link1'); ?>"><?php esc_html_e('Hide the post link', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Hide the property price -->
         
        <?php $p_price1 = isset( $instance['p_price1'] ) ? $instance['p_price1'] : false ; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_price1'); ?>" name="<?php echo $this->get_field_name('p_price1'); ?>" <?php if ($instance['p_price1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_price1'); ?>"><?php esc_html_e('Hide the property price', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Hide the property address -->
         
        <?php $p_address1 = isset( $instance['p_address1'] ) ? $instance['p_address1'] : false ; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_address1'); ?>" name="<?php echo $this->get_field_name('p_address1'); ?>" <?php if ($instance['p_address1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_address1'); ?>"><?php esc_html_e('Hide the property address', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Use custom post templates -->
         
        <?php $p_custom_tmp = isset( $instance['p_custom_tmp'] ) ? $instance['p_custom_tmp'] : false ; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_custom_tmp'); ?>" name="<?php echo $this->get_field_name('p_custom_tmp'); ?>" <?php if ($instance['p_custom_tmp']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_custom_tmp'); ?>"><?php esc_html_e('Use Custom post template (override part of settings)', 'ang-plugins'); ?></label>
        </p>
        
        
        <!--        Height of slideshow-->
        
        <?php $height = isset( $instance['height'] ) ? $instance['height'] : "auto"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('height')); ?>">
                Slideshow height:
                <input class="widefat"
                        id="<?php echo esc_attr($this->get_field_id('height')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('height')); ?>" 
                        type="text"
                        value="<?php echo esc_attr($height); ?>" />
            </label>
        </p>        
        
        <!--   Order type extended -->
        
        <?php 
		$p_orders = array(
                        'Post ID' => 'ID',
                        'Random' => 'rand',
			'Author' => 'author',
			'Title' => 'title',
			'Post slug' => 'name',
                        'Publication date' => 'date',
                        'Modified date' => 'modified',
			'Comments count' => 'comment_count',
                        'Menu order' => 'menu_order',
		);
		
                ?>
        
       <?php $p_order_by = isset( $instance[ 'p_order_by' ] ) ? $instance[ 'p_order_by' ] : 'ID'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_order_by'); ?>">
                Order type format :
            </label> 
            <br>
            
            <select id="<?php echo esc_attr($this->get_field_id('p_order_by')); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_by')); ?>">
                <?php foreach($p_orders as $p_order =>$value){ ?>           
                <option value="<?php echo $value; ?>" <?php if ($value == $instance[ 'p_order_by' ]){ echo 'selected=""';}?> name="<?php echo esc_attr($this->get_field_name('p_order_by')); ?>" ><?php echo $p_order ; ?></option>
            <?php } ?>
                
            </select>
        </p>
        
        <!--   Order type -->
        
        <?php $p_order_type = isset( $instance['p_order_type'] ) ? $instance['p_order_type'] : "ASC"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'p_order_type' )); ?>">
                <?php esc_html_e('Posts order type:', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_ASC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="ASC" <?php if($p_order_type=="ASC"){ echo "checked"; }?>>ASC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_DESC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="DESC" <?php if($p_order_type=="DESC"){ echo "checked"; }?>>DESC
        </p>
        
        
          <!--        Slideshow next and prev navigation -->
          
        <?php $slidenav_btn = isset( $instance['slidenav_btn'] ) ? $instance['slidenav_btn'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_btn' )); ?>">
                Show next and previous buttons:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="1" <?php if($slidenav_btn=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="2" <?php if($slidenav_btn=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow thumbnail navigation -->
        
        <?php $slidenav = isset( $instance['slidenav'] ) ? $instance['slidenav'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav' )); ?>">
                Show dot navigation:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="1" <?php if($slidenav=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="2" <?php if($slidenav=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow thumbnail navigation type -->
        
        <?php $slidenav_type = isset( $instance['slidenav_type'] ) ? $instance['slidenav_type'] : "2"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_type' )); ?>">
               Navigation type:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="1" <?php if($slidenav_type=="1"){ echo "checked"; }?>>Round &nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="2" <?php if($slidenav_type=="2"){ echo "checked"; }?>>Square &nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_3"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="3" <?php if($slidenav_type=="3"){ echo "checked"; }?>>Dashed
        </p>
                  <!--        Slideshow animation -->
                  
        <?php $animation = isset( $instance['animation'] ) ? $instance['animation'] : "fade"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'animation' )); ?>">
                Animation:
            </label> 
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('animation')); ?>" name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
                <option value="fade" <?php echo ($animation=='fade')?'selected':''; ?>>Fade</option>
                <option value="scroll" <?php echo ($animation=='scroll')?'selected':''; ?>>Scroll</option>
                <option value="scale" <?php echo ($animation=='scale')?'selected':''; ?>>Scale</option>
                <option value="slice-down" <?php echo ($animation=='slice-down')?'selected':''; ?>>Slice-down</option>
                <option value="slice-up" <?php echo ($animation=='slice-up')?'selected':''; ?>>Slice-up</option>
                <option value="slice-up-down" <?php echo ($animation=='slice-up-down')?'selected':''; ?>>Slice-up-down</option>
                <option value="swipe" <?php echo ($animation=='swipe')?'selected':''; ?>>Swipe</option>
                <option value="fold" <?php echo ($animation=='fold')?'selected':''; ?>>Fold</option>
                <option value="puzzle" <?php echo ($animation=='puzzle')?'selected':''; ?>>Puzzle</option>
                <option value="boxes" <?php echo ($animation=='boxes')?'selected':''; ?>>Boxes</option>
                <option value="boxes-reverse" <?php echo ($animation=='boxes-reverse')?'selected':''; ?>>Boxes-reverse</option>
                <option value="random-fx" <?php echo ($animation=='random-fx')?'selected':''; ?>>Random</option>
            </select>
        </p>
        
        <!--        Slideshow animation duration -->
        
        <?php $duration = isset( $instance['duration'] ) ? $instance['duration'] : "1500"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('duration')); ?>">
                Duration of animation:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('duration')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('duration')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($duration); ?>" />
            </label>
        </p>
        
        <!--        Slideshow autoplay -->
        
        <?php $autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'autoplay')); ?>">
                Autoplay:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr ($this->get_field_id('autoplay')."_1"); ?>" name="<?php echo esc_attr ($this->get_field_name('autoplay')); ?>" value="1" <?php if($autoplay=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr ($this->get_field_id('autoplay')."_2"); ?>" name="<?php echo esc_attr ($this->get_field_name('autoplay')); ?>" value="2" <?php if($autoplay=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow autoplay interval -->
        
        <?php $autoplayInterval = isset( $instance['autoplayInterval'] ) ? $instance['autoplayInterval'] : "15000"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoplayInterval')); ?>">
                Autoplay Interval:
                <input class="widefat" 
                    id="<?php echo esc_attr ($this->get_field_id('autoplayInterval')); ?>" 
                    name="<?php echo esc_attr ($this->get_field_name('autoplayInterval')); ?>" 
                    type="text" 
                    value="<?php echo esc_attr ($autoplayInterval); ?>" />
            </label>
        </p>
        
        <!--        Slideshow video autoplay option -->
        
        <?php $videoautoplay = isset( $instance['videoautoplay'] ) ? $instance['videoautoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'videoautoplay' )); ?>">
                Video autoplay:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('videoautoplay')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('videoautoplay')); ?>" value="1" <?php if($videoautoplay=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('videoautoplay')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('videoautoplay')); ?>" value="2" <?php if($videoautoplay=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow video mute option -->
        
        <?php $videomute = isset( $instance['videomute'] ) ? $instance['videomute'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'videomute' )); ?>">
                Video mute:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('videomute')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('videomute')); ?>" value="1" <?php if($videomute=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('videomute')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('videomute')); ?>" value="2" <?php if($videomute=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow kenburns option -->
        
        <?php $kenburns = isset( $instance['kenburns'] ) ? $instance['kenburns'] : "2"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'kenburns' )); ?>">
                Kenburns:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('kenburns')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('kenburns')); ?>" value="1" <?php if($kenburns=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('kenburns')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('kenburns')); ?>" value="2" <?php if($kenburns=="2"){ echo "checked"; }?>>No
		</p>
        
        <!--        Pause on hover-->

        <?php $pauseOnHover = isset( $instance['pauseOnHover'] ) ? $instance['pauseOnHover'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pauseOnHover' )); ?>">
                Pause on Hover:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="1" <?php if($pauseOnHover=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="2" <?php if($pauseOnHover=="2"){ echo "checked"; }?>>No
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['descr'] = $new_instance['descr'];
        $instance['fixed_bg'] = $new_instance['fixed_bg'];
        $instance['descr_disable'] = $new_instance['descr_disable'];
        $instance['extra_class'] = $new_instance['extra_class'];
        $instance['p_post_type'] = $new_instance['p_post_type'];
        $instance['CatID'] = $new_instance['CatID'];
        $instance['TaxEvent'] = $new_instance['TaxEvent'];
        $instance['PostsCount1'] = $new_instance['PostsCount1'];
        
        $instance['p_number_words1'] = $new_instance['p_number_words1'];
        $instance['p_order_by'] = $new_instance['p_order_by'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_featured1'] = $new_instance['p_featured1'];
        $instance['p_title1'] = $new_instance['p_title1'];
        $instance['pesc_html_excerpt1'] = $new_instance['pesc_html_excerpt1'];
        $instance['p_link1'] = $new_instance['p_link1'];
        $instance['p_price1'] = $new_instance['p_price1'];
        $instance['p_address1'] = $new_instance['p_address1'];
        $instance['p_custom_tmp'] = $new_instance['p_custom_tmp'];
        
        $instance['height'] = $new_instance['height'];
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
        $instance['slidenav_type'] = $new_instance['slidenav_type'];

        $instance['animation'] = $new_instance['animation'];
        $instance['duration'] = $new_instance['duration'];
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['autoplayInterval'] = $new_instance['autoplayInterval'];
        $instance['videoautoplay'] = $new_instance['videoautoplay'];
        $instance['videomute'] = $new_instance['videomute'];
        $instance['kenburns'] = $new_instance['kenburns'];
        $instance['pauseOnHover'] = $new_instance['pauseOnHover'];
            
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        
        $fixed_bg = $instance['fixed_bg'] ? true : false;
        $descr_disable = $instance['descr_disable'] ? true : false;
        $p_featured1 = $instance['p_featured1'] ? true : false;
        $p_title1 = $instance['p_title1'] ? true : false;
        $pesc_html_excerpt1 = $instance['pesc_html_excerpt1'] ? true : false;
        $p_link1 = $instance['p_link1'] ? true : false;
        $p_price1 = $instance['p_price1'] ? true : false;
        $p_address1 = $instance['p_address1'] ? true : false;
        $p_custom_tmp = $instance['p_custom_tmp'] ? true : false;
        
        // UIkit Slideshow configuration
        $slideshow_cfg = array ();
        $slideshow_cfg[] = "height: '".$instance['height']."'";
        $slideshow_cfg[] = "animation: '".$instance['animation']."'";
        $slideshow_cfg[] = "duration: '".$instance['duration']."'";
        $slideshow_cfg[] = "autoplayInterval: '".$instance['autoplayInterval']."'";
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['videoautoplay']=="1"){$slideshow_cfg[] = "videoautoplay: true";}else{$slideshow_cfg[] = "videoautoplay: false";}
        if($instance['videomute']=="1"){$slideshow_cfg[] = "videomute: true";}else{$slideshow_cfg[] = "videomute: false";}
        if($instance['kenburns']=="1"){$slideshow_cfg[] = "kenburns: true";}else{$slideshow_cfg[] = "kenburns: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}

        
        
        $epl_posts = array('property', 'land', 'commercial', 'business', 'commercial_land', 'rental', 'rural');
        $post_slideshow = array('post', 'slideshow');
        
        $args = array(
            'post_type'        => $instance['p_post_type'],
            'posts_per_page'   => $instance['PostsCount1'],
            'offset'           => 0,
            //'cat'         => $cat_typeID,
            'orderby'          => $instance['p_order_by'],
            'order'            => $instance['p_order_type'],
            'post_status'      => 'publish',
            'suppress_filters' => true,
        );
        
        if($instance['p_post_type'] == 'slideshow' && $instance['TaxEvent'] !=''){
        /*
         * Check Post type slideshow and taxonomy
         */
            $args['tax_query'][] = array(
                    'taxonomy' => 'slideset',
                    'field' => 'term_id',
                    'terms' => $instance['TaxEvent']
            );
        }elseif($instance['p_post_type'] == 'post'){
        /*
         * Check Post type post and category
         */
           $args['cat'] = $instance['CatID'];
           if ( $p_featured1 == true ) {
               $args['post__in']  = get_option( 'sticky_posts' );
           }
        }else{
            $args['cat'] = '';
            if ( $p_featured1 == true ) {
               $args['meta_query'][]  = array(
                        'key' 	=> 'property_featured',
                        'value'	=> 'yes'
                    );
           }
        }

        $plugin_dir = plugin_dir_path( __FILE__ ); //plagin path 
        $temp_path = $plugin_dir.'templates/';
        $temp_array = array( 'temp-0.php', 'temp-1.php', 'temp-2.php', 'temp-3.php', 'temp-4.php', 'temp-5.php', 'temp-6.php', 'temp-7.php' );
          
        $item = new WP_Query( $args );
        if($p_custom_tmp == true || $instance['p_post_type'] == 'slideshow'){ ?>
                
        <div class="ang-megaslideshow-wrapper ang-custom-slide-tmp <?php if($instance['extra_class'] !='') echo $instance['extra_class']; ?>">
        <?php if($instance['descr'] != NULL && $descr_disable != true ) : ?>
        <div class="ang-slideshow-descr">
            <div class="uk-width-1-1 tm-widget-descr">
                <?php echo do_shortcode($instance['descr']); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="akslider-module">
            <div class="uk-slidenav-position" data-uk-slideshow="{<?php echo esc_attr(implode(", ", $slideshow_cfg)); ?>}">
                <?php if ( $item->have_posts() ) { ?>
                <ul class="uk-slideshow uk-overlay-active">
                    <?php 
                        $count = 0;
                        while ( $item->have_posts() ) {
                                    $item->the_post(); 
                                    global $post; ?>
                    <li class="uk-cover uk-height-viewport <?php if ( $fixed_bg == true) echo 'ang-fixed-slide-bg'; ?> <?php echo 'post-'.$post->ID; ?> <?php echo 'post_type-'.$post->post_type; ?>">
                    <?php //echo get_the_post_thumbnail ($item->ID, 'full', array('class' => 'ang-slideshow-bg'));
                            echo do_shortcode($post->post_content); ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
                <?php if($instance['slidenav_btn']=="1") : ?>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <?php endif; ?>
                
                
                <?php if($instance['slidenav']=="1") { ?>
                    <div class="uk-container uk-container-center tt-margin-navigation">
                        <ul class="uk-dotnav uk-dotnav-contrast <?php if($instance['slidenav_type']=="2"){ echo ' ang-squarenav ';}?> <?php if($instance['slidenav_type']=="3"){ echo ' ang-dashednav uk-container uk-container-center';}?> ">
                            <?php   $counter = 0;
                                    $my_posts = $item->query($args);
                                    foreach ($my_posts as $list) :
                                        $thumbnail_object = get_post(get_post_thumbnail_id($list->ID));
                                            if($thumbnail_object->guid) : ?>
                                                <li data-uk-slideshow-item="<?php echo esc_attr($counter); ?>"><a href="" style="background-image: url(<?php echo esc_url ($thumbnail_object->guid); ?>)"><?php echo esc_attr($counter); $counter++; ?></a></li>
                                        <?php else : ?>
                                                <li data-uk-slideshow-item="<?php echo esc_attr($counter); ?>"><a href=""><?php echo esc_attr($counter); $counter++; ?></a></li>
                                        <?php endif; 
                                    endforeach; ?>
                        </ul>
                    </div>
                <?php } ?>
                
                
            </div>
        </div>
    </div>
    
    <?php } else{ ?>
    <div class="ang-megaslideshow-wrapper <?php if($instance['extra_class'] !='') echo $instance['extra_class']; ?>">
        <?php if($instance['descr'] != NULL && $descr_disable != true ) : ?>
        <div class="ang-slideshow-descr">
            <div class="uk-width-1-1 tm-widget-descr">
                <?php echo do_shortcode($instance['descr']); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="akslider-module">
            <div class="uk-slidenav-position" data-uk-slideshow="{<?php echo esc_attr(implode(", ", $slideshow_cfg)); ?>}">
                 <?php if ( $item->have_posts() ) { ?>
                <ul class="uk-slideshow uk-overlay-active">
                    
                    <?php 
                    $count = 0;
                    //foreach ($list as $item) : 
                        while ( $item->have_posts() ) {
                                    $item->the_post(); 
                                    global $post; ?>
                    <?php  $post_type = $post->post_type;
                            $categories = get_the_category($post->ID); ?>
                    <?php if(has_post_thumbnail($post->ID)){ ?>
                    <li class="uk-cover uk-height-viewport <?php if ( $fixed_bg == true) echo 'ang-fixed-slide-bg'; ?> post-<?php echo 'post-'.$post->ID; ?> <?php echo 'post_type-'.$post->post_type; ?> <?php echo 'cat-id-'.$categories[0]->cat_ID; ?> <?php echo 'cat-name-'.$categories[0]->cat_name; ?> <?php if ( $p_featured1 == true ){echo 'featured';} ?>">
                        <?php  switch ($count) {
                                case 0:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 1:
                                    include $temp_path.$temp_array[$count]; //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 2:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 3:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 4:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 5:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 6:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count++;
                                    break;
                                case 7:
                                    include $temp_path.$temp_array[$count];  //include slideshow template
                                    echo $count;
                                    $count -=7;
                                    shuffle($temp_array);
                                    break;
                                
                                default:
                                    include $temp_path.$temp_array[0];  //include slideshow template
                                    echo $count;
                                    $count = 0;
                                    break;
                            }
                            //echo do_shortcode($item->post_content) ; 
                            ?>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php }
                wp_reset_postdata(); ?>
                
                <?php if($instance['slidenav_btn']=="1") : ?>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <?php endif; ?>
                <?php if($instance['slidenav']=="1") { ?>
                    <div class="uk-container uk-container-center tt-margin-navigation">
                        <ul class="uk-dotnav uk-dotnav-contrast <?php if($instance['slidenav_type']=="2"){ echo ' ang-squarenav ';}?> <?php if($instance['slidenav_type']=="3"){ echo ' ang-dashednav uk-container uk-container-center';}?> ">
                            <?php   $counter = 0;
                                    $my_posts = $item->query($args);
                                    foreach ($my_posts as $list) :
                                        if(has_post_thumbnail($list->ID)){
                                        $thumbnail_object = get_post(get_post_thumbnail_id($list->ID));
                                            if($thumbnail_object->guid) : ?>
                                                <li data-uk-slideshow-item="<?php echo esc_attr($counter); ?>">
                                                    <a href="" style="background-image: url(<?php echo esc_url ($thumbnail_object->guid); ?>)"><?php echo esc_attr($counter); $counter++; ?></a>
                                                </li>
                                        <?php else :?>
                                                <li data-uk-slideshow-item="<?php echo esc_attr($counter); ?>">
                                                    <a href=""><?php echo esc_attr($counter); $counter++; ?></a>
                                                </li>
                                        <?php endif;
                                        }
                                    endforeach; 
                                wp_reset_postdata(); 
                            ?>
                        </ul>
                    </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php }
        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("ANG_Mega_Slideshow");'));
