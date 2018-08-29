<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$_SESSION['property_type'] = "";
$_SESSION['postcode'] = "";
$_SESSION['property_id'] = "";
$responsive_options = responsive_get_options();
//test for first install no database
$db = get_option( 'responsive_theme_options' );
//test if all options are empty so we can display default text if they are
$empty = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;
$emtpy_cta = ( empty( $responsive_options['cta_text'] ) ) ? false : true;
?>
<?php
	$responsive_options = responsive_get_options();
	$display_slider = (! empty ($responsive_options['enable_slider']))?$responsive_options['enable_slider']:0;
	if ($display_slider == 1) {
		$slider_content = $responsive_options['home_slider'];
	?>
<?php
}
?>
<script type="text/javascript">
function validPostCode(){
	var postcode = $("#postcode").val();
	if(postcode != ""){
		$.ajax({
			url:'checkpostcode.php',
			type:"POST",
			data:{postcode:postcode},
			cache:false,
			async:false,
			success:function(html){
			//alert("fdsa "+html);
				html = html.trim();
				if(html != ""){
					$("#search").removeAttr('disabled');
					$("#wrong_postcode").html("");
				}else{
					$("#search").attr('disabled','disabled');
					$("#wrong_postcode").css('color','red');
					$("#wrong_postcode").html("Please enter correct or complete postcode");
				}
			}
		});
	}else{
		return "";
	}
}
</script>
</div>
<div class="header-container">
  <div class="slider"><img src="<?php echo SITEURL;?>wp-content/uploads/2018/04/Home-Banner.png"></div>
  <div class="search-feature clearfix">
    <form action="<?php echo SITEURL?>property-list" method="post" id="property_search">
      <ul class="field-list clearfix">
      <li class="looking_for_txt"> <span class="map-icon"><i class="fa fa-map-marker"></i></span> I am looking for </li>
      <li class="property_type_">
        <?php 
	$data = getAllPropertyType();
	//echo "<pre>"; print_r($data); exit;
	if(!empty($data)){
	?>
        <select name="property_type" id="property_type" class="form-control">
          <option value="">Rental Type</option>
          <option value="all">All Properties</option>
		  <?php 
		foreach($data as $data){
		?>
          <option value="<?php echo $data->id;?>"><?php echo $data->type;?></option>
          <?php
		}
		?>
        </select>
        <?php 
	}
	?>
      </li>
      <li class="location_submit_box">
        <!--<select class="form-control "><option>Location</option></select>-->
        <!--<input type="text" name="postcode" class="location_input" id="postcode" placeholder = "Post code" onfocusout="return validPostCode();" maxlength="10"/>-->
		<input type="text" name="postcode" class="location_input" id="postcode" placeholder = "Postcode/Town" onfocusout="" maxlength="15"/>
        <button type="submit" id="search" name="submit" class="submit" value=""/>
        <i class="fa fa-search"></i>
        </button>
        <div id="wrong_postcode"></div>
        <!--<input type="submit" id="search" name="submit" class="submit" value="Search"/>-->
        <!--
        <input type="text" name="postcode" id="postcode" placeholder = "Location" onfocusout="return validPostCode();" maxlength="9"/>
		-->
      </li>
      <!--
	<li>
		<input type="submit" id="search" name="submit" class="submit" value="Search"/>
	</li>-->
      <!--<button type="submit" id="submit" name="search" onclick="return searchProperties();" style="display:none;">Search</button>-->
    </form>
    <div class="how_it_works_link"><a href="<?php echo SITEURL;?>how-it-works" class="how_it_works_btn">How it Works?</a></div>
  </div>
</div>
<section class="popular_cities_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> <span class="heading_as_btn_new heading_button">popular cities</span> </div>
    </div>
    <div class="w3-row">
      <div class="owl-carousel owl-theme show_on_mobile populr_cities">
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Liverpool.jpg" alt="Liverpool" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Liverpool</span> <span class="p-c_right text-right"><i class="fa fa-home"></i>Coming Soon...</span> </div>
          </div>
        </div>
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/London.jpg" alt="London" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">London</span> <span class="p-c_right text-right "><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </div>
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Manchester.jpg" alt="Manchester" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Manchester</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </div>
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/birmingham.jpg" alt="birmingham" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Birmingham</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </div>
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Leeds.jpg" alt="Leeds" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Leeds</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </div>
        <div class="item">
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Nottingham.jpg" alt="Nottingham" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Nottingham</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </div>
      </div>
      <ul class="popular_cities_list hide_on_mobile">
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Liverpool.jpg" alt="Liverpool" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Liverpool</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/London.jpg" alt="London" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">London</span> <span class="p-c_right text-right "><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Manchester.jpg" alt="Manchester" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Manchester</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/birmingham.jpg" alt="birmingham" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Birmingham</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Leeds.jpg" alt="Leeds" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Leeds</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
        <li>
          <div class="inner_box_popular_cities">
            <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/Nottingham.jpg" alt="Nottingham" class="img-responsive" /> </div>
            <div class="p-c_bottom row"> <span class="p-c_left text-left city_name">Nottingham</span> <span class="p-c_right text-right"><i class="fa fa-home"></i> Coming Soon...</span> </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<!--<section class="what_makes_us_the_preferred_choice">
  <div class="container">
    <div class="heading">
      <h3>What Makes us the Preferred Choice</h3>
    </div>
    <div class="row">
      <div class="owl-carousel owl-theme show_on_mobile choice_slider">
        <div class="item">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/maximum-choice.png" alt="maximum-choice"></div>
            <h4>Maximum Choice</h4>
            <p>15 Lac + & counting. New properties every<br>
              hour to help buyers find the right home</p>
          </div>
        </div>
        <div class="item">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/trust-icon.png" alt="trust-icon"></div>
            <h4>Buyers Trust Us</h4>
            <p>12 million users visit us every month for their buying and renting needs</p>
          </div>
        </div>
        <div class="item">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/like-icon.png" alt="like-icon"></div>
            <h4>Seller Prefer Us</h4>
            <p>27,000 new properties posted daily, making us the biggest platform to sell & rent properties</p>
          </div>
        </div>
        <div class="item">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/expert-icon.png" alt="expert-icon"></div>
            <h4>Expert Guidance</h4>
            <p>Advice from the largest panel of industry<br>
              experts to help you make smart<br>
              property decisions</p>
          </div>
        </div>
      </div>
      <div class="hide_on_mobile clearfix">
        <div class="col-md-3">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/maximum-choice.png" alt="maximum-choice"></div>
            <h4>Maximum Choice</h4>
            <p>15 Lac + & counting. New properties every<br>
              hour to help buyers find the right home</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/trust-icon.png" alt="trust-icon"></div>
            <h4>Buyers Trust Us</h4>
            <p>12 million users visit us every month for their buying and renting needs</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/like-icon.png" alt="like-icon"></div>
            <h4>Seller Prefer Us</h4>
            <p>27,000 new properties posted daily, making us the biggest platform to sell & rent properties</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="preferred_choice_box text-center">
            <div class="icon-box"><img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/expert-icon.png" alt="expert-icon"></div>
            <h4>Expert Guidance</h4>
            <p>Advice from the largest panel of industry<br>
              experts to help you make smart<br>
              property decisions</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>-->
<section class="property_added_this_month hide_on_mobile">
  <div class="container"> <span class="heading_as_btn_new heading_button">Property Added this Month</span>
<?php 
$getLatestProperties = getLatestProperties();
if(!empty($getLatestProperties)){
	//echo "<pre>"; print_r($getLatestProperties); exit;
	$no_of_latest_properties = count($getLatestProperties)
	
?>
    <div class="w3-row main-row w3-padding">
      <div class="w3-col l5">
        <div class=""><img src="<?php echo SITEURL;?>images/property_images/<?php echo $getLatestProperties[0]->featured_image;?>" alt="<?php echo $getLatestProperties[0]->title;?>" style="height:300px !important; border-radius: 10px;"></div>
        <h3><?php echo $getLatestProperties[0]->title;?></h3>
        <p><?php echo $getLatestProperties[0]->description;?></p>
        <a href="view-property-details/?slug=<?php echo $getLatestProperties[0]->slug;?>&title=<?php echo $getLatestProperties[0]->title;?>&id=<?php echo $getLatestProperties[0]->wpid;?>" target="_blank" class="view-property-btn">View Property <i class="fa fa-arrow-right"></i></a> </div>
      <?php 
	if($no_of_latest_properties > 1){
	
	?>
      <div class="w3-col l7 p-0">
        <div class="w3-row">
		<div class="" id="latest-property-w">
      <?php 
	  $i=0;
	  foreach($getLatestProperties as $getLatestProperties){
	  if($i != 0){
	  ?>
	  <div class="item">
          <div class="w3-col m6">
            <div class="img-box"><img src="<?php echo SITEURL;?>images/property_images/<?php echo $getLatestProperties->featured_image;?>" alt="<?php echo $getLatestProperties->title;?>"></div>
            <h3><?php echo $getLatestProperties->title;?></h3>
            <a href="view-property-details/?slug=<?php echo $getLatestProperties->slug;?>&title=<?php echo $getLatestProperties->title;?>&id=<?php echo $getLatestProperties->wpid;?>" target="_blank" class="view-property-btn">View Property <i class="fa fa-arrow-right"></i></a> </div></div>
      <?php
	  }
	  	++$i;
	  }
	  ?>
        </div>
      </div>
      <?php 

	}
	?>
    </div>
    <?php 
}else{
?>
    <p>No property added this month.</p>
    <?php
}
?>
  </div>
</section>

<!-- for mObile Section -->
<section class="property_added_this_month show_on_mobile">
  <div class="container"> <span class="heading_as_btn_new heading_button">Property Added this Month</span>
<?php 
$getLatestProperties = getLatestProperties();
if(!empty($getLatestProperties)){
	//echo "<pre>"; print_r($getLatestProperties); exit;
	$no_of_latest_properties = count($getLatestProperties)
?>
    <div class="w3-row main-row w3-padding">
           
      <div class="w3-col l12 p-0">
        <div class="w3-row">
		<div class="owl-carousel owl-theme" id="latest-property-slider">
      <?php 
	  $i=0;
	  foreach($getLatestProperties as $getLatestProperties){
	  
	  ?>
	  <div class="item">
          <div class="w3-col m12">
            <div class="img-box"><img src="<?php echo SITEURL;?>images/property_images/<?php echo $getLatestProperties->featured_image;?>" alt="<?php echo $getLatestProperties->title;?>"></div>

            <h3><?php echo $getLatestProperties->title;?></h3>
            <a href="view-property-details/?slug=<?php echo $getLatestProperties->slug;?>&title=<?php echo $getLatestProperties->title;?>&id=<?php echo $getLatestProperties->wpid;?>" target="_blank" class="view-property-btn">View Property <i class="fa fa-arrow-right"></i></a> </div></div>
      <?php
	  
	  	++$i;
	  }
	  ?>
	  </div>
        </div>
      </div>
      <?php 

	
	?>
    </div>
    <?php 
}else{
?>
    <p>No property added this month.</p>
    <?php
}
?>
  </div>
</section>


<!-- End Mobile Section -->


<section class="our_happy_family">
  <div class="container">
  <div class="heading" style="margin-bottom: 17px;"> <span class="heading_as_btn_new heading_button">Our Happy Customers</span> </div>
    <div class="main-wrapper">
      <!--<div class="heading"> <span class="heading_as_btn heading_button">Our Happy Customers</span> </div>-->
      
      <div class="w3-row">
        <div class="owl-carousel owl-theme show_on_mobile happy_fmly_slider">
          <div class="item">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/rajesh.png" alt="Rajesh Testimonial"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Rajesh Satwah <small>Land Lord</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I am a business owner. I own two properties. One I regularly rent out & another one I live in has one spare double bedroom, which I occasionally rent out for short term. I am a busy person so need a quick & reliable platform for renting. Desihomes helps me to make quick decision as I vet potential tenant myself. Thanks to Desihomes for providing me cost effective & no-frills solution.</p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/manoj.png" alt="Manoj Testimonial"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Manoj Dhirde <small>Tenant</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I was travelling UK for short assignment & needed a double bedroom for 3 months. I approached house owner via desihomes who was happy to let for short term.  Process was smooth & I negotiated all-inclusive rent with house owner directly </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/neha.png" alt="Neha Chauhan"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Neha Chauhan <small>Student</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I needed single room near the college & only for college terms. I got connected to land lady via Desihomes who was happy to accommodate me in her house. She took me as paying guest. Have to say I thoroughly enjoyed my stay. Thanks to desihomes for connecting me with such a beautiful family. </p>
              </div>
            </div>
          </div>
        </div>
        <div class="hide_on_mobile clearfix">
          <div class="w3-col l4">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/rajesh.png" alt="Rajesh Testimonial"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Rajesh Satwah <small>Land Lord</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I am a business owner. I own two properties. One I regularly rent out & another one I live in has one spare double bedroom, which I occasionally rent out for short term. I am a busy person so need a quick & reliable platform for renting. Desihomes helps me to make quick decision as I vet potential tenant myself.</p>
              </div>
            </div>
          </div>
          <div class="w3-col l4">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/manoj.png" alt="Manoj tesimonial"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Manoj Dhirde <small>Tenant</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I was travelling UK for short assignment & needed a double bedroom for 3 months. I approached house owner via desihomes who was happy to let for short term.  Process was smooth & I negotiated all-inclusive rent with house owner directly. Thanks desihome for solving my biggest concern while I was abroad. </p>
              </div>
            </div>
          </div>
          <div class="w3-col l4">
            <div class="our_happy_family_box">
              <div class="top_box">
                <div class="cell-box">
                  <div class="img-box"> <img src="<?php echo SITEURL;?>/wp-content/uploads/2018/05/neha.png" alt="Neha Chauhan Testimonial"> </div>
                </div>
                <div class="top-info cell-box">
                  <h3>Neha Chauhan <small>Student</small></h3>
                </div>
              </div>
              <div class="info">
                <p>I needed single room near the college & only for college terms. I got connected to land lady via Desihomes who was happy to accommodate me in her house. She took me as paying guest. Have to say I thoroughly enjoyed my stay. Thanks to desihomes for connecting me with such a beautiful family.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
