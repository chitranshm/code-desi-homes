<?php
require_once "fbconfig.php";
//echo "Data<pre>"; print_r($_GET); 
//echo "<pre>Helper is "; print_r($helper); 
//$accessToken = $helper->getAccessToken();
echo "Hello";
//exit;
//echo "<pre>Access Token is "; print_r($accessToken); 
//exit;
try {
	$accessToken = $helper->getAccessToken();
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

if (!$accessToken) {
	//header('Location: login');
	//exit();
	echo "Error is "; print_r($helper->getError()); exit;
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
$oAuth2Client = $FB->getOAuth2Client();
if (!$accessToken->isLongLived())
	$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
$userData = $response->getGraphNode()->asArray();
$_SESSION['userData'] = $userData;
$_SESSION['access_token'] = (string) $accessToken;
header('Location: index.php');
exit();
get_footer(); 
?>