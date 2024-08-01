<?php
$queryArgs = array(
  'post_type'      => 'project',
  'posts_per_page' => 3
);
$loop = new WP_Query($queryArgs);

$sectionTitle = $args['section_title'] ?? 'Recent Projects';

?>

<section class="section margin-t-1 padding-v-2">
  <div class="container">
    <div class="grid-x section__header">
      <h2 class="col-md-6 col-sx-12 section__title"><?php echo $sectionTitle; ?></h2>
      <a class="col-md-6 col-sx-12 section__moreLink" href="/projects/">View more</a>
    </div>
    <div class="grid-x grid-gap-2 margin-v-2 animate animate-stagger">
      <?php
      if ($loop->have_posts()) {
        while ($loop->have_posts()) {
          $loop->the_post();
          get_template_part('parts/loops/project', '', ['animate' => true]);
        }
      }
      ?>
    </div>
  </div>
</section>