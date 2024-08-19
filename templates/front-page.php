<?php

/**
 * 
 * Template Name: Front Page
 */

get_header();

$pageID = get_the_ID();
?>


<?php get_template_part('parts/layout/hero', '', ['size' => 'large']) ?>

<?php get_template_part('parts/home/projects', '', ['section_title' => 'Featured Projects']) ?>

<section class="section margin-t-1 padding-v-2">
  <div class="container">
    <h2>Some awesome content</h2>
    <div class="grid-x grid-gap-2 margin-v-2 animate animate-stagger">
      <?php get_template_part('parts/components/content', 'list', [
        'title'     => '📖 Blog Posts',
      ]) ?>
      <?php get_template_part('parts/components/content', 'list', [
        'title'     => '📝 Code Snippets',
        'post_type' => 'code-snippet',
      ]) ?>
    </div>
  </div>
</section>


<?php get_footer() ?>