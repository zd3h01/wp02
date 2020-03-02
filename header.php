<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="<?php bloginfo("charset") ?>">
<title><?php bloginfo("name") ?><?php wp_title(" | ")?></title>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/css/main.css">
<script src="<?= get_template_directory_uri() ?>/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/js/colorbox/colorbox.css">
<script src="<?= get_template_directory_uri() ?>/js/colorbox/jquery.colorbox-min.js"></script>
<script src="<?= get_template_directory_uri() ?>/js/blog.js"></script>

<?php if(is_page("gallery")): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/gallery.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/gallery.js"></script>
<?php endif; ?>

<?php wp_head() ?>
</head>
<body>
<div id="container">
  <header>
    <div id="logo">
      <p><?php bloginfo("description") ?></p>
      <h1><a href="<?=  home_url() ?>"><?php bloginfo("name") ?></a></h1>
    </div>
    <nav>
      <?php wp_nav_menu(["container" => false]) ?>
    </nav>
  </header>
  <main>