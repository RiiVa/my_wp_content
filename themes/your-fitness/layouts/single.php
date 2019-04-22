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

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class( 'uk-article' ); ?> data-permalink="<?php the_permalink(); ?>">
        
        <div class=" tt-title-12">
            <h3 class="uk-panel-title"><span class="title-span"><?php the_title(); ?></span></h3>
        </div>    

        <?php the_content(''); ?>

        <?php wp_link_pages(); ?>

        <?php the_tags('<p>'.esc_html__('Tags: ', 'your-fitness'), ', ', '</p>'); ?>

        <?php if (get_the_author_meta('description')) : ?>
        <div class="uk-panel uk-panel-box">

            <div class="uk-align-medium-left">
                <?php echo get_avatar(get_the_author_meta('user_email')); ?>
            </div>

            <h2 class="uk-h3 uk-margin-top-remove"><?php the_author(); ?></h2>

            <div class="uk-margin"><?php echo esc_html(get_the_author_meta('description'), 'your-fitness'); ?></div>

        </div>
        <?php endif; ?>

        <?php comments_template(); ?>

        <?php
            $prev = get_previous_post();
            $next = get_next_post();
        ?>
        
        
        <?php if ($this['config']->get('post_nav', 0) && ($prev || $next)) : ?>
        <ul class="uk-pagination">
            <?php if ($next) : ?>
            <li class="uk-pagination-next">
                <a href="<?php echo get_permalink($next->ID) ?>" title="<?php echo esc_html__('Next', 'your-fitness'); ?>">
                    <?php echo esc_html__('Next', 'your-fitness'); ?>
                    <i class="uk-icon-arrow-right"></i>
                </a>
            </li>
            <?php endif; ?>
            <?php if ($prev) : ?>
            <li class="uk-pagination-previous">
                <a href="<?php echo get_permalink($prev->ID) ?>" title="<?php echo esc_html__('Prev', 'your-fitness'); ?>">
                    <i class="uk-icon-arrow-left"></i>
                    <?php echo esc_html__('Prev', 'your-fitness'); ?>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

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

    </article>

    <?php endwhile; ?>
 <?php endif; ?>
