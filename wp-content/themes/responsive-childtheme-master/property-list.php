<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
//echo "Data = ".get_the_title(); exit;
/**
 * Full Content Template
 *
Template Name:  Property List (no sidebar)
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
get_header(); 
$_SESSION['property_id'] = "";
?> 
<div class="clearfix"></div>
<script type="text/javascript">
function filterProperties(){
	$("#loader").show();
	var property_type = $('#property_type').val();
	var no_of_bedrooms = $('#no_of_bedrooms').val();
	var no_of_bedrooms1 = $('#no_of_bedrooms1').val();
	var price = $('#price').val();
	var price1 = $('#price1').val();
	var postcode = $("#ppcode").val();
	//alert(property_type+"---"+no_of_bedrooms+"---"+price+"-----"+postcode);
	if(property_type != "" || ((no_of_bedrooms != "" && no_of_bedrooms1 != "") || (price != "" && price1 != "")) && postcode != ""){
		$.ajax({
			url:'<?php echo SITEURL;?>filter-properties',
			type:'POST',
			data:{property_type:property_type,no_of_bedrooms:no_of_bedrooms,no_of_bedrooms1:no_of_bedrooms1,price:price,price1:price1,postcode:postcode},
			async:false,
			cache:false,
			success:function(html){
			//alert(html);
				$("#loader").hide();
				$('#searched_properties').html(html);
			}
		});
	}else{
		$('#searched_properties').html("Please select property type");
	}
}

function changeMaxBedroom(val){
	if(val != ""){
		var val1 = $("#no_of_bedrooms1").val();
		$.ajax({
			url:'<?php SITEURL;?>changemaxbedroom.php',
			type:'POST',
			data:{val:val,val1:val1},
			cache:false,
			async:false,
			success:function(html){
				//alert(html);
				$("#no_of_bedrooms1").html(html);
				filterProperties();
			}
		});
	}else{
		$("#no_of_bedrooms1").html("<option value=''>Max Bedroom</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option>");
		filterProperties();
	}
}

function changeMaxRent(val){
	val1 = $("#price1").val();
	if(val != ""){
		$.ajax({
			url:'<?php SITEURL;?>changemaxrent.php',
			type:'POST',
			data:{val:val,val1:val1},
			cache:false,
			async:false,
			success:function(html){
				//alert(html);
				$("#price1").html(html);
				filterProperties();
			}
		});
	}else{
		$.ajax({
			url:'<?php SITEURL;?>originalmaxrent.php',
			type:'POST',
			data:{val1:val1},
			cache:false,
			async:false,
			success:function(html){
				//alert(html);
				$("#price1").html(html);
				filterProperties();
			}
		});
	}
}

function getContactDetails(id){
	$("#contact_details_"+id).show();
	return false;
}
function hidecontactdiv(id){
	$("#contact_details_"+id).hide();
	return false;
}
</script>
<div id="content-full" class="grid col-940">
	<?php if ( have_posts() ) : ?>
		<?php while( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'loop-header', get_post_type() ); ?>
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php responsive_entry_top(); ?>
				<?php get_template_part( 'post-meta', get_post_type() ); ?>
				<div class="post-entry">
					<?php responsive_page_featured_image(); ?>
					<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
				</div>
<div id="success"></div>
<img id="loader" src="<?php echo SITEURL;?>images/giphy.gif" style="display:none;"/>
<section class="property_list_filter_header prpty_list_page_hdr">
 <div class="container">
<ul class="select_box_list clearfix">
<li>
  <?php 
		if($_POST['property_type'] != "" && $_POST['postcode'] != ""){
			$_SESSION['property_type'] = $_POST['property_type'];
			$_SESSION['postcode'] = $_POST['postcode'];
		}
		
		//echo "<pre>"; print_r($_POST); exit;
		$data = getAllPropertyType();
		if(!empty($data)){
		?>
		<div class="select_box">	
		 <select name="property_type" id="property_type" onchange="return filterProperties();">
			<option value="all" <?php if($_SESSION['property_type'] == "all"){ echo "selected";}?>>All Properties</option>
			<?php 
			foreach($data as $data){
			?>
			<option value="<?php echo $data->id;?>" <?php if($data->id == $_SESSION['property_type']){ echo "selected";}?>><?php echo $data->type;?></option>
			<?php
			}
			?>
		 </select>
		</div>		
		<?php 
		}
		?>
</li>
<li>
	<div class="select_box">	
           <select name="no_of_bedrooms" id="no_of_bedrooms" onchange="return changeMaxBedroom(this.value);">
			<option value="">Min Bedrooms</option>
			<?php 
			for($b=1;$b<=5;$b++){
			?>
			<option value="<?php echo $b;?>"><?php echo $b;?></option>
			<?php
			}
			?>
		</select>
       </div>
</li>
<li>
	<div class="select_box">	
           <select name="no_of_bedrooms1" id="no_of_bedrooms1" onchange="return filterProperties();">
			<option value="">Max Bedrooms</option>
			<?php 
			for($b=1;$b<=5;$b++){
			?>
			<option value="<?php echo $b;?>"><?php echo $b;?></option>
			<?php
			}
			?>
		</select>
       </div>
</li>
<li>
       <div class="select_box">		
		<select name="price" id="price" onchange="return changeMaxRent(this.value);;">
			<option value="">Min Rent</option>
			<?php 
			for($r=100;$r<=40000;$r++){
			?>
			<option value="<?php echo $r;?>"><?php echo $r;?></option>
			<?php
				if($r >= 100 && $r < 500){
					$r = $r+49;
				}
				if($r >= 500 && $r < 2000){
					$r = $r+99;
				}
				if($r >= 2000 && $r < 5000){
					$r = $r+499;
				}
				if($r >= 5000 && $r < 20000){
					$r = $r+999;
				}
				if($r >= 20000 && $r < 40000){
					$r = $r+4999;
				}
			}
			?>
		</select>
	</div>
</li>
<li>
       <div class="select_box">		
		<select name="price1" id="price1" onchange="return filterProperties();">
			<option value="">Max Rent</option>
			<?php 
			for($r=100;$r<=40000;$r++){
			?>
			<option value="<?php echo $r;?>"><?php echo $r;?></option>
			<?php
				if($r >= 100 && $r < 500){
					$r = $r+49;
				}
				if($r >= 500 && $r < 2000){
					$r = $r+99;
				}
				if($r >= 2000 && $r < 5000){
					$r = $r+499;
				}
				if($r >= 5000 && $r < 20000){
					$r = $r+999;
				}
				if($r >= 20000 && $r < 40000){
					$r = $r+4999;
				}
			}
			?>
		</select>
	</div>
</li>
</ul>
		<input type="hidden" name="ppcode" id="ppcode" value="<?php echo $_POST['postcode'];?>"/>
 </div>
</section>
  <section id="searched_properties" class="property_listing serch_prpty_pg">
    <div class="container">
     <div class="property_listing-wrapper clearfix">
      <div class="left-sidebar">
      
        <div class="left_sidebar_wrapper ">
        
                         
 
                    
		<?php 
			
			//echo "<pre>"; print_r($_SESSION);
			if(!empty($_SESSION['property_type']) && !empty($_SESSION['postcode'])){
				//echo "Data<pre>"; print_r($_SESSION); exit;
				$tt = "[";
				$propertyList = getSearchedProperties($_SESSION);
				//echo "<pre>"; print_r($propertyList); exit;
				if(!empty($propertyList)){
					//echo "<pre>"; print_r($propertyList); exit;
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
					<!-- Property Listing Starts-->
					
			 <div class="listing-box">
                 <div class="listing-info">
						<div class="title"> <a href="<?php echo SITEURL?>view-property-details/?slug=<?php echo $propertyList->slug;?>&title=<?php echo $propertyList->title;?>&id=<?php echo $propertyList->id;?>" target="_blank"><?php echo stripslashes($propertyList->title);?></a> </div>
						<?php 
						$crrctLoc = $propertyList->location;
						$ar = explode(",",$crrctLoc);
						//echo "Data<pre>"; print_r($ar);
						$countyloc = $ar[2];
						$ar2 = explode("-",$countyloc);
						//echo "Data<pre>"; print_r($ar2); exit;
						$showloc = $ar[0].",".$ar[1].",".$ar2[0];
						?>
						<div class="location-and-post"> <?php echo stripslashes($showloc);?>, <?php echo stripslashes($propertyList->postcode);?></div>
                        <div class="list_address_"><?php echo stripslashes($propertyList->county);?>, <?php echo stripslashes($propertyList->city);?></div>
                        
                        <div class="list_fclity_box"><?php echo stripslashes($propertyList->no_of_bedrooms);?> Bedrooms, <?php echo stripslashes($propertyList->no_of_bathrooms);?> Toilets</div>
                        <div class="col-xs-12 list_aminities_box">
                        <ul class="clearfix">
						<?php 
						if($propertyList->near_by_busstop != "" && $propertyList->unitbusstopdist != ""){
							if($propertyList->unitbusstopdist == "Kms"){
								$busdistdesk = "Kms";
							}else{
								$busdistdesk = "Miles";
							}
							$bus = $propertyList->near_by_busstop." ".$busdistdesk;
						}else{
							$bus = "N/A";
						}
						?>
                        <li><i class="fa fa-bus"></i><?php echo $bus;?> </li>
						<?php 
						if($propertyList->near_by_station != "" && $propertyList->unittraindist != ""){
							if($propertyList->unittraindist == "Kms"){
								$traindistdesk = "Kms";
							}else{
								$traindistdesk = "Miles";
							}
							$train = $propertyList->near_by_station." ".$traindistdesk;
						}else{
							$train = "N/A";
						}
						?>
                        <li><i class="fa fa-train"></i> <?php echo $train;?></li>
						<?php 
						if($propertyList->near_by_grocery != "" && $propertyList->unitgrocerydist != ""){
							if($propertyList->unitgrocerydist == "Kms"){
								$grocerydistdesk = "Kms";
							}else{
								$grocerydistdesk = "Miles";
							}
							$hospital = $propertyList->near_by_grocery." ".$grocerydistdesk;
						}else{
							$hospital = "N/A";
						}
						?>
                        <li><i class="fa fa-shopping-cart"></i> <?php echo $hospital;?></li>
                        </ul>
                        </div>
                        <div class="col-xs-12 bottom_price_cntnr">
                        
                        <div class="col-xs-12 list_price_box">
                        <?php echo "&#xa3; ".stripslashes($propertyList->price);?>
                        </div>
                        
                        <div class="col-xs-12 contact_btn_box">
                        	<?php 
							if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
							?>
							<a href="<?php echo SITEURL?>view-property-details/?slug=<?php echo $propertyList->slug;?>&title=<?php echo $propertyList->title;?>&id=<?php echo $propertyList->id;?>" target="_blank" class="contact_listing_btn">Contact</a> 
                            <?php 
							}else{
							?>
							<a href="#" onclick="return getContactDetails('<?php echo $propertyList->id;?>');" class="contact_listing_btn">Contact</a>
							<?php
							}
							?>
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
					</div>
					<?php 
						if($propertyList->featured_image != "" && file_exists("./images/property_images/".$propertyList->featured_image)){
						?>
						<div class="col-xs-12 img-box" style="background-image:url('<?php echo SITEURL?>images/property_images/<?php echo $propertyList->featured_image;?>');"></div>
					<?php
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
						$_SESSION['tt'] = $tt;
				  }else{
				  ?>
					<p>No property available please try some other post code.</p>
				  <?php
				  }
				}else{
					$location = SITEURL . "/";
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

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>

		<script type="text/javascript">

//alert('Welcome')		

<!-- Code For Locations on Map-->

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

			//alert('Dudey');

var mapOptions = {

				center: new google.maps.LatLng(<?php echo $firstLat?>, <?php echo $firstLong?>),   // Coimbatore = (11.0168445, 76.9558321)

				zoom: 15,

				mapTypeId: google.maps.MapTypeId.ROADMAP

			};

			

			map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

			//alert(map);

			//alert("in ABCD");

			var data = '<?php echo $_SESSION['tt'];?>';

			//alert("Data "+data);

			//var data = '[{ "DisplayText": "adcv", "ADDRESS": "Jamiya Nagar Kovaipudur Coimbatore-641042", "LatitudeLongitude": "26.8554273,75.8047189", "MarkerId": "Customer" },{ "DisplayText": "abcd", "ADDRESS": "Coimbatore-641042", "LatitudeLongitude": "26.8616495,75.7904612", "MarkerId": "Customer"}]';

			//alert(data1);

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
							html: people["DisplayText"]
							//icon: "images/marker/" + people["MarkerId"] + ".png"
							//icon: "<?php echo SITEURL;?>images/mapicon.png"
						});
						//marker.setPosition(latlng);
						//map.setCenter(latlng);
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
			}
			else {
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
				//marker.setPosition(latlng);
				//map.setCenter(latlng);
				google.maps.event.addListener(marker, 'click', function(event) {
					infowindow.setContent(this.html);
					infowindow.setPosition(event.latLng);
					infowindow.open(map, this);
				});
			}
		}
		<!--  End of code for Map  -->
		</script>
		<?php 
		}
		?>
		<div id="map-canvas" style="width: 100%; height: 650px;"></div>
      </div>
     </div>
    </div>
   </div>
  </section>
		<!-- end of .post-entry -->

		<?php get_template_part( 'post-data', get_post_type() ); ?>

		<?php responsive_entry_bottom(); ?>

	</div>

	<!-- end of #post-<?php the_ID(); ?> -->

	<?php responsive_entry_after(); ?>

	<?php responsive_comments_before(); ?>

	<?php comments_template( '', true ); ?>

	<?php responsive_comments_after(); ?>

	<?php

	endwhile; 

	?>	

	<?php

	get_template_part( 'loop-nav', get_post_type() );

	else:

	get_template_part( 'loop-no-posts', get_post_type() );

	endif;

	?>

	</div><!-- end of #content-full -->

  </div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/core/js/jquery.custom-scrollbar.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/core/css/jquery.custom-scrollbar.css"/>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".demo").customScrollbar();
		jQuery('.cross_icon').click(function()
		{
			$(this).closest('.contact_details').fadeOut();	
		});
       
    });
</script>
<?php get_footer(); ?>