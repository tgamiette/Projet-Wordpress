<div class="row flex-nowrap justify-content-between align-items-center">
    <div class="c-nav text-center">
        <!-- <a class="blog-header-logo text-dark" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a> -->
        <div class="c-logo">
            <?php if(has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif; ?>
        </div>
        <div class="c-link">
            <?php
            wp_nav_menu(array(
                'theme_location'    => 'header_menu',
                'items_wrap'     => '%3$s',
                'container'      => false,
                'depth'          => 1,
                'link_before'    => '<span>',
                'link_after'     => '</span>',
                'fallback_cb'    => false,
            ));
            ?>
        </div>

        <div class="c-right_header">
            <?php if(is_user_logged_in()){ ?>
                <a class="c-btn is__orange" href="<?= home_url('/ajout-logement')?> ">Ajouter un logement</a>
                <?php
                if(current_user_can('administrator')){
                    ?>
                    <a class="c-btn is__brown" href="<?= home_url('/moderation')?> ">Moderation</a>
                    <?php
                }
            }else {
                return null;
            }
            ?>
        </div>

    </div>
</div>
</div>