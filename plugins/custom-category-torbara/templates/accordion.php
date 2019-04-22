<div class="uk-accordion" data-uk-accordion="{duration: 300}" style="margin-top: 50px; margin-bottom: 50px;"> 
    <?php while ($q->have_posts()) {
    $q->the_post(); ?>

    <h3 class="uk-accordion-title accordion-title" style="text-transform: uppercase;"><?php echo $post->post_title;?></h3>
    <div class="uk-accordion-content"> <?php the_content(); ?></div>

    <?php } ?>
</div>