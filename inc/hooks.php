<?php

if (!function_exists('wp_body_open')) {
  /**
   * Fire the wp_body_open action.
   *
   * Added for backwards compatibility to support WordPress versions prior to 5.2.0.
   */
  function wp_body_open()
  {
    /**
     * Triggered after the opening <body> tag.
     */
    do_action('wp_body_open');
  }
}
