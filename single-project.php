<?php get_header();

$previewID = get_field('full_project_preview', get_the_ID());

?>

<?php get_template_part('parts/project/header', 'single') ?>

<section class="container grid-x grid-gap-2 mh-1 mt-1 ">

  <div class="col-sx-12 col-md-7 padding-v-2">
    <?php the_content(); ?>
    <?php echo andor_get_post_taxonomy('post_tag'); ?>
  </div>
  <div class="col-sx-12 col-md-5 project__preview">
    <?php echo  wp_get_attachment_image($previewID, 'full') ?? get_the_post_thumbnail() ?>
  </div>

</section>


<?php get_footer() ?>