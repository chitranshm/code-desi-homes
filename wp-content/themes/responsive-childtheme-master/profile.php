<?php
//Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Profile Page (no sidebar)
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
$getUserDetailsByID = getUserDetailsByID($user_id);
//echo "<pre>"; print_r($getUserDetailsByID); exit;
?>
<script type="text/javascript">
function deleteImage(id,image){
	//alert(id+"_________"+image);
	if(confirm('Are you sure to delete this image ?')){
		window.location.href="<?php echo SITEURL?>delete_user_image.php?id="+id+"&image="+image;
	}
	return false;
}
</script>
<div class="clearfix additional_form_css">
<!-- Left Panel -->
	<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">
		<div id="main-menu" class="main-menu collapse navbar-collapse">
        <span class="mobile_nav_icon"><i class="fa fa-bars"></i></span>
			<ul class="nav navbar-nav">
				<?php 
				$results = $wpdb->get_results( "SELECT * FROM `wp_register_users` WHERE id = '".$_SESSION['user_id']."'");
				if(!empty($results)){
					if($_SESSION['loginwith'] == "f"){
						$userImg = $results[0]->image;
					}else{
						if($results[0]->image != "" && file_exists("./images/user_images/".$results[0]->image)){
							$userImg = SITEURL."images/user_images/".$results[0]->image;
						}else{
							$userImg = SITEURL."images/no_image_available.png";
						}
					}
				}
				?>
				<li class="profile_pic_box"><span class="profile_pic" style="text-align:center;font-size:40px;color:#009900; background: url(<?php echo $userImg;?>); background-size: 80px 80px; background-repeat: no-repeat;"></span><span class="name_profile"><?php echo $_SESSION['name'];?></span></li>
				<li class=""><a href="<?php echo SITEURL?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
				<li class="active"><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>inbox"> <i class="menu-icon fa fa-envelope"></i>Inbox</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<!--<li class=""><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-plus"></i>Add Property</a></li>-->
				<!--<li class=""><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->
    <div id="right-panel" class="right-panel full_width_">
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="row">
                  <!--/.col-->
                  <div class="col-lg-12 profile_box">
                    <div class="card">
                      <div class="card-header">
                        Update Profile
                      </div>
					  <form action="<?php echo SITEURL;?>update_profile.php" method="post" class="profile_form form-horizontal" id="profile_form" enctype="multipart/form-data">
					  <!--<form action="" method="post" class="form-horizontal" id="profile_form">-->
                      <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="name" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="name" name="name" value="<?php echo stripslashes($getUserDetailsByID[0]->name);?>" placeholder="Enter Name..." class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="email" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9"><input type="email" id="email" name="email" value="<?php echo stripslashes($getUserDetailsByID[0]->email);?>" placeholder="Enter Email..." class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="mobile" class=" form-control-label">Mobile</label></div>
                            <div class="col-12 col-md-9"><input type="tel" id="mobile" name="mobile" value="<?php echo $getUserDetailsByID[0]->mobile;?>" placeholder="Enter Mobile..." class="form-control" maxlength="11"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="address_line1" class=" form-control-label">Address Line 1</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="address_line1" name="address_line1" value="<?php echo stripslashes($getUserDetailsByID[0]->address_line1);?>" placeholder="Enter Address Line 1" class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="address_line2" class=" form-control-label">Address Line 2</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="address_line2" name="address_line2" value="<?php echo stripslashes($getUserDetailsByID[0]->address_line2);?>" placeholder="Enter Address Line 2" class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="address_line3" class=" form-control-label">Address Line 3</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="address_line3" name="address_line3" value="<?php echo stripslashes($getUserDetailsByID[0]->address_line3);?>" placeholder="Enter Address Line 3" class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="town" class=" form-control-label">Town</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="town" name="town" value="<?php echo stripslashes($getUserDetailsByID[0]->town);?>" placeholder="Enter Town" class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="postcode" class=" form-control-label">Postcode</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="postcode" name="postcode" value="<?php echo stripslashes($getUserDetailsByID[0]->postcode);?>" placeholder="Enter Postcode" class="form-control"></div>
                          </div>
						  <?php 
						  if($_SESSION['loginwith'] == "f"){
						  ?>
						  <!--<img src="<?php echo $getUserDetailsByID[0]->image;?>" width="20%" height="20%"/><br>-->
						  <?php
						  }else{
							  if($getUserDetailsByID[0]->image != "" && file_exists('./images/user_images/'.$getUserDetailsByID[0]->image)){
							  ?>
							  <div class="col col-md-3 ad_prpty_fld"><label for="image" class=" form-control-label">Image</label></div>
							  <div class="col-md-9">
							  <img src="<?php echo SITEURL;?>images/user_images/<?php echo $getUserDetailsByID[0]->image;?>" width="20%" height="20%"/><br>
							  
							  <a href="#" onclick="return deleteImage('<?php echo $getUserDetailsByID[0]->id?>','<?php echo $getUserDetailsByID[0]->image?>')">Delete Image</a>
							  </div>
							  <input type="hidden" name="image1" value="<?php echo $getUserDetailsByID[0]->image;?>"/>
							  <?php
							  }else{
							  ?>
							  <div class="row form-group">
								<div class="col col-md-3 ad_prpty_fld"><label for="image" class=" form-control-label">Image</label></div>
								<div class="col-12 col-md-9"><input type="file" id="image" name="image" class="form-control profile_upload_img" accept=".jpg,.jpeg,.png"></div>
							  </div>
							  <?php 
							  }
						  }
						  ?>
						  <!--<div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="date_of_birth" class=" form-control-label">Date of birth</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="date_of_birth" name="dob" value="<?php echo $getUserDetailsByID[0]->dob;?>" placeholder="Enter Date of Birth..." class="form-control datepicker"></div>
                          </div>-->
                      </div>
                      <div class="card-footer">
                         <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Update Account Details
                        </button> 
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
					  </form>
                    </div>
                  </div>
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
</div>
 <script>
$(document).ready(function(){
	$('.mobile_nav_icon').click(function(){
		$(this).closest('#main-menu').find('.navbar-nav').slideToggle(1000);
	});
});
</script>
<?php get_footer(); ?>