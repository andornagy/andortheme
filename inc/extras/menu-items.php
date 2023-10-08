<?php

class MyCP_Menu_Item_Field_Creator
{

  public function __construct()
  {
    add_action('wp_nav_menu_item_custom_fields', array($this, 'menu_item_sub'), 10, 2);
    add_action('wp_update_nav_menu_item', array($this, 'save_menu_item_sub'), 10, 2);
    add_filter('wp_nav_menu_args', array($this, 'menu_item_sub_custom_walker'));
  }

  public function menu_item_sub($item_id, $item)
  {
    $menu_item_sub = get_post_meta($item_id, '_menu_item_sub', true);
?>
    <p class="description description-wide">
      <label for="menu-item-sub-<?php echo $item_id; ?>">
        <?php _e('Subtitle', 'menu-item-sub'); ?><br />
        <input type="text" id="menu-item-sub-<?php echo $item_id; ?>" class="widefat menu-item-sub" name="menu_item_sub[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_item_sub); ?>" />
      </label>
    </p>
<?php
  }

  public function save_menu_item_sub($menu_id, $menu_item_db_id)
  {
    if (isset($_POST['menu_item_sub'][$menu_item_db_id])) {
      $sanitized_data = sanitize_text_field($_POST['menu_item_sub'][$menu_item_db_id]);
      update_post_meta($menu_item_db_id, '_menu_item_sub', $sanitized_data);
    } else {
      delete_post_meta($menu_item_db_id, '_menu_item_sub');
    }
  }

  public function menu_item_sub_custom_walker($args)
  {
    if (class_exists('My_Custom_Nav_Walker')) {
      $args['walker'] = new My_Custom_Nav_Walker();
    } else {
      echo 'DOES NOT EXIST';
    }

    return $args;
  }
}

$mycp_menu_item_field_creator = new MyCP_Menu_Item_Field_Creator();

if (!class_exists('My_Custom_Nav_Walker')) {

  class My_Custom_Nav_Walker extends Walker_Nav_Menu
  {

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
      $menu_item_sub = get_post_meta($item->ID, '_menu_item_sub', true);

      $output .= '<li class="' . implode(' ', $item->classes) . '">';
      if (!empty($menu_item_sub)) {
        $output .= '<span class="menu-item-sub">' . $menu_item_sub . '</span>';
      }
      if ($item->url && $item->url != '#') {
        $output .= '<a href="' . $item->url . '">';
      } else {
        $output .= '<span>';
      }

      $output .= $item->title;
      if ($item->url && $item->url != '#') {
        $output .= '</a>';
      } else {
        $output .= '</span>';
      }
    }
  }
}
