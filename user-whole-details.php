<?php
//echo "asdsfsdfsdfsd"; exit;
date_default_timezone_set("Europe/London");
require_once 'wp-config.php';
$id = $_GET['id'];
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE id = '".$id."'");
if(!empty($results)){
	//echo "<pre>"; print_r($results);
	//return $results;
?>
	<!--<h3 style="text-align:center;"><?php echo stripslashes($results[0]->title)?></h3>-->
	<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<td><strong>Name</strong> : </td><td><?php echo stripslashes($results[0]->name)?></td>
		</tr>
		<tr>
			<td><strong>Email</strong> : </td><td><?php echo stripslashes($results[0]->email)?></td>
		</tr>
		<tr>
			<td><strong>Contact</strong> : </td><td><?php echo stripslashes($results[0]->mobile)?></td>
		</tr>
		<tr>
			<td><strong>Address Line 1</strong> : </td><td><?php echo stripslashes($results[0]->address_line1);?></td>
		</tr>
		<tr>
			<td><strong>Address Line 2</strong> : </td><td><?php echo stripslashes($results[0]->address_line2);?></td>
		</tr>
		<tr>
			<td><strong>Address Line 3</strong> : </td><td><?php echo stripslashes($results[0]->address_line3);?></td>
		</tr>
		<tr>
			<td><strong>Town</strong> : </td><td><?php echo stripslashes($results[0]->town);?></td>
		</tr>
		<tr>
			<td><strong>Postcode</strong> : </td><td><?php echo stripslashes($results[0]->postcode);?></td>
		</tr>
		<tr>
			<td><strong>Added Date</strong> : </td><td><?php echo date("d-m-Y",$results[0]->added_date);?></td>
		</tr>
		<tr>
			<?php 
			if($results[0]->loginwith == "f"){
				$userImg = $results[0]->image;
			}else{
				if($results[0]->image != "" && file_exists("./images/user_images/".$results[0]->image)){
					$userImg = SITEURL."images/user_images/".$results[0]->image;
				}else{
					$userImg = SITEURL."images/no_image_available.png";
				}
			}
			?>
			<td><strong>Image</strong> : </td><td><img src="<?php echo $userImg;?>" width="100" height="100"/></td>
		</tr>
	</table>
	</div>
<?php
}else{
	return "";
}
?>