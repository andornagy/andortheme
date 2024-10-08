<?php

$title      = isset($args['title']) ? $args['title'] : 'Recent Posts';
$color      = isset($args['color']) ? 'bg-' . $args['color'] : 'bg-secondary';

$post_type  = isset($args['post_type']) ? $args['post_type'] : 'post';
$limit      = isset($args['limit']) ? $args['limit'] : 5;

$args = array(
  'post_type'      => $post_type,
  'posts_per_page' => $limit
);
$loop = new WP_Query($args);
?>

<div class="card col-sm-12 col-md-6 <?php echo $color ?> stagger-item">
  <h3><?php echo $title ?></h3>
  <ul>
    <?php
    while ($loop->have_posts()) {
      $loop->the_post();

      $id = get_the_ID();

    ?>
      <li>
        <a href="<?php echo get_permalink($id) ?>" title="<?php echo get_the_title($id) ?>">
          <?php echo get_the_title($id) ?>
        </a>
      </li>
    <?php
    }
    ?>
  </ul>
</div>