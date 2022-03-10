<?php

class BannerMessage {
  const OPTION_GROUP = "wphetic_group";
  const SETTING_SECTION = "wphetic_section";

  public function __construct() {
    add_action('admin_menu', [$this, 'addMenu']);
  }

  public static function init() {
    add_action('admin_menu', [self::class, 'addMenu']);
    add_action('admin_init', [self::class, 'registerSetting']);
  }

  public static function registerSetting() {
    registerSetting(self::OPTION_GROUP, 'custom_header_banner', 'custom_header_banner', ['default' => 'promo avec le code :']);

    add_settings_section(self::SETTING_SECTION, 'paramètre', function () {
      echo 'modifier la banière';
    }, self::MENU_PAGE_NAME);

    add_setting_field('wphetic_banner_message', 'Message de la bannière', function () {
      ?>
      <textarea name=<?= self::BANNER_MESSAGE; ?>><?= get_otion(self::BANNER_MESSAGE); ?>"</textarea>
      <? php},self::MENU_PAGE_NAME,self::SETTING_SECTION);

}

  public static function wphetic_render_header_banner() {
    echo get_option("custom_header_banner");
  }

  public function addMenu() {
    add_Menu_page('Ajouter une bannière',
      'Header Banner',
      'manage_options', 'wphetic_banner', [$this, 'wphetic_render_banner'], 'dashicons-info', 80);
  }
}
