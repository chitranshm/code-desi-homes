
<?php


$table_name =  'wp_property_type';
$results = $wpdb->get_results( "SELECT * FROM $table_name");

print_r($results);

?>


<form method="post" action="save_property.php" id="property_form" name="property_form" enctype="multipart/form-data">
	<p>
	<div>
	<label>Property Type</label>
	
	<select name="property_type" id="property_type">
		<option value="">Select Property Type</option>
		
		<option value="">xxxxx</option>
		<option value="">xxxxx</option>
		
	</select>
	</div>
	</p>
	<p>
	<div>
		<label>Title</label>
		<input id="title" name="title" type="text"> 
	</div>
	</p>
	<p>
	<div>
		<label>Description</label>
		<textarea name="description" id="description"></textarea>   
	</div>
	</p>
	<p>
	<div>
		<label>Location</label>
		<input id="location" name="location" type="text">  
	</div>
	</p>
	<p>
	<div>
		<label>Postcode</label>
		<input id="postcode" name="postcode" type="text">
	</div>
	</p>
	<p>
	<div>
		<label>City</label>
		<input id="city" name="city" type="text">
	</div>
	</p>
	<p>
	<div>
		<label>Country</label>
		<input id="country" name="country" type="text">
	</div>
	</p>
	<p>
	<div>
		<label>Map</label>
		<textarea name="map" id="map"></textarea> 
	</div>
	</p>
	<p>
	<div>
		<label>Contact Details</label>
		<textarea name="contact_details" id="contact_details"></textarea> 
	</div>
	</p>
	<p>
	<div>
		<label>Number of Bedrooms</label>
		<input id="no_of_bedrooms" name="no_of_bedrooms" type="text">
	</div>
	</p>
	<p>
	<div>
		<label>Number of Bathrooms</label>
		<input id="no_of_bathrooms" name="no_of_bathrooms" type="text">
	</div>
	</p>
	<p>
	<div>
		<label>Price</label>
		<input id="price" name="price" type="text">
	</div>
	</p>
	<p>
	<div id="p_scents">
		<div>
			<label>Image</label>
			<input name="image[]" type="file">
			<a href="#" id="addScnt">Add More</a>
		</div>
	</div>
	</p>
	<p>
	<div>
		<label>Facilities</label>
		<div>
		<input id="" name="is_garden" type="checkbox" value="t">Garden<br/>
		<input id="" name="is_parking" type="checkbox" value="t">Parking<br/>
		<input id="" name="is_centralheating" type="checkbox" value="t">Central Heating<br/>
		<input id="" name="is_ac" type="checkbox" value="t">AC<br/>
		<input id="" name="is_wifi" type="checkbox" value="t">Wi-Fi<br/>
		<input id="" name="is_cable" type="checkbox" value="t">Cable Television<br/>
		<input id="" name="is_washing" type="checkbox" value="t">Washing Machine<br/>
		<input id="" name="is_dryer" type="checkbox" value="t">Dryer<br/>
		<input id="" name="is_dishwasher" type="checkbox" value="t">Dishwasher<br/>
		<input id="" name="is_microwave" type="checkbox" value="t">Microwave<br/>
		</div>
	</div>
	</p>
	<p>
	<div>
		<label>&nbsp;</label>
		<input id="submit" name="submit" type="submit" value="Save">
	</div>
	</p>
	</form>