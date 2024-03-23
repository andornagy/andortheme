<?php get_header() ?>

<section class="container grid-x grid-gap-2 mh-1 mt-1">

  <?php get_template_part('parts/layout/title'); ?>

  <div class="content card bg-blue text-white col-sm-12 col-md-9">
    <?php the_content(); ?>
    <?php echo andor_get_post_taxonomy('post_tag'); ?>
  </div>
</section>

<section class="container grid-x grid-gap-2 mh-1 mt-1">
  <?php get_template_part('parts/components/content', 'list', [
    'title'     => '📖 Blog Posts',
  ]) ?>
  <?php get_template_part('parts/components/content', 'list', [
    'title'     => '📝 Code Snippets',
    'post_type' => 'code-snippet',
  ]) ?>
</section>


<?php get_footer() ?>