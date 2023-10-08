<?php get_header() ?>


<div class="container grid-x grid-gap-2 mh-1 mt-1">
  <?php get_template_part('parts/components/about') ?>
  <?php get_template_part('parts/components/socials') ?>

  <?php get_template_part('parts/home/projects') ?>
  <div class="container grid-x grid-gap-2 mh-1 mt-2">
    <section class="card content-recent-posts col-sm-12 col-md-6">
      <h2>📖 Blog Posts</h2>
      <ul>
        <li>How to learn Coding the proper way</li>
        <li>Learn CSS Selectors quickly</li>
        <li>The WordPress Rest API</li>
        <li>Custom REST API Endpoints in WordPress</li>
        <li>The rule of the univers and beyound</li>
      </ul>
    </section>
    <section class="card content-recent-snippets col-sm-12 col-md-6">
      <h2>📝 Code Snippets</h2>
      <ul>
        <li>How to learn Coding the proper way</li>
        <li>Learn CSS Selectors quickly</li>
        <li>The WordPress Rest API</li>
        <li>Custom REST API Endpoints in WordPress</li>
        <li>The rule of the univers and beyound</li>
      </ul>
    </section>
  </div>


  <?php get_footer() ?>