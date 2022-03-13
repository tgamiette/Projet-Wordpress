<?php

class logementManagerQuery
{
    private $nb_posts;
    private $query;

    public function __construct(int $nb_posts = 3)
    {
        $this->nb_posts = $nb_posts;
        $this->query();
    }

    public function query()
    {
        $args = [
            'post_type' => 'logement',
            'posts_per_page' => $this->nb_posts,
            'orderby' => 'rand'
        ];

        $this->query = new WP_Query($args);
    }

    public function render(WP_Query $query)
    {
        if ($query->have_posts()):
            ob_start();
            ?>
            <div class="container pub"
            <div class="row"
            <?php while ($query->have_posts()):
            $query->the_post();
            ?>
            <div class="col-lg-4" style="margin-bottom: 1.5rem; text-align: center;">
                <img class="bd-placeholder-img rounded-circle" width="140" height="140"
                     style="object-fit: cover" alt="cover"
                     src="<?= get_the_post_thumbnail_url() ?>"/>
                <h2 style="font-weight: 400;"><?= the_title() ?></h2>
                <p><?= the_excerpt(); ?></p>
                <p><a class="btn btn-secondary" href="<?= get_post_permalink(); ?>">Voir plus</a></p>
            </div>
        <?php endwhile;
            ?>
        <?php endif;
        return ob_get_clean();
    }
} ?>