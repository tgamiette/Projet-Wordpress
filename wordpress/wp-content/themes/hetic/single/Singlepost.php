<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="card">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php the_content(); ?></p>
                <p class="card-text"><small class="text-muted"> Ecrit le :<?php the_date(); ?> </small></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>