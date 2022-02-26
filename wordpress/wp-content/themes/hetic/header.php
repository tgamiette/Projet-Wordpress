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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php wp_nav_menu(['theme_location' => 'header_menu',
                               'container'      => false,
                               'menu_class'     => "navbar-nav me-auto mb-2 mb-lg-0"]); ?>

            <?php get_search_form(); ?>
        </div>
    </div>
</nav>
<div class="alert alert-warning alert-dismissible fade show"
     style="color:<?= get_theme_mod('wphetic_promo_font_color') ?>;background:<?= get_theme_mod('wphetic_promo_bg_color') ?>"
     role="alert">
    <strong> <?= get_theme_mod('wphetic_promo_label') ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container">
</body>
