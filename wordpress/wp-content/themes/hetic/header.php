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
        <!-- <a class="blog-header-logo text-dark" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a> -->
        <?php if(has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
        <?php else : ?>
        <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>
        <?php if(is_user_logged_in()){ ?>
          <a class="btn btn-warning" href="<?= home_url('/ajout-logement')?> ">Ajouter un logement</a>
          <?php
          if(current_user_can('administrator')){
            ?>
              <a class="btn btn-danger" href="<?= home_url('/moderation')?> ">Moderation</a>
            <?php
          }
        }else {
          return null;
        }
        ?>
      </div>
    </div>
  </header>
  <!-- Fin du header -->
>>>>>>> 90963aa ([First version] add post)

<<<<<<< HEAD
        </div>
    </div>
</nav>
</body>
=======
  <!-- Menu header -->
 <!-- <nav class="navbar navbar-expand-md navbar-light" role="navigation">
   <div class="container">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="#header-menu" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <?php
     // wp_nav_menu(array(
     //               'theme_location'    => 'header_menu',
     //               'depth'             => 2,
     //               'container'         => 'div',
     //               'container_class'   => 'collapse navbar-collapse',
     //               'container_id'      => 'header-menu',
     //               'menu_class'        => 'nav navbar-nav',
     //               'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
     //               'walker'            => new WP_Bootstrap_Navwalker(),
     //             ));
     ?>
   </div>
 </nav> -->
>>>>>>> f97e97a ([style] add style)
