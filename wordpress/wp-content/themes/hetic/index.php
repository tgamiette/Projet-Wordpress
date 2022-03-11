<!--// Chargement des styles et des scripts Bootstrap sur WordPress-->
<?php get_header(); ?>
<?php


$query = new WP_Query(array(
    'post_type' => 'logement',
    'post_status' => 'publish'
));
?>
<div class="container-home">
    <?php
    if($query->have_posts()){
        ?>
        <div class="card-group container">
        <?php
        while ($query->have_posts()) {
            $query->the_post(); ?>
                <div class="card-post">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p><small> Logement: <?= get_post_meta( get_the_ID(), 'hcf-logement_type', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-proprio_type', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-ville_logement', true ) ?></small></p>
                        <h5 class="card-title"><?php the_title(); ?></h5>

                        <p><small><?= get_post_meta( get_the_ID(), 'hcf-nb_pers', true ) ?> voyageurs • <?= get_post_meta( get_the_ID(), 'hcf-espace', true ) ?> • <?= get_post_meta( get_the_ID(), 'hcf-nb_lit', true ) ?> lit(s) • <?= get_post_meta( get_the_ID(), 'hcf-nb_sdb', true ) ?> salle de bain</small></p>

                        <p class="card-text"><?php the_content(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="c-btn is__orange">Voir le logement</a>
                    </div>
                </div>
        <?php
        }

        ?> </div>

        <div class="c-comments">
               <h3>Les derniers avis</h3>
               <?php
               $args = array(
                    'status' => 'approve',
                    'number' => '3'
               );
               $comments = get_comments( $args );
                foreach ( $comments as $comment ) {
                    ?>
                    <div class="c-comments_card">
                         <div class="top_comment">
                              <div class="icon_comment">
                                   <a href="https://www.flaticon.com/free-icons/profile" title="profile icons"></a>
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
        <?php
    }
    ?>
</div>
<?php

?>


<?php get_template_part('body'); ?>
<?php get_footer(); ?>
