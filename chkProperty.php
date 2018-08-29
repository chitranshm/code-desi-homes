<?php 
require_once('wp-config.php');
global $wpdb;
$id = $_POST['id'];
$title = $_POST['title'];
//echo $id."--".$title;
if($id != "" && $title != ""){
	$sql = "SELECT id FROM `wp_add_property` WHERE added_by = '".$_SESSION['user_id']."' AND title = '".$title."' AND id != '".$id."' ";
}else if($id == "" && $title != ""){
	$sql = "SELECT id FROM `wp_add_property` WHERE added_by = '".$_SESSION['user_id']."' AND title = '".$title."' ";
}
$results = $wpdb->get_results($sql);
if(!empty($results)){
 echo "false";
}else{
 echo "true";
}
?>