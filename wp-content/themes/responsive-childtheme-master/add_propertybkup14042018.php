<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Add Property Page (no sidebar)
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
//echo "<pre>"; print_r($_SESSION); exit;
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
	$page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
	exit;
}
$user_id = $_SESSION['user_id'];
//$getUserDetailsByID = getUserDetailsByID($user_id);
//echo "<pre>"; print_r($getUserDetailsByID); exit;
?>
<link rel="stylesheet" href="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/css/tabstyle.css">
 <script src="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/js/jquery.organictabs.js"></script>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">
		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo SITEURL?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
				<li class=""><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<li class=""><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-building"></i>Add Property</a></li>
				<li class=""><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Property</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Add Property</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<?php 
		if(isset($_POST['submit'])){
			//echo "<pre>"; print_r($_POST); exit;
			$addProperty = saveProperty($_POST);
			if($addProperty == "saved"){
				$_SESSION['info'] = "Property added successfully";
			}else{
				$_SESSION['info'] = "Property not added";
			}
		}
		?>
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="row">
                  <!--/.col-->
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <strong>Add</strong> Property
                      </div>
					  <?php 
					  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
					  ?>
					  <span><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>
					  <?php
					  }
					  ?>
					  <form action="" method="post" class="form-horizontal" id="profile_form" enctype="multipart/form-data">
					  <!--<form action="" method="post" class="form-horizontal" id="profile_form">-->
                      <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="name" class=" form-control-label">Property Type</label></div>
                            <div class="col-12 col-md-9">
								<?php 
								$getAllPropertyType = getAllPropertyType();
								//echo "<pre>"; print_r($getAllPropertyType); exit;
								if(!empty($getAllPropertyType)){
								?>
								<select name="property_type" id="property_type" class="form-control" required>
									<option value="">Select Property Type</option>
									<?php 
									foreach($getAllPropertyType as $getAllPropertyType){
									?>
									<option value="<?php echo $getAllPropertyType->id?>"><?php echo stripslashes($getAllPropertyType->type);?></option>
									<?php 
									}
									?>
								</select>
								<?php
								}
								?>
							</div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="name" class=" form-control-label">Title</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Enter Title..." class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="description" class=" form-control-label">Description</label></div>
                            <div class="col-12 col-md-9">
							<textarea id="description" name="description" placeholder="Enter Description..." class="form-control" required></textarea>
							</div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="location" class=" form-control-label">Location</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="location" name="location" placeholder="Enter Location..." class="form-control" required/></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="postcode" class=" form-control-label">Postcode</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="postcode" name="postcode" placeholder="Enter Postcode..." class="form-control" maxlength="8" required></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="city" class=" form-control-label">City</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="city" name="city" placeholder="Enter City..." class="form-control" required/></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="country" class=" form-control-label">Country</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="country" name="country" placeholder="Enter Country..." class="form-control" required/></div>
                          </div>
						  <!--<div class="row form-group">
                            <div class="col col-md-3"><label for="map" class=" form-control-label">Map</label></div>
                            <div class="col-12 col-md-9"><textarea id="map" name="map" placeholder="Enter Map..." class="form-control" required></textarea></div>
                          </div>-->
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="contact_details" class=" form-control-label">Contact Details</label></div>
                            <div class="col-12 col-md-9"><textarea id="contact_details" name="contact_details" placeholder="Enter Contact Details..." class="form-control" required></textarea></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="no_of_bedrooms" class=" form-control-label">Number of Bedrooms</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="no_of_bedrooms" name="no_of_bedrooms" placeholder="Enter Number of Bedrooms..." class="form-control" maxlength="2" required></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="no_of_bathrooms" class=" form-control-label">Number of Bathrooms</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="no_of_bathrooms" name="no_of_bathrooms" placeholder="Enter Number of Bathrooms..." class="form-control" maxlength="2" required></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="price" class=" form-control-label">Price</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Enter Price..." class="form-control" maxlength="8" required/></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="" class=" form-control-label">Image</label></div>
                            <div class="col-12 col-md-9" id="p_scents">
								<label>Image</label>
								<input name="image[]" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif"><a href="#" id="addScnt">Add More</a>
							</div>
							
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="price" class=" form-control-label">Facilities</label></div>
								<div class="col-12 col-md-9">
									<input id="" name="is_garden" type="checkbox" value="t"> Garden<br/>
									<input id="" name="is_parking" type="checkbox" value="t"> Parking<br/>
									<input id="" name="is_centralheating" type="checkbox" value="t"> Central Heating<br/>
									<input id="" name="is_ac" type="checkbox" value="t"> AC<br/>
									<input id="" name="is_wifi" type="checkbox" value="t"> Wi-Fi<br/>
									<input id="" name="is_cable" type="checkbox" value="t"> Cable Television<br/>
									<input id="" name="is_washing" type="checkbox" value="t"> Washing Machine<br/>
									<input id="" name="is_dryer" type="checkbox" value="t"> Dryer<br/>
									<input id="" name="is_dishwasher" type="checkbox" value="t"> Dishwasher<br/>
									<input id="" name="is_microwave" type="checkbox" value="t"> Microwave<br/>
								</div>
                          </div>
                      </div>
                      <div class="card-footer">
                         <button type="submit" name="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Save
                        </button> 
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
					  </form>
                    </div>
                  </div>
				  
				  <!-- Tabs -->
				  <div class="col-lg-6">
					<div id="example-one">
        			
        	<ul class="nav">
                <li class="nav-one"><a href="#featured" class="current">Featured</a></li>
                <li class="nav-two"><a href="#core">Core</a></li>
                <li class="nav-three"><a href="#jquerytuts">jQuery</a></li>
                <li class="nav-four last"><a href="#classics">Classics</a></li>
            </ul>
        	
        	<div class="list-wrap">
        	
        		<ul id="featured">
        			<li><a href="http://css-tricks.com/perfect-full-page-background-image/">Full Page Background Images</a></li>
        			<li><a href="http://css-tricks.com/designing-for-wordpress-complete-series-downloads/">Designing for WordPress</a></li>
        			<li><a href="http://css-tricks.com/build-your-own-social-home/">Build Your Own Social Home!</a></li>
        			<li><a href="http://css-tricks.com/absolute-positioning-inside-relative-positioning/">Absolute Positioning Inside Relative Positioning</a></li>
        			<li><a href="http://css-tricks.com/ie-css-bugs-thatll-get-you-every-time/">IE CSS Bugs That'll Get You Every Time</a></li>
        			<li><a href="http://css-tricks.com/404-best-practices/">404 Best Practices</a></li>
        			<li><a href="http://css-tricks.com/date-display-with-sprites/">Date Display with Sprites</a></li>
        		</ul>
        		 
        		 <ul id="core" class="hide">
                    <li><a href="http://css-tricks.com/video-screencasts/58-html-css-the-very-basics/">The VERY Basics of HTML &amp; CSS</a></li>
                    <li><a href="http://css-tricks.com/the-difference-between-id-and-class/">Classes and IDs</a></li>
                    <li><a href="http://css-tricks.com/the-css-box-model/">The CSS Box Model</a></li>
                    <li><a href="http://css-tricks.com/all-about-floats/">All About Floats</a></li>
                    <li><a href="http://css-tricks.com/the-css-overflow-property/">CSS Overflow Property</a></li>
        			<li><a href="http://css-tricks.com/css-font-size/">CSS Font Size - (px - em - % - pt - keyword)</a></li>
        			<li><a href="http://css-tricks.com/css-transparency-settings-for-all-broswers/">CSS Transparency / Opacity</a></li>
        			<li><a href="http://css-tricks.com/css-sprites/">CSS Sprites</a></li>
        			<li><a href="http://css-tricks.com/nine-techniques-for-css-image-replacement/">CSS Image Replacement</a></li>
        		 	<li><a href="http://css-tricks.com/what-is-vertical-align/">CSS Vertial Align</a></li>
        			<li><a href="http://css-tricks.com/the-css-overflow-property/">The CSS Overflow Property</a></li>
        		 </ul>
        		 
        		 <ul id="jquerytuts" class="hide">
        		    <li><a href="http://css-tricks.com/anythingslider-jquery-plugin/">Anything Slider jQuery Plugin</a></li>
        		    <li><a href="http://css-tricks.com/moving-boxes/">Moving Boxes</a></li>
        			<li><a href="http://css-tricks.com/simple-jquery-dropdowns/">Simple jQuery Dropdowns</a></li>
        			<li><a href="http://css-tricks.com/creating-a-slick-auto-playing-featured-content-slider/">Featured Content Slider</a></li>
        			<li><a href="http://css-tricks.com/startstop-slider/">Start/Stop Slider</a></li>
        			<li><a href="http://css-tricks.com/banner-code-displayer-thing/">Banner Code Displayer Thing</a></li>
        			<li><a href="http://css-tricks.com/highlight-certain-number-of-characters/">Highlight Certain Number of Characters</a></li>
        			<li><a href="http://css-tricks.com/auto-moving-parallax-background/">Auto-Moving Parallax Background</a></li>
        		 </ul>
        		 
        		 <ul id="classics" class="hide">
                    <li><a href="http://css-tricks.com/css-wishlist/">Top Designers CSS Wishlist</a></li>
                    <li><a href="http://css-tricks.com/what-beautiful-html-code-looks-like/">What Beautiful HTML Code Looks Like</a></li>
                    <li><a href="http://css-tricks.com/easily-password-protect-a-website-or-subdirectory/">Easily Password Protect a Website or Subdirectory</a></li>
                    <li><a href="http://css-tricks.com/how-to-create-an-ie-only-stylesheet/">IE-Only Stylesheets</a></li>
                    <li><a href="http://css-tricks.com/ecommerce-considerations/">eCommerce Considerations</a></li>
                    <li><a href="http://css-tricks.com/php-for-beginners-building-your-first-simple-cms/">PHP: Build Your First CMS</a></li>
        		 </ul>
        		 
        	 </div> <!-- END List Wrap -->
         
         </div>	
				</div> 
				  <!-- End Tabs -->
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
<?php get_footer(); ?>