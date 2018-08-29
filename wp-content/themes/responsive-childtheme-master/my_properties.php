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
			<ul class="nav navbar-nav">
				<li class="profile_pic_box"><span class="profile_pic"></span><span class="name_profile"><?php echo $_SESSION['name'];?></span></li>
				<li class=""><a href="<?php echo SITEURL?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
				<li class=""><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<!--<li class=""><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-plus"></i>Add Property</a></li>
				<li class="active"><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->
    <!-- Left Panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel full_width_">
        <!-- Header-->
        <!-- /header -->
        <!-- Header-->
<!--
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>My Properties</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">My Properties</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
-->
		<div class="content mt-12">

            <div class="animated fadeIn">

                <div class="row">

                  <!--/.col-->

                  <div class="col-lg-12">

                    <div class="card">

                      <div class="card-header">

                        <strong>My</strong> Properties

                      </div>

					  <?php 

					  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){

					  ?>

					  <span><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>

					  <?php

					  }

					  ?>

					  

					  <div class="card-body">

					  <table id="bootstrap-data-table" class="table table-striped table-bordered">

						<thead>

						  <tr>

							<th>S.No.</th>

							<th>Title</th>

							<th>Postcode</th>

							<th>City</th>

							<th>Country</th>

							<!--<th>Status</th>-->

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

								<td><?php echo stripslashes($showVendorProperties->country);?></td>

								<?php 

								/*if($showVendorProperties->status == "t"){

									$status = "<font color='green'>Active</font>";

								}else{

									$status = "<font color='red'>Inactive</font>";

								}*/

								?>

								<!--<td style="text-align:center;"><a href="change_property_status.php?id=<?php echo $showVendorProperties->id;?>&sts=<?php echo $showVendorProperties->status;?>"><?php echo $status;?></a></td>-->

								<td style="text-align:center;"><a href="<?php echo SITEURL;?>edit-property/?id=<?php echo $showVendorProperties->id;?>">Edit</a> <!--| <a href="#">Delete</a>-->

								| <a href="<?php echo SITEURL;?>book-property/?property_id=<?php echo $showVendorProperties->id;?>">Book property</a> | <a href="<?php echo SITEURL;?>show-bookings/?property_id=<?php echo $showVendorProperties->id;?>">Show Bookings</a>

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

	

<?php get_footer(); ?>