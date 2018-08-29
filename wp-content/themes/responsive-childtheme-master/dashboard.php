<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  My Properties Page (no sidebar)
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
	$location1 = SITEURL . "/login";
	wp_redirect( $location1, 301 );
	exit;
}
$user_id = $_SESSION['user_id'];

$showVendorProperties = showVendorProperties($_SESSION['user_id']);
//echo "<pre>"; print_r($showVendorProperties); exit;
//$getUserDetailsByID = getUserDetailsByID($user_id);
?>
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
				<li class="active"><a href="<?php echo SITEURL?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
				<li class=""><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>inbox"> <i class="menu-icon fa fa-envelope"></i>Inbox</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<!--<li class=""><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-plus"></i>Add Property</a></li>-->
				<!--<li class="active"><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->
    <div id="right-panel" class="right-panel full_width_">
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="row">
                  <!--/.col-->
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <strong>My Properties</strong>
                      </div>
					  <?php 
					  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
					  ?>
					  <span class="inf_crd_hdr"><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>
					  <?php
					  }
					  ?>
					  <div class="card-body">
                      <div class="table-responsive" >
					  <table id="bootstrap-data-table" class="table table-striped table-bordered ">
						<thead>
						  <tr>
							<th>S.No.</th>
							<th>Title</th>
							<th>Postcode</th>
							<th>City</th>
							<th>Availability</th>
							<th>Verification Status</th>
							<th>Property Status</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						  <?php 
						  if(!empty($showVendorProperties)){
						  	$i=1;
							foreach($showVendorProperties as $showVendorProperties){
						  ?>
							  <tr>
								<td style="text-align:center;"><?php echo $i;?>.</td>
								<td><?php echo stripslashes($showVendorProperties->title);?></td>
								<td><?php echo stripslashes($showVendorProperties->postcode);?></td>
								<td><?php echo stripslashes($showVendorProperties->city);?></td>
								<td><?php echo stripslashes($showVendorProperties->available_from)." to ".stripslashes($showVendorProperties->available_to);?></td>
								<?php 
								if($showVendorProperties->status == "t"){
									$status = "<font color='green'>Verified</font>";
								}else{
									$status = "<font color='red'>Not Verified</font>";
								}
								?>
								<td style="text-align:center;"><?php echo $status;?></td>
								<?php 
								if($showVendorProperties->user_availability_status == "t"){
									$user_availability_status = "<font color='green'>Available</font>";
								}else{
									$user_availability_status = "<font color='red'>Rented</font>";
								}
								?>
								<td style="text-align:center;"><a href="<?php echo SITEURL;?>change_property_availability_status.php?id=<?php echo $showVendorProperties->id;?>&user_availability_status=<?php echo $showVendorProperties->user_availability_status;?>"><?php echo $user_availability_status;?></a></td>
								<td style="text-align:center;"><a href="<?php echo SITEURL;?>edit-property/?id=<?php echo $showVendorProperties->id;?>">Edit</a> <!--| <a href="#">Delete</a>-->
								| <a href="<?php echo SITEURL;?>book-property/?property_id=<?php echo $showVendorProperties->id;?>">Block Dates</a> | <a href="<?php echo SITEURL;?>show-bookings/?property_id=<?php echo $showVendorProperties->id;?>">Release Dates</a>
								<?php 
								if($showVendorProperties->expire == "f"){
								?>
								| <a href="<?php echo SITEURL;?>expire_property.php?id=<?php echo $showVendorProperties->id;?>">Delist</a>
								<?php 
								}else{
								?>
								| <font color='red'>Delisted</font>
								<?php
								}
								?>
								</td>
							  </tr>
						  <?php
						  	++$i;
						  	}
						  }
						  ?>
						</tbody>
					  </table>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
</div>
	<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/datatables.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/jszip.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/pdfmake.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/vfs_fonts.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/buttons.html5.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/buttons.print.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/buttons.colVis.min.js"></script>
    <script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/datatables-init.js"></script>
    <script>
	$(document).ready(function()
	{
		$('.mobile_nav_icon').click(function()
		{
			$(this).closest('#main-menu').find('.navbar-nav').slideToggle(1000);
		});
	});
	</script>
	<?php //echo "DashboardFoot<pre>"; print_r($_SESSION); exit;?>
<?php get_footer(); ?>