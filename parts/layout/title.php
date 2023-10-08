<?php
$id = get_the_ID();
$author_id = get_post_field('post_author', $id);
$author_name = get_the_author_meta('display_name', $author_id);



?>

<div class="col-sm-12 text-white">
  <h1 class="title"><?php echo get_the_title() ?></h1>
  <div class="meta">
    <span class="meta__author">
      <?php if (get_avatar($author_id, '30',)) { ?>
        <?php echo get_avatar($author_id, '30',) ?>
      <?php } ?>
      <?php echo $author_name; ?>
    </span>
    <span class="meta__date"><?php echo get_the_date(); ?></span>
    <span class="meta__cat"><?php echo andor_get_post_tax('category', $id) ?></span>
  </div>
</div>