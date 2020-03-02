<?php get_header() ?>

	<?php if(have_posts()):?>
	<?php while(have_posts()):the_post();?>

    <div id="resume">
      <?php the_content();?>

    </div>
    <div id="portrait">
      <?php the_post_thumbnail(array(400,400));?>
<!--       <img width="400" height="400" src="sample/portrait.jpg" alt=""> -->
    </div>

	<?php endwhile;?>
	<?php endif;?>

<?php get_footer() ?>