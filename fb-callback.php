<?php
require_once "fbconfig.php";
require_once "wp-config.php";
//echo "Data<pre>"; print_r($_GET); 
//echo "<pre>Helper is "; print_r($helper); 
//$accessToken = $helper->getAccessToken($callbackurl);
//echo "<pre>"; print_r($accessToken); exit;
//echo "Hello";
//exit;
//echo "<pre>Access Token is "; print_r($accessToken); 
//exit;
try {
	$accessToken = $helper->getAccessToken($callbackurl);
	//echo "Data<pre>"; exit;
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
	echo "Response Exception: " . $e->getMessage();
	exit();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
	echo "SDK Exception: " . $e->getMessage();
	exit();
} catch(Exception $e){
	echo "Other Exception: " . $e->getMessage();
	exit();
}

if (empty($accessToken)) {
	//header('Location: login');
	//exit();
	//echo "Error is "; print_r($helper->getError()); exit;
	if ($helper->getError()) {
		header('HTTP/1.0 401 Unauthorized');
		echo "Error: " . $helper->getError() . "\n";
		echo "Error Code: " . $helper->getErrorCode() . "\n";
		echo "Error Reason: " . $helper->getErrorReason() . "\n";
		echo "Error Description: " . $helper->getErrorDescription() . "\n";
	  }else{
    	header('HTTP/1.0 400 Bad Request');
    	echo 'Bad requesting';
  	  }
  	exit;
}
$oAuth2Client = $fb->getOAuth2Client();
if (!$accessToken->isLongLived())
	$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

$response = $fb->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
$userData = $response->getGraphNode()->asArray();
$_SESSION['userData'] = $userData;
//echo "<pre>"; print_r($_SESSION); exit;
$_SESSION['access_token'] = (string) $accessToken;

$first_name = $_SESSION['userData']['first_name'];
$last_name = $_SESSION['userData']['last_name'];
$email = $_SESSION['userData']['email'];
$name = $first_name." ".$last_name;
$image = $_SESSION['userData']['picture']['url'];
//echo "Data<pre>"; print_r($_SESSION['userData']); exit;
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE email = '".$email."'");
if(!empty($results)){
	$id = $results[0]->id;
	$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET name = %s,email = %s,image = %s WHERE id = %d",$name,$email,$image,$id));
	$_SESSION['user_id'] = $results[0]->id;
	$_SESSION['name'] = $results[0]->name;
	$_SESSION['email'] = $results[0]->email;
	$_SESSION['mobile'] = $results[0]->mobile;
	$_SESSION['loginwith'] = $results[0]->loginwith;
}else{
	$added_date = strtotime(date("d-m-Y"));
	$wpdb->insert('wp_register_users', array(
	  'name' => $name, 
	  'email' => $email,
	  'status' => 't',
	  'image' => $image,
	  'loginwith' => 'f',
	  'added_date' => $added_date,  
	  ),
	array('%s','%s','%s','%s','%s','%s'));
	$id = $wpdb->insert_id;	
	$_SESSION['user_id'] = $id;
	//$_SESSION['user_id'] = $_SESSION['userData']['id'];	
	$_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
	$_SESSION['loginwith'] = $results[0]->loginwith;
}
header('Location: https://desihomes.co.uk');
exit();
get_footer(); 
?>