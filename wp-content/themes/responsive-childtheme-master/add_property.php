<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
*Full Content Template
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
	$location1 = SITEURL . "/login";
	wp_redirect( $location1, 301 );
	exit;
}
$user_id = $_SESSION['user_id'];
//echo "User id is ".$user_id; exit;
//$getUserDetailsByID = getUserDetailsByID($user_id);
//echo "<pre>"; print_r($getUserDetailsByID); exit;
?>
<link rel="stylesheet" href="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/css/tabstyle.css">
<script src="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/js/jquery.organictabs.js"></script>
<script type="text/javascript">
function getSlug(){
	var title = $("#title").val();
	if(title != ""){
		$.ajax({
			url:'<?php echo SITEURL;?>getslug.php',
			type:'POST',
			data:{title:title},
			async:false,
			cache:false,
			success:function(html){
				//alert(html);
				$("#slug").val(html);
			}
		});
	} 
}
</script>
<!-- Left Panel -->
<div class="clearfix additional_form_css">
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
				<li class=""><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>inbox"> <i class="menu-icon fa fa-envelope"></i>Inbox</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<!--<li class="active"><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-plus"></i>Add Property</a></li>-->
				<!--<li class=""><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
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
        <!--<div class="breadcrumbs">
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
        </div> -->
		<?php 
		if(isset($_POST['submit']) || isset($_POST['save_next'])){
			//echo "<pre>"; print_r($_POST); exit;
			$addProperty = saveProperty($_POST);
			//echo $addProperty; exit;
			if($addProperty != ""){
				
			if($addProperty != 'already'){	
				$_SESSION['info'] = "<font color='#00CC00'></font>";
				$type = "general";
				if($_POST['save_next'] == "save_next"){
					$type = "facilities";
				}
				$location1 = SITEURL . "/edit-property/?id=".$addProperty."&type=".$type;
				wp_redirect( $location1, 301 );
				exit;
			  }else{
			  	$_SESSION['info'] = "<font color='#FF0000'>Looks like you have already advertised this property, please check if your property is pending for approval or change the title</font>";
				$location1 = SITEURL . "/add-property/";
				wp_redirect( $location1, 301 );
				exit;
			  }
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
                        Add Property
                      </div>
					  <?php 
					  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
					  ?>
					  <span><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>
					  <?php
					  }
					  ?>
					  <form action="" method="post" class="form-horizontal" id="property_general_form" enctype="multipart/form-data">
					  <!--<form action="" method="post" class="form-horizontal" id="profile_form">-->
                      <input type="hidden" name="id" id="id" value=""/>
					  <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-3 ad_prpty_fld"><label for="name" class=" form-control-label">Property Type</label></div>
                            <div class="col-12 col-md-9">
								<?php 
								$getAllPropertyType = getAllPropertyType();
								//echo "<pre>"; print_r($getAllPropertyType); exit;
								if(!empty($getAllPropertyType)){
								?>
								<select name="property_type" id="property_type" class="form-control input_width" required>
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
                            <div class="col col-md-3 ad_prpty_fld"><label for="name" class=" form-control-label">Title</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Enter Title..." class="form-control" required maxlength="200" onblur="return getSlug();"></div>
							<input type="hidden" id="slug" name="slug" placeholder="Enter Slug..." class="form-control" required maxlength="2000">
                          </div>
                          <div class="row form-group add_prop_title">
                            <div class="col col-md-3 ad_prpty_fld"><label for="description" class=" form-control-label">Description</label></div>
                            <div class="col-12 col-md-9">
							<textarea id="description" name="description" style="resize: none; width:100% !important;" placeholder="Enter Description..." class="form-control" rows="10" required maxlength="2000"></textarea>
							</div>
                          </div>
                      </div>
                      <div class="card-footer">
                          <button type="submit" name="submit" id="savegen" class="btn btn-primary btn-sm" value="save">
						  <i class="fa fa-dot-circle-o"></i> Save
						</button>
						 <button type="submit" name="save_next" id="savegennext" class="btn btn-primary btn-sm right_flting" value="save_next">
						  <i class="fa fa-dot-circle-o"></i> Save & Next
						</button>
                        <!--<button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>-->
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
	$(document).ready(function()
	{
		$('.mobile_nav_icon').click(function()
		{
			$(this).closest('#main-menu').find('.navbar-nav').slideToggle(1000);
			
		});
		
			
	});
	</script>
<?php get_footer(); ?>