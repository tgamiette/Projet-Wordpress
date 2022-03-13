<!--// Chargement des styles et des scripts Bootstrap sur WordPress-->
<?php get_header(); ?>

<?php //get_template_part('body'); ?>
<?php //add_shortcode('display_logements',function (){
//    require_once 'Classes/logementManagerQuery.php';
//    $query= new logementManagerQuery();
//    return $query->render();
//}); ?>
<?php get_template_part('getLogement'); geturl?>
<?php get_template_part('inscription'); ?>
<?php get_footer(); ?>
