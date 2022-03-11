<?php

class BannerMessage {
const OPTION_GROUP = "wphetic_group";
const SETTING_SECTION = "wphetic_section";
const MENU_PAGE_NAME = "wphetic_header_banner";
const BANNER_MESSAGE = "custom_header_banner";
const BANNER_ACTIVE = "wphetic_banner_active";

public function __construct() {
  add_action('admin_menu', [$this, 'addMenu']);
}

//
public static function init() {
  add_action('admin_menu', [self::class, 'addMenu']);
  add_action('admin_init', [self::class, 'registerSetting']);
}

//
public static function registerSetting() {
  add_settings_section(self::SETTING_SECTION, 'Paramètres', function () {
    echo 'modifier la banière';
  }, self::MENU_PAGE_NAME);

  //message
  registerSetting(self::OPTION_GROUP, self::BANNER_MESSAGE, ['default' => 'rien de spe']);
  add_settings_field('wphetic_banner_message', 'Message de la bannière', function () {
    ?>
    <textarea name="<?= self::BANNER_MESSAGE ?>"><?= get_option(self::BANNER_MESSAGE); ?></textarea>
  <?php }, self::MENU_PAGE_NAME, self::SETTING_SECTION);

//  /bouton
  registerSetting(self::OPTION_GROUP, self::BANNER_ACTIVE, ['default' => 'rien de spe']);
  add_settings_field('wphetic_banner_message', 'Message de la bannière', function () {
    ?>
    <input type="checkbox" value="true" name="<?= self::BANNER_ACTIVE ?> "><?= checked(get_option(self::BANNER_ACTIVE),true); ?></input>
  <?php }, self::MENU_PAGE_NAME, self::SETTING_SECTION);

}

public static function wphetic_render_header_banner() {
?>
<div class="wrap">
  <H1><?= get_admin_page_title(); ?></H1>
  <form action="options.php" method="post">
    <?php settings_fields(self::OPTION_GROUP); ?>
    <?php do_settings_sections(self::MENU_PAGE_NAME); ?>
    <?php submit_button(); ?>
  </form>
</div>
<?php
}

public function addMenu() {
add_Menu_page('Ajouter une bannière dans le header',
'Header Banner',
'manage_options', self::MENU_PAGE_NAME, [$this, 'wphetic_render_header_banner'], 'dashicons-info', 80);
}
}
