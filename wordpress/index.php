<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
define( 'WP_USE_THEMES', true );

?>
<!--fdsfdfsdsfd-->
<?php //get_header(); ?>
<!---->
<?php //if (have_posts()): ?>
<!--  <label>il y a des post</label>-->
<!---->
<!--  --><?php //while (have_posts()): ?>
<!---->
<!--     --><?php //the_post();?>
<!--     <h1>--><?php //the_title();?><!--</h1>-->
<!---->
<!--  --><?php //endwhile; ?>
<!---->
<!---->
<?php //else: ?>
<!---->
<!--  <label>il y a pas de  post</label>-->
<!---->
<?php //endif; ?>
<!---->
<?php //get_footer(); ?>
