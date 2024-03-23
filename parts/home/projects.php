<?php
$args = array(
  'post_type'      => 'project',
  'posts_per_page' => 3
);
$loop = new WP_Query($args);
?>

<section class="container grid-x grid-gap-2 margin-h-1 animate animate-stagger">
  <?php
  if ($loop->have_posts()) {
    while ($loop->have_posts()) {
      $loop->the_post();
      get_template_part('parts/loops/project', '', ['animate' => true]);
    }
  }
  ?>
</section>