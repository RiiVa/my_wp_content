<?php

class ANG_Content_Slideshow extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ang-content-slideshow', // Base ID
            __('ANG Content Slideshow', 'text_domain'), // Name
            array( 'description' => __( 'Displays random posts(image plus content) with thumbnail navigation', 'text_domain' ), ) // Args
        );
    }
    
    function form($instance) {
        $instance['descr_disable'] = "";
        $instance['p_post_type'] = "";
        $instance['CatID'] = "";
        $instance['p_featured1'] = "";
        $instance['p_title1'] = "";
        $instance['p_link1'] = "";
        $instance['p_order_by'] = "";
        $instance['descr_disable'] = "";
        $instance['p_post_type'] = "";
        ?>

<!--        Widget title -->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Slideshow"; ?>
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
                <?php _e('Description:', 'text_domain'); ?>
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
        <!--   Checkox Disable description output -->
         
         <?php $descr_disable = isset( $instance['descr_disable'] ) ? $instance['descr_disable'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('descr_disable'); ?>" name="<?php echo $this->get_field_name('descr_disable'); ?>" <?php if ($instance['descr_disable']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('descr_disable'); ?>"><?php _e('Disable description output', 'text_domain'); ?></label>
        </p>
             
        <!--   Add Extra class -->
        
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
                <?php _e('Select post type:', 'text_domain'); ?>
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
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'slideset',
                    'pad_counts'               => false 
                );
                
        $tax_events = get_categories( $args );
            if( $tax_events ){
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('TaxEvent'); ?>">
                Slideshow tax: 
                    <select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('TaxEvent')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('TaxEvent')); ?>" >
                     <option value="" <?php if('' == $instance['TaxEvent']){echo 'selected=""';} ?>>--All Slidsets--</option>
          <?php
                foreach ($tax_events as $tax_event){
                    ?><option value="<?php echo esc_attr($tax_event->term_id); ?>" <?php if($tax_event->term_id==$instance['TaxEvent']){echo 'selected=""';} ?>><?php echo $tax_event->name; ?></option><?php
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
                    'hide_empty'               => 1,
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
                          name="<?php echo esc_attr($this->get_field_name('CatID')); ?>" ><?php
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
                
        <!--   Checkox Show only featured or sticky -->
        
        <?php $p_featured1 = isset( $instance['p_featured1'] ) ? $instance['p_featured1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_featured1'); ?>" name="<?php echo $this->get_field_name('p_featured1'); ?>" <?php if ($instance['p_featured1']) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('p_featured1'); ?>"><?php _e('Only Show Featured or Sticky', 'text_domain'); ?></label>
        </p>
         
        <!--   Checkox Hide the post title -->
         
         <?php $p_title1 = isset( $instance['p_title1'] ) ? $instance['p_title1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_title1'); ?>" name="<?php echo $this->get_field_name('p_title1'); ?>" <?php if ($instance['p_title1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_title1'); ?>"><?php _e('Hide the post title', 'text_domain'); ?></label>
        </p>
                
         <!--   Checkox Hide the post link -->
         
        <?php $p_link1 = isset( $instance['p_link1'] ) ? $instance['p_link1'] : false ; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_link1'); ?>" name="<?php echo $this->get_field_name('p_link1'); ?>" <?php if ($instance['p_link1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_link1'); ?>"><?php _e('Hide the post link', 'text_domain'); ?></label>
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
                <?php _e('Posts order type:', 'text_domain'); ?>
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
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="1" <?php if($slidenav_type=="1"){ echo "checked"; }?>>Round &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="2" <?php if($slidenav_type=="2"){ echo "checked"; }?>>Square
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
                <option value="swipe" <?php echo ($animation=='swipe')?'selected':''; ?>>Swipe</option>
                <option value="fold" <?php echo ($animation=='fold')?'selected':''; ?>>Fold</option>
                <option value="puzzle" <?php echo ($animation=='puzzle')?'selected':''; ?>>Puzzle</option>
                <option value="boxes" <?php echo ($animation=='boxes')?'selected':''; ?>>Boxes</option>
                <option value="boxes-reverse" <?php echo ($animation=='boxes-reverse')?'selected':''; ?>>Boxes-reverse</option>
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
        $instance['descr_disable'] = $new_instance['descr_disable'];
        $instance['extra_class'] = $new_instance['extra_class'];
        $instance['p_post_type'] = $new_instance['p_post_type'];
        $instance['TaxEvent'] = $new_instance['TaxEvent'];
        $instance['CatID'] = $new_instance['CatID'];
        $instance['PostsCount1'] = $new_instance['PostsCount1'];
        
        $instance['p_order_by'] = $new_instance['p_order_by'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_featured1'] = $new_instance['p_featured1'];
        $instance['p_title1'] = $new_instance['p_title1'];
        $instance['p_link1'] = $new_instance['p_link1'];
        
        $instance['height'] = $new_instance['height'];
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
        $instance['slidenav_type'] = $new_instance['slidenav_type'];

        $instance['animation'] = $new_instance['animation'];
        $instance['duration'] = $new_instance['duration'];
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['autoplayInterval'] = $new_instance['autoplayInterval'];
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
        
        $descr_disable = $instance['descr_disable'] ? true : false;
        $p_featured1 = $instance['p_featured1'] ? true : false;
        $p_title1 = $instance['p_title1'] ? true : false;
        $p_link1 = $instance['p_link1'] ? true : false;
        
        
        // UIkit Slideshow configuration
        $slideshow_cfg = array ();
        $slideshow_cfg[] = "height: '".$instance['height']."'";
        $slideshow_cfg[] = "animation: '".$instance['animation']."'";
        $slideshow_cfg[] = "duration: '".$instance['duration']."'";
        $slideshow_cfg[] = "autoplayInterval: '".$instance['autoplayInterval']."'";
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
        
        
        $epl_posts = array('property', 'land', 'commercial', 'business', 'commercial_land', 'rental', 'rural');
        
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

    $item = new WP_Query( $args ); ?>
       
    <div class="ang-contentslideshow-wrapper <?php if($instance['extra_class'] !='') echo $instance['extra_class']; ?>">
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
                                    $count++;
                                    global $post; ?>
                    <?php  $post_type = $post->post_type;
                            $categories = get_the_category($post->ID); ?>
                    <?php if(has_post_thumbnail($post->ID)){ ?>
                    <li class="uk-cover post-<?php echo 'post-'.$post->ID; ?> <?php echo 'post_type-'.$post->post_type; ?> <?php echo 'cat-id-'.$categories[0]->cat_ID; ?> <?php echo 'cat-name-'.$categories[0]->cat_name; ?> <?php if ( $p_featured1 == true ){echo 'featured';} ?>">
                        <div class="uk-panel uk-panel-box uk-padding-remove">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-1-1 uk-width-medium-1-2 <?php echo $count % 2 == 0 ? 'uk-push-1-2' : '' ;?>">
                                <?php echo get_the_post_thumbnail ($post->ID, 'gallery-slider', array('class' => 'ang-cont-slider-thumb')); ?>
                                </div>
                                <div class="uk-width-1-1 uk-width-medium-1-2 <?php echo $count % 2 == 0 ? 'uk-pull-1-2' : '' ;?>">
                                    <div class="uk-panel uk-panel-box ang-get-height">
                                        <div class=" uk-scrollable-box uk-padding-remove">
                                        <?php if($p_title1 != true){ ?>
                                            <h5>
                                                <?php if($p_link1 != true){ ?>
                                                <a href="<?php echo get_permalink($post->ID); ?>">
                                                <?php } ?>
                                                <?php if (in_array($post->post_type, $epl_posts)) {
                                                    echo get_post_meta( $post->ID, 'property_heading', true );
                                                    }else{
                                                        echo $post->post_title;
                                                    } ?>
                                                <?php if($p_link1 != true){ ?></a><?php } ?>
                                            </h5>
                                        <?php  } ?>
                                        <div> <?php echo do_shortcode($post->post_content); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                 <?php } ?>
                <?php if($instance['slidenav_btn']=="1") : ?>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <?php endif; ?>
                <?php if($instance['slidenav']=="1") { ?>
                    <ul class="uk-dotnav <?php if($instance['slidenav_type']=="2"){ echo ' ang-squarenav ';}?> uk-dotnav-contrast uk-position-bottom uk-text-center">
                <?php $counter = 0;
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
                <?php } ?>
            </div>
        </div>
    </div>
    <?php echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("ANG_Content_Slideshow");'));
