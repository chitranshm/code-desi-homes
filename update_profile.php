<?php 
require_once('wp-config.php');
global $wpdb;
extract($_POST);
if($_FILES['image']['name'] != ""){
	$image = $_FILES['image']['name'];
	if($image != ""){
		if(!is_dir('./images/user_images')){
			mkdir('./images/user_images');
		}
		$image = time()."-".str_replace(" ","_",$image);
		$uploaddir = './images/user_images/';
		$uploadPath = $uploaddir.$image;
		move_uploaded_file($_FILES['image']['tmp_name'],$uploadPath);
	}
}else{
	$image = $_POST['image1'];
}
$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET name = %s,email = %s,mobile = %s,image = %s,address_line1 = %s, address_line2 = %s, address_line3 =%s,town = %s,postcode = %s WHERE id = %d",$name,$email,$mobile,$image,$address_line1,$address_line2,$address_line3,$town,$postcode,$_SESSION['user_id']));
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['mobile'] = $mobile;
$page = get_page_by_title('profile');
wp_redirect(get_permalink($page->ID));
$location1 = SITEURL . "/profile";
wp_redirect( $location1, 301 );
exit;
?>