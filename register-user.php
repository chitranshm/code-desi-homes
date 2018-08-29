<?php
require_once('wp-config.php');
global $wpdb;
$_SESSION['error_msgs'] = "";
$_SESSION['success_msg'] = "";
if(isset($_POST['submit']) && $_POST['submit'] != ''){
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
		$secret = '6LdxGF8UAAAAAPyqSfJXzhQaryL-pR9U7bxVffLl';
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
		if($responseData->success){
			$email = $_POST['email']; 
			$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE email = '".$email."' ");
			if(!empty($results)){
			 $_SESSION['error_msgs'] .= "You Have already registered, Please login";
			}else{
			 		extract($_POST);
					$email = strtolower($email);
					if($name == ''){
						$_SESSION['error_msgs'] .= "Please enter names<br/>";
					}else{
						if(!preg_match('/^[a-z .\-]+$/i', $name)){
							$_SESSION['error_msgs'] .= "Name should contain only letters<br/>";	
						}
					}
					
					if($email == ""){
						$_SESSION['error_msgs'] .= "Please enter email<br/>";
					}else{
						if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email)){
							$_SESSION['error_msgs'] .= "Please enter valid email<br/>";	
						}
					}
					
					if($mobile != "" && !preg_match('/^[0-9]{9,13}$/', $mobile)){
						$_SESSION['error_msgs'] .= "Please enter valid mobile number<br/>";	
					}
					
					if($password == ""){
						$_SESSION['error_msgs'] .= "Please enter password<br/>";
					}else{
						if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/', $password)){
							$_SESSION['error_msgs'] .= "Password should contain atleast one special character and one number and one capital letter<br/>";	
						}
					}
					
					if($terms == ""){
						$_SESSION['error_msgs'] .= "Please select terms & conditions<br/>";	
					}
					
					if($confirm_password == ""){
						$_SESSION['error_msgs'] .= "Please enter confirm password<br/>";
					}else{
						if($confirm_password != $password){
							$_SESSION['error_msgs'] .= "Password and confirm password mismatch<br/>";
						}
					}
					
					
					
					if($_SESSION['error_msgs'] == ''){
						$added_date = strtotime(date("d-m-Y"));
						$string = "abcdefghijklmnopqrstuvexyz1234567890";
						$registration_link = str_shuffle(substr($string,10));
						global $wpdb;
						$password = md5($password);
						$added_date = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
						$wpdb->insert('wp_register_users', array(
						  'name' => $name, 
						  'email' => $email, 
						  'mobile' => $mobile, 
						  'password' => $password,
						  'added_date' => $added_date, 
						  'registration_link'=>$registration_link, 
						  ),
						array( '%s', '%s', '%s', '%s','%s','%s'));
						
						//echo "Inserted"; exit;
						
						$to = $email;
						$subject = "Account activation link";
						$activation_link = SITEURL."activate-account/?activation_link=".$registration_link;
						//$message = "Please <a href='".$activation_link."' target='_blank'>click on this link</a> to activate your account";
						$message = "Please <a href='$activation_link' target='_blank'>click on this link</a> to activate your account";
						//$message = 'Please <a href="'.$activation_link.'" target="_blank">click on this link</a> to activate your account';
						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						// More headers
						$headers .= 'From: <info@desihomes.co.uk>' . "\r\n";
						@mail($to,$subject,$message,$headers);
						$_SESSION['success_msg'] = "Please check your email to activate your account. Please check spam folder if email did not landed in inbox";
					}
				}
			  }
		  }else{
		  	$_SESSION['error_msgs'] .= 'Robot verification failed, please try again.';
		  }
		}else{
			$_SESSION['error_msgs'] .= 'Please click on the reCAPTCHA box.';
		}
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
?>