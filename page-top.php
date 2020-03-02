<?php get_header() ?>

<div id="catch">
    <?php
    $args = array(
        'post_type' => 'photo',
        'post_status' => 'publish',
        'posts_per_page' => 1
    );
    $customPosts = get_posts($args);
    ?>
 <?php if ($customPosts): ?>
 <?php foreach ($customPosts as $post): setup_postdata($post); ?>
 <a href="<?php echo home_url(); ?>/gallery">
 <?php the_post_thumbnail('gallery-full',array('title'=>'')); ?></a>
 <?php endforeach; ?>
 <?php endif; ?>
 <?php wp_reset_postdata(); ?>
 </div>

<?php get_footer() ?>
