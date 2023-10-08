<?php

/**
 * Returns the blog title, in <h1> if front page, <span> if not.
 *
 * @return string blog title
 */
if (!function_exists('andor_blog_title')) {
  function andor_blog_title()
  {
    $output = ''; // Initialize $output variable

    $output .= (is_front_page() === true) ? '<h1 class="site-title">' : '<span class="site-title">';
    $output .= get_bloginfo('name');
    $output .= (is_front_page() === true) ? '</h1>' : '</span>';

    return $output;
  }
}

/**
 * Returns the post categories as a list
 *
 * @param int post ID
 * @return html list of post categories
 */
if (!function_exists('andor_get_post_cats')) {
  function andor_get_post_tax(string $type = 'category', int $post_id = null)
  {

    $post_id = $post_id ?? get_the_ID();

    $taxonomies = get_the_terms($post_id, $type);

    $output = '<ul class="cat-list">';

    foreach ($taxonomies as $taxonomy) {

      $link = get_term_link($taxonomy->term_id);
      $name = $taxonomy->name;

      $output .= "<li><a href='{$link}' title='{$name}'>{$name}</a></li>";
    }

    $output .= '</ul>';

    return $output;
  }
}
