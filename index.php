<?php get_header() ?>

    <?php if(have_posts()): ?>
    <?php $more = 1; ?>
    <?php while(have_posts()): the_post();?>
    <article class="post">
      <p class="date"><?= get_the_date("n/j")?></p>
      <h2><?php the_title() ?></h2>
      <div class="entry">
		<?php the_content() ?>
      </div>
    </article><!-- post -->
    <?php endwhile; ?>
    <?php endif; ?>

    <div id="link">
      <?php previous_posts_link() ?>
        <?php next_posts_link() ?>
    </div>

 <?php get_footer() ?>
