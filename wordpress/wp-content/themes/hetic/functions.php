<?php
//


function wpbootstrap_after_setup_theme() {
  // On ajoute un menu
  register_nav_menu('header_menu', "Menu du header");
  register_nav_menu('footer_menu', "Menu du footer");

  // On ajoute une classe php permettant de gérer les menus Bootstrap
//  require_once get_template_directory() . 'class-wp-bootstrap-navwalker.php';

}

add_action('after_setup_theme', 'wpbootstrap_after_setup_theme');
add_theme_support('custom-logo');
add_theme_support( 'custom-header');

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



//Update comments

function updateComment() {
  if(current_user_can('administrator')){
    if(wp_verify_nonce($_REQUEST['update_comment_nonce'], 'update_comment_post')){
      $args = array(
        'comment_ID' => $_POST['update_comment_id'],
        'comment_approved' => 'approve'
      );

      if($_POST['btn-publish']){
          wp_set_comment_status($post_args);
      }else if ($_POST['btn-delete']){
          wp_delete_comment($_POST['update_comment_id']);
      }
      wp_redirect(home_url('/moderation'));
    }else{
      var_dump('Une erreur de nonce s\'est produite :)!');
    }
  }else{
    var_dump('Une erreur de role s\'est produite!');
  }
}

add_action( 'admin_post_update_comment_post', 'updateComment' );


// custom_pagination
function cpt_pagination($pages = '', $range = 5){
      $showitems = ($range * 2)+1;
      global $paged;

      if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        if(1 != $pages)
        {

            echo "<nav aria-label='page_nav example' class='c-pagination'> <span>Page ".$paged." of ".$pages."</span><ul class='pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class=\"page-item active\"><a class='page-link'>".$i."</a></li>":"<li class='page-item'> <a href='".get_pagenum_link($i)."' class=\"page-link\">".$i."</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\">i class='flaticon flaticon-back'></i></a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'><i class='flaticon flaticon-arrow'></i></a></li>";
            echo "</ul></nav>\n";
        }
  }

//redirection apres la connection
function redirect_login($redirect, $b, $user)
{
    if (!is_wp_error($user) && in_array('logement_manager', (array)$user->roles)) {
        return '/wp-admin';
    } elseif (!is_wp_error($user) && in_array('subscriber', (array)$user->roles)) {
        return '/';
    }
    return $redirect;
}

add_filter('login_redirect', 'redirect_login', 10, 3);

//prise en compte de ma nouvelle feuille de style pour page de connexion
function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login/style.css');
}

add_action('login_enqueue_scripts', 'my_login_stylesheet');

//pour la barre de recherche
add_filter('query_vars', function ($params) {
    $params[] = 'ville';
    $params[] = 'prix_min';
    $params[] = 'prix_max';
    $params[] = 'type';
    return $params;
});


add_action('pre_get_posts', function (WP_Query $query) {
    if (is_admin() || $query->is_main_query()) {
        return;
    }

    var_dump(get_query_var('prix_max'));

    if ($query->get('post_type') === 'logement' && !empty(get_query_var('prix_min'))) {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'hcf-prix_logement',
            'value' => get_query_var('prix_min'),
            'compare' => '>=',
            'type' => 'NUMERIC'
        ];

        $query->set('meta_query', $meta_query);
    }

    if ($query->get('post_type') === 'event' && !empty(get_query_var('prix_max'))) {
        die;
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'hcf-prix_logement',
            'value' => get_query_var('prix_max'),
            'compare' => '>=',
            'type' => 'NUMERIC'
        ];

        $query->set('meta_query', $meta_query);
    }


    if ($query->get('post_type') === 'logement' && !empty(get_query_var('personne_min'))) {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'hcf-nb_pers',
            'value' => get_query_var('personne_min'),
            'compare' => '>=',
            'type' => 'NUMERIC'
        ];

        $query->set('meta_query', $meta_query);
    }

    if ($query->get('post_type') === 'logement' && !empty(get_query_var('ville'))) {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'hcf-ville_logement',
            'value' => get_query_var('ville'),
            'compare' => '=',
            'type' => 'TEXT'
        ];

        $query->set('meta_query', $meta_query);
    }

    if ($query->get('post_type') === 'logement' && !empty(get_query_var('type'))) {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'hcf-logement_type',
            'value' => get_query_var('type'),
            'compare' => '=',
            'type' => 'TEXT'
        ];

        $query->set('meta_query', $meta_query);
    }

});
