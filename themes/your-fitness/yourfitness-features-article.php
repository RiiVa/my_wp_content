<?php
/*
Template Name: YourFitness Features Article
*/
?>

<?php get_header(); ?>

<?php
    if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('uk-article tt-single-margin'); ?> data-permalink="<?php the_permalink(); ?>">
                <div class="uk-container uk-container-center">
                    <h1 class="uk-article-title tt-features-title">
                        <?php the_title(); ?>
                    </h1>

                     <p class="uk-article-meta tt-post-time">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/calendar.png" class="tt-post-img-calendar" alt="calendar.png"/>
                        <?php
                            $date = '<time datetime="'.get_the_date('d F Y').'">'.get_the_date('d F Y').'</time>';
                            printf(wp_kses(__('<span class="tt-features-display">%s</span>  %s  <span class="uk-float-right">%s</span>', 'your-fitness'), array('span' => array('class' => array()))), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
                        ?>
                    </p>

                    <div class="uk-cover-background" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>); width: 100%; height: 500px; background-position: 50% 0%;">
                        <img class="uk-invisible" src="<?php the_post_thumbnail_url('full'); ?>" width="" height="" alt="">
                    </div>

                    </div>

                    <div class="tt-single-blog">
                        <?php echo the_content(""); ?>
                    </div>

                    <?php wp_link_pages(); ?>

                    <?php the_tags('<p>'.esc_html__('Tags: ', 'your-fitness'), ', ', '</p>'); ?>



                    <?php if (get_the_author_meta('description')) : ?>
                    <div class="uk-panel uk-panel-box">

                        <div class="uk-align-medium-left">

                            <?php echo get_avatar(get_the_author_meta('user_email')); ?>

                        </div>

                        <h2 class="uk-h3 uk-margin-top-remove"><?php the_author(); ?></h2>

                        <div class="uk-margin"><?php echo esc_html(get_the_author_meta('description')); ?></div>

                    </div>
                    <?php endif; ?>

                    <?php comments_template(); ?>
                </article>
            <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>