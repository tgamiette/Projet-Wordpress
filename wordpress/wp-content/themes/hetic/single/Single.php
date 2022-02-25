<<<<<<< HEAD:wordpress/wp-content/themes/hetic/single/Single.php
<?php
$query= new WP_Query([
  "post_type"=>"event",
  "meta_key"=>"",
  "is_valid"=>"",
  "meta_type"=>"NUMERIC",
  "orderby"=>""
                     ]);

if ($query->have_posts()){
  $query->the_post();
}
?>
=======

 <?php get_header(); ?>

 <?php
 /**
  * Template Name: Modèle single
  * Template Post Type: page, post
  */


 if(have_posts()){
     ?>
     <div class="card-group container">
     <?php
     while (have_posts()) {
         the_post(); ?>
             <div class="card col-md-3">
                 <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                 <div class="card-body">

                     <p><small> Logement: <?= get_post_meta( get_the_ID(), 'hcf-logement_type', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-proprio_type', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-ville_logement', true ) ?></small></p>
                     <h5 class="card-title"><?php the_title(); ?></h5>

                     <p><small><?= get_post_meta( get_the_ID(), 'hcf-nb_pers', true ) ?> voyageurs • <?= get_post_meta( get_the_ID(), 'hcf-espace', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-nb_lit', true ) ?> lit(s) • <?= get_post_meta( get_the_ID(), 'hcf-nb_sdb', true ) ?> salle de bain</small></p>

                     <p class="card-text"><?= get_post_meta( get_the_ID(), 'hcf-description', true ) ?></p>


                     <p class="card-text"><?= get_post_meta( get_the_ID(), 'hcf-adresse_logement', true ) ?></p>

                     <p class="card-text"><?= get_post_meta( get_the_ID(), 'hcf-prix_logement', true ) ?>€/nuit</p>

                </div>
             </div>
     <?php
     }

     ?> </div>
     <?php
 }

 ?>



 <?php get_footer(); ?>
>>>>>>> e903f43 (Add thumbnail + single.php):wordpress/wp-content/themes/hetic/single.php
