<?php 
require_once('wp-config.php');
global $wpdb;
$email = $_POST['email'];
$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE email = '".$email."' ");
if(!empty($results)){
 echo "false";
}else{
 echo "true";
}
?>