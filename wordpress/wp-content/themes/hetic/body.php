<?php if (have_posts()) : ?>
    <div class="row row-cols-1 row-cols-md3 g-4">
        <?php while (have_posts()) : the_post(); ?>
<!--        --><?php //die(the_permalink()); ?>
            <div class="col">
                <div class="card">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p class="card-text"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire la sssuite</a>
                        <?php if (is_singular()) : if (comments_open()) : comments_template(); endif; endif; ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>