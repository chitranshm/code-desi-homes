<?php 
class general{
	
	function getAllPropertyType($con){
		$sql = "SELECT * FROM `property_type` WHERE 1";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) > 0){
			$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
			return $data;
		}else{
			return "";
		}
	}
	
	function getSearchedProperties($con,$post){
		if(!empty($post)){
			$where = "";
			if(isset($post['property_type']) && $post['property_type'] != ""){
				$where .= " AND property_type_id = '".$post['property_type']."' ";
			}
			if(isset($post['location']) && $post['location'] != ""){
				$where .= " AND postcode = '".$post['location']."' ";
			}
			if(isset($post['no_of_bedrooms']) && $post['no_of_bedrooms'] != ""){
				$where .= " AND no_of_bedrooms = '".$post['no_of_bedrooms']."' ";
			}
			
			if(isset($post['price']) && $post['price'] != ""){
				$where .= " AND price <= '".$post['price']."' ";
			}
			
			$sql = "SELECT * FROM `properties` WHERE 1 ".$where." ORDER BY added_date DESC ";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function userRegistration($wpdb,$post){
		if(!empty($post)){
			$added_date = strtotime(date("d-m-Y"));
			extract($post);
			$string = "abcdefghijklmnopqrstuvexyz1234567890";
			$registration_link = str_shuffle(substr($string,10));
			$sql = "INSERT INTO `users` SET name = '".$name."', ";
			$sql .= "email = '".$email."',";
			$sql .= "mobile = '".$mobile."',";
			$sql .= "password = '".md5($password)."',";
			$sql .= "registration_link = '".$registration_link."',";
			$sql .= "added_date = '".$added_date."' ";
			mysqli_query($con,$sql);
			$to = $email;
			$subject = "Account activation link";
			$activation_link = "http://localhost/portal/activate_account.php?activation_link=".$registration_link;
			$message = "Please <a href='".$activation_link."' target='_blank'>click on this link</a> to activate your account";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <info@desihomes.com>' . "\r\n";
			@mail($to,$subject,$message,$headers);
			echo "success";
			return "registered";

		}else{
			return "";
		}
	}
	
	function userLogin($con,$post){
		if(!empty($post)){
			extract($post);
			$password = md5($password);
			$sql = "SELECT * FROM `users` WHERE email = '".$email."' AND password = '".$password."' AND status = 't' ";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_assoc($result);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function saveProperty($con,$post){
		if(!empty($post)){
			extract($post);
			$added_date = date("d-m-Y");
			$added_by = $_SESSION['user_id'];
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
			$sql = "";
			$sql .= "INSERT INTO `properties` SET 	property_type_id = '".$property_type."', ";
			$sql .= "title = '".$title."',";
			$sql .= "description ='".$description."',";
			$sql .= "location = '".$location."',";
			$sql .= "postcode = '".$postcode."',";
			$sql .= "city = '".$city."',";
			$sql .= "country ='".$country."',";
			$sql .= "map = '".$map."',";
			$sql .= "contact_details = '".$contact_details."',";
			$sql .= "no_of_bedrooms = '".$no_of_bedrooms."',";
			$sql .= "no_of_bathrooms = '".$no_of_bathrooms."',";
			$sql .= "is_garden = '".$is_garden."',";
			$sql .= "is_parking = '".$is_parking."',";
			$sql .= "is_centralheating = '".$is_centralheating."',";
			$sql .= "is_ac = '".$is_ac."',";
			$sql .= "is_wifi = '".$is_wifi."',";
			$sql .= "is_cable = '".$is_cable."',";
			$sql .= "is_washing = '".$is_washing."',";
			$sql .= "is_dryer = '".$is_dryer."',";
			$sql .= "is_dishwasher = '".$is_dishwasher."',";
			$sql .= "is_microwave = '".$is_microwave."',";
			$sql .= "price ='".$price."', ";
			$sql .= "added_by ='".$added_by."', ";
			$sql .= "added_date ='".$added_date."' ";
			mysqli_query($con,$sql);
			$id = mysqli_insert_id($con);	
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
					$sql_image = "INSERT INTO `property_images` SET property_id = '".$id."',image = '".$image."' "; 
					mysqli_query($con,$sql_image);
				}
			}
			return "saved";
		}else{
			return "";
		}
	}
	
	function getPropertyById($con,$id){
		if($id != ""){
			$sql = "SELECT * FROM `properties` WHERE id = '".$id."' ";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function getImagesOfProperty($con,$id){
		if($id != ""){
			$sql = "SELECT * FROM `property_images` WHERE property_id = '".$id."' "; 
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function get_data_by($con,$table,$field,$id){
		if($table != "" && $field != ""){
			$sql = "SELECT ".$field." FROM ".$table." WHERE id = '".$id."' ";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_assoc($result);
				return $data[$field];
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function showVendorProperties($con,$added_by){
		if($added_by != ""){
			$sql = "SELECT * FROM `properties` WHERE added_by = '".$added_by."' "; 
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function changePropertyStatus($con,$get){
		if(!empty($get)){
			if($get['sts'] == "t"){
				$status = "f";
			}else{
				$status = "t";
			}
			$sql = "UPDATE `properties` SET status = '".$status."' WHERE id = '".$get['id']."' ";
			$result = mysqli_query($con,$sql);
			return "updated";
		}else{
			return "";
		}
	}
	
	function getPropertyByIdForVendor($con,$id){
		if($id != ""){
			$sql = "SELECT * FROM `properties` WHERE id = '".$id."' AND added_by = '".$_SESSION['user_id']."' "; 
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function getPropertyImages($con,$property_id){
		if($property_id != ""){
			$sql = "SELECT * FROM `property_images` WHERE property_id = '".$property_id."' "; 
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function deletePropertyImage($con,$id,$image){
		if($id != "" && $image != ""){
			$sql = "DELETE FROM `property_images` WHERE id = '".$id."' ";
			mysqli_query($con,$sql);
			unlink('./images/property_images/'.$image);
			return "removed";
		}else{
			return "";
		}
	}
	
	function updateProperty($con,$post){
		if(!empty($post)){
			//echo "HI<pre>"; print_r($post); exit;
			extract($post);
			//$id = $post['id']
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
			$sql = "";
			$sql .= "UPDATE `properties` SET property_type_id = '".$property_type."', ";
			$sql .= "title = '".$title."',";
			$sql .= "description ='".$description."',";
			$sql .= "location = '".$location."',";
			$sql .= "postcode = '".$postcode."',";
			$sql .= "city = '".$city."',";
			$sql .= "country ='".$country."',";
			//$sql .= "map = '".$map."',";
			$sql .= "contact_details = '".$contact_details."',";
			$sql .= "no_of_bedrooms = '".$no_of_bedrooms."',";
			$sql .= "no_of_bathrooms = '".$no_of_bathrooms."',";
			$sql .= "is_garden = '".$is_garden."',";
			$sql .= "is_parking = '".$is_parking."',";
			$sql .= "is_centralheating = '".$is_centralheating."',";
			$sql .= "is_ac = '".$is_ac."',";
			$sql .= "is_wifi = '".$is_wifi."',";
			$sql .= "is_cable = '".$is_cable."',";
			$sql .= "is_washing = '".$is_washing."',";
			$sql .= "is_dryer = '".$is_dryer."',";
			$sql .= "is_dishwasher = '".$is_dishwasher."',";
			$sql .= "is_microwave = '".$is_microwave."',";
			$sql .= "price ='".$price."'  ";
			$sql .= "WHERE id ='".$id."' ";
			//echo $sql; exit;
			mysqli_query($con,$sql);
			//$id = mysqli_insert_id($con);	
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
					$sql_image = "INSERT INTO `property_images` SET property_id = '".$id."',image = '".$image."' "; 
					mysqli_query($con,$sql_image);
				}
			}
			return "updated";
		}else{
			return "";
		}
	}
	
	function activeUser($con,$registration_link){
		if($registration_link != ""){
			$sql = "UPDATE `users` SET status = 't' WHERE registration_link = '".$registration_link."' ";
			mysqli_query($con,$sql);
			return "activated";
		}else{
			return "";
		}
	}
	
	function resetPasswordLink($con,$post){
		if($post != ""){
			//echo "<pre>"; print_r($post); exit;
			$email = $post['email'];
			$emailexists = $this->checkemailexists($con,$email);
			if($emailexists != ""){
				$string = "abcdefghijklmnopqrstuvexyz1234567890";
				$password_reset_link = str_shuffle(substr($string,10));
				$sql = "UPDATE `users` SET password_reset_link = '".$password_reset_link."' WHERE email = '".$email."' ";
				mysqli_query($con,$sql);
				$to = $email;
				$subject = "Password reset link";
				$password_reset_link = "http://localhost/portal/reset_password.php?password_reset_link=".$password_reset_link;
				$message = "Please <a href='".$password_reset_link."' target='_blank'>click on this link</a> to reset your password";
				//echo $message; exit;
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: <info@desihomes.com>' . "\r\n";
				@mail($to,$subject,$message,$headers);
				
				return "sent";
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function checkemailexists($con,$email){
		if($email != ""){
			$sql = "SELECT id FROM `users` WHERE email = '".$email."' ";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				return "exists";
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function resetPassword($con,$post){
		if($post != ""){
			//echo "<pre>"; print_r($post); exit;
			$password = md5($post['new_password']);
			$password_reset_link = $post['password_reset_link'];
			$sql = "UPDATE `users` SET password = '".$password."' WHERE password_reset_link = '".$password_reset_link."' ";
			mysqli_query($con,$sql);
			return "updated";
		}else{
			return "";
		}
	}
	
	function getUserDetailsByID($con,$user_id){
		if($user_id != ""){
			$sql = "SELECT * FROM `users` WHERE id = '".$user_id."' "; 
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_assoc($result);
				return $data;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	
	function updateUserProfile($con,$post){
		if(!empty($post)){
			extract($post);
			$sql = "UPDATE `users` SET name = '".$name."', ";
			$sql .= "email = '".$email."',";
			$sql .= "mobile = '".$mobile."' ";
			$sql .= "WHERE id = '".$_SESSION['user_id']."' ";
			mysqli_query($con,$sql);
			return "updated";
		}else{
			return "";
		}
	}
	
	function changePassword($con,$post){
		if($post != ""){
			//echo "<pre>"; print_r($post); exit;
			$password = md5($post['new_password']);
			$sql = "UPDATE `users` SET password = '".$password."' WHERE id = '".$_SESSION['user_id']."' ";
			mysqli_query($con,$sql);
			return "updated";
		}else{
			return "";
		}
	}
}
?>