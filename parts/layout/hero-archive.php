<?php
$pageID = get_the_ID();

$data = [
  'title'       => get_field('title', $pageID) ?? get_the_title($pageID),
  'subtitle'    => get_field('subtitle', $pageID) ?? '',
  'background'  => get_field('background_image', $pageID) ?? '',
];

if ($data['background']) {
  $backgroundImg = wp_get_attachment_url($data['background']);
}

$heroSize = $args['size'] ? 'hero--' . $args['size'] : 'hero--small';

?>

<section class="section section--full-width hero <?php echo $heroSize ?> hero--dark-overlay align-vertical-center">
  <?php if ($backgroundImg) { ?>
    <img class="hero__background" src="<?php echo $backgroundImg ?>" />
  <?php } ?>
  <div class="hero__content container">
    <h1><?php echo $data['title'] ?></h1>
    <h3><?php echo $data['subtitle'] ?></h3>
  </div>
</section>