<?php get_header()?>

<?php

/**
 * Template Name: Modèle addLogement
 * Template Post Type: page, post
 */



?>

<form class="" action="<?= admin_url('admin_post.php'); ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="titre">Titre de l'annonce</label>
    <input type="text" name="titre" value="">
  </div>


  <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" rows="8" cols="80"></textarea>
  </div>


  <input type="file" name="" value="" multiple>

  <div class="form-group">
    <label for="logement_type">Type de logement</label>
    <input type="radio" name="logement_type">Appartement</option>
    <input type="radio" name="logement_type">Maison</input>
  </div>

  <div class="form-group">
    <label for="espace">L'espace</label>
    <select class="" name="espace">
      <option value="studio">Studio</option>
      <option value="duplex">Duplex</option>
      <option value="duplex">3 pièeces</option>
      <option value="duplex">4 pièces</option>
      <option value="duplex">5 pièces</option>
    </select>
  </div>

  <div class="form-group">
    <label for="nb_lit">Nombre de lits</label>
    <input type="text" name="nb_lit" value="">
  </div>

  <div class="form-group">
    <label for="nb_sdb">Nombre de salle de bain</label>
    <input type="text" name="nb_sdb" value="">
  </div>

  <!-- Service checkbox -->

  <div class="form-group">
    <label for="">Les services que vous proposer</label>
  </div>

  <div class="form-group">
    <label for="adresse_logement">Adresse du logement</label>
    <input type="text" name="adresse_logement" value="">
  </div>

  <div class="form-group">
    <label for="prix_logement">Prix du logement par nuit</label>
    <input type="text" name="prix_logement" value="">
  <div>

  <input type="submit" name="submit_logement" value="Soumettre">
</form>


<?php get_footer() ?>
