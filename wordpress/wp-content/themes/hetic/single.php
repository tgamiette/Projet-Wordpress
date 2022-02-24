<?php
$query= new WP_Query([
  "post_type"=>"event",
  "meta_key"=>"",
  "meta_type"=>"NUMERIC",
  "orderby"=>""
                     ]);

if ($query->have_posts()){
  $query->the_post();
}