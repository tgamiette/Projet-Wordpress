<?php if (have_posts()) : ?>
    <div class="card-group">

    <?php while (have_posts()) : the_post(); ?>
        <div class="card col-md-3">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire la suite</a>
                <!--                        --><?php //if (is_singular()) : if (comments_open()) : comments_template(); endif; endif; ?>

            </div>
        </div>
    <?php endwhile; ?>
    </div>

<?php endif; ?>