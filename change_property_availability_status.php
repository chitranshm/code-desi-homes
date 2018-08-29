<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$user_availability_status = $_GET['user_availability_status'];
if($id != "" && $user_availability_status != ""){
	if($user_availability_status == "t"){
		$stf = "f";
	}else{
		$stf = "t";
	}
	
	$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET user_availability_status = %s WHERE id = %d",$stf,$id));
	//echo "Status Changed"; exit;
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}else{

}
?>