<?php
/*
 *
 * @encoding     UTF-8
 * @author       Torbara (support@torbara.com)
 * @copyright    Copyright (C) 2016 torbara (http://torbara.com/). All rights reserved.
 * @license      Copyrighted Commercial Software
 * @support      support@torbara.com
 *
 */
?>

<div class="uk-container uk-container-center tt-first-blog-margin">
<article id="item-<?php the_ID(); ?>" <?php post_class( 'uk-article' ); ?> data-permalink="<?php the_permalink(); ?>">
    

    <h1 class="tt-title-post tt-margin-blog-h1"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

    <p class="uk-article-meta tt-post-time-blog">

        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/calendar.png" class="tt-post-img-calendar" alt="calendar.png"/>

        <?php
            $date = '<time datetime="'.get_the_date('d F Y').'">'.get_the_date('d F Y').'</time>';
            printf(wp_kses(__('<span class="tt-features-display">%s</span>  %s  <span class="uk-float-right">%s</span>', 'your-fitness'), array('span' => array('class' => array()))), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
        ?>
    </p>

    <?php
    $path_src= wp_get_attachment_url( get_post_thumbnail_id($post->ID));
    $size = getimagesize ($path_src);

    if($size[0] > 700){
    ?>
        <div class="uk-cover-background" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>); width: 100%; height: 500px; background-position: 50% 0%;">
            <img class="uk-invisible" src="<?php the_post_thumbnail_url('full'); ?>" width="" height="" alt="">
        </div>
    <?php
    }else{
    ?>
        <div  style="width: 100%; height: 500px; text-align: center; overflow: hidden;">
            <img  src="<?php the_post_thumbnail_url('full'); ?>"  alt="">
        </div>
    <?php
        }
    ?>



    <?php the_content(); ?>

    <?php
    $defaults = array(
        'before'           => '<p>' . esc_html__( 'Pages:', 'your-fitness' ),
        'after'            => '</p>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => esc_html__( 'Next page', 'your-fitness' ),
        'previouspagelink' => esc_html__( 'Previous page', 'your-fitness' ),
        'pagelink'         => '%',
        'echo'             => 1
    );

    wp_link_pages( $defaults );
    ?>

    <?php edit_post_link(esc_html__('Edit this post.', 'your-fitness'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>
    <hr class="uk-grid-divider"/>
</article>
</div>