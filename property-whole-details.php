<?php
//echo "asdsfsdfsdfsd"; exit;
require_once 'wp-config.php';
$id = $_GET['id'];
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM `wp_add_property` WHERE id = '".$id."'");
if(!empty($results)){
	//echo "<pre>"; print_r($results);
	//return $results;
?>
	<h3 style="text-align:center;"><?php echo stripslashes($results[0]->title)?></h3>
	<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<td><strong>Property Type</strong> : <?php echo stripslashes(get_data_by('wp_property_type','type',$results[0]->property_type_id));?></td>
			<?php 
			$getContactDetails = get_all_data_by('wp_register_users',$results[0]->added_by);
			?>
			<td><strong>Contact Details</strong> : <?php echo stripslashes($getContactDetails[0]->name." ".stripslashes($getContactDetails[0]->email)." ".$getContactDetails[0]->mobile);?></td>
		</tr>
		<tr>
			<td><strong>Description</strong> : <?php echo stripslashes($results[0]->description);?></td>
			<td><strong>Postcode</strong> : <?php echo stripslashes($results[0]->postcode);?></td>
			
		</tr>
		<tr>
			<td><strong>Address</strong> : <?php echo stripslashes($results[0]->location);?></td>
			<td><strong>Address Line 1</strong> : <?php echo stripslashes($results[0]->first_address_line);?></td>
			
		</tr>
		<tr>
			<td><strong>Address Line 2</strong> : <?php echo stripslashes($results[0]->second_address_line);?></td>
			<td><strong>Address Line 3</strong> : <?php echo stripslashes($results[0]->third_address_line);?></td>
			
		</tr>
		<tr>
			<td><strong>City</strong> : <?php echo stripslashes($results[0]->city);?></td>
			<td><strong>County</strong> : <?php echo stripslashes($results[0]->county);?></td>
		</tr>
		<tr>
			<td><strong>Available From</strong> : <?php echo stripslashes($results[0]->available_from);?></td>
			<td><strong>Available To</strong> : <?php echo stripslashes($results[0]->available_to);?></td>
		</tr>
		<tr>
			<td><strong>Near By School</strong> : <?php echo stripslashes($results[0]->near_by_school)." ".$results[0]->unitschooldist;?></td>
			<td><strong>Near By Bus Stop</strong> : <?php echo stripslashes($results[0]->near_by_busstop)." ".$results[0]->unitbusstopdist;?></td>
		</tr>
		<tr>
			<td><strong>Near By Train Station</strong> : <?php echo stripslashes($results[0]->near_by_station)." ".$results[0]->unittraindist;?></td>
			<td><strong>Near By Grocery Shop</strong> : <?php echo stripslashes($results[0]->near_by_grocery)." ".$results[0]->unitgrocerydist;?></td>
		</tr>
		<tr>
			<td><strong>No. of Bedrooms : </strong><?php echo stripslashes($results[0]->no_of_bedrooms);?></td>
			<td><strong>No. of Bathrooms : </strong><?php echo stripslashes($results[0]->no_of_bathrooms);?></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Facilities</strong> : 
				<?php 
				if($results[0]->is_washing == "t"){
					echo "Washing, ";
				}
				if($results[0]->is_dishwasher == "t"){
					echo "Dishwasher, ";
				}
				if($results[0]->is_microwave == "t"){
					echo "Microwave, ";
				}
				if($results[0]->is_parking == "t"){
					echo "Parking, ";
				}
				if($results[0]->is_centralheating == "t"){
					echo "Central Heating, ";
				}
				if($results[0]->is_cable == "t"){
					echo "Cable TV, ";
				}
				if($results[0]->is_wifi == "t"){
					echo "Wifi, ";
				}
				if($results[0]->is_garden == "t"){
					echo "Garden, ";
				}
				if($results[0]->ac == "t"){
					echo "AC, ";
				}
				if($results[0]->is_dryer == "t"){
					echo "Dryer, ";
				}
				?>
			</td>
		</tr>
		<tr>
			<td><strong>Rent : </strong><?php echo $results[0]->price;?></td>
			<td><strong>Added Date : </strong><?php echo $results[0]->added_date;?></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Featured Image : </strong>
				<?php 
				if($results[0]->featured_image != "" && file_exists("./images/property_images/".$results[0]->featured_image)){
				?>
				<img src="<?php echo SITEURL?>images/property_images/<?php echo $results[0]->featured_image;?>" width="50%" height="50%"/>
				<?php
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Other Images : </strong>
				<table>
				<?php 
				$getPropertyImages = getPropertyImages($results[0]->id);
				if(!empty($getPropertyImages)){
				?>
				
				<?php 
				foreach($getPropertyImages as $getPropertyImages){
					if($getPropertyImages->image != "" && file_exists('./images/property_images/'.$getPropertyImages->image)){
				?>
					<tr>
					<td><p><img src="<?php echo SITEURL;?>images/property_images/<?php echo $getPropertyImages->image;?>" width="500" height="300"/></p></td>
					</tr>
				<?php
					}
				}
				?>
				<?php 
				}else{
				?>
				<tr><td>No more images</td></tr>
				<?php
				}
				?>
				</table>
			</td>
		</tr>
	</table>
	</div>
<?php
}else{
	return "";
}
?>