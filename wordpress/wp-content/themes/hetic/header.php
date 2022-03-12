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
<div class="container">
  <!-- Header -->
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="c-nav text-center">
        <!-- <a class="blog-header-logo text-dark" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a> -->
        <div class="c-logo">
         <?php if(has_custom_logo()) : ?>
         <?php the_custom_logo(); ?>
         <?php else : ?>
         <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
         <?php endif; ?>
        </div>
        <div class="c-link">
          <?php
          wp_nav_menu(array(
            'theme_location'    => 'header_menu',
            'items_wrap'     => '%3$s',
            'container'      => false,
            'depth'          => 1,
            'link_before'    => '<span>',
            'link_after'     => '</span>',
            'fallback_cb'    => false,
          ));
          ?>
        </div>

        <div class="c-right_header">
          <?php if(is_user_logged_in()){ ?>
            <a class="c-btn is__orange" href="<?= home_url('/ajout-logement')?> ">Ajouter un logement</a>
            <?php
            if(current_user_can('administrator')){
              ?>
                <a class="c-btn is__brown" href="<?= home_url('/moderation')?> ">Moderation</a>
              <?php
            }
          }else {
            return null;
          }
          ?>
        </div>

        </div>
      </div>
    </div>
  </header>
</div>
<div class="sub-header"></div>

  <!-- Fin du header -->

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
