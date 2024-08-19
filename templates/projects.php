<?php

/**
 * 
 * Template Name: Projects
 */

get_header();

$projects = getQuery('project');

?>

<?php get_template_part('parts/layout/hero', 'archive') ?>

<section class="section margin-t-1 padding-v-2">
  <div class="container">
    <div class="grid-x grid-gap-2 margin-v-2 animate animate-stagger">
      <?php
      if ($projects->have_posts()) {
        while ($projects->have_posts()) {
          $projects->the_post();
          get_template_part('parts/loops/project', '', ['animate' => true]);
        }
      }
      ?>
    </div>
  </div>
</section>


<?php get_footer() ?>