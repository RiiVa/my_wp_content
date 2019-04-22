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
<?php if (comments_open() || have_comments()) : ?>
<div class="uk-container uk-container-center tt-comments-top">
    <div id="comments" class="uk-margin">


        <?php if (have_comments()) : ?>

            <h2 class="uk-h3"><?php printf(esc_html__('Comments (%s)', 'your-fitness'), get_comments_number()); ?></h2>

            <?php

                $classes = array("level1");

                if (get_option('comment_registration') && !is_user_logged_in()) {
                    $classes[] = "no-response";
                }

                if (get_option('thread_comments')) {
                    $classes[] = "nested";
                }

            ?>

            <ul class="uk-comment-list">
            <?php

                // single comment
                function yourfitness_comment($comment, $args, $depth)
                {
                    global $user_identity;

                    $GLOBALS['comment'] = $comment;

                    $_GET['replytocom'] = get_comment_ID();
                    ?>
                    <li>
                        <article id="comment-<?php comment_ID(); ?>" class="uk-comment <?php echo ($comment->user_id > 0) ? 'uk-comment-primary' : '';?>">

                            <header class="uk-comment-header">

                                <?php echo get_avatar($comment, $size='50', null, 'Avatar'); ?>

                                <h3 class="uk-comment-title"><?php echo get_comment_author_link(); ?></h3>

                                <p class="uk-comment-meta">
                                    <time datetime="<?php echo get_comment_date('Y-m-d'); ?>"><?php printf(esc_html__('%1$s at %2$s', 'your-fitness'), get_comment_date(), get_comment_time()) ?></time>
                                    | <a class="permalink" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">#</a>
                                    <?php edit_comment_link(esc_html__('Edit', 'your-fitness'),'| ','') ?>
                                </p>

                            </header>

                            <div class="uk-comment-body">

                                <?php comment_text(); ?>

                                <?php if (comments_open() && $args['max_depth'] > $depth) : ?>
                                <p class="js-reply"><a href="#" rel="<?php comment_ID(); ?>"><?php echo wp_kses(__('<i class="uk-icon-reply"></i> Reply', 'your-fitness'), array('span' => array('class' => array()))); ?></a></p>
                                <?php endif; ?>

                                <?php if ($comment->comment_approved == '0') : ?>
                                <div class="uk-alert"><?php esc_html_e('Your comment is awaiting moderation.', 'your-fitness'); ?></div>
                                <?php endif; ?>

                            </div>

                        </article>
                    <?php
                    unset($_GET['replytocom']);

                }

                wp_list_comments('type=all&callback=yourfitness_comment');
            ?>
            </ul>

            <?php echo $this->render("_pagination", array("type"=>"comments")); ?>

        <?php endif; ?>


        <div id="respond">

            <h2 class="uk-h3"><?php (comments_open()) ? comment_form_title(esc_html__('Leave a comment', 'your-fitness')) : esc_html_e('Comments are closed', 'your-fitness'); ?></h2>

            <?php if (comments_open()) : ?>

                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                    <div class="uk-alert uk-alert-warning"><?php printf(wp_kses(__('You must be <a href="%s">logged in</a> to post a comment.', 'your-fitness'), array('a' => array('href' => array()))), wp_login_url(get_permalink())); ?></div>
                <?php else : ?>

                    <form class="uk-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

                        <?php if (is_user_logged_in()) : ?>

                            <?php global $user_identity; ?>

                            <p><?php printf(wp_kses(__('Logged in as <a href="%s">%s</a>.', 'your-fitness'), array('a' => array('href' => array()))), get_option('siteurl').'/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_html_e('Log out of this account', 'your-fitness'); ?>"><?php esc_html_e('Log out &raquo;', 'your-fitness'); ?></a></p>

                        <?php else : ?>

                            <?php $req = get_option('require_name_email');?>

                            <div class="uk-form-row <?php if ($req) echo "required"; ?>">
                                <input type="text" name="author" placeholder="<?php esc_html_e('Name', 'your-fitness'); ?> <?php if ($req) echo "*"; ?>" value="<?php echo esc_attr(@$comment_author); ?>" <?php if ($req) echo "aria-required='true'"; ?>>
                            </div>

                            <div class="uk-form-row <?php if ($req) echo "required"; ?>">
                                <input type="text" name="email" placeholder="<?php esc_html_e('E-mail', 'your-fitness'); ?> <?php if ($req) echo "*"; ?>" value="<?php echo esc_attr(@$comment_author_email); ?>" <?php if ($req) echo "aria-required='true'"; ?>>
                            </div>

                            <div class="uk-form-row">
                                <input type="text" name="url" placeholder="<?php esc_html_e('Website', 'your-fitness'); ?>" value="<?php echo esc_attr(@$comment_author_url); ?>">
                            </div>

                        <?php endif; ?>

                        <div class="uk-form-row">
                            <textarea name="comment" id="comment" cols="80" rows="5" tabindex="4"></textarea>
                        </div>

                        <div class="uk-form-row actions">
                            <button class="uk-button uk-button-primary" name="submit" type="submit" id="submit" tabindex="5"><?php esc_html_e('Submit Comment', 'your-fitness'); ?></button>
                            <?php comment_id_fields(); ?>
                        </div>
                        <?php global $post; do_action('comment_form', $post->ID); ?>

                    </form>

                <?php endif; ?>

            <?php endif; ?>

        </div>

       </div>
    </div>

<?php endif;
