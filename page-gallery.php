<?php get_header() ?>

    <div id="gallery-main">
      <div id="screen"></div>
      <div id="caption"></div>
    </div>
    <div id="gallery-navigation">
      <div class="navigation-panel">
        <a class="prev" href="#" title="Previous Page"></a>
        <div id="thumb-panel">
          <ul class="thumbs">
			<?php $args = array(
			    "post_type" => "photo",
			    "post_status" => "publish",
			    "posts_per_page" => -1
			);
			$customPosts = get_posts($args);
			?>
			<?php if(customPosts):?>
			<?php foreach($customPosts as $post):setup_postdata($post); ?>
			<?php
			$thumb = wp_get_attachment_image_src(
				    get_post_thumbnail_id($post->id),
				    "gallery-full");
                $url = $thumb["0"];
			?>
			<li>
			<a class="thumb" href="<?= $url ?>">
				<?php the_post_thumbnail("gallery-thumb",
				    array("title" => get_the_title())); ?>
				</a>
            </li>
            <?php endforeach;?>
			<?php endif;?>
			<?php wp_reset_postdata();?>
          </ul>
        </div>
        <a class="next" href="#" title="Next Page"></a>
      </div>
    </div>

<?php get_footer() ?>