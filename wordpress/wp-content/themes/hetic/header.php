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
<<<<<<< HEAD
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php wp_nav_menu([
                'theme_location' => 'header_menu',
                'container' => false,
                'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
            ]); ?>

            <?php get_search_form(); ?>
=======
  <!-- Header -->
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-12 text-center">
        <a class="blog-header-logo text-dark" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a>
        <?php if(is_user_logged_in()){ ?>
          <a class="btn btn-warning" href="<?= home_url('/ajout-logement')?> ">Ajouter un logement</a>
        <?php
        }else {
          return null;
        }
        ?>
      </div>
    </div>
  </header>
  <!-- Fin du header -->
>>>>>>> 90963aa ([First version] add post)

        </div>
    </div>
</nav>
</body>
