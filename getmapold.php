<html>
<body onLoad="initialize()">
<?php 
require_once('wp-config.php');
global $wpdb;
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$property_id = $_GET['propertyid'];
if(isset($_POST['submit']) && $_POST['submit'] != ""){
	$latitude_new = $_POST['latitude_new'];
	$longitude_new = $_POST['longitude_new'];
	$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET latitude = %s, longitude = %s WHERE id = %d ",$latitude_new,$longitude_new,$property_id));
	$_SESSION['info'] = "Location updated successfully";
	$location1 = get_site_url() . "/edit-property/?id=".$property_id."&type=address";
	wp_redirect( $location1, 301 );
	exit;
}
?>
  <div id="latlong">
    <form method="post" name="setLatLongForm" id="setLatLongForm">
	<p>Latitude: <input size="20" type="text" id="latbox" name="latitude_new" value="<?php echo $latitude;?>"></p>
    <p>Longitude: <input size="20" type="text" id="lngbox" name="longitude_new" value="<?php echo $longitude;?>"></p>
	<p><input type="submit" name="submit" id="submit" value="Update Location"/></p>
	</form>
  </div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7IZt-36CgqSGDFK8pChUdQXFyKIhpMBY&sensor=true" type="text/javascript"></script>
<script type="text/javascript">
  var map;
  function initialize() {
	var myLatlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
  	var myOptions = {
     zoom: 8,
     center: myLatlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
     }
 	 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 

	  var marker = new google.maps.Marker({
		draggable: true,
		position: myLatlng, 
		map: map,
		title: "Your location"
	  });

	google.maps.event.addListener(marker, 'dragend', function (event) {
		document.getElementById("latbox").value = this.getPosition().lat();
		document.getElementById("lngbox").value = this.getPosition().lng();
	});
}
</script> 
 <div id="map_canvas" style="width:50%; height:50%"></div>
</body>
</html>