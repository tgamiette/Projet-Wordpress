
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

      <div class="comments_section container">

           <div class="c-comments">
                <h3>Les commentaires</h3>
                <?php
                $args = array(
                     'post_id' => get_the_ID(),
                );
                $comments = get_comments( $args );
                 foreach ( $comments as $comment ) {
                     ?>
                     <div class="c-comments_card">
                          <div class="top_comment">
                               <div class="icon_comment">
                                    <img src="http://localhost:8080/wp-content/uploads/2022/03/user.png"/>
                               </div>
                               <span><?= $comment->comment_author ?></span>
                          </div>
                          <div class="text_comments">
                               <p><?= $comment->comment_content ?></p>
                               <span>Publié le <?= $comment->comment_date ?></span>
                          </div>
                     </div>

                     <?php
                 }
             ?>
          </div>

          <div class="c-form_comments">
               <h2>Mettre un commentaire ?</h2>
               <form class="" action="index.html" method="post">


                    <div class="c-input">
                         <label for="comment_drescription">Votre commentaire</label>
                         <textarea type="text" name="comment_drescription" value="" maxlength="500"></textarea>
                    </div>


                    <input type="hidden" name="action" value="add_logement_comment" />
                    <?php wp_nonce_field('add_logement_comment', 'add_logement_nonce'); ?>

                    <button type="submit" name="button"  class="c-btn is__orange">Publier</button>
               </form>
          </div>

     </div>





 <?php get_footer(); ?>
