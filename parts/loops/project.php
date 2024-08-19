<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$excerpt = isset($args['excerpt']) ? $args['excerpt'] : true;

$animate_class = !isset($args['animate']) || $args['animate'] ? 'stagger-item' : '';

?>

<div <?php post_class('card bg-secondary col-md-4 col-xs-12 ' . esc_attr($animate_class)); ?>>
  <?php if (has_post_thumbnail()) { ?>
    <div class="card__image rectangle-img">
      <?php the_post_thumbnail('medium') ?>
    </div>
  <?php } ?>
  <h3 class="card__title"><a href="<?php echo get_the_permalink($id) ?>"><?php echo get_the_title($id) ?></a></h3>
</div>