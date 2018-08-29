<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Get Map Page (no sidebar)
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
                        <h1>Address Map</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Address Map</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="row">
                  <!--/.col-->
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <strong>Address </strong>Map
                      </div>

	  <div id="latlong">
		<p>Latitude: <input size="20" type="text" id="latbox" name="lat" ></p>
		<p>Longitude: <input size="20" type="text" id="lngbox" name="lng" ></p>
		<input type="button" name="btn" id="btn" onclick="initialize()"/>
	  </div>
			<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7IZt-36CgqSGDFK8pChUdQXFyKIhpMBY&sensor=true" type="text/javascript"></script>
			<script type="text/javascript">
			  var map;
			  function initialize() {
				var myLatlng = new google.maps.LatLng(40.713956,-74.006653);
				var myOptions = {
				 zoom: 8,
				 center: myLatlng,
				 mapTypeId: google.maps.MapTypeId.ROADMAP
				 }
			  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
			alert('map');
			  var marker = new google.maps.Marker({
				draggable: true,
				position: myLatlng, 
				map: map,
				title: "Your location"
			  });
			
				google.maps.event.addListener(marker, 'dragend', function (event) {
					document.getElementById("latbox").value = this.getPosition().lat();
					document.getElementById("lngbox").value = this.getPosition().lng();
				});
			}
			</script> 
			 <div id="map_canvas" style="width:50%; height:50%"></div>
				  
                    </div>
                  </div>
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
<?php get_footer(); ?>