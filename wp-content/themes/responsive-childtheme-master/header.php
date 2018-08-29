<?php
/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.3
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
} 
?>
	<!doctype html>
	<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/png" href="<?php echo SITEURL;?>images/desi-fav-icon.png"/>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
 		<link rel="stylesheet" href="<?php echo SITEURL;?>
		wp-content/themes/responsive-childtheme-master/core/css/w3.css">
		
		<?php wp_head(); ?>
		<?php 
		$poster = get_post();
		?>
		<!-- Dashboard Css-->
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/normalize.css">
		<!--<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/bootstrap.min.css">-->
		<?php 
		if($poster->ID != "61"){
		?>
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/abc.min.css">
		<?php 
		}else{
		?>
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/bootstrap.min.css">
		<?php
		}
		?>
		<link rel="stylesheet" href="https://reinventdigital.com/demo/listingwebsite/wp-content/themes/responsive-childtheme-master/style.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/themify-icons.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/flag-icon.min.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/cs-skin-elastic.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/style.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/style1.css">
		<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/slider/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/slider/css/owl.carousel.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
		<!-- End Dashboardcss-->
		<?php 
		if($poster->ID != "69"){
		?>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/jquery.validate.min.js"></script>
		<?php 
		}
		?>
		<?php
		if($poster->ID != "40" && $poster->ID != "42"  && $poster->ID != "69"){
			require_once './wp-content/themes/responsive-childtheme-master/core/js/js.php';
		}else{
			//require_once './wp-content/themes/responsive-childtheme-master/core/js/js1.php';
		}
		?>

</head>

<body <?php body_class(); ?>>
<?php responsive_container(); // before container hook ?>
<div id="container" class="hfeed">

<?php responsive_header(); // before header hook ?>
	<div class="top-header">
     <div class="container">
        <div class="w3-row">
		<div class="w3-left">
		<?php if ( has_nav_menu( 'top-menu', 'responsive' ) ) {
			wp_nav_menu( array(
				'container'      => '',
				'fallback_cb'    => false,
				'menu_class'     => 'top-menu',
				'theme_location' => 'top-menu'
			) );
		} ?></div>
		
       </div>
     </div>
	</div><!-- top-header -->
	<!--<div id="alpha"><p>Alpha</p></div>-->
	<div id="header" role="banner">
      <div class="container">
       <div class="w3-row">
		<?php responsive_header_top(); // before header content hook ?>
		  <?php responsive_in_header(); // header hook ?>
		<?php if ( get_header_image() != '' ) : ?>
<div class="logo-section w3-col l3">
			
			<div id="logo">
				<a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="https://desihomes.co.uk/wp-content/uploads/2018/04/cropped-Desi-Homes-Logo.png" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>"/></a>
				<p>Find your <span>Desh in Videsh!</span></p>
			</div><!-- end of #logo -->
		<?php endif; // header image was removed ?>
		<?php if ( !get_header_image() ) : ?>
			<div id="logo">
				<span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<span class="site-description"><?php bloginfo( 'description' ); ?></span>
			</div><!-- end of #logo -->
		</div>
		<?php endif; // header image was removed (again) ?>
		 <span class="alpha-text">Alpha</span>
</div><!-- End container -->
	<div class="w3-col l9 link_section">
      <div class="menu_wrap">
		<?php 
		if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
		?>
        <div class="before_login">
      	  <a href="<?php echo SITEURL;?>register" class="register-link"><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/reg-icon-1.png"> Register</a> 
          <a href="<?php echo SITEURL;?>login" class="login-link"><i class="fa fa-user"></i> Sign In</a>  
          </div>
          <!--<a href="#" class="post_listing_btn">POST A LISTING</a>-->
		<?php 
		}else{
		?>
		
        <div class="after_login_">
		<span class="after-login"><span class="welcome_txt">Welcome,</span> <a class="user_name_" href="<?php echo SITEURL?>dashboard"><?php echo stripslashes(ucwords($_SESSION['name']));?></a> |</span> <a href="<?php echo SITEURL;?>logout" class="logout_btn_ desihomes_btn">Logout</a> | <a href="<?php echo SITEURL;?>add-property" class="post_listing_btn desihomes_btn">Advertise My Property</a>
        </div>
		
		<!-- MOBILE VIEW -->
		<div class="mob_after_login">
			<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">&times;</a>
			  <ul>
				  <li><a href="index.html" class="welcome_txt" >Welcome,<a style="margin-right: 9%;" class="user_name_" href="<?php echo SITEURL?>dashboard"><?php echo stripslashes(ucwords($_SESSION['name']));?></a></li>
				  <li><a href="<?php echo SITEURL;?>add-property" class="post_listing_btn desihomes_btn mob_ad">Advertise My Property</a></li>
				  <li><a href="<?php echo SITEURL;?>logout" class="logout_btn_ desihomes_btn mob_logout">Logout</a></li>
			  </ul>
			</div>

			<i class="fa fa-bars" onClick="openNav()"></i>


			<!--<p id="menu" onclick="toggleMenu()"> <i class="fa fa-bars"></i></p>
			<ul class="login_mobile_menu" id="menu-box" style="display: none;margin: 0px;">
			  <li style="padding-top: 29px;"><a href="index.html" class="welcome_txt">Welcome,<a class="user_name_" href="<?php echo SITEURL?>dashboard"><?php echo stripslashes(ucwords($_SESSION['name']));?></a></a></li>
			  <li><a href="<?php echo SITEURL;?>logout" class="logout_btn_ desihomes_btn">Logout</a></li>
			  <li><a href="<?php echo SITEURL;?>add-property" class="post_listing_btn desihomes_btn">Advertise My Property</a></li>
			</ul>-->
		</div>
		
		<?php
		}
		?>
      </div>
</div>

		<?php responsive_header_bottom(); // after header content hook ?>
      </div>
	</div><!-- end of #header -->
</div>
<?php responsive_header_end(); // after header container hook ?>
<?php responsive_wrapper(); // before wrapper container hook ?>
	<div id="wrapper" class="clearfix">
<?php responsive_wrapper_top(); // before wrapper content hook ?>
<?php responsive_in_wrapper(); // wrapper hook ?>

<!--<script type="text/javascript">
	function toggleMenu() {
	  var menuBox = document.getElementById('menu-box');    
	  if(menuBox.style.display == "none") { // if is menuBox displayed, hide it
		menuBox.style.display = "block";
	  }
	  else { // if is menuBox hidden, display it
		menuBox.style.display = "none";
	  }
	}
</script>-->

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<style>
#header
{
	border-bottom:2px solid #f87a1f;
}

#wrapper
{
	margin:0;
}


</style>

