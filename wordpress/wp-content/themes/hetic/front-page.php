<?php get_header();

if (have_posts()):
    while (have_posts()): the_post(); ?>

    <img src="<?php the_post_thumbnail_url();?>">
    <?php endwhile; endif;
get_footer()
?>
