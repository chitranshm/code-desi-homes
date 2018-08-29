<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$slug1 = $_POST['title'];
$slug = strtolower(str_replace(" ","-",$slug1));
$sql = "SELECT * FROM `wp_add_property` WHERE slug = '".$slug."' ";
//echo $sql; exit; 
$results = $wpdb->get_results($sql); 
if(!empty($results)){
	echo $slug."1";
}else{
	echo $slug;
}
?>
