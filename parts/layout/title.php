<?php
$id = get_the_ID();
$author_id = get_post_field('post_author', $id);
$author_name = get_the_author_meta('display_name', $author_id);

?>

<div class="col-sm-12 text-white">
  <h1 class="title"><?php echo get_the_title() ?></h1>
</div>