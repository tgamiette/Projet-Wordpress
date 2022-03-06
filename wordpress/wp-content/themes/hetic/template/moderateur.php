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
  if($query->have_posts()){
    ?>
      <div class="container row-md-6">
        <?php
        while($query->have_posts()){
          $query->the_post(); ?>
          <div class="col-lg-12">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="..." style="width:50px;">
            <h5 class="card-title"><?php the_title(); ?></h5>

            <form action="<?= admin_url('admin-post.php'); ?>" method="post">

              <input type="submit" name="btn-publish" class="btn btn-warning" value='Publier'/>
              <input type="submit" name="btn-delete" class="btn btn-danger"  value='Supprimer'/>
              <input type="hidden" name="update_post_id" value="<?php the_ID(); ?>">
              <input type="hidden" name="action" value="update_logement_post" />
              <?php wp_nonce_field('update_logement_post', 'update_logement_nonce'); ?>


            </form>

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
