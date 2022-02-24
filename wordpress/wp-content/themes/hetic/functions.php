<?php
define(SINGLE_PATH, TEMPLATEPATH . '/single');

function bootstrap_stylesheet() {
  wp_enqueue_style("bootstrap_css", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css");
  wp_enqueue_style("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js", [], false, true);
}


function custom_setup_theme() {

  // On ajoute un menu
  //  register_nav_menu('header_menu', "Menu du header");
  // On ajoute une classe php permettant de gérer les menus Bootstrap
  //  require_once get_template_directory() . 'class-wp-bootstrap-navwalker.php';
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  //add_theme_support('is_validate');
}

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

//prise en compte de ma nouvelle feuille de style pour page de connexion
function my_login_stylesheet() {
  wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login/style.css');
}


/**
 * Filter the single_template with our custom function
 */

/**
 * Single template function which will choose our template
 */
function my_single_template($single) {
  global $wp_query, $post;

  foreach ((array)get_the_category() as $cat) :
//    object(WP_Term)#4558 (16) { ["term_id"]=> int(1) ["name"]=> string(11) "Non classé" ["slug"]=> string(10) "non-classe" ["term_group"]=> int(0) ["term_taxonomy_id"]=> int(1) ["taxonomy"]=> string(8) "category" ["description"]=> string(0) "" ["parent"]=> int(0) ["count"]=> int(4) ["filter"]=> string(3) "raw" ["cat_ID"]=> int(1) ["category_count"]=> int(4) ["category_description"]=> string(0) "" ["cat_name"]=> string(11) "Non classé" ["category_nicename"]=> string(10) "non-classe" ["category_parent"]=> int(0) }
    if (file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php')) {
      return SINGLE_PATH . '/single-cat' . $cat->slug . '.php';
    }
    elseif (file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php')) {
      return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';
    }
    else{
      return SINGLE_PATH . '/single.php';
    }

  endforeach;
}


add_action('widgets_init', 'wpbootstrap_sidebar');
add_action('after_setup_theme', 'custom_setup_theme');
add_action('login_enqueue_scripts', 'my_login_stylesheet');
add_action('wp_enqueue_scripts', 'bootstrap_stylesheet');
add_filter('single_template', 'my_single_template');

