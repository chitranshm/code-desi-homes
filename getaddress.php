<?php 
ob_start();
session_start();
$addresses = array();
$postcode = $_POST['postcode'];
if($postcode != ""){
	//$api_key  = "iddqd";
	$api_key  = "ak_jf89lk231OXOebn9e7QsWuEDrz27q";
	$base_url = "https://api.ideal-postcodes.co.uk/v1/postcodes/";
	//$base_url = "https://api.postcodes.io/postcodes/";
	$url = $base_url . rawurlencode($postcode) . "?api_key=" . $api_key;
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch1, CURLOPT_URL, $url);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	$response = json_decode(curl_exec($ch1), true);
	curl_close($ch1);
	if(isset($response["result"]) && !empty($response["result"])){
		$addresses = $response["result"];
	}
	$num = count($addresses);
	if(!empty($addresses)){
		$_SESSION['longitude'] = $addresses[0]['longitude'];
		$_SESSION['latitude'] = $addresses[0]['latitude'];
		$_SESSION['county'] = $addresses[0]['county'];
		$_SESSION['district'] = $addresses[0]['district'];
		$_SESSION['country'] = $addresses[0]['country'];
		?>
		<option value="">Select your address</option>
		<?php
		for($i=0;$i<count($addresses);$i++){
		?>
		<option value="<?php echo $addresses[$i]['line_1'].", ".$addresses[$i]['district'].", ".$addresses[$i]['county']."-".$addresses[$i]['latitude']."-".$addresses[$i]['longitude'];?>"><?php echo $addresses[$i]['line_1'].", ".$addresses[$i]['district'].", ".$addresses[$i]['county'];?></option>
		<?php
		}
	}else{
		$_SESSION['longitude'] = "-0.078407275956371";
		$_SESSION['latitude'] = "51.382744307273";
		$_SESSION['county'] = "county";
		$_SESSION['district'] = "Croydon";
		$_SESSION['country'] = "England";
		?>
		<option value="">Select your address</option>
		<option value="1 Testing Gardens, Testdon, Testrey">1 Testing Gardens, Testdon, Testrey</option>
		<option value="2 Testing Gardens, Testdon, Testrey">2 Testing Gardens, Testdon, Testrey</option>
		<?php
	}
}else{
	echo "";
}
?>