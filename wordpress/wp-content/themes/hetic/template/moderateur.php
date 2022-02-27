<?php  get_header(); ?>

<?php

/**
 * Template Name: Modèle moderation
 * Template Post Type: page,post
 */

$query = new WP_Query(array(
  'post_type' => 'logement',
  'post_status' => 'pending'
));

if(current_user_can('administrator')){
  if($query -> have_posts()){
    ?>
      <div class="container row-md-6">
        <?php
        while($query->have_posts()){
          $query->the_post(); ?>
          <div class="col-lg-12">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="..." style="width:50px;">
            <h5 class="card-title"><?php the_title(); ?></h5>

            <button type="button" name="button" class="btn btn-warning">Publier</button>
            <button type="button" name="button" class="btn btn-danger">Supprimer</button>
          </div>
          <?php
        }
      ?>
      </div>

    <?php
  }
}

?>

<?php get_footer(); ?>
