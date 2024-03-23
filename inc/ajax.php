<?php
/*
* DISPLAY FILTER SELECTOR
*/
function displayFilterSelect($options, $slug, $title)
{
  if ($options) {
    $current = isset($_GET[$slug]) ? $_GET[$slug] : null;
    echo '<div class="cell medium-6 large-2">';
    echo '<select name="' . esc_attr($slug) . '" class="filter__item filter__item--reset">';
    echo '<option value>' . esc_html($title) . '</option>';
    foreach ($options as $option => $title) {
      $currentOption = $current == $option ? 'selected="selected"' : '';
      echo '<option value="' . esc_attr($option) . '" ' . esc_attr($currentOption) . '>' . esc_html($title) . '</option>';
    }
    echo '</select>';
    echo '</div>';
  }
}

/*
* DISPLAY FILTER CHECKBOXES
*/
function displayFilterCheckbox($options, $slug, $label = '')
{
  if ($options) {
    $current_query = isset($_GET[$slug]) ? $_GET[$slug] : null;
    $current_checked = explode('|', $current_query);
    echo '<fieldset class="filter">';

    if ($label) echo '<label class="input__label">' . esc_html($label) . '</label>';
    foreach ($options as $option => $title) {
      $checked = in_array($option, $current_checked) ? 'checked="checked"' : '';
      echo '<div class="input--checkbox"><input id="' . esc_attr($option) . '" name="' . esc_attr($slug) . '" value="' . esc_attr($option) . '" class="filter__item filter__item--reset" type="checkbox" ' . esc_attr($checked) . '><label for="' . esc_attr($option) . '">' . esc_html($title) . '</label></div>';
    }
    echo '</fieldset>';
  }
}

/*
* DISPLAY FILTERS
*/
function ajaxFilters($type, $cat = null)
{

  $output = '';

  if ($type) {
    echo '<form id="filters" class="filters" method="POST">';

    // Start of wrapper
    echo '<div class="grid-x grid-margin-x grid-padding-y">';
    // Filters here

    // POSTS CATEGORIES
    if ($type === 'post') {
      $post_categories = get_terms(array(
        'taxonomy' => 'category',
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));
      $options = [];

      foreach ($post_categories as $post_category) {
        if ($post_category->term_id === 1) continue;
        $options[$post_category->slug] = $post_category->name;
      }
      displayFilterSelect($options, 'cat', __('All posts', 'squareeye'));
    }

    // BARRISTERS CATEGORIES
    if ($type === 'barrister') {
      $barrister_cats = getPublicBarristerCategories(); // query.php
      $options = [];
      foreach ($barrister_cats as $barrister_cat) {
        $options[$barrister_cat['slug']] = $barrister_cat['title'];
      }
      displayFilterSelect($options, 'b_cat', __('Any categories', 'squareeye'));
    }


    // AREAS
    if ($type === 'post' || $type === 'barrister' || $type === 'case' || $type === 'event' || $type === 'publication') {
      $areas = new WP_Query(array(
        'post_type' => 'area',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'post_parent' => 0,
        'orderby' => 'title',
        'order' => 'ASC'
      ));
      $options = [];
      while ($areas->have_posts()) {
        $areas->the_post();
        $options[get_the_ID()] = get_the_title();
      }
      wp_reset_postdata();
      displayFilterSelect($options, 'a', __('Any expertise', 'squareeye'));
    }

    // BARRISTERS
    if ($type === 'post' || $type === 'case' || $type === 'event' || $type === 'publication') {
      $barristers = new WP_Query(array(
        'post_type' => 'barrister',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
      ));
      $options = [];
      while ($barristers->have_posts()) {
        $barristers->the_post();
        $options[get_the_ID()] = get_the_title();
      }
      wp_reset_postdata();
      displayFilterSelect($options, 'b', __('All barristers', 'squareeye'));
    }

    // YEAR
    if ($type === 'post') {
      $years = array();
      $cat_obj = is_numeric($cat) ? get_category($cat) : get_category_by_slug($cat);
      $years = $cat_obj ? get_posts_years('post', $cat_obj->term_id) : get_posts_years('post');
      $options = [];
      foreach ($years as $year) {
        $options[$year] = $year;
      }
      displayFilterSelect($options, 'y', __('All years', 'squareeye'));
    }

    // SEARCH POSTS
    if ($type === 'post') {
      $current = isset($_GET['kw']) ? $_GET['kw'] : '';
      echo '<div class="cell medium-6 large-2">';
      echo '<input type="text" name="kw" class="input__search filter__item filter__item--reset" value="' . esc_attr($current) . '" placeholder="' . __('Search', 'squareeye') . '">';
      echo '</div>';
    }

    // SEARCH BARRISTERS
    if ($type === 'barrister') {
      $current = isset($_GET['title']) ? $_GET['title'] : '';
      echo '<div class="cell medium-6 large-2">';
      echo '<input type="text" name="title" class="input__search filter__item filter__item--reset" value="' . esc_attr($current) . '" placeholder="' . __('Search by name', 'squareeye') . '">';
      echo '</div>';
    }

    // RESET
    echo '<div class="cell medium-6 large-2">';
    echo '<button type="button" class="reset hollow button primary">' . __('Reset', 'squareeye') . '</button>';
    echo '</div>';

    // End of wrapper
    echo '</div>';

    if ($cat) echo '<input type="hidden" name="cat" value="' . esc_attr($cat) . '">';
    //echo '<input type="hidden" name="slug" value="' . basename(get_permalink(get_the_ID())) . '">';
    echo '<input type="hidden" name="type" value="' . esc_attr($type) . '">';
    echo '<input type="hidden" name="pg" value="">';
    echo '</form>';
  }

  return $output;
}

/*
* DISPLAY PAGINATION
*/
function ajaxPagination($type, $cat = null)
{
  if ($type) {
    add_action('pre_get_posts', 'stickyPostsFunctionality');

    $query = getQuery($type, $cat);

    $paged = $query->query_vars['paged'];
    $max_num_pages = $query->max_num_pages;

    // if sticky posts and on the first page, then need to count manually without sticky posts
    if (isset($query->query_vars['enable_sticky_posts']) && $query->query_vars['enable_sticky_posts'] && !$query->query_vars('paged')) {
      $temp_args = $query->query_vars;
      $temp_args['post__in'] = '';
      $temp_args['fields'] = 'ids';
      $query_temp = new WP_Query($temp_args);
      $paged = 1;
      $max_num_pages = $query_temp->max_num_pages;
    }

    if ($max_num_pages) {
      if (isset($_REQUEST['pg']) && absint($_REQUEST['pg']) > 0) {
        $current = absint($_REQUEST['pg']);
      } else {
        $current = max(1, $paged);
      }

      $paginateArgs = array(
        'base' => '#%#%',
        'format' => '%#%',
        'current' => $current,
        'total' =>  $max_num_pages,
        'prev_text' => '',
        'next_text' => ''
      );

      echo '<div class="cell cell--no-line padding-vertical-1 flex-container align-middle">';
      echo '<div class="pagination">' . paginate_links($paginateArgs) . '</div>';
      echo '</div>';
    }
  }
}


/*
* AJAX FILTER PROCESSOR
*/

add_action('wp_ajax_process_ajax', 'ajax_processor_function');
add_action('wp_ajax_nopriv_process_ajax', 'ajax_processor_function');

function ajax_processor_function()
{
  // Check for nonce security      
  //    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
  //       die('Busted!');
  //    }

  // Process loop here
  if (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) {
    $type = $_REQUEST['type'];

    remove_all_actions('pre_get_posts');

    add_action('pre_get_posts', 'stickyPostsFunctionality');

    $cat = isset($_REQUEST['cat']) && !empty($_REQUEST['cat']) ? $_REQUEST['cat'] : null;

    $query = getQuery($type, $cat);

    if ($query->have_posts()) {

      // If barristers archive
      if ($type === 'barrister') {
        $barristers_cats = getBarristersByShowOnArchive();
        if (!empty($barristers_cats)) {
          while ($query->have_posts()) {
            $query->the_post();
            foreach ($barristers_cats as $i => $cat) {
              if (has_term($cat['slug'], 'barrister_category')) {
                ob_start();
                get_template_part('parts/loop/loop', 'barrister');
                $barristers_cats[$i]['output'][] = ob_get_contents();
                ob_end_clean();
              }
            }
          }

          wp_reset_postdata();

          foreach ($barristers_cats as $cat) {
            if (isset($cat['output']) && $cat['output']) {
              echo '<div class="cell"><h2>' . esc_html($cat['title']) . '</h2></div>';
              echo implode('', $cat['output']);
            }
          }
        } else {
          while ($query->have_posts()) {
            $query->the_post();
            get_template_part('parts/loop/loop', 'barrister');
          }
        }
      } else {
        // if not barristers archive
        while ($query->have_posts()) {
          $query->the_post();
          $args = array(
            'excerpt' => true,
            'columns' => 3,
          );
          if ($type === 'post') get_template_part('parts/loop/loop', '', $args);
          else get_template_part('parts/loop/loop', $type, $args);
        }
      }



      if ($query->max_num_pages > 1) {
        ajaxPagination($type, $cat); // see pagination.php
      }

      wp_reset_postdata();
    } else {
      echo '<div class="cell"><h4>' . __('No results found. Please adjust your filters.', 'squareeye') . '</h4></div>';
    }
  }

  wp_die();
}
