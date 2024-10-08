<?php

/*-------------------------------*/
/* THEME FEATURES */
/*-------------------------------*/

add_action('after_setup_theme', 'andor_theme_features');

function andor_theme_features()
{
  add_theme_support('title-tag');
  add_theme_support('responsive-embeds');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_theme_support('custom-background');
  add_theme_support('wp-block-styles');

  register_nav_menus(array(
    'main-menu' => 'Main menu',
    'top-menu' => 'Top menu',
    'footer-menu' => 'Footer menu'
  ));

  add_image_size('banner', 1600, 900);
  add_image_size('landscape', 600, 400, true);
  add_image_size('avatar', 256, 256, true);
}
