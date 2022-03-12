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

            <div class="container">
              <table>
                <tr>
                  <th></th>
                  <th>Titre</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Auteur</th>
                  <th>Action</th>
                </tr>

              <?php
              while($query_posts->have_posts()){
                $query_posts->the_post(); ?>
                <tr>
                  <td><img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="..."></td>
                  <td><?php the_title(); ?></td>
                  <td><?php the_content(); ?></td>
                  <td><?php the_date('F j, Y'); ?></td>
                  <td><?php the_author(); ?></td>
                  <td>
                    <form action="<?= admin_url('admin-post.php')?>" method="post">

                      <input type="submit" name="btn-publish" class="c-btn is__orange" value='Publier'/>
                      <input type="submit" name="btn-delete" class="c-btn is__brown"  value='Supprimer'/>
                      <input type="hidden" name="update_post_id" value="<?php the_ID(); ?>">
                      <input type="hidden" name="action" value="update_logement_post" />
                      <?php wp_nonce_field('update_logement_post', 'update_logement_nonce'); ?>
                    </form>
                  </td>

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
              <tr class="c-comment_table">
                     <td><?= $comment->comment_author ?></td>
                     <td><?= $comment->comment_content ?></td>
                     <td><?= $comment->comment_date ?></td>
                     <td>
                       <form action="<?= admin_url('admin-post.php'); ?>" method="post">

                         <input type="submit" name="btn-publish" class="c-btn is__orange" value='Publier'/>
                         <input type="submit" name="btn-delete" class="c-btn is__brown"  value='Supprimer'/>
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
