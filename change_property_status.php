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
	$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET status = %s WHERE id = %d",$stf,$id));
	if($stf == "t"){
		$addedByResult = $wpdb->get_results( "SELECT added_by FROM `wp_add_property` WHERE id = '".$id."' "); 
		$vendor_id = $addedByResult[0]->added_by;
		$getContactDetails = get_all_data_by("wp_register_users",$vendor_id);
		$to = $getContactDetails[0]->email;
		$subject = "Property Verified";
		$message = "Your property has been verified";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: <info@desihomes.co.uk>' . "\r\n";
		@mail($to,$subject,$message,$headers);
	}
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}else{

}
?>