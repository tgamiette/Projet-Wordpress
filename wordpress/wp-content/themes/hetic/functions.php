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

function generateForm(){
    ob_start();
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login/style.css');
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

    register_taxonomy('style', ['post'], $argsTaxo);
}

//Add metabox to post Logements
function hcf_register_meta_boxes(){
    add_meta_box('hcf-1', __('Desciption du logement', 'hcf'), 'hcf_display_callback', 'logement');
}

function hcf_display_callback($post){
    include plugin_dir_path(__FILE__) . './metabox.php';
}

add_action('add_meta_boxes', 'hcf_register_meta_boxes');


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
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
//add_filter('single_template', 'my_single_template');
add_action('widgets_init', 'wpbootstrap_sidebar');
add_action('init', 'cptui_register_my_cpts_logement');
add_action('save_post', 'hcf_save_meta_box');
add_action('"admin_post_nopriv_wpinscription_form', function (){
    if (!wp_verify_nonce($_POST['random_nonce'], 'random_action')){
        die("erreur non invalide ");
    }
    $email    = $_POST['email'];
    $username = $_POST['username'];
    $name     = $_POST['name'];
    $lastName = $_POST['lastname'];
    $password = $_POST['password'];
    wp_insert_user(['user_login' => username,
                    'user_pass'  => $password,
                    'user_mail'  => $email,
                    'role'=> 'ABONNE']);
    wp_redirect($_POST['_wp_http_refer'] . "message=" . $password);
    exit();
});


