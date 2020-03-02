<?php
/**
 * カスタムメニューの登録
 */
register_nav_menus();

/**
 * アイキャッチ画像の有効化
 */
add_theme_support('post-thumbnails');

/**
 * フォトギャラリー用画像サイズの登録
 */
add_image_size('gallery-thumb', 80, 54,true);
add_image_size('gallery-full', 960, 540,true);


/**
 * カスタム投稿タイプ（写真）の登録
 */
register_post_type(
    'photo',
    array(
        'label' => '写真',
        'public' => true,
        'supports' =>array('title','thumbnail')
    )
    );




