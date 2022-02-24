<!--// Chargement des styles et des scripts Bootstrap sur WordPress-->
<?php get_header(); ?>
<?php
if (have_posts()):
  while (have_posts()): ?>
    <?php the_post();
  endwhile;
endif; ?>


<?php get_template_part('body'); ?>
<?php get_footer(); ?>


