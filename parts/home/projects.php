<?php
$args = array(
  'post_type'      => 'project',
  'posts_per_page' => 3
);
$loop = new WP_Query($args);
?>

<section class="container grid-x grid-gap-2 mh-1">
  <?php
  while ($loop->have_posts()) {
    $loop->the_post();
    get_template_part('parts/loops/project');
  }
  ?>
</section>