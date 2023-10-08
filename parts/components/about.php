<?php

$title = isset($args['title']) && $args['title'] ? $args['title'] : '🐯 About me';

$user = get_user_by('login', 'andor');

$description = get_user_meta($user->ID, 'description', true)

?>

<section class="about-me card col-sm-12 col-md-8 p-1 bg-primary-dark-1 text-white">
  <h2><?php echo $title ?></h2>
  <div class="grid-x grid-gap-1 pt-1">
    <div class="col-sm-4">
      <?php
      echo get_avatar($user->id, $size = '200', $default = '<path_to_url>');
      ?>
    </div>

    <div class="col-sm-8">
      <?php echo $description ? wpautop($description) : ''; ?>
    </div>
  </div>
</section>