<?php  get_header(); ?>

<?php

/**
 * Template Name: Modèle moderation
 * Template Post Type: page,post
 */

$query_posts = new WP_Query(array(
  'post_type' => 'logement',
  'post_status' => 'pending'
));

$args = array(
  'status' => 'hold'
);
$comments = get_comments($args);

if(current_user_can('administrator')){
  ?>
    <button type="button" name="button" class="btn-post">Les posts</button>
    <button type="button" name="button" class="btn-comment">Les commentaires</button>

    <div class="c-moderation">
      <div class="c-moderation_post">
        <?php
        if($query_posts->have_posts()){
          ?>

            <div class="container row-md-6">
              <table>
                <tr>
                  <th></th>
                  <th>Titre</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>

              <?php
              while($query_posts->have_posts()){
                $query_posts->the_post(); ?>
                <tr class="col-lg-12">
                  <th><img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="..." style="width:50px;"></th>
                  <th><h5 class="card-title"><?php the_title(); ?></h5></th>
                  <th><p><?php the_content(); ?></p></th>
                  <th><p><?php the_content(); ?></p></th>
                  <th>
                    <form action="" method="post">

                      <input type="submit" name="btn-publish" class="btn btn-warning" value='Publier'/>
                      <input type="submit" name="btn-delete" class="btn btn-danger"  value='Supprimer'/>
                      <input type="hidden" name="update_post_id" value="<?php the_ID(); ?>">
                      <input type="hidden" name="action" value="update_logement_post" />
                      <?php wp_nonce_field('update_logement_post', 'update_logement_nonce'); ?>
                    </form>
                  </th>

                </tr>
                <?php
              }
            ?>
            </table>
           </div>

          <?php
        }
        ?>
      </div>

      <div class="c-moderation_comments hidden">
        <table>
          <tr>
            <th>Auteur</th>
            <th>Description</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
            <?php
            foreach ( $comments as $comment ) {
              ?>
              <tr class="c-comments_card">
                     <td><?= $comment->comment_author ?></td>
                     <td><?= $comment->comment_content ?></td>
                     <td><?= $comment->comment_date ?></td>
                     <td>
                       <form action="<?= admin_url('admin-post.php'); ?>" method="post">

                         <input type="submit" name="btn-publish" class="btn btn-warning" value='Publier'/>
                         <input type="submit" name="btn-delete" class="btn btn-danger"  value='Supprimer'/>
                         <input type="hidden" name="update_post_id" value="<?php the_ID(); ?>">
                         <input type="hidden" name="action" value="update_comment_post" />
                         <?php wp_nonce_field('update_comment_post', 'update_comment_nonce'); ?>
                       </form>
                    </td>
              </tr>

              <?php
            }

            ?>
        </table>

      </div>

    </div>
    <?php

}
?>
<?php get_footer(); ?>
