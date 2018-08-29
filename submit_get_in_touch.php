<?php
require_once('wp-config.php');
ob_start();
global $wpdb;
date_default_timezone_set("Europe/London");
//$added_date = mktime(date('h'),date('i'),date('s'),date('m'),date('d'),date('Y'));
extract($_POST);
if($name != "" && $email != "" && $message != ""){
	$to = "info@desihomes.co.uk,chitransh@reinventdigital.com";
	$subject = "Enquiry Received";
	$message1 .= "Name : ".$name."<br/>";
	$message1 .= "Email : ".$email."<br/>";
	$message1 .= "Phone : ".$mobile."<br/>";
	$message1 .= "Message : ".$message."<br/>";
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: <'.$email.'>' . "\r\n";
	@mail($to,$subject,$message1,$headers);
	//header('Location:https://desihomes.co.uk/thanks/'); exit;
	echo "success";
}else{
	echo "error";
}
exit;
?>