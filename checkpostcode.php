<?php 
$postcode = $_POST['postcode'];
if($postcode != ""){
	$api_key  = "iddqd";
	$base_url = "https://api.postcodes.io/postcodes/".$postcode."/validate";
	//$url = $base_url . rawurlencode($postcode) . "?api_key=" . $api_key;
	$url = $base_url;
	//echo $url; exit; 
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch1, CURLOPT_URL, $url);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	$response = json_decode(curl_exec($ch1), true);
	curl_close($ch1);
	//echo "<pre>"; print_r($response); exit;
	echo $response['result'];	
}else{
	echo "";
}
?>