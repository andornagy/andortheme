<?php

/*
* GET POSTS YEARS
*/

function get_posts_years($post_type = 'post', $category = null)
{
  // Prepare query arguments for retrieving posts
  $query_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => -1, // Get all posts
    'fields'         => 'post_date', // Only retrieve post dates
    'orderby'        => 'post_date',
    'order'          => 'DESC'
  );

  // If a category is specified, add it to the query
  if ($category) {
    $query_args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => $category
      )
    );
  }

  // Execute the query to retrieve posts
  $posts = get_posts($query_args);

  // Extract years from post dates
  $years = array();
  foreach ($posts as $post) {
    $years[] = date('Y', strtotime($post->post_date));
  }

  // Return unique years
  return array_unique($years);
}
