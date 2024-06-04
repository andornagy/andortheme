<?php

class Andor_Nav_Walker extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
  {
    $output .= "<li class='" .  implode(" ", $item->classes) . "'>";

    if ($item->url && $item->url != '#') {
      $output .= '<a href="' . $item->url . '">';
    } else {
      $output .= '<span>';
    }

    $output .= '<span  class="menu-item-title">' . $item->title . '</span>';

    if ($depth == 0 && !empty($item->description)) {
      $output .= '<span class="menu-item-desc">' . $item->description . '</span>';
    }

    if ($item->url && $item->url != '#') {
      $output .= '</a>';
    } else {
      $output .= '</span>';
    }

    if ($args->walker->has_children) {
      $output .= '<i class="caret fa fa-angle-down"></i>';
    }
  }
}
