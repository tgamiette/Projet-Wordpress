

<?php $query = new WP_Query(array('post_type'   => 'logement',
                                  'post_status' => 'publish'));
?>

<?php if ($query->have_posts()) : ?>
    <div class="card-group container">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="card col-md-3">
                <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                <div class="card-body">

                    <?php if (get_post_meta(get_the_ID(), 'wpheticSponso', true)) : ?>
                        <div class="alert alert-primary" role="alert">
                            Contenu Soponso
                        </div>
                    <?php endif; ?>

                    <p><small> Logement: <?= get_post_meta(get_the_ID(), 'hcf-logement_type', true) ?>
                            • <?= get_post_meta(get_the_ID(), 'hcf-proprio_type', true) ?>
                            • <?= get_post_meta(get_the_ID(), 'hcf-ville_logement', true) ?></small></p>
                    <h5 class="card-title"><?php the_title(); ?></h5>

                    <p><small><?= get_post_meta(get_the_ID(), 'hcf-nb_pers', true) ?> voyageurs
                            • <?= get_post_meta(get_the_ID(), 'hcf-espace', true) ?>
                            • <?= get_post_meta(get_the_ID(), 'hcf-nb_lit', true) ?>
                            • <?= get_post_meta(get_the_ID(), 'hcf-nb_sdb', true) ?></small></p>

                    <p class="card-text"><?php the_content(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Voir le logement</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>