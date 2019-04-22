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

<article id="item-<?php the_ID(); ?>" <?php post_class( 'uk-article' ); ?> data-permalink="<?php the_permalink(); ?>">

    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
    <?php endif; ?>

    <h1 class="uk-article-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

    <p class="uk-article-meta">
        <?php
            $date = '<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date().'</time>';
            printf(esc_html__('Written by %s on %s. Posted in %s', 'your-fitness'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
        ?>
    </p>

    <?php the_content(''); ?>

    <ul class="uk-subnav uk-subnav-line">
        <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Continue Reading', 'your-fitness'); ?></a></li>
        <?php if(comments_open() || get_comments_number()) : ?>
            <li><?php comments_popup_link(esc_html__('No Comments', 'your-fitness'), esc_html__('1 Comment', 'your-fitness'), esc_html__('% Comments', 'your-fitness'), "", ""); ?></li>
        <?php endif; ?>
    </ul>

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

</article>