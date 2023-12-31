<?php get_header() ?>

<section class="container grid-x grid-gap-2 mh-1 mt-1">
  <?php get_template_part('parts/components/about') ?>
  <?php get_template_part('parts/components/socials') ?>
</section>

<?php get_template_part('parts/home/projects') ?>

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