<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Change Password Page (no sidebar)
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
?>
<?php
//echo "Here<pre>"; print_r($_SESSION); exit;
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
	$page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
	exit;
}
$user_id = $_SESSION['user_id'];
$_SESSION['info'] = ""; $_SESSION['color'] = "";
if($_POST['new_password'] != "" && $_POST['confirm_new_password'] != ""){
	$changePassword = changePassword($_REQUEST);
	if(!empty($changePassword)){
		$_SESSION['info'] = "Your password is updated successfully";
		$_SESSION['color'] = "#006600;";
	}else{
		//$_SESSION['info'] = "Password is not updated";
		//$_SESSION['color'] = "#FF0000;";
	}
}else{
	//$_SESSION['info'] = "Password and confirm password can't be empty";
	//$_SESSION['color'] = "#FF0000;";
}
?>
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
				<li class="active"><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
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
                  <div class="col-lg-12">
                    <div class="card">
                      
					  <?php 
						if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
						?>
						<span style="color:<?php echo $_SESSION['color'];?>"><?php echo $_SESSION['info'];?></span>
						<?php
						$_SESSION['info'] = "";
						}
						$_SESSION['info'] = "";
						$_SESSION['color']="";
						?>
						<form action="" method="post" id="reset_password_form">
<div class="card-body card-block">
<div class="card-header">
                        Change Password
                      </div>
							<div class="form-group col-sm-12">
								<div class="col col-md-4 ad_prpty_fld col-lg-3">
								<label class=" form-control-label">New Password</label>
                                </div>
								<div class="col col-md-4 ad_prpty_fld col-lg-2">
								<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter Password" onkeyup="return checkPassword(this.value);" <?php if($_SESSION['loginwith'] == "f"){?>disabled="disabled"<?php }?> maxlength="15">
								<div id="passerr" style="font-size:14px !important;"></div>
								</div>
							</div>
							<div class="form-group col-sm-12">
							<div class="col col-md-4 ad_prpty_fld col-lg-3">
								<label class=" form-control-label">Confirm New Password</label>
							</div>
							<div class="col col-md-4 ad_prpty_fld col-lg-2">
								<input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Repeat Password" <?php if($_SESSION['loginwith'] == "f"){?>disabled="disabled"<?php }?> maxlength="15">
                            </div>
							</div>
                            </div>
<div class="card-footer" style="border-bottom:0;">
							<button type="submit" name="submit" class="btn btn-primary btn-flat m-b-15 change_pass_btn" <?php if($_SESSION['loginwith'] == "f"){?>disabled="disabled"<?php }?>>Change Password</button>
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