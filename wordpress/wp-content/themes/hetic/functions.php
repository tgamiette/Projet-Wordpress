<?php
//


function wpbootstrap_after_setup_theme() {
  // On ajoute un menu
  register_nav_menu('header_menu', "Menu du header");
  // On ajoute une classe php permettant de gérer les menus Bootstrap
//  require_once get_template_directory() . 'class-wp-bootstrap-navwalker.php';

}

add_action('after_setup_theme', 'wpbootstrap_after_setup_theme');

//Ajout de Boostrap;
add_action('wp_enqueue_scripts', 'wpheticBootstrap');
function wpheticBootstrap()
{
    wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script("bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", [], false, true);
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
        "supports" => ["title", "thumbnail"],
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

    register_taxonomy('style', ['post'], $argsTaxo);
}

add_action('init', 'cptui_register_my_cpts_logement');



//Add metabox to post Logements
function hcf_register_meta_boxes() {
    add_meta_box( 'hcf-1', __( 'Desciption du logement', 'hcf' ), 'hcf_display_callback', 'logement' );
}

function hcf_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './metabox.php';
}

add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
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
