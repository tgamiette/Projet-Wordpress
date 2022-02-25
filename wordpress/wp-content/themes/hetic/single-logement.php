<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div class="card-group container">
        <div class="card col-mb-3">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="..."
                 width="600"
                 height="337"
                 style="width: 100%; height: 350px;"
            >
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
            </div>
        </div>
    <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
