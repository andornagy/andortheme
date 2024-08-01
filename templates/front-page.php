<?php

/**
 * 
 * Template Name: Front Page
 */

get_header();

$pageID = get_the_ID();

$data = [
  'title'       => get_field('title', $pageID) ?? '',
  'subtitle'    => get_field('subtitle', $pageID) ?? '',
  'background'  => get_field('background_image', $pageID) ?? '',
];

if ($data['background']) {
  $backgroundImg = wp_get_attachment_url($data['background']);
}

?>

<section class="section section--full-width hero hero--large hero--dark-overlay align-vertical-center">
  <img class="hero__background" src="<?php echo $backgroundImg ?>" />
  <div class="hero__content container">
    <h2 class="font-lg"><?php echo $data['title'] ?></h2>
    <h3><?php echo $data['subtitle'] ?></h3>
  </div>
</section>



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