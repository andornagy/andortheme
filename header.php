<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header bg-secondary text-white">
    <div class="container grid-x grid-gap-1">
      <section class="col-sm-12 col-md-2">
        <?php echo andor_blog_title() ?>
      </section>
      <nav class="nav col-sm-12 col-md-10">
        <?php
        // Main menu
        wp_nav_menu(array(
          'theme_location' => 'main-menu',
          'items_wrap' => '<ul class="menu">%3$s</ul>',
          'container' => '',
          'depth' => 3,
          'walker' => new Andor_Nav_Walker(),
          'show_carets' => true
        ));
        ?>
      </nav>
    </div>
  </header>