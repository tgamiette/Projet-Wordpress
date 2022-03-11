<?php
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
  <!-- Header -->
<!--  <class="blog-header py-3">-->
  <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-12 text-center">
      <a class="blog-header-logo text-dark" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a>
      <?php if (is_user_logged_in()) : ?>
        <a class="btn btn-warning" href="<?= home_url('/ajout-logement') ?> ">Ajouter un logement</a>
        <?php
        if (current_user_can('administrator')) : ?>
          <a class="btn btn-danger" href="<?= home_url('/moderation') ?> ">Moderation</a>
        <?php endif;
      else :
        return null;
      endif;
      ?>
    </div>
  </div>
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
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif;?>
<div class="container">
