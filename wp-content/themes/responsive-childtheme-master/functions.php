<?php 
function userLogin($post){
	if(!empty($post)){
		extract($post);
		$email = strtolower($email);
		$password = md5($password);
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE email = '".$email."' AND password = '".$password."' AND status = 't' ");
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getUserDetailsByID($user_id){
	if($user_id != ""){
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE id = '".$user_id."' "); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getAllPropertyType(){
	global $wpdb;
	$sql = "SELECT * FROM `wp_property_type` WHERE 1";
	$results = $wpdb->get_results($sql);
	if(!empty($results)){
		return $results;
	}else{
		return "";
	}
}

function saveProperty($post){
	if(!empty($post)){
		extract($post);
		$added_date = date("d-m-Y");
		//echo "Data<pre>"; print_r($_SESSION); exit;
		$added_by = $_SESSION['user_id'];
		$lastupdatedtime = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
		$sqlpropcheck = "SELECT id FROM `wp_add_property` WHERE added_by = '".$added_by."' AND title = '".$title."' ";
		global $wpdb; 
		$results = $wpdb->get_results($sqlpropcheck);
		//echo "Data<pre>"; print_r($results); exit;
		if(empty($results)){
			//$table_name = $wpdb->prefix ."register_users";
			$wpdb->insert('wp_add_property', array(
			  'property_type_id' => $property_type, 
			  'title' => $title, 
			  'slug' => $slug,
			  'description' => $description, 
			  'added_by'=>$added_by,
			  'added_date'=>$added_date,
			  'lastupdatedtime'=>$lastupdatedtime
			  ),
			array( '%s', '%s', '%s', '%s','%s','%s','%d'));
			$id = $wpdb->insert_id;	
			$numberofImages = count($_FILES['image']['name']);
			for($i=0;$i<$numberofImages;$i++){
				$image = $_FILES['image']['name'][$i];
				if($image != ""){
					if(!is_dir('./images/property_images')){
						mkdir('./images/property_images');
					}
					$image = time()."-".str_replace(" ","_",$image);
					$uploaddir = './images/property_images/';
					$uploadPath = $uploaddir.$image;
					move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadPath);
					$wpdb->insert('wp_property_images', array(
						'property_id' => $id, 
						'image' => $image, 
					),
					array('%s','%s'));
				}
			}
			/* Mail to admin*/
			$getContactDetails = get_all_data_by("wp_register_users",$added_by);
			
			$to = "chitransh@reinventdigital.com,admin@desihomes.co.uk";
			$subject = "Property Added";
			$message = "Property has been added by ".$getContactDetails[0]->name;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <'.$getContactDetails[0]->email.'>' . "\r\n";
			@mail($to,$subject,$message,$headers);
			return $id;
		}else{
			return "already";
		}
	}else{
		return "";
	}
}

function showVendorProperties($added_by){
	if($added_by != ""){
		$sql = "SELECT * FROM `wp_add_property` WHERE added_by = '".$added_by."' ORDER BY id DESC "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function showVendorPropertiesIds($added_by){
	if($added_by != ""){
		$sql = "SELECT id FROM `wp_add_property` WHERE added_by = '".$added_by."' ORDER BY id DESC "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function showVendorPropertiesEnquiries($property_ids){
	if($property_ids != ""){
		$sql = "SELECT * FROM `wp_enquiries` WHERE property_id IN (".$property_ids.") ORDER BY id DESC "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getSearchedProperties($post){
	if(!empty($post)){
		//echo "Data<pre>"; print_r($post);exit;
		$where = "";
		if(isset($post['property_type']) && $post['property_type'] != ""){
			if($post['property_type'] == "all"){
				$where .= " AND property_type_id in ('1','2','3','4','5')";
			}else{
				$where .= " AND property_type_id = '".trim($post['property_type'])."' ";
			}
		}
		/*if(isset($post['postcode']) && $post['postcode'] != ""){
			$where .= " AND postcode = '".trim($post['postcode'])."' ";
		}*/

		if(isset($post['no_of_bedrooms']) && $post['no_of_bedrooms'] != "" && isset($post['no_of_bedrooms1']) && $post['no_of_bedrooms1'] != ""){
			//$where .= " AND no_of_bedrooms = '".$post['no_of_bedrooms']."' ";
			$where .= " AND no_of_bedrooms BETWEEN '".$post['no_of_bedrooms']."' AND '".$post['no_of_bedrooms1']."' ";
		}
		
		if(isset($post['price']) && $post['price'] != "" && isset($post['price1']) && $post['price1'] != ""){
			//$where .= " AND price <= '".$post['price']."' ";
			$where .= " AND price BETWEEN '".$post['price']."' AND '".$post['price1']."' ";
		}
		
		$sql = "SELECT * FROM `wp_add_property` WHERE 1 AND status = 't' AND user_availability_status = 't' AND expire = 'f' AND (postcode LIKE '%".$post['postcode']."%' OR city LIKE '%".$post['postcode']."%' OR postcode = '".$post['postcode']."') ".$where." ORDER BY lastupdatedtime DESC ";
		//echo $sql; exit; 
		//echo "1".$sql; exit; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			//echo "hi"; exit;
			return $results;
		}else{
			//echo "hiee"; exit;
			/* Finding Near By*/
			$postcode = $post['postcode'];
			$api_key  = "iddqd";
			$base_url = "https://api.postcodes.io/postcodes/";
			$url = $base_url . rawurlencode($postcode) . "?api_key=" . $api_key;
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch1, CURLOPT_URL, $url);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch1), true);
			curl_close($ch1);
			//echo "<pre>"; print_r($response); exit;
			$near_array = array();
			$near_array = $response['result'];
			//echo "<pre>"; print_r($near_array); exit;
			$near_latitude = $near_array['latitude'];
			$near_longitude = $near_array['longitude'];
			//echo $near_latitude."  ".$near_longitude; exit;
			
			$base_url2 = "http://api.postcodes.io/postcodes?lon=".$near_longitude."&lat=".$near_latitude."";
			$url2 = $base_url2 . rawurlencode($postcode) . "?api_key=" . $api_key;
			$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch2, CURLOPT_URL, $url2);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
			$response2 = json_decode(curl_exec($ch2), true);
			curl_close($ch2);
			$arr = array();
			$arr = $response2['result'];
			//echo "<pre>"; print_r($arr); exit;
			$postcodestr = "";
			for($i=0;$i<count($arr);$i++){
				$postcodestr .= "'".$arr[$i]['postcode']."'";
				if($i<(count($arr)-1)){
					$postcodestr .= ",";
				}
			}
			//echo $postcodestr; exit; 
			if($postcodestr != ""){
				//echo "Tost";exit;
				/*if($post['property_type'] == "all"){
					$where .= " AND property_type_id in ('1','2','3','4','5')";
				}else{
					$where .= " AND property_type_id = '".trim($post['property_type'])."' ";
				}*/
				
				
				$sql_near = "SELECT * FROM `wp_add_property` WHERE 1 AND status = 't' AND user_availability_status = 't' AND expire = 'f' AND postcode in (".$postcodestr.") AND (postcode LIKE '%".$post['postcode']."%' OR city LIKE '%".$post['postcode']."%' OR postcode = '".$post['postcode']."') ".$where." ORDER BY lastupdatedtime DESC ";
				//echo "2".$sql_near; exit;
				global $wpdb;
				$results_near = $wpdb->get_results($sql_near); 
				if(!empty($results_near)){
					//echo "<pre>"; print_r($results_near); exit;
					//echo "hello"; exit;
					return $results_near;
				}else{
					//echo "hellos"; exit;
					$similar_postcode = substr($postcode,0,3);
					$sql_similar =  "SELECT * FROM `wp_add_property` WHERE 1 AND status = 't' AND user_availability_status = 't' AND expire = 'f' AND property_type_id = '".$post['property_type']."' AND (postcode LIKE '%".$post['postcode']."%' OR city LIKE '%".$post['postcode']."%' OR postcode = '".$post['postcode']."') ".$where." ORDER BY lastupdatedtime DESC ";
					//echo "3".$sql_similar; exit;
					global $wpdb;
					$results_similar = $wpdb->get_results($sql_similar);
					if(!empty($results_similar)){
						return $results_similar;
					}else{
						return false;
					}
				}
			}else{
				$sql_similar =  "SELECT * FROM `wp_add_property` WHERE 1 AND status = 't' AND user_availability_status = 't' AND expire = 'f' AND property_type_id = '".$post['property_type']."' AND (postcode LIKE '%".$post['postcode']."%' OR city LIKE '%".$post['postcode']."%' OR postcode = '".$post['postcode']."') ".$where." ORDER BY lastupdatedtime DESC ";
				//echo "3".$sql_similar; exit;
				global $wpdb;
				$results_similar = $wpdb->get_results($sql_similar);
				if(!empty($results_similar)){
					return $results_similar;
				}else{
					return false;
				}
			}
		}
	}else{
		return "";
	}
}

function getSingleImagesOfProperty($id){
	if($id != ""){
		$sql = "SELECT image FROM `wp_property_images` WHERE image != '' AND property_id = '".$id."' ORDER BY id ASC LIMIT 1 "; 
		//echo $sql; exit;
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getImagesOfProperty($id){
	if($id != ""){
		$sql = "SELECT * FROM `wp_property_images` WHERE property_id = '".$id."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function bookProperty($post){
	if(!empty($post)){
		
		$available_from = $_POST['bookstart'];
		$available_to = $_POST['bookend'];
		
		$period = new DatePeriod(
			 new DateTime($available_from),
			 new DateInterval('P1D'),
			 new DateTime($available_to)
		);
		
		$all_available_dates = "";
		foreach ($period as $key => $value) {
			$all_available_dates .= $value->format('d-m-Y');
			$all_available_dates .= ",";
		}
		//$available_to = $available_to->format('d-m-Y');
		$available_to = strtotime($available_to);
		$available_to = date("d-m-Y",$available_to);
		$all_available_dates .= $available_to;
		
		//echo $all_available_dates; exit;
		
		$dates = array();
		$dates = explode(",",$all_available_dates);
		//echo "<pre>"; print_r($dates); exit;
		$num = count($dates);
		$property_id = $post['property_id'];
		$owner_id = $_SESSION['user_id'];
		global $wpdb;
		for($i=0;$i<$num;$i++){
			$wpdb->insert('wp_property_booking_dates', array(
			  'property_id' => $property_id, 
			  'owner_id' => $owner_id,
			  'booked_date' => trim($dates[$i])
			  ),
			array('%s','%s','%s'));
		}
		return "booked";
	}else{
		return "";
	}
}

function getPropertyVendor($property_id){
	//echo $property_id; exit;
	if($property_id != ""){
		$sql = "SELECT added_by FROM `wp_add_property` WHERE id = '".$property_id."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function showPropertyBookedDates($property_id){
	if($property_id != ""){
		$sql = "SELECT * FROM `wp_property_booking_dates` WHERE property_id = '".$property_id."' AND owner_id = '".$_SESSION['user_id']."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function deleteBooking1($id){
	if($id != ""){
		 $sql = "DELETE FROM `wp_property_booking_dates` WHERE id = '".$id."' ";
		 global $wpdb;
		 $wpdb->query($sql);
		 return "deleted";
	}else{
		return "";
	}
}

function getPropertyByIdForVendor($id){
	if($id != ""){
		$sql = "SELECT * FROM `wp_add_property` WHERE id = '".$id."' AND added_by = '".$_SESSION['user_id']."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getPropertyImages($property_id){
	if($property_id != ""){
		$sql = "SELECT * FROM `wp_property_images` WHERE property_id = '".$property_id."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function deletePropertyImage($id,$image){
	if($id != "" && $image != ""){
		$sql = "DELETE FROM `wp_property_images` WHERE id = '".$id."' ";
		//echo $sql; exit;
		global $wpdb;
		$wpdb->query($sql);
		unlink('./images/property_images/'.$image);
		return "removed";
	}else{
		return "";
	}
}

function deletePropertyFeaturedImage($id,$image){
	if($id != "" && $image != ""){
		$img = "";
		global $wpdb;
		$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET featured_image = %s WHERE id = %d ",$img,$id));
		unlink('./images/property_images/'.$image);
		return "removed";
	}else{
		return "";
	}
}


function updateProperty($post){
	if(!empty($post)){
		extract($post);
		$status = "f";
		$lastupdatedtime = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
		if($type == "general"){
			$sqlpropcheck = "SELECT id FROM `wp_add_property` WHERE added_by = '".$_SESSION['user_id']."' AND title = '".$title."' AND id != '".$id."' ";
			global $wpdb; 
			$results = $wpdb->get_results($sqlpropcheck);
			if(empty($results)){
				$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET property_type_id = %d, title = %s,description = %s,status = %s,lastupdatedtime = %d WHERE id = %d ",$property_type,$title,$description,$status,$lastupdatedtime,$id));
				return "updated";
			}else{
				return "already";
			}
		}
		
		if($type == "facilities"){
			if(isset($post['is_garden']) && $post['is_garden']=='t'){
				$is_garden = "t";
			}else{
				$is_garden = "f";
			}
			if(isset($post['is_parking']) && $post['is_parking']=='t'){
				$is_parking = "t";
			}else{
				$is_parking = "f";
			}
			if(isset($post['is_centralheating']) && $post['is_centralheating']=='t'){
				$is_centralheating = "t";
			}else{
				$is_centralheating = "f";
			}
			if(isset($post['is_ac']) && $post['is_ac']=='t'){
				$is_ac = "t";
			}else{
				$is_ac = "f";
			}
			if(isset($post['is_wifi']) && $post['is_wifi']=='t'){
				$is_wifi = "t";
			}else{
				$is_wifi = "f";
			}
			if(isset($post['is_cable']) && $post['is_cable']=='t'){
				$is_cable = "t";
			}else{
				$is_cable = "f";
			}
			if(isset($post['is_washing']) && $post['is_washing']=='t'){
				$is_washing = "t";
			}else{
				$is_washing = "f";
			}
			if(isset($post['is_dryer']) && $post['is_dryer']=='t'){
				$is_dryer = "t";
			}else{
				$is_dryer = "f";
			}
			if(isset($post['is_dishwasher']) && $post['is_dishwasher']=='t'){
				$is_dishwasher = "t";
			}else{
				$is_dishwasher = "f";
			}
			if(isset($post['is_microwave']) && $post['is_microwave']=='t'){
				$is_microwave = "t";
			}else{
				$is_microwave = "f";
			}
			if(isset($post['house_alarm']) && $post['house_alarm']=='t'){
				$house_alarm = "t";
			}else{
				$house_alarm = "f";
			}
			if(isset($post['pets']) && $post['pets']=='t'){
				$pets = "t";
			}else{
				$pets = "f";
			}
			if(isset($post['nosmoking']) && $post['nosmoking']=='t'){
				$nosmoking = "t";
			}else{
				$nosmoking = "f";
			}
			global $wpdb;
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET is_garden = %s,is_parking = %s,is_centralheating = %s,is_ac = %s,is_wifi = %s,is_cable = %s,is_washing = %s,is_dryer = %s,is_dishwasher = %s,is_microwave = %s,house_alarm = %s,pets = %s,nosmoking = %s,no_of_bedrooms = %s,no_of_bathrooms = %s,price = %s,status = %s,lastupdatedtime = %d WHERE id = %d",$is_garden,$is_parking,$is_centralheating,$is_ac,$is_wifi,$is_cable,$is_washing,$is_dryer,$is_dishwasher,$is_microwave,$house_alarm,$pets,$nosmoking,$no_of_bedrooms,$no_of_bathrooms,$price,$status,$lastupdatedtime,$id));
			return "updated";
		}
		
		if($type == "address"){
			global $wpdb;
			if($_POST['location'] != ''){
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET postcode = %s, location = %s,first_address_line = %s,second_address_line = %s,third_address_line = %s,city = %s,county = %s,latitude = %s,longitude = %s,status = %s,lastupdatedtime = %d WHERE id = %d ",$postcode,$location,$first_address_line,$second_address_line,$third_address_line,$city,$county,$latitude,$longitude,$status,$lastupdatedtime,$id));
			}else{
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET postcode = %s, location = %s,first_address_line = %s,second_address_line = %s,third_address_line = %s,city = %s,county = %s,latitude = %s,longitude = %s,status = %s,lastupdatedtime = %d WHERE id = %d ",$postcode,$locationnew,$first_address_line,$second_address_line,$third_address_line,$city,$county,$latitude,$longitude,$status,$lastupdatedtime,$id));
			}
			return "updated";
		}
		
		if($type == "calendar"){
			$available_from = $_POST['available_from'];
			$available_to = $_POST['available_to'];
			
			$period = new DatePeriod(
				 new DateTime($available_from),
				 new DateInterval('P1D'),
				 new DateTime($available_to)
			);
			
			$all_available_dates = "";
			foreach ($period as $key => $value) {
				$all_available_dates .= $value->format('d-m-Y');
				$all_available_dates .= ",";
			}
			$available_to = strtotime($available_to);
			$available_to = date("d-m-Y",$available_to);
			$all_available_dates .= $available_to;
			$available_from = strtotime($available_from);
			$available_from = date("d-m-Y",$available_from);
			global $wpdb;
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET available_from = %s,available_to = %s,all_available_dates = %s,status = %s,lastupdatedtime = %d WHERE id = %d",$available_from,$available_to,$all_available_dates,$status,$lastupdatedtime,$id));
			return "updated";
		}
		
		if($type == "nearby"){
			global $wpdb;
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET near_by_school_name = %s, near_by_school =%s,unitschooldist =%s,near_by_busstop_name=%s,near_by_busstop=%s,unitbusstopdist =%s,near_by_station_name=%s,near_by_station = %s, unittraindist = %s,near_by_grocery_name=%s,near_by_grocery = %s,unitgrocerydist = %s,status = %s,lastupdatedtime = %d WHERE id = %d",$near_by_school_name,$near_by_school,$unitschooldist,$near_by_busstop_name,$near_by_busstop,$unitbusstopdist,$near_by_station_name,$near_by_station,$unittraindist,$near_by_grocery_name,$near_by_grocery,$unitgrocerydist,$status,$lastupdatedtime,$id));
			return "updated";
		}
		
		/*$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET property_type_id = %d, title = %s,description = %s,location = %s,postcode = %s,city = %s,country = %s,contact_details = %s,no_of_bedrooms = %s,no_of_bathrooms = %s,is_garden = %s,is_parking = %s,is_centralheating = %s,is_ac = %s,is_wifi = %s,is_cable = %s,is_washing = %s,is_dryer = %s,is_dishwasher = %s,is_microwave = %s,price = %s WHERE id = %d",$property_type,$title,$description,$location,$postcode,$city,$country,$contact_details,$no_of_bedrooms,$no_of_bathrooms,$is_garden,$is_parking,$is_centralheating,$is_ac,$is_wifi,$is_cable,$is_washing,$is_dryer,$is_dishwasher,$is_microwave,$price,$id));*/
		if($type == "photos"){
			//global $wpdb;
			/*$featured_image = $_FILES['featured_image']['name'];
			if($featured_image != ""){
				if(!is_dir('./images/property_images')){
					mkdir('./images/property_images');
				}
				$featured_image = time()."f-".str_replace(" ","_",$featured_image);
				$uploaddir = './images/property_images/';
				$uploadPath = $uploaddir.$featured_image;
				move_uploaded_file($_FILES['featured_image']['tmp_name'],$uploadPath);
				global $wpdb;
				$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET featured_image = %s,status = %s WHERE id = %d",$featured_image,$status,$id));
			}*/
			
			
			$numberofImages = count($_FILES['image']['name']);
			if($numberofImages > 0 && !empty($_FILES['image']['name'][0])){
			//echo "Hiee"; exit;
			for($i=0;$i<$numberofImages;$i++){
				$status = 'f';
				//echo "TEst"; exit;
				//echo "<pre>"; print_r($_FILES); exit;
				$image = $_FILES['image']['name'][$i];
				if($image != ""){
					if(!is_dir('./images/property_images')){
						mkdir('./images/property_images');
					}
					$image = time()."s-".str_replace(" ","_",$image);
					$uploaddir = './images/property_images/';
					$uploadPath = $uploaddir.$image;
					move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadPath);
					global $wpdb;
					
					$getPropertyImages = getPropertyImages($id);
					if(empty($getPropertyImages)){
						if($i==0){
							$featured_image = $image;
							$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET featured_image = %s,status = %s,lastupdatedtime = %d WHERE id = %d",$featured_image,$status,$lastupdatedtime,$id));
						}
					}
					$wpdb->insert('wp_property_images', array(
						'property_id' => $id, 
						'image' => $image, 
					),
					array('%s','%s'));
				}
			}
			$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET status = %s,lastupdatedtime = %d WHERE id = %d",$status,$lastupdatedtime,$id));
			}else{
				//echo "Hello"; exit;
			}
			return "updated";
		}
	}else{
		return "";
	}
}

function resetPasswordLink($post){
	if($post != ""){
		//echo "Data<pre>"; print_r($post); exit;
		$email = $post['email'];
		$emailexists = checkemailexists($email);
		if($emailexists[0]->id != ""){
			$string = "abcdefghijklmnopqrstuvexyz1234567890";
			$password_reset_link = str_shuffle(substr($string,10));
			global $wpdb;
			$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET password_reset_link = %s WHERE email = %s AND id = %d",$password_reset_link,$email,$emailexists[0]->id));
			$to = $email;
			$subject = "Password reset link";
			$password_reset_link = SITEURL."reset-password/?password_reset_link=".$password_reset_link;
			$message = "Please <a href='".$password_reset_link."' target='_blank'>click on this link</a> to reset your password";
			//echo $message; exit;
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <info@desihomes.co.uk>' . "\r\n";
			@mail($to,$subject,$message,$headers);
			return "sent";
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function checkemailexists($email){
	if($email != ""){
		//echo "email : ".$email; exit;
		$sql = "SELECT id FROM `wp_register_users` WHERE email = '".$email."' ";
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function resetPassword($post){
	if($post != ""){
		$password = md5($post['new_password']);
		$password_reset_link = $post['password_reset_link'];
		global $wpdb;
		$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET password = %s WHERE password_reset_link = %s",$password,$password_reset_link));
		return "updated";
	}else{
		return "";
	}
}

function changePassword($post){
	if($post != ""){
		//echo "<pre>"; print_r($post); exit;
		$password = md5($post['new_password']);
		global $wpdb;
		$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET password = %s WHERE id = %d",$password,$_SESSION['user_id']));
		return "updated";
	}else{
		return "";
	}
}

function totalProperties($added_by,$status){
	if($added_by != ""){
		$where = "";
		if($status != ""){
			$where .= " AND status = '".$status."' ";
		}
		$sql = "SELECT * FROM `wp_add_property` WHERE 1 AND added_by = '".$added_by."' ".$where; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getPropertyById($id,$slug){
	if($id != "" && $slug != ""){
		$sql = "SELECT * FROM `wp_add_property` WHERE id = '".$id."' AND slug = '".$slug."' ";
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getPropertySlugTitle($id){
	if($id != ""){
		$sql = "SELECT title,slug FROM `wp_add_property` WHERE id = '".$id."'";
		//echo $sql; exit;
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function get_data_by($table,$field,$id){
	if($table != "" && $field != ""){
		$sql = "SELECT ".$field." FROM ".$table." WHERE id = '".$id."' ";
		//echo $sql; exit; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results[0]->$field;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function get_all_data_by($table,$id){
	if($table != "" && $id != ""){
		$sql = "SELECT * FROM ".$table." WHERE id = '".$id."' ";
		//echo $sql; exit; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			//echo "Data<pre>"; print_r($results); exit;
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}


function getPropertyBookedDates($property_id){
	if($property_id != ""){
		$sql = "SELECT booked_date FROM `wp_property_booking_dates` WHERE property_id = '".$property_id."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function getPropertyAvailableDates($property_id){
	if($property_id != ""){
		$sql = "SELECT all_available_dates FROM `wp_add_property` WHERE id = '".$property_id."' "; 
		global $wpdb;
		$results = $wpdb->get_results($sql); 
		if(!empty($results)){
			return $results;
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function activeUser($registration_link){
	if($registration_link != ""){
		global $wpdb;
		$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET status = %s WHERE registration_link = %s",'t',$registration_link));
		return "activated";
	}else{
		return "";
	}
}

function getLatestProperties(){
	$sql = "SELECT id as wpid,title,slug,description,featured_image FROM `wp_add_property` WHERE status = 't' AND user_availability_status = 't' AND expire = 'f' AND featured_image != '' ORDER BY id DESC LIMIT 5"; 
	//echo $sql; exit;
	global $wpdb;
	$results = $wpdb->get_results($sql); 
	if(!empty($results)){
		return $results;
	}else{
		return "";
	}
}

function deleteBooking($post){
	if(!empty($post)){
		
		//echo "de<pre>"; print_r($post); exit;
		
		$available_from = $post['bookstart'];
		$available_to = $post['bookend'];
		$property_id = $post['property_id']; 
		if($available_from != "" && $available_to != ""){
			$period = new DatePeriod(
				 new DateTime($available_from),
				 new DateInterval('P1D'),
				 new DateTime($available_to)
			);
			
			$all_available_dates = "";
			foreach ($period as $key => $value) {
				$all_available_dates .= $value->format('d-m-Y');
				$all_available_dates .= ",";
			}
			$all_available_dates .= $available_to;
			
			//echo "All Dates<pre>"; print_r($all_available_dates); exit;
			
			$datearr = array();
			if($all_available_dates != ""){
				$datearr = explode(",",$all_available_dates);
			}
			//echo "datearr is <pre>"; print_r($datearr); exit;
			global $wpdb;
			for($i=0;$i<count($datearr);$i++){
				$sql = "DELETE FROM `wp_property_booking_dates` WHERE property_id = '".$property_id."' AND booked_date =  '".$datearr[$i]."' ";		 
				$wpdb->query($sql);
			 }
			  return "deleted";
		 }else if($available_from != "" && $available_to == ""){
		 	global $wpdb;
			$sql = "DELETE FROM `wp_property_booking_dates` WHERE property_id = '".$property_id."' AND booked_date =  '".$available_from."' ";		 
				$wpdb->query($sql);
			return "deleted";
		 }
	}else{
		return "";
	}
}
?>