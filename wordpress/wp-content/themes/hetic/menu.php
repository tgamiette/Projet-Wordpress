<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
            ]); ?>
            <?php if (is_user_logged_in()) : ?>
                <a class="nav-link" href="<?= home_url('/ajout-logement') ?> ">Ajouter un logement </a>
            <?php endif; ?>
            <?php if (current_user_can('administrator')) : ?>
                <a class="" href="<?= home_url('/moderation') ?> ">Gestion des logements </a>
            <?php endif; ?>

            <?php get_search_form(); ?>
            <?php if (is_user_logged_in()) : ?>
                <li class="nav-item"><a class="nav-link" href="/wp-login.php?action=logout">Deconnexion </a></li>
            <?php endif ?>
            <?php if (!is_user_logged_in()) : ?>
                <li class="nav-item"><a class="nav-link" href="<?= get_template_directory_uri("inscription.php") ?>"S'inscrire</a></li>
                <li class="nav-item"><a class="nav-link" href="/wp-login.php">Se connecter </a></li>
            <?php endif; ?>

        </div>
    </div>
</nav>