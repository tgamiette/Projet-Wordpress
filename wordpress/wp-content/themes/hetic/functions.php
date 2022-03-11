<?php
define(SINGLE_PATH, TEMPLATEPATH . '/template');

function bootstrap_stylesheet(){
    wp_enqueue_style("bootstrap_css", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css");
    wp_enqueue_style("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js", [], false, true);
}

function custom_setup_theme(){
    //    je sais pas c'est quoi '
    add_theme_support('title-tag');
    //    ajout image de presentation post
    add_theme_support('post-thumbnails');
    //    menu
    add_theme_support('menus');
    register_nav_menu('header_menu', "Menu du header");
    // On ajoute le support du html5 pour les listes de commentaires
    add_theme_support('html5', array('comment-list'));

    //add_theme_support('is_validate');
}

<<<<<<< HEAD
// On ajoute une sidebar
function wpbootstrap_sidebar(){
    register_sidebar(['name'          => "Sidebar principale",
                      'id'            => 'main-sidebar',
                      'description'   => "La sidebar principale",
                      'before_widget' => '<div id="%1$s" class="widget %2$s p-4">',
                      'after_widget'  => '</div>',
                      'before_title'  => '<h4 class="widget-title font-italic">',
                      'after_title'   => '</h4>',]);
}

//prise en compte de ma nouvelle feuille de style pour page de connexion
function my_login_stylesheet(){
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login/style.css');
}

/**
 * Single template function which will choose our template
 */
function my_single_template($single){
    global $wp_query, $post;

    foreach ((array) get_the_category() as $cat) :

        if (file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
            return SINGLE_PATH . '/single-cat' . $cat->slug . '.php';

        elseif (file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
            return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';
        else
            return SINGLE_PATH . '/single-post.php';


    endforeach;
}

//Ajout de widget "Logement"
function cptui_register_my_cpts_logement(){
    $labels = ["name"          => __("Logements", "custom-post-type-ui"),
               "singular_name" => __("Logement", "custom-post-type-ui"),];

    $args = ["label"            => __("Logements", "custom-post-type-ui"),
             "labels"           => $labels,
             "description"      => "",
             "public"           => true,
             "show_in_rest"     => true,
             "has_archive"      => true,
             "delete_with_user" => false,
             "capability_type"  => "post",
             "map_meta_cap"     => true,
             "hierarchical"     => false,
             "rewrite"          => ["slug" => "logement", "with_front" => true],
             "query_var"        => true,
             "supports"         => ["title", "thumbnail"],
             "show_in_graphql"  => false,];

    register_post_type("logement", $args);

    $labelsTaxo = ['name'          => 'Styles',
                   'singular_name' => 'Style'];

    $argsTaxo = ['labels'            => $labelsTaxo,
                 'public'            => true,
                 'hierarchical'      => true,
                 'show_in_rest'      => true,
                 'show_admin_column' => true];
=======
add_action('after_setup_theme', 'wpbootstrap_after_setup_theme');
add_theme_support('custom-logo');

//Ajout de Boostrap;

function wpheticBootstrap()
{
    wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", [], false, true);
    wp_enqueue_script("jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", false, false, true);
    wp_enqueue_script("script", get_stylesheet_directory_uri() . '/script.js');
}

add_action('wp_enqueue_scripts', 'wpheticBootstrap');

function my_styles() {
    wp_register_style( 'styles', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style( 'styles');
}
add_action( 'wp_enqueue_scripts', 'styles' );

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


//Ajout de widget "Logement"
function cptui_register_my_cpts_logement()
{
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
        "supports" => ["title", "thumbnail", "comments"],
        "show_in_graphql" => false
    ];

    register_post_type("logement", $args);
    add_theme_support( "post-thumbnails", array("logement"));

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
>>>>>>> 5e725fa (Add custom postt type + metabox + show post)

    register_taxonomy('style', ['post'], $argsTaxo);
}

<<<<<<< HEAD
//Add metabox to post Logements
function hcf_register_meta_boxes(){
    add_meta_box('hcf-1', __('Desciption du logement', 'hcf'), 'hcf_display_callback', 'logement');
}

function hcf_display_callback($post){
    include plugin_dir_path(__FILE__) . './metabox.php';
}

add_action('add_meta_boxes', 'hcf_register_meta_boxes');
=======
add_action('init', 'cptui_register_my_cpts_logement');



//Add metabox to post Logements
function hcf_register_meta_boxes() {
    add_meta_box( 'hcf-1', __( 'Desciption du logement', 'hcf' ), 'hcf_display_callback', 'logement' );
}

function hcf_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './metabox.php';
}

add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );
>>>>>>> 5e725fa (Add custom postt type + metabox + show post)


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
<<<<<<< HEAD
function hcf_save_meta_box($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if ($parent_id = wp_is_post_revision($post_id)){
        $post_id = $parent_id;
    }
    $fields = ['hcf-description',
               'hcf-logement_type',
               'hcf-espace',
               'hcf-nb_lit',
               'hcf-nb_sdb',
               'hcf-nb_pers',
               'hcf-adresse_logement',
               'hcf-ville_logement',
               'hcf-prix_logement',
               'hcf-proprio_type',];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)){
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

add_filter('nav_menu_css_class', function ($classes){
    $classes[] = "nav-item";
    return $classes;
});

add_filter('nav_menu_link_attributes', function ($attr){
    $attr['class'] = 'nav-link';
    return $attr;
});


add_action('widgets_init', 'wpbootstrap_sidebar');
add_action('after_setup_theme', 'custom_setup_theme');
add_action('login_enqueue_scripts', 'my_login_stylesheet');
add_action('wp_enqueue_scripts', 'bootstrap_stylesheet');
add_filter('single_template', 'my_single_template');
add_action('widgets_init', 'wpbootstrap_sidebar');
add_action('init', 'cptui_register_my_cpts_logement');
add_action('save_post', 'hcf_save_meta_box');


=======
function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
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
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'hcf_save_meta_box' );
<<<<<<< HEAD
>>>>>>> 5e725fa (Add custom postt type + metabox + show post)
=======


//Update post

function updatePost() {
  if(current_user_can('administrator')){
    if(wp_verify_nonce($_REQUEST['update_logement_nonce'], 'update_logement_post')){
      $post_args = array(
        'ID' => $_POST['update_post_id'],
        'post_status' => 'publish'
      );

      if($_POST['btn-publish']){
          wp_update_post($post_args);
      }else if ($_POST['btn-delete']){
        wp_delete_post($_POST['update_post_id']);
      }
      wp_redirect(home_url('/moderation'));
    }else{
      var_dump('Une erreur de nonce s\'est produite :)!');
    }
  }else{
    var_dump('Une erreur de role s\'est produite!');
  }
}

add_action( 'admin_post_update_logement_post', 'updatePost' );
<<<<<<< HEAD
>>>>>>> 70a37c9 ([moderation role] publish + delete post)
=======



//Update comments

function updateComments() {
  if(current_user_can('administrator')){
    if(wp_verify_nonce($_REQUEST['update_comment_nonce'], 'update_comment_post')){
      $post_args = array(
        'ID' => $_POST['update_comment_id'],
        'comment_approved' => 'approve'
      );

      if($_POST['btn-publish']){
          wp_set_comment_status($post_args);
      }else if ($_POST['btn-delete']){
        wp_delete_comment($_POST['update_post_id']);
      }
      wp_redirect(home_url('/moderation'));
    }else{
      var_dump('Une erreur de nonce s\'est produite :)!');
    }
  }else{
    var_dump('Une erreur de role s\'est produite!');
  }
}

add_action( 'admin_post_update_logement_post', 'updateComments' );
>>>>>>> a581134 ([add] Add comments)
