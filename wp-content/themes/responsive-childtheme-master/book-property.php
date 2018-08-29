<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Book Property Page (no sidebar)
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
$getPropertyVendor = getPropertyVendor($_GET['property_id']);
if(!empty($getPropertyVendor)){
	if($getPropertyVendor[0]->added_by != $_SESSION['user_id']){
		//echo "Not your Property"; exit;
		$location1 = SITEURL . "/dashboard/";
		wp_redirect( $location1, 301 );
		exit;
	}
}else{
	$location1 = SITEURL . "/dashboard/";
	wp_redirect( $location1, 301 );
	exit;
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/jquery-ui.multidatespicker.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/jquery-ui.multidatespicker.js"></script> 
<style>
.dp-highlight2 .ui-state-default {
	  background: #0066FF !important;
	  color: #FFF !important;
	}
 .dp-highlight .ui-state-default {
	  background: #FF0000 !important;
	  color: #FFF !important;
	}
	.ui-datepicker.ui-datepicker-multi  {
	  width: 100% !important;
	}
	.ui-datepicker-multi .ui-datepicker-group {
		float:left;
	}
	#datepicker {
	  height: auto;
	  overflow-x: scroll;
	}
	.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all.ui-datepicker-multi-3.ui-datepicker-multi{display:inline-block}
	input#submit{display: block;margin: 0 auto;margin-top: 20px;}
.ui-widget { font-size: 100% }
</style>
<?php 
$getPropertyBookedDates = getPropertyBookedDates($_GET['property_id']);
//echo "<pre>"; print_r($getPropertyBookedDates); exit;
$booked_dates = "";
$booked_date_arr = array();
$lastdate = "";
if(!empty($getPropertyBookedDates)){
	$num1 = count($getPropertyBookedDates);
	$booked_dates .= "[";
	$j=0;
	foreach($getPropertyBookedDates as $getPropertyBookedDates){
		$booked_dates .= '"'.trim($getPropertyBookedDates->booked_date).'"';
		if($j<($num1-1)){
			$booked_dates .= ',';
		}else{
			$lastdate = $getPropertyBookedDates->booked_date;
		}
		$booked_date_arr[] = $getPropertyBookedDates->booked_date;
		++$j;
	}
	$booked_dates .= "]";
	//echo $booked_dates."<br/>".$lastdate;
	$breaklastdate = array();
	$breaklastdate = explode("-",$lastdate);
	//echo "<pre>"; print_r($breaklastdate);
	$lastmindate = $breaklastdate[2].", ".$breaklastdate[1]." - 1,".$breaklastdate[0]." + 1";
	//exit;
}

?>
<?php 
$getPropertyBookedDates = getPropertyBookedDates($_GET['property_id']);
//echo "Data<pre>"; print_r($getPropertyBookedDates); exit;
?>
<script type="text/javascript">
/** Display Checkin Datepicker and Checkout DatePicker */
var eventDates1 = {};
<?php 
if(!empty($getPropertyBookedDates)){
	for($aa=0;$aa<=count($getPropertyBookedDates);$aa++){
		$datestr1 = strtotime($getPropertyBookedDates[$aa]->booked_date);
		$datestr = date("m/d/Y",$datestr1)
	?>
	eventDates1[ new Date('<?php echo $datestr;?>')] = new Date('<?php echo $datestr;?>').toString();	
	<?php
	} 
}
?>
//eventDates1[ new Date( '07/19/2018' )] = new Date( '07/19/2018' );
datePicker();
function datePicker(){
   $(document).ready(function(){
      
	  var tomorrow = new Date(<?php echo $lastmindate;?>);
	  tomorrow.setDate(tomorrow.getDate());
	  
	  $("#Datepicker").datepicker({
         dateFormat: "MM d, yy",
		 minDate: 0,
		 numberOfMonths: [2, 3],
		 maxDate: "+6M +0D", 
         beforeShowDay: dateRange,
	 	 onSelect: DRonSelect
      });
   });
}

function dateRange(date){
	var string = $.datepicker.formatDate('yy-mm-dd', date);
    var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate").val());
    var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate").val());
    //var isHighlight = date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2));
	var isHighlight2 = date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2));
	var isHighlight = eventDates1[date];
	//var isHighlight =
      $(document).ready(function(){
  		// $("td.dp-highlight").text("Y");
	  });
   //return [true, isHighlight ? "dp-highlight" : ""];
   return [true, isHighlight2 ? "dp-highlight2" : ""];
}
  
function DRonSelect(dateText, inst) {
   var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate").val());
   var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate").val());
      if (!date1 || date2) {
         $("#checkinDate").val(dateText);
	 $("#checkoutDate").val("");
         $("#Datepicker").datepicker();
      } 
      else {
         if ( $.datepicker.parseDate("MM d, yy", $("#checkinDate").val()) >= 
$.datepicker.parseDate("MM d, yy", dateText)) {
            $("#checkinDate").val(dateText);
            $("#checkoutDate").val("");
            $("#Datepicker").datepicker();
         }
         else {
	    $("#checkoutDate").val(dateText);
            $("#Datepicker").datepicker();
         }
      }   
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
				<li class=""><a href="<?php echo SITEURL?>profile"> <i class="menu-icon fa fa-user"></i>Profile</a></li>
				<li class=""><a href="<?php echo SITEURL?>inbox"> <i class="menu-icon fa fa-envelope"></i>Inbox</a></li>
				<li class=""><a href="<?php echo SITEURL?>change-password"> <i class="menu-icon fa fa-key"></i>Change Password</a></li>
				<!--<li class=""><a href="<?php echo SITEURL?>add-property"> <i class="menu-icon fa fa-plus"></i>Add Property</a></li>-->
				<!--<li class="active"><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
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

        
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="row">
                  <!--/.col-->
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <strong>Book Property</strong>
                      </div>
					  <?php 
					  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
					  ?>
					  <span><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>
					  <?php
					  }
					  ?>
						<?php 
						if(isset($_POST['submit'])){
							//echo "<pre>"; print_r($_POST); exit;
							$book_property = bookProperty($_POST);
							if($book_property == "booked"){
								$_SESSION['info'] = "Property booked successfully";
							}else{
								$_SESSION['info'] = "Property not booked";
							}
							$location = get_site_url() . "/book-property/?property_id=".$_GET['property_id'];
							wp_redirect( $location, 301 );
							exit; 
						}
						if($_GET['property_id'] != ""){
						?>
                        <div class="col-md-12">
							<div id="Datepicker"></div>
								<form method="post" id="property_book_form" name="property_book_form" action="" class="">
								<p>
								<input type="hidden" name="bookstart" id="checkinDate"/>
								<input type="hidden" name="bookend" id="checkoutDate">
								<input type="hidden" name="property_id" value="<?php echo $_GET['property_id'];?>" />
								<input type="submit" name="submit" id="submit" value="Book" class="book_propty_submit" />
								</form>
								</p>
                         </div>
                         
						<?php	
						}else{
							$location = get_site_url() . "/dashboard/";
							wp_redirect( $location, 301 );
							exit; 
						}
						?>
                    </div>
                  </div>
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
	</div>
<?php get_footer(); ?>