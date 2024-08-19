<?php
/*
* ENQUEUE JS AND CSS
*/
add_action('wp_enqueue_scripts', 'andor_enqueue_scripts');

function andor_enqueue_scripts()
{
  wp_enqueue_style('theme-fonts', get_theme_file_uri('/assets/css/theme-fonts.css'), array(), filemtime(get_theme_file_path('/assets/css/theme-fonts.css')), 'all');

  wp_enqueue_style('theme-css', get_theme_file_uri('/assets/css/main.css'), array(), filemtime(get_theme_file_path('/assets/css/main.css')), 'all');

  wp_enqueue_script('theme-js', get_theme_file_uri('/assets/js/bundle.js'), array(), filemtime(get_theme_file_path('/assets/js/bundle.js')), true);

  wp_enqueue_script('font-awesome-kit', 'https://kit.fontawesome.com/da106994c1.js', array(), '6.0.0');

  wp_register_script('custom-vars', '',);
  wp_enqueue_script('custom-vars');
  $data = "
    window.themeData = {
        root_url: '" . site_url('/') . "',
        ajax_url: '" . site_url() . "/wp-admin/admin-ajax.php',
        rest_nonce: '" . wp_create_nonce('wp_rest') . "',
        ajax_nonce: '" . wp_create_nonce('ajax-nonce')  . "',
    }
    ";

  wp_add_inline_script('custom-vars', $data);

  // wp_dequeue_style('global-styles');
}
