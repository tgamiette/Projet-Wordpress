<?php

/**
 *
 */
class Wp_addPost
{

  private $styles;

  public function __construct(){
    $this->styles =  get_terms([
      'taxonomy' => 'style',
      'hide_emtpy' => false
    ]);
  }

  public function generateForm(){
    ob_start();
    ?>
      <form class="" action="<?= admin_url('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
          <p class="meta-options hcf_field">
              <label for="hcf-title">Titre de l'annonce</label>
              <input type="text" name="hcf-title" id="hcf-title"></input>
          </p>

          <p class="meta-options hcf_field">
              <label for="hcf-description">Description</label>
              <textarea name="hcf-description" rows="8" cols="80" id="hcf-description"></textarea>
          </p>
          <p class="meta-options hcf_field">
              <label for="hcf-logement_type">Type de logement</label>

              <input type="radio" name="hcf-logement_type" value="Appartement">Appartement</input>
              <input type="radio" name="hcf-logement_type" value="Maison">Maison</input>
          </p>
          <p class="meta-options hcf_field">
              <label for="hcf-espace">L'espace</label>
              <select class="" name="hcf-espace" id="hcf-espace">
                <option value="studio">Studio</option>
                <option value="duplex">Duplex</option>
                <option value="duplex">3 pièeces</option>
                <option value="duplex">4 pièces</option>
                <option value="duplex">5 pièces</option>
              </select>
          </p>

          <p class="meta-options hcf_field">
            <label for="hcf-nb_lit">Nombre de lits</label>
            <input type="text" name="hcf-nb_lit" id="hcf-nb_lit" value="">
          </p>

          <p class="meta-options hcf_field">
              <label for="hcf-nb_sdb">Nombre de salle de bain</label>
              <input type="text" name="hcf-nb_sdb" id="hcf-nb_sdb" value="">
          </p>

          <p class="meta-options hcf_field">
              <label for="hcf-nb_pers">Nombre de personne pouvant être accueillis</label>
              <input type="text" name="hcf-nb_pers" id="hcf-nb_pers" value="">
          </p>


          <p class="meta-options hcf_field">
           <label for="">Services</label>
          </p>

          <p class="meta-options hcf_field">
             <label for="hcf-adresse_logement">Adresse du logement</label>
             <input type="text" name="hcf-adresse_logement" id="hcf-adresse_logement" value="">
             <label for="hcf-ville_logement">Ville du logement</label>
             <input type="text" name="hcf-ville_logement" id="hcf-ville_logement" value="">
          </p>
          <p class="meta-options hcf_field">
            <label for="hcf-prix_logement">Prix du logement par nuit</label>
            <input type="text" name="hcf-prix_logement" id="hcf-prix_logement" value="">
          </p>

          <p class="meta-options hcf_field">
            <label for="hcf-proprio_type">Vous êtes ...</label>
            <input type="radio" name="hcf-proprio_type" value="Particulier">Particulier</input>
            <input type="radio" name="hcf-proprio_type" value="Professionnel">Professionnel</input>
        </p>

        <p class="meta-options hcf_field">
          <label for="hcf-picture">Photos</label>
          <input id="hcf-picture" name="hcf-picture" type="file" multiple="false">
        </p>

        <input type="hidden" name="action" value="hcf_logement_post">
        <?php wp_nonce_field('hcf_logement_post', 'hcf_logement_nonce'); ?>

        <button type="submit">Poster</button>


      </form>
    <?php

    return ob_get_clean();
  }

  public static function handleForm(){
    if(current_user_can('manage_logement')){

      if(wp_verify_nonce($_REQUEST['hcf_logement_nonce'], 'hcf_logement_post')){

         $post_args = array(
           'post_title' => $_POST['hcf-title'],
           'post_content' => $_POST['hcf-description'],
           'post_type' => 'logement',
           'post_status' => 'pending',
           'post_author' => get_current_user_id(),
           'tax_input' => [
             'style' => [$_POST['logement_style']]
           ],
           'meta_input' => [
               'hcf-description' => $_POST['hcf-description'],
               'hcf-logement_type' => $_POST['hcf-logement_type'],
               'hcf-espace' => $_POST['hcf-espace'],
               'hcf-nb_lit' => $_POST['hcf-nb_lit'],
               'hcf-nb_sdb' => $_POST['hcf-nb_sdb'],
               'hcf-nb_pers' => $_POST['hcf-nb_pers'],
               'hcf-adresse_logement' => $_POST['hcf-adresse_logement'],
               'hcf-ville_logement' => $_POST['hcf-ville_logement'],
               'hcf-prix_logement' => $_POST['hcf-prix_logement'],
               'hcf-proprio_type' => $_POST['hcf-proprio_type']
           ]
         );

         $postId = wp_insert_post($post_args);
         $attachment_id = media_handle_upload('hcf-picture', $postId);
         set_post_thumbnail( $postId, $attachment_id);
         wp_redirect(home_url('?p='. $postId));

      } else {
         var_dump('Une erreur de nonce s\'est produite!');
      }
    }else{
      wp_redirect(home_url());
    }
  }
}




?>
