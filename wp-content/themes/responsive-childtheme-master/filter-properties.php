<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
//echo "Data = ".get_the_title(); exit;
/**
 * Full Content Template
 *
Template Name:  Filter Properties (no sidebar)
 *
 * @file           full-width-page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
 //get_header();
?>
   <div class="container">
     <div class="property_listing-wrapper">
      <div class="left-sidebar">
        <div class="left_sidebar_wrapper">
<?php 
	if(!empty($_POST['property_type']) && !empty($_POST['postcode'])){
		$tt = "[";
		$propertyList = getSearchedProperties($_POST);
		if(!empty($propertyList)){
			$i = 0;
			$numm = count($propertyList);
			?>
			<div class="top_title_box clearfix">   
                    <span class="found_title"><?php echo $numm;?> Listings Found</span>    
                    <span class="right_ad_ heading_as_btn_new">Recently Added</span>
                </div>    
                <div class="listing_outer___  demo default-skin" >
			<?php
			$firstLat = "";
			$firstLong = "";
			foreach($propertyList as $propertyList){
			?>
			 <div class="listing-box">
                 <div class="listing-info">
						<div class="title"><?php echo stripslashes($propertyList->title);?>  </div>
						<div class="location-and-post"> <?php echo stripslashes($propertyList->location);?>, <?php echo stripslashes($propertyList->postcode);?></div>
                        <div class="list_address_"><?php echo stripslashes($propertyList->county);?>, <?php echo stripslashes($propertyList->city);?></div>
                        
                        <div class="list_fclity_box"><?php echo stripslashes($propertyList->no_of_bedrooms);?> Bedrooms, <?php echo stripslashes($propertyList->no_of_bathrooms);?> Toilet</div>
                        <div class="list_aminities_box">
                        <ul class="clearfix">
                        <li><i class="fa fa-bus"></i>
							<?php 
							if($propertyList->unitbusstopdist == "Kms"){
								$busdistdesk = "Kms";
							}else{
								$busdistdesk = "Miles";
							}
							?>
							<?php echo stripslashes($propertyList->near_by_busstop);?> <?php echo stripslashes($busdistdesk);?> </li>
                        <li><i class="fa fa-train"></i>
							<?php 
							if($propertyList->unittraindist == "Kms"){
								$traindistdesk = "Kms";
							}else{
								$traindistdesk = "Miles";
							}
							?>
							<?php echo stripslashes($propertyList->near_by_station);?> <?php echo stripslashes($traindistdesk);?> </li>
                        <li><i class="fa fa-shopping-cart"></i> 
							<?php 
							if($propertyList->unitgrocerydist == "Kms"){
								$grocerydistdesk = "Kms";
							}else{
								$grocerydistdesk = "Miles";
							}
							?>
							<?php echo stripslashes($propertyList->near_by_grocery);?> <?php echo stripslashes($grocerydistdesk);?> </li>
                        </ul>
                        </div>
                        <div class="col-xs-12 bottom_price_cntnr">
                        
                        <div class="col-xs-12 list_price_box">
                        <?php echo "&#xa3; ".stripslashes($propertyList->price);?>
                        </div>
                        
                        <div class="col-xs-12 contact_btn_box">
                        	<a href="#" onclick="return getContactDetails('<?php echo $propertyList->id;?>');" class="contact_listing_btn">Contact</a> 
                            <img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/user-check.png">
							<?php 
							if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
								$getContactDetails = get_all_data_by("wp_register_users",$propertyList->added_by);
							?>
							<div id="contact_details_<?php echo $propertyList->id;?>" class="contact_details" style="display:none;"><?php echo $getContactDetails[0]->name;?> <?php echo "".$getContactDetails[0]->email;?> <?php if($getContactDetails[0]->mobile != ""){ echo "".$getContactDetails[0]->mobile;}?>
                            <span class="cross_icon"><a href="#" onclick="return hidecontactdiv('<?php echo $propertyList->id;?>')">X</a></span>
                            </div>
							<?php
							}else{
							?>
							<div id="contact_details_<?php echo $propertyList->id;?>" style="display:none;" class="contact_details">Please <a href="<?php echo SITEURL;?>login">Login</a> to contact
							<span class="cross_icon"><a href="#" onclick="return hidecontactdiv('<?php echo $propertyList->id;?>')">X</a></span>
							</div>
							<?php
							}
							?>
                        </div>
                        
                         <a href="<?php echo SITEURL?>view-property-details/?slug=<?php echo $propertyList->slug;?>&title=<?php echo $propertyList->title;?>&id=<?php echo $propertyList->id;?>" class="read_more_btn_prpty" target="_blank">More Details</a>
                        
                        </div>
                        
						<!-- <p>Price : <?php echo $propertyList->price;?></p> -->
						<?php 
						if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
							$getContactDetails = get_all_data_by("wp_register_users",$propertyList->added_by);
						?>
						<!-- <p>Contact Details : <?php echo $getContactDetails[0]->name;?> 
										  <?php echo ",".$getContactDetails[0]->email;?>
										  <?php if($getContactDetails[0]->mobile != ""){ echo ",".$getContactDetails[0]->mobile;}?></p> -->
						<?php
						}else{
						?>
						<!-- <p>Please Login to know contact details : <a href="<?php echo SITEURL;?>login">Login</a></p> -->
						<?php
						}
						?>
						<?php 
						$added_date = strtotime($propertyList->added_date);
						?>
						<!-- <p>Added Date : <?php echo date("d-m-Y",$added_date);?></p> -->
						<?php 
						//if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
						?>
						<!-- <a href="view-property-details/?slug=<?php echo $propertyList->slug;?>&title=<?php echo $propertyList->title;?>&id=<?php echo $propertyList->id;?>" target="_blank">View More</a> -->
						<!--<a href="view-property-details/<?php echo $propertyList->slug;?>">View More</a>-->
						<?php 
						//}
						?>
					</div>
					<?php 
					$getSingleImagesOfProperty = getSingleImagesOfProperty($propertyList->id);
					if(!empty($getSingleImagesOfProperty)){
						//echo "<pre>"; print_r($getSingleImagesOfProperty); exit;
						if($getSingleImagesOfProperty[0]->image != "" && file_exists("./images/property_images/".$getSingleImagesOfProperty[0]->image)){
						?>
				<div class="col-xs-12 img-box" style="background-image:url('<?php echo SITEURL?>images/property_images/<?php echo $getSingleImagesOfProperty[0]->image;?>');"></div>
					<!-- <img src="<?php echo SITEURL?>images/property_images/<?php echo $getSingleImagesOfProperty[0]->image;?>" alt="<?php echo stripslashes($propertyList->title);?>" title="<?php echo stripslashes($propertyList->title);?>"/> -->
					<?php
						}
					}
					?>
                   </div>
			<?php 
			$tt .= '{';
			$tt .= '"DisplayText":"'.$propertyList->title.'",';
			$tt .= '"ADDRESS":"'.$propertyList->location.'",';
			$tt .= '"LatitudeLongitude":"'.$propertyList->latitude.','.$propertyList->longitude.'",';
			$tt .= '"MarkerId":"Customer"';
			$tt .= '}';
			if($i<($numm-1)){
				$tt .= ",";
			}
			if($i==0){
				$firstLat = $propertyList->latitude;
				$firstLong = $propertyList->longitude;
			}
			?>
			<!-- Property Listing Ends-->
			<?php
				++$i;
				}
				$tt .= "]";
				//echo $numm."<br/>";
				//echo $tt; exit;
				//echo $tt; exit;
		  }else{
		  ?>
			<p>No property available please try some other post code.</p>
		  <?php
		  }
		}else{
			$location = get_site_url() . "/";
			wp_redirect( $location, 301 );
			exit;  
		}
		?>
		
		</div>
      </div>
	  </div>
	  <!--  left sidebar end here  -->
	  <div class="content-wrapper">
     	<div class="map-section">	
			<?php 
			if(!empty($propertyList)){
			?>
			<script type="text/javascript">
				var map;
				var geocoder;
				var marker;
				var people = new Array();
				var latlng;
				var infowindow;
				$(document).ready(function(){
					abc();
				});
				function abc(){
					var mapOptions = {
						center: new google.maps.LatLng(<?php echo $firstLat;?>, <?php echo $firstLong;?>),   // Coimbatore = (11.0168445, 76.9558321)
						zoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					//alert(mapOptions);
					map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
					var data = '<?php echo $tt;?>';
					//alert(data);
					people = JSON.parse(data); 
					for (var i = 0; i < people.length; i++) {
						setMarker(people[i]);
					}
				}
				function setMarker(people) {
					geocoder = new google.maps.Geocoder();
					infowindow = new google.maps.InfoWindow();
					if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
						geocoder.geocode({ 'address': people["Address"] }, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
								marker = new google.maps.Marker({
									position: latlng,
									map: map,
									draggable: false,
									html: people["DisplayText"],
									icon: "images/marker/" + people["MarkerId"] + ".png"
								});
								google.maps.event.addListener(marker, 'click', function(event) {
									infowindow.setContent(this.html);
									infowindow.setPosition(event.latLng);
									infowindow.open(map, this);
								});
							}
							else {
								alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
							}
						});
					}else {
						var latlngStr = people["LatitudeLongitude"].split(",");
						var lat = parseFloat(latlngStr[0]);
						var lng = parseFloat(latlngStr[1]);
						latlng = new google.maps.LatLng(lat, lng);
						marker = new google.maps.Marker({
							position: latlng,
							map: map,
							draggable: false,               // cant drag it
							html: people["DisplayText"],    // Content display on marker click
							//icon: "images/marker.png"       // Give ur own image
							icon: "<?php echo SITEURL;?>images/mapicon.png"
						});
						google.maps.event.addListener(marker, 'click', function(event) {
							infowindow.setContent(this.html);
							infowindow.setPosition(event.latLng);
							infowindow.open(map, this);
						});
					}
				}
				</script>
			
			<?php 
			}
			?>	
			<div id="map-canvas" style="width: 800px; height: 500px;"></div>
			</div>
		 </div>
		</div>
	   </div>
       <script src="<?php echo get_stylesheet_directory_uri(); ?>/core/js/jquery.custom-scrollbar.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/core/css/jquery.custom-scrollbar.css"/>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".demo").customScrollbar();
       
    });
</script>
<style>
 .read_more_btn_prpty
 {
	display: inline-block;
    font-size: 12px;
    margin-left: 5px;
    font-weight: 700;
    color: #118808;
 }
  </style>