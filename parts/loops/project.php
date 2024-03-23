<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$excerpt = isset($args['excerpt']) ? $args['excerpt'] : true;

$animate_class = !isset($args['animate']) || $args['animate'] ? 'stagger-item' : '';

?>

<div <?php post_class('card bg-primary col-sm-12 col-md-4 ' . esc_attr($animate_class)); ?>>
  <?php if (has_post_thumbnail()) { ?>
    <div class="card-img rectangle-img">
      <?php the_post_thumbnail('medium') ?>
    </div>
  <?php } ?>
  <h3 class="card-title"><?php echo get_the_title($id) ?></h3>
  <?php if ($excerpt) {
    echo has_excerpt($id) ? wpautop(get_the_excerpt($id)) : wpautop(wp_trim_words(get_the_content($id), 20, ''));
  } ?>
  <a class="btn btn-readMore" href="<?php the_permalink() ?>">View Project</a>
</div>