<?php
require_once('wp-config.php');
global $wpdb;
date_default_timezone_set("Europe/London");
$added_date = mktime(date('h'),date('i'),date('s'),date('m'),date('d'),date('Y'));
//echo $added_date."<br/>";
//echo date("d-m-Y h:i:s A",$added_date);
//echo "Hi";
//echo "<pre>"; print_r($_POST);
extract($_POST);
if($name != "" && $email != "" && $property_id != ""){
	$results = $wpdb->get_results( "SELECT title,added_by FROM `wp_add_property` WHERE id = '".$property_id."' ");
	//$property_title = 
	//echo "<pre>"; print_r($results);
	if(!empty($results)){
		$property_title = $results[0]->title;
		$user_id = $results[0]->added_by;
		if($user_id != ""){
			$userEmail = get_data_by('wp_register_users','email',$user_id);
			
			$to = $userEmail;
			$subject = "Enquiry Received";
			$message1 = "Enquiry received for ".$property_title."<br/>";
			$message1 .= "Name : ".$name."<br/>";
			$message1 .= "Email : ".$email."<br/>";
			$message1 .= "Phone : ".$phone."<br/>";
			$message1 .= "Message : ".$message."<br/>";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <'.$email.'>' . "\r\n";
			@mail($to,$subject,$message1,$headers);
			/*if(mail("coderchitransh@gmail.com",$subject,$message,$headers)){
				echo "Sentfsdafsd";exit;
			}else{
				echo "Not Sent  asf";exit;
			}*/
			/* Enquiry Insertion*/
			$wpdb->insert('wp_enquiries', array(
			  'property_id' => $property_id,
			  'name' => $name, 
			  'email' => $email, 
			  'phone' => $phone, 
			  'message' => $message,
			  'added_date' => $added_date 
			  ),
			array( '%s', '%s', '%s', '%s','%s','%s'));
			echo "success";	
		}else{
			echo "error";
		}
	}else{
		echo "error";
	} 
}else{
	echo "error";
}
exit;
?>