<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$expire = "t";
if($id != "" && $expire != ""){
	$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET expire = %s WHERE id = %d",$expire,$id));
	//echo "Status Changed"; exit;
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}else{

}
?>