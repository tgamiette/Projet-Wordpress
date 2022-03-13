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
        </div>
      </div>
    </div>
  </header>
</div>
  <!-- Fin du header -->
<div class="container">

