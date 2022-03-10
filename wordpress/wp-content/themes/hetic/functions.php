<?php
define(SINGLE_PATH, TEMPLATEPATH . '/template');

function bootstrap_stylesheet() {

  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css');
  wp_enqueue_script('jquery');
  wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array('jquery'), 1, true);
  wp_enqueue_script('boostrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array(
    'jquery',
    'popper'
  ), 1, true);
}

//inscription de l'utilisateur
function save_user() {
  if (!wp_verify_nonce($_POST['random_nonce'], 'random_action')) {
    die("erreur nonce invalide ");
  }
  $username = substr($_POST['email'], 0, strpos($_POST['email'], "@"));
  $user_array = array(
    'user_email' => $_POST['email'],
    'user_login' => $username,
    'first_name' => $_POST['name'],
    'last_name' => $_POST['lastname'],
    'user_pass' => $_POST['password']
  );
  $id = wp_insert_user($user_array);

  wp_update_user(array('ID' => $id, 'role' => $_POST['role']));
  wp_redirect('/');
}

//redirection apres la connection
function redirect_login($redirect, $b, $user) {
  if (!is_wp_error($user) && user_can($user, 'editor')) {
    return '/';
  }
  return $redirect;
}

function custom_setup_theme() {
  //    je sais pas c'est quoi '
  add_theme_support('title-tag');
  //    ajout image de presentation post
  add_theme_support('post-thumbnails');
  //    menu
  add_theme_support('menus');
  register_nav_menu('header_menu', "Menu du header");
  // On ajoute le support du html5 pour les listes de commentaires
  add_theme_support('html5', array('comment-list'));
  $user = wp_get_current_user();

  if (current_user_can('editor'||current_user_can('hetic-user'))) {
    show_admin_bar(false);
  }
}

//Ajout de Boostrap;
//add_action('wp_enqueue_scripts', 'wpheticBootstrap');
//function wpheticBootstrap()
//{
//    wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
//    wp_enqueue_script("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", [], false, true);
//}

// On ajoute une sidebar
//function wpbootstrap_sidebar(){
//    register_sidebar(['name'          => "Sidebar principale",
//                      'id'            => 'main-sidebar',
//                      'description'   => "La sidebar principale",
//                      'before_widget' => '<div id="%1$s" class="widget %2$s p-4">',
//                      'after_widget'  => '</div>',
//                      'before_title'  => '<h4 class="widget-title font-italic">',
//                      'after_title'   => '</h4>',]);
//}

//prise en compte de ma nouvelle feuille de style pour page de connexion
function my_login_stylesheet() {
  wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login/style.css');
}

//Ajout de widget "Logement"
function cptui_register_my_cpts_logement() {
  $labels = [
    "name" => __("Logements", "custom-post-type-ui"),
    "singular_name" => __("Logement", "custom-post-type-ui"),
  ];

  $args = [
    "label" => __("Logements", "custom-post-type-ui"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "show_in_rest" => true,
    "has_archive" => true,
    "delete_with_user" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => ["slug" => "event", "with_front" => true],
    "query_var" => true,
    "supports" => ["title", "thumbnail"],
    "show_in_graphql" => false
  ];

  register_post_type("logement", $args);
  add_theme_support("post-thumbnails", array("logement"));

  $labelsTaxo = [
    'name' => 'Styles',
    'singular_name' => 'Style'
  ];

  $argsTaxo = [
    'labels' => $labelsTaxo,
    'public' => true,
    'hierarchical' => true,
    'show_in_rest' => true,
    'show_admin_column' => true
  ];

  register_taxonomy('style', ['post'], $argsTaxo);
}

//Add metabox to post Logements
function hcf_register_meta_boxes() {
  add_meta_box('hcf-1', __('Desciption du logement', 'hcf'), 'hcf_display_callback', 'logement');
}

function hcf_display_callback($post) {
  include plugin_dir_path(__FILE__) . './metabox.php';
}


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function hcf_save_meta_box($post_id) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if ($parent_id = wp_is_post_revision($post_id)) {
    $post_id = $parent_id;
  }
  $fields = [
    'hcf-description',
    'hcf-logement_type',
    'hcf-espace',
    'hcf-nb_lit',
    'hcf-nb_sdb',
    'hcf-nb_pers',
    'hcf-adresse_logement',
    'hcf-ville_logement',
    'hcf-prix_logement',
    'hcf-proprio_type',
    'hcf-pictures',
  ];
  foreach ($fields as $field) {
    if (array_key_exists($field, $_POST)) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }
}

add_filter('nav_menu_css_class', function ($classes) {
  $classes[] = "nav-item";
  return $classes;
});

add_filter('nav_menu_link_attributes', function ($attr) {
  $attr['class'] = 'nav-link';
  return $attr;
});

add_filter('login_redirect', 'redirect_login', 10, 3);
add_action('add_meta_boxes', 'hcf_register_meta_boxes');
add_action('widgets_init', 'wpbootstrap_sidebar');

add_action('add_meta_boxes', 'hcf_register_meta_boxes');



//Update post

function updatePost() {
  if (current_user_can('administrator')) {
    if (wp_verify_nonce($_REQUEST['update_logement_nonce'], 'update_logement_post')) {
      $post_args = array(
        'ID' => $_POST['update_post_id'],
        'post_status' => 'publish'
      );

      if ($_POST['btn-publish']) {
        wp_update_post($post_args);
      }
      else {
        if ($_POST['btn-delete']) {
          wp_delete_post($_POST['update_post_id']);
        }
      }
      wp_redirect(home_url('/moderation'));
    }
    else {
      var_dump('Une erreur de nonce s\'est produite :)!');
    }
  }
  else {
    var_dump('Une erreur de role s\'est produite!');
  }
}

add_action('admin_post_update_logement_post', 'updatePost');
add_action('after_setup_theme', 'custom_setup_theme');
add_action('login_enqueue_scripts', 'my_login_stylesheet');
add_action('wp_enqueue_scripts', 'bootstrap_stylesheet');
add_action('widgets_init', 'wpbootstrap_sidebar');
add_action('init', 'cptui_register_my_cpts_logement');
add_action('save_post', 'hcf_save_meta_box');
add_action('admin_post_nopriv_wpinscription_form', 'save_user');





add_action('customize_register', function (WP_Customize_Manager $manager) {
  $manager->add_section('wphetic_promo_color', ['title' => 'Bannière promo (HETIC)']);
  $manager->add_setting('wphetic_promo_bg_color', [
    'default' => '#d3d3d3',
    'sanitize' => 'sanitize_hex_color'
  ]);
  $manager->add_control(new WP_Customize_Color_Control($manager, 'wphetic_promo_bg_color', [
    'section' => 'wphetic_promo_color',
    'label' => 'Couleur de fond de la bannière'
  ]));
  $manager->add_setting('wphetic_promo_font_color', [
    'default' => '#d3d3d3',
    'sanitize' => 'sanitize_hex_color'
  ]);
  $manager->add_control(new WP_Customize_Color_Control($manager, 'wphetic_promo_font_color', [
    'section' => 'wphetic_promo_color',
    'label' => 'Couleur  de la police'
  ]));
  $manager->add_setting('wphetic_promo_label');
  $manager->add_control('wphetic_promo_label', [
    'section' => 'wphetic_promo_color',
    'label' => __("label", 'TextDomain')
  ]);
});
