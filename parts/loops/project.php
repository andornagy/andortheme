<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$excerpt = isset($args['excerpt']) ? $args['excerpt'] : true;

?>

<div class="card bg-primary col-sm-12 col-md-4">
  <h3 class="card-title"><?php echo get_the_title($id) ?></h3>
  <?php if ($excerpt) {
    echo has_excerpt($id) ? wpautop(get_the_excerpt($id)) : wpautop(wp_trim_words(get_the_content($id), 20, ''));
  } ?>
  <a class="btn btn-readMore" href="#">Read More</a>
</div>