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

    echo $output;
  }
}
