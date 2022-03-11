<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="hcf-description">Description</label>
        <textarea name="hcf-description" rows="8" cols="80" id="hcf-description"><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-description', true ) ); ?></textarea>
    </p>
    <p class="meta-options hcf_field">
        <label>Type de logement</label>

        <input type="radio" name="hcf-logement_type" value="Appartement" <?php esc_attr( get_post_meta( get_the_ID(), 'hcf-logement_type', true ) ) === 'Appartement'? 'checked' : '' ?> >Appartement</input>
        <input type="radio" name="hcf-logement_type" value="Maison" <?php esc_attr( get_post_meta( get_the_ID(), 'hcf-logement_type', true ) ) === 'Maison'? 'checked' : '' ?>>Maison</input>
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
      <input type="text" name="hcf-nb_lit" id="hcf-nb_lit" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-nb_lit', true ) ); ?>">
    </p>

    <p class="meta-options hcf_field">
        <label for="hcf-nb_sdb">Nombre de salle de bain</label>
        <input type="text" name="hcf-nb_sdb" id="hcf-nb_sdb" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-nb_sdb', true ) ); ?>">
    </p>

    <p class="meta-options hcf_field">
        <label for="hcf-nb_pers">Nombre de personne pouvant être accueillis</label>
        <input type="text" name="hcf-nb_pers" id="hcf-nb_pers" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-nb_pers', true ) ); ?>">
    </p>


    <p class="meta-options hcf_field">
     <label for="">Services</label>
     <input type="text" name="" value="">
    </p>

    <p class="meta-options hcf_field">
       <label for="hcf-adresse_logement">Adresse du logement</label>
       <input type="text" name="hcf-adresse_logement" id="hcf-adresse_logement" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-adresse_logement', true ) ); ?>">
       <label for="hcf-ville_logement">Ville du logement</label>
       <input type="text" name="hcf-ville_logement" id="hcf-ville_logement" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-ville_logement', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
      <label for="hcf-prix_logement">Prix du logement par nuit</label>
      <input type="text" name="hcf-prix_logement" id="hcf-prix_logement" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf-prix_logement', true ) ); ?>">
    </p>

    <p class="meta-options hcf_field">
      <label for="hcf-proprio_type">Vous êtes ...</label>
      <input type="radio" name="hcf-proprio_type" value="Particulier" <?php esc_attr( get_post_meta( get_the_ID(), 'hcf-proprio_type', true ) ) === 'Appartement'? 'checked' : '' ?> >Particulier</input>
      <input type="radio" name="hcf-proprio_type" value="Professionnel" <?php esc_attr( get_post_meta( get_the_ID(), 'hcf-proprio_type', true ) ) === 'Maison'? 'checked' : '' ?>>Professionnel</input>
  </p>

  <p class="meta-options hcf_field">
    <label for="hcf-pictures">Photos</label>
    <input multiple id="hcf-pictures" name="hcf-pictures" type="file">
  </p>


</div>
