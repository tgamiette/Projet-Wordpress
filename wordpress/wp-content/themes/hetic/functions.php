<?php
//


function wpbootstrap_after_setup_theme() {
  // On ajoute un menu
  register_nav_menu('header_menu', "Menu du header");
  // On ajoute une classe php permettant de gérer les menus Bootstrap
//  require_once get_template_directory() . 'class-wp-bootstrap-navwalker.php';

}
add_action('after_setup_theme', 'wpbootstrap_after_setup_theme');


// On ajoute une sidebar
function wpbootstrap_sidebar() {
  register_sidebar([
                     'name'          => "Sidebar principale",
                     'id'            => 'main-sidebar',
                     'description'   => "La sidebar principale",
                     'before_widget' => '<div id="%1$s" class="widget %2$s p-4">',
                     'after_widget'  => '</div>',
                     'before_title'  => '<h4 class="widget-title font-italic">',
                     'after_title'   => '</h4>',
                   ]);
}

add_action('widgets_init', 'wpbootstrap_sidebar');





//prise en compte de ma nouvelle feuille de style
function my_login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login/style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );