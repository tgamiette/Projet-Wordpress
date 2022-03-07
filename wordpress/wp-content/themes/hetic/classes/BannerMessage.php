<?php

class BannerMessage {
  public function __construct() {
    add_action('admin_menu', [$this, 'addMenu']);
  }


  public function addMenu() {
    add_Menu_page('Ajouter une bannière', 'Header Banner', 'Manage_option', 'wphetic_banner', [$this, 'wp_hetic_render_banner'], 'dashicons-info', 80);
  }
}
