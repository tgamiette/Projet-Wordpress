<?php get_header() ?>
<style>
.meta-options.hcf_field{
  display: flex;
  flex-direction: column;
}

</style>
<form class="" action="index.html" method="post" enctype="multipart/form-data">
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
    <label for="hcf-pictures">Photos</label>
    <input multiple id="hcf-pictures" name="hcf-pictures" type="file">
  </p>

  <input type="submit" name="submit" value="Poster">


</form>

<?php get_footer() ?>
