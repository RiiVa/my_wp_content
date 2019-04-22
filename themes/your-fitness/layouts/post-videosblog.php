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

<div class="uk-container uk-container-center">
<article id="item-<?php the_ID(); ?>" <?php post_class( 'uk-article' ); ?> data-permalink="<?php the_permalink(); ?>">


    <h1 class="tt-header-videos">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h1>


    <p class="uk-article-meta-video tt-post-time uk-width-medium-6-10">
        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/calendar.png" class="tt-post-img-calendar" alt="calendar.png"/>
        <?php
        $date = '<time datetime="'.get_the_date('d F Y').'">'.get_the_date('d F Y').'</time>';
        printf(wp_kses(__('<span class="tt-features-display">%s</span>  %s  <span class="uk-float-right">%s</span>', 'your-fitness'), array('span' => array('class' => array()))), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
        ?>
    </p>


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
    
    <hr class="uk-grid-divider tt-videos-blog-mar">
</article>
</div>
