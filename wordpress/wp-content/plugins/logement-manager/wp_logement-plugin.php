<?php

/*

Plugin Name: Logements Manager

Description: Plugin pour ajouter des logements en fonction des utilisateurs à l'aide d'un formulaire

Author: Maélys

*/

register_activation_hook( __FILE__ , function(){

  $admin = get_role('administrator');
  $admin->add_cap('manage_logement');


  add_role('logement_manager', 'Logement Manager', [
    'read' => true,
    'manage_logement' => true
  ]);
});

register_deactivation_hook( __FILE__ , function(){
  $admin = get_role('administrator');
  $admin->remove_cap('manage_logement');
  remove_role('logement_manager');
});


//Form add logement post
require_once 'classes/wp-addPost.php';

add_shortcode('add_logement', function(){
  $manager = new Wp_addPost();
  return $manager->generateForm();
});

add_action('admin_post_hcf_logement_post', function(){
  Wp_addPost::handleForm();
});

?>
