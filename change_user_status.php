<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$status = $_GET['status'];
if($id != "" && $status != ""){
	if($status == "t"){
		$stf = "f";
	}else{
		$stf = "t";
	} 
	$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET status = %s WHERE id = %d",$stf,$id));
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}else{

}
?>