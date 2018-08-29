<?php 
require_once('wp-config.php');
global $wpdb;
$email = $_POST['email'];
$id = $_POST['id'];
//$sql = "SELECT * FROM `wp_register_users` WHERE email = '".trim($email)."' WHERE id != '".$_SESSION['user_id']."' ";
$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE email = '".trim($email)."' AND id != '".$_SESSION['user_id']."' ");
if(!empty($results)){
 echo "false";
}else{
 echo "true";
}
?>