<?php
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <!-- Header -->
  <header class="blog-header py-3">
      <?php get_template_part('menu')?>
  </header>

<div class="sub-header"></div>
  <?php if (get_option('wphetic_banner_active') == 'true'): ?>
      <div class="alert alert-danger"
           style="color:<?= get_option('wphetic_banner_font_color') ?>;background:<?= get_option('wphetic_banner_bg_color') ?>"
           role="alert"
      <?php getoption('custom_header_banner'); ?>
      </div>
  <?php endif; ?>

  <?php if (get_theme_mod('wphetic_promo_active') == 'true'): ?>
      <div class="alert alert-warning alert-dismissible fade show"
           style="color:<?= get_theme_mod('wphetic_promo_font_color') ?>;background:<?= get_theme_mod('wphetic_promo_bg_color') ?>"
           role="alert">
          <strong> <?= esc_html(get_theme_mod('wphetic_promo_label')) ?></strong>
      </div>
  <?php endif;?>
  <div class="container">

