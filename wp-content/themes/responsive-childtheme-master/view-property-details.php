<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
//echo "Data = ".get_the_title(); exit;
/**
 * Full Content Template
 *
Template Name:  View Property Details (no sidebar)
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
get_header(); ?>
<?php 
/*if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
	$page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
	exit;
}*/
session_start();
$_SESSION['property_id'] = $_GET['id'];
$user_id = $_SESSION['user_id'];
$getPropertyBookedDates = getPropertyBookedDates($_GET['id']);
//echo "<prE>"; print_r($getPropertyBookedDates); exit;
$booked_dates = "";
$booked_date_arr = array();
if(!empty($getPropertyBookedDates)){
	$num = count($getPropertyBookedDates);
	$booked_dates .= "[";
	$ja = 0;
	foreach($getPropertyBookedDates as $getPropertyBookedDates){
		$booked_dates .= '"'.trim($getPropertyBookedDates->booked_date).'"';
		if($ja<($num-1)){
			$booked_dates .= ',';
		}
		$booked_date_arr[] = $getPropertyBookedDates->booked_date;
		++$ja;
	}
	$booked_dates .= "]";
	//echo $booked_dates; exit;
}
$getPropertyAvailableDates = getPropertyAvailableDates($_GET['id']);
$available_date_arr = array();
if(!empty($getPropertyAvailableDates)){
	$available_date_arr = explode(",",$getPropertyAvailableDates[0]->all_available_dates);
	if(!empty($booked_date_arr)){
		$available_date_arr = array_values(array_diff($available_date_arr,$booked_date_arr));
	}
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/jquery-ui.multidatespicker.css">
<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/bootstrap.min.css">
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/bootstrap.min.js"></script>
<style type="text/css">

/*.ui-datepicker-title{color:#009900;background:#FF9900;}
.ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-left{background:#FF9900 !important;}*/
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/jquery-ui.multidatespicker.js"></script>
<script>
$(function(){
    var eventDates = {};
	<?php 
	if(!empty($available_date_arr)){
		for($aa=0;$aa<=count($available_date_arr);$aa++){
			$datestr1 = strtotime($available_date_arr[$aa]);
			$datestr = date("m/d/Y",$datestr1)
		?>
		eventDates[ new Date('<?php echo $datestr;?>')] = new Date('<?php echo $datestr;?>').toString();	
		<?php
		}
	}
	?>
	//alert(JSON.stringify(eventDates));
 getMap();
 
 if($(window).width()>767)
{ 
 
 $('#datepicker1').datepicker({
	minDate:0,
	numberOfMonths: [4, 3],
	dateFormat:"dd-mm-yy",
	showOn: 'button',
    buttonText: 'Show Date',
    buttonImageOnly: true,
    buttonImage: 'https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/avail-img-1.jpg',
	autoclose: false,
	selectMultiple:true,
	inline:true,
	beforeShow:function(textbox, instance){
    $('#ui-datepicker-div').css({
        position: 'absolute',
        top:-20,
        left:5                   
    });
    $('#availe_').append($('#ui-datepicker-div'));
    //$('#ui-datepicker-div').hide();
  }
	/*maxDate: "+1M +10D",*/
	<?php 
	if($booked_dates != ""){
	?>
	//,beforeShowDay: DisableSpecificDates
	,beforeShowDay: function(date){
		var highlight = eventDates[date];
		if( highlight ) {
			 return [true, "event", highlight];
		} else {
			 //return [true, '', ''];
			 return DisableSpecificDates(date);
		}
	 }	
	<?php 
	}else{
	?>
	,beforeShowDay: function(date){
		var highlight = eventDates[date];
		if(highlight){
			return [true, "event", highlight];
		}else{
			return [true, "undefined", highlight];
		}
	}
	<?php
	}
	?>
 });
 
 $.datepicker._selectDateOverload = $.datepicker._selectDate;
	$.datepicker._selectDate = function (id, dateStr){
	  var target = $(id);
	  var inst = this._getInst(target[0]);
	  inst.inline = true;
	  $.datepicker._selectDateOverload(id, dateStr);
	  inst.inline = false;
	  if (target[0].multiDatesPicker != null) {
		target[0].multiDatesPicker.changed = false;
	  } else {
		target.multiDatesPicker.changed = false;
	  }
	  this._updateDatepicker(inst);
	};
	
}else{
 $('#datepicker2').datepicker({
	minDate:0,
	numberOfMonths: [4, 3],
	dateFormat:"dd-mm-yy",
	showOn: 'button',
    buttonText: 'Show Date',
    buttonImageOnly: true,
    buttonImage: 'https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/avail-img-1.jpg',
	autoclose: false,
	selectMultiple:true,
	inline:true,
	beforeShow:function(textbox, instance){
    $('#ui-datepicker-div').css({
        position: 'absolute',
        top:-20,
        left:5                   
    });
    $('#availe_1').append($('#ui-datepicker-div'));
    //$('#ui-datepicker-div').hide();
  }
	/*maxDate: "+1M +10D",*/
	<?php 
	if($booked_dates != ""){
	?>
	//,beforeShowDay: DisableSpecificDates
	,beforeShowDay: function(date){
		var highlight = eventDates[date];
		if( highlight ) {
			 return [true, "event", highlight];
		} else {
			 //return [true, '', ''];
			 return DisableSpecificDates(date);
		}
	 }	
	<?php 
	}else{
	?>
	,beforeShowDay: function(date){
		var highlight = eventDates[date];
		if(highlight){
			return [true, "event", highlight];
		}else{
			return [true, "undefined", highlight];
		}
	}
	<?php
	}
	?>
 });
 
 $.datepicker._selectDateOverload = $.datepicker._selectDate;
	$.datepicker._selectDate = function (id, dateStr){
	  var target = $(id);
	  var inst = this._getInst(target[0]);
	  inst.inline = true;
	  $.datepicker._selectDateOverload(id, dateStr);
	  inst.inline = false;
	  if (target[0].multiDatesPicker != null) {
		target[0].multiDatesPicker.changed = false;
	  } else {
		target.multiDatesPicker.changed = false;
	  }
	  this._updateDatepicker(inst);
	};
	
	
}
	$('.ui-datepicker-trigger').trigger('click');
	
	$('.tabs_list li').click(function()
	{
		var li_data = $(this).attr('data');
		$('.tabs_inner_').hide();
		$('#'+li_data).show();
		$('.tabs_list li').removeClass('active');
		$(this).addClass('active');	
	});  
	
	$(".ui-datepicker-trigger").click(function(){
		$('.tabs_inner_').hide();
		$('#availe_').show();
		$('.tabs_list li').removeClass('active');
		$(this).closest('li').addClass('active');
	});
	
	$(".ui-datepicker-trigger").click(function(){
		
		$('#availe_1').show();
		
	});
	
	/*Form Submission Validation Starts*/
	$("#enquiry_form").submit(function(){
		//alert('Hey');
		var errormsg = "";
		var error = true;
		var name = $("#name").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var message = $("#message").val();
		//var tand_c_check = $("#tand_c_check").val();
		//alert(tand_c_check);
		if(name == ""){
			$("#nameerrmsg").text('Please enter name').css('color','#fff').show();
			error = false;
		}else{
			$("#nameerrmsg").text('');
			$("#nameerrmsg").hide();
		}
		
		if(email == ""){
			$("#emailerrmsg").text('Please enter an email').css('color','#fff').show();;
			error = false;
		}else{
			if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)){
				$("#emailerrmsg").text('Please enter valid email').css('color','#fff').show();;
				error = false;
			}else{
				$("#emailerrmsg").text('');
				$("#emailerrmsg").hide();
			}
		}
		
		if(phone != "" && !/^[0-9\s]{10,16}/.test(phone)){ 
			$("#mobileerrmsg").text('Please enter valid phone number').css('color','#fff').show();;
			error = false;
		}else{
			$("#mobileerrmsg").text('');
			$("#mobileerrmsg").hide();
		}
		
		if(message == ""){
			$("#messageerrmsg").text('Please enter message').css('color','#fff').show();
			error = false;
		}else{
			$("#messageerrmsg").text('');
			$("#messageerrmsg").hide();
		}
		
		if($('#tand_c_check').is(':checked')) {
			$("#tand_c_checkerrmsg").text('');
			$("#tand_c_checkerrmsg").hide();
		}else{
			$("#tand_c_checkerrmsg").text('Please agree terms and conditions').css('color','#fff').show();
			error = false;
		}
		
		if(error == true){
			$.ajax({
				url:'<?php echo SITEURL?>submit_enquiry.php',
				type:'POST',
				data:$('#enquiry_form').serialize(),
				cache:false,
				async:false,
				success:function(html){
					html = html.trim();
					//alert(html);
					if(html == "success"){
						window.location.href="<?php echo SITEURL;?>thanks";
					}else{
						$("#errocc").html('Some error occured').css('color','red')
					}
				}
			});
			
		}else{	
			return error;
		}
	});
	
	/*Form Submission Validation Ends*/
	
	$( ".txtOnly" ).keypress(function(e) {
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});
	
	var window_width = $(window).width();
	if(window_width<992)
	{
	
if(window_width>767)
{
	var fix_width = parseFloat(window_width-60);
	$('#map_canvas').css('width',fix_width);	

}
else
{
	var fix_width = parseFloat(window_width-70);
	$('#map_canvas_1').css('width',fix_width);
}
	}
	
	
});
 var disableddates = <?php echo $booked_dates;?>
   
  function DisableSpecificDates(date){
  	var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    return [disableddates.indexOf(string) == -1];
  }
  
  function isNumber(evt) {
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
		return false;
	return true;
 } 
 
 $(document).ready(function()
 {
 	function toggleIcon(e) {
		
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa-plus fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
 });
</script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/bootstrap.min.js"></script>
<!-- Start from here-->
<div class="clearfix"></div>
<?php 
if(!empty($_GET['id']) && !empty($_GET['slug'])){
	$getPropertyById = getPropertyById($_GET['id'],$_GET['slug']);
	//echo "<pre>"; print_r($getPropertyById);
	if(!empty($getPropertyById)){
		if($getPropertyById[0]->status == 'f' || $getPropertyById[0]->user_availability_status == 'f'){
			$location = get_site_url() . "/";
			wp_redirect( $location, 301 );
			exit; 
		}
?>
<div id="content-outer">
<div id="content-full" class="grid col-940">
<div class="new_view_prpty">
  <div class="col-md-12">
    <div class="heading_bg"><?php echo stripslashes($getPropertyById[0]->title);?></div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-8 col-sm-12 carousel_outer">
    <div class="col-md-12 prpty_msg"><?php echo stripslashes($getPropertyById[0]->description);?></div>
    <div class="clearfix"></div>
    <?php 
$getImagesOfProperty = getImagesOfProperty($getPropertyById[0]->id);
//echo "<pre>"; print_r($getImagesOfProperty); exit;
if(!empty($getImagesOfProperty)){
?>
    <div id="myCarousel" class="owl-carousel owl-theme propty_feat_image">
      <!-- Indicators 
  <ol class="carousel-indicators">
    <?php
	$i=0;
	foreach($getImagesOfProperty as $getImagesOfProperty){
		if($getImagesOfProperty->
      image != "" && file_exists('./images/property_images/'.$getImagesOfProperty->image)){
      ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $i?>" <?php if($i==0){?>class="active" <?php }?>></li>
      <?php 
		}
		++$i;
	}
	?>
      </ol>
      -->
      <!-- Wrapper for slides -->
      <?php 
	$getImagesOfProperty = getImagesOfProperty($getPropertyById[0]->id);
	$j=0;
	foreach($getImagesOfProperty as $getImagesOfProperty){
		if($getImagesOfProperty->image != "" && file_exists('./images/property_images/'.$getImagesOfProperty->image)){
	?>
      <div class="item <?php if($j==0){ echo "active"; }?>" style="background:url('<?php echo SITEURL;?>images/property_images/<?php echo $getImagesOfProperty->image;?>'); background-size:cover;"> <!--<img src="" alt="<?php // echo stripslashes($getPropertyById[0]->title);?>" width="833" height="420"/>--> </div>
      <?php
	++$j;
	}
	}
	?>
    </div>
    <?php 
}
?>
  </div>
  <div class="col-md-4 col-sm-12 form_box_vi">
   <?php 
	  if(isset($_SESSION['name']) && $_SESSION['name'] != ""){
	  ?>
    <div class="form_inner">
    
      <div class="heading_cnct_now">Connect Now</div>
      <span id="errocc"></span>
     
	  <form action="javascript:void(0)" method="post" id="enquiry_form" class="view_prpty_form">
        <input type="hidden" name="property_id" value="<?php echo $_GET['id'];?>"/>
        <div class="form-group po_relative">
          <input type="text" placeholder="Name" id="name" name="name" value="<?php echo $_SESSION['name'];?>" class="form-control field_view txtOnly">
          <span id="nameerrmsg" class="error_msg_"></span> </div>
        <div class="form-group po_relative">
          <input type="hidden" placeholder="Email" id="email" name="email" value="<?php echo $_SESSION['email'];?>" class="form-control field_view">
          <span id="emailerrmsg" class="error_msg_"></span> </div>
        <div class="form-group po_relative">
          <input type="hidden" placeholder="Phone No." id="phone" name="phone" value="<?php echo $_SESSION['mobile'];?>" class="form-control field_view" onkeypress="return isNumber(event);" maxlength="15">
          <span id="mobileerrmsg" class="error_msg_"></span> </div>
        <div class="form-group po_relative">
          <textarea class="form-control field_view cnct_nw_msg_box" id="message" name="message" placeholder="Message" maxlength="150"></textarea>
          <span id="messageerrmsg" class="error_msg_"></span> </div>
        <div class="form-group t_and_c po_relative">
          <input type="checkbox" id="tand_c_check" value="t">
          <label for="tand_c_check">Terms &amp; Condition</label>
          <span id="tand_c_checkerrmsg" class="error_msg_"></span> </div>
        <div class="form-group submit_btn_box">
          <input type="submit" value="SUBMIT" id="submit_enquiry_button" class="btn btn-submit">
        </div>
      </form>
	 
    </div>
     <?php 
	  }else{
	  ?>
	  <p class="" id="login_txt__">Please <a href="<?php echo SITEURL?>login">Login</a> to Connect</p>
	  <?php
	  }
	  ?>
  </div>
  <div class="col-md-12 form_bottom_box">
    <ul class="facilities_list clearfix">
      <li>
        <?php
		$busdistdesk = "";
		$traindistdesk = "";
		$schooldistdesk = "";
		$grocerydistdesk = "";
		if($getPropertyById[0]->near_by_busstop != "" && $getPropertyById[0]->unitbusstopdist != ""){
			if($getPropertyById[0]->unitbusstopdist == "Kms"){
				$busdistdesk = "Kms";
			}else{
				$busdistdesk = "Miles";
			}
			$bus = $getPropertyById[0]->near_by_busstop." ".$busdistdesk;
		}else{
			$bus = "N/A";
		}
		?>
        <i class="fa fa-bus"></i> <?php echo $bus;?> </li>
      <li>
        <?php 
		if($getPropertyById[0]->near_by_station != "" && $getPropertyById[0]->unittraindist != ""){
			if($getPropertyById[0]->unittraindist == "Kms"){
				$traindistdesk = "Kms";
			}else{
				$traindistdesk = "Miles";
			}
			$train = $getPropertyById[0]->near_by_station." ".$traindistdesk;
		}else{
			$train = "N/A";
		}
		?>
        <i class="fa fa-train"></i> <?php echo $train;?> </li>
		<li>
        <?php 
		if($getPropertyById[0]->near_by_school != "" && $getPropertyById[0]->unitschooldist != ""){
			if($getPropertyById[0]->unitschooldist == "Kms"){
				$schooldistdesk = "Kms";
			}else{
				$schooldistdesk = "Miles";
			}
			$school = $getPropertyById[0]->near_by_school." ".$schooldistdesk;
		}else{
			$school = "N/A";
		}
		?>
        <i class="fa fa-graduation-cap"></i> <?php echo $school;?> </li>
      <li>
        <?php 
		if($getPropertyById[0]->near_by_grocery != "" && $getPropertyById[0]->unitgrocerydist != ""){
			if($getPropertyById[0]->unitgrocerydist == "Kms"){
				$grocerydistdesk = "Kms";
			}else{
				$grocerydistdesk = "Miles";
			}
			$grocery = $getPropertyById[0]->near_by_grocery." ".$grocerydistdesk;
		}else{
			$grocery = "N/A";
		}
		?>
        <i class="fa fa-shopping-cart"></i> <?php echo $grocery;?> </li>
    </ul>
    <div class="tabs_box hide_tbs_mobile_">
      <ul class="tabs_list clearfix">
        <li data="amenities_tabs" class="active">Amenities </li>
        <li data="location_tab_box">Location</li>
        <li data="availe_">
          <input type="hidden" id="datepicker1"/>
          Availability</li>
        <li data="near_by">Nearby</li>
      </ul>
      <div class="tabs_box_in">
        <div class="col-md-12 tabs_inner_" id="amenities_tabs">
          <div class="tab_heading">Property Features</div>
          <ul class="amin_list clearfix">
            <?php 
			if($getPropertyById[0]->is_washing == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-1.png"> Washing Machine</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_dishwasher == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/dishwaser-green.png" class="glass_icon_dshwshr"> Dishwasher</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_microwave == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/micr.png"> Microwave</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_parking == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-6.png"> Parking</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_centralheating == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-7.png"> Central Heating</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->house_alarm == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/house-alarm-green.png"> House Alarm</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_cable == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-8.png"> Satellite TV</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_wifi == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-3.png"> Wifi</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_garden == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-2.png"> Garden</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_dryer == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/dryer-1.png"> Dryer</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->is_ac == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-9.png"> Air Conditioning</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->pets == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/pets-51.png"> Pets Allowed</li>
            <?php 
			}
			?>
            <?php 
			if($getPropertyById[0]->nosmoking == "t"){
			?>
            <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/no-smoking-green.png"> No Smoking</li>
            <?php 
			}
			?>
          </ul>
        </div>
        <div class="col-md-12 tabs_inner_ " id="location_tab_box">
          <div class="tab_heading"></div>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>
          <script type="text/javascript">
				 if($(window).width()>767)
				 {
					var map;
					function getMap(){
						var myLatlng = new google.maps.LatLng(<?php echo $getPropertyById[0]->latitude;?>,<?php echo $getPropertyById[0]->longitude?>);
						var myOptions = {
							 zoom: 15,
							 center: myLatlng,
							 mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
						
						 var marker = new google.maps.Marker({
							draggable: false,
							position: myLatlng, 
							map: map,
							title: "<?php echo $getPropertyById[0]->title;?>",
							icon: "<?php echo SITEURL;?>images/mapicon.png"
						  });
						  
						 /*google.maps.event.addListener(marker, 'dragend', function (event){
						   document.getElementById("latbox").value = this.getPosition().lat();
						   document.getElementById("lngbox").value = this.getPosition().lng();
						});*/
						return false;
					}
				 }
				</script>
          <div id="map_canvas" style="width:100%; height:400px"></div>
        </div>
        <div class="col-md-12 tabs_inner_" id="availe_">
          <div class="tab_heading">Availability</div>
          <div class="info_outer">
            <div class="inline_info">
              <div id="square_available"></div>
              Available Dates</div>
            <div class="inline_info">
              <div id="square_not_available"></div>
              Booked or Unavailable Dates </div>
          </div>
        </div>
        <div class="col-md-12 tabs_inner_" id="near_by">
          <div class="tab_heading"> Near By </div>
          <ul class="nearest_place_list clearfix">
            <li>
              <?php 
				if($getPropertyById[0]->near_by_busstop != "" && $getPropertyById[0]->unitbusstopdist != ""){
					$bus1 = $getPropertyById[0]->near_by_busstop." ".$busdistdesk;
					$busname = $getPropertyById[0]->near_by_busstop_name;
				}else{
					$bus1 = "N/A";
					$busname = "";
				}
				?>
              <i class="fa fa-bus"></i>Bus Stop : <?php echo $busname;?> <?php echo $bus1;?> </li>
            <li>
              <?php 
				if($getPropertyById[0]->near_by_station != "" && $getPropertyById[0]->unittraindist != ""){
					$train1 = $getPropertyById[0]->near_by_station." ".$traindistdesk;
					$trainname = $getPropertyById[0]->near_by_station_name;
				}else{
					$train1 = "N/A";
					$trainname = "";
				}
				?>
              <i class="fa fa-train"></i>Railway Station : <?php echo $trainname;?> <?php echo $train1;?> </li>
			  <li>
              <?php 
				if($getPropertyById[0]->near_by_school != "" && $getPropertyById[0]->unitschooldist != ""){
					$school1 = $getPropertyById[0]->near_by_school." ".$schooldistdesk;
					$schoolname = $getPropertyById[0]->near_by_school_name;
				}else{
					$school1 = "N/A";
					$schoolname = "";
				}
				?>
              <i class="fa fa-graduation-cap"></i>School : <?php echo $schoolname;?> <?php echo $school1;?> </li>
            <li>
              <?php 
				if($getPropertyById[0]->near_by_grocery != "" && $getPropertyById[0]->unitgrocerydist != ""){
					$grocery1 = $getPropertyById[0]->near_by_grocery." ".$grocerydistdesk;
					$groceryname = $getPropertyById[0]->near_by_grocery_name;
				}else{
					$grocery1 = "N/A";
					$groceryname = "";
				}
			?>
              <i class="fa fa-shopping-cart"></i>Grocery Shop : <?php echo $groceryname;?> <?php echo $grocery1;?> </li>
            <!--<li>
              <?php 
				if($getPropertyById[0]->near_by_hospital != "" && $getPropertyById[0]->unithospitaldist != ""){
					$hospital1 = $getPropertyById[0]->near_by_hospital." ".$getPropertyById[0]->unithospitaldist;
				}else{
					$hospital1 = "N/A";
				}
				?>
              <i class="fa fa-bed"></i> Nearest Hospital : <?php echo $hospital1;?> </li>-->
            
          </ul>
        </div>
      </div>
    </div>
    <div class="default-tab show_tab_mobile view_mobile">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingone">
            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseone" aria-expanded="false" aria-controls="collapseone"> <i class="more-less fa fa-plus"></i> Amenities </a> </h4>
          </div>
          <div id="collapseone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingone">
            <div class="panel-body">
              <div class="col-md-12">
                <div class="tab_heading">Property Features</div>
                <ul class="amin_list clearfix">
                  <?php 
	if($getPropertyById[0]->is_washing == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-1.png"> Washing Machine</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_dishwasher == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/dishwaser-green.png"> Dishwasher</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_microwave == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/micr.png"> Microwave</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_parking == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-6.png"> Parking</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_centralheating == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-7.png"> Central Heating</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->house_alarm == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/house-alarm-green.png"> House Alarm</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_cable == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-8.png"> Satellite TV</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_wifi == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-3.png"> Wifi</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_garden == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-2.png"> Garden</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_dryer == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/dryer-1.png"> Dryer</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->is_ac == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/amin-9.png"> Air Conditioning</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->pets == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/pets-51.png"> Pets Allowed</li>
                  <?php 
	}
	?>
                  <?php 
	if($getPropertyById[0]->nosmoking == "t"){
	?>
                  <li><img src="https://reinventdigital.com/demo/listingwebsite/wp-content/uploads/2018/05/no-smoking-green.png"> No Smoking</li>
                  <?php 
	}
	?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingtwo">
            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwo" aria-expanded="false" aria-controls="collapsetwo"> <i class="more-less fa fa-plus"></i> Location </a> </h4>
          </div>
          <div id="collapsetwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingtwo">
            <div class="panel-body">
              <div class="col-md-12" id="">
                <div class="tab_heading"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>
                <script type="text/javascript">
				 
				 if($(window).width()<=767)
				 {
					var map;
					function getMap(){
						var myLatlng = new google.maps.LatLng(<?php echo $getPropertyById[0]->latitude;?>,<?php echo $getPropertyById[0]->longitude?>);
						var myOptions = {
							 zoom: 15,
							 center: myLatlng,
							 mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						map = new google.maps.Map(document.getElementById("map_canvas_1"), myOptions);
						
						 var marker = new google.maps.Marker({
							draggable: false,
							position: myLatlng, 
							map: map,
							title: "<?php echo $getPropertyById[0]->title;?>",
							icon: "<?php echo SITEURL;?>images/mapicon.png"
						  });
						  
						 /*google.maps.event.addListener(marker, 'dragend', function (event){
						   document.getElementById("latbox").value = this.getPosition().lat();
						   document.getElementById("lngbox").value = this.getPosition().lng();
						});*/
						return false;
					}
				 }
				</script>
                <div id="map_canvas_1" style="width:100%; height:400px"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <i class="more-less fa fa-plus"></i>
              <input type="hidden" id="datepicker2"/>
              Availability </a> </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
              <div class="col-md-12" id="availe_1">
                <div class="tab_heading">Availability</div>
                <div class="info_outer">
                  <div class="inline_info">
                    <div id="square_available"></div>
                    Available Dates</div>
                  <div class="inline_info">
                    <div id="square_not_available"></div>
                    Booked or Unavailable Dates </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingfour">
            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour"> <i class="more-less fa fa-plus"></i> Nearby </a> </h4>
          </div>
          <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
              <div class="col-md-12">
                <div class="tab_heading"> Near By </div>
                <ul class="nearest_place_list clearfix">
                  <li>
                    <?php 
					if($getPropertyById[0]->near_by_busstop != "" && $getPropertyById[0]->unitbusstopdist != ""){
						$bus1 = $getPropertyById[0]->near_by_busstop." ".$busdistdesk;
						$busname = $getPropertyById[0]->near_by_busstop_name;
					}else{
						$bus1 = "N/A";
						$busname = "";
					}
					?>
                    <i class="fa fa-bus"></i>Bus Stop : <?php echo $busname;?> <?php echo $bus1;?> </li>
                  <li>
                    <?php 
					if($getPropertyById[0]->near_by_station != "" && $getPropertyById[0]->unittraindist != ""){
						$train1 = $getPropertyById[0]->near_by_station." ".$traindistdesk;
						$trainname = $getPropertyById[0]->near_by_station_name;
					}else{
						$train1 = "N/A";
						$trainname = "";
					}
					?>
		<i class="fa fa-train"></i>Railway Station : <?php echo $trainname;?> <?php echo $train1;?> </li>
		<li>
		<?php 
		if($getPropertyById[0]->near_by_school != "" && $getPropertyById[0]->unitschooldist != ""){
			$school1 = $getPropertyById[0]->near_by_school." ".$schooldistdesk;
			$schoolname = $getPropertyById[0]->near_by_school_name;
		}else{
			$school1 = "N/A";
			$schoolname = "";
		}
		?>
		<i class="fa fa-graduation-cap"></i>School : <?php echo $schoolname;?> <?php echo $school1;?> </li>
	  <li>
		<?php 
		if($getPropertyById[0]->near_by_grocery != "" && $getPropertyById[0]->unitgrocerydist != ""){
			$grocery1 = $getPropertyById[0]->near_by_grocery." ".$grocerydistdesk;
			$groceryname = $getPropertyById[0]->near_by_school_name;
		}else{
			$grocery1 = "N/A";
			$groceryname = "";
		}
		?>
		<i class="fa fa-shopping-cart"></i>Grocery Shop : <?php echo $groceryname;?> <?php echo $grocery1;?> </li>
			  <!--<li>
				<?php 
				if($getPropertyById[0]->near_by_hospital != "" && $getPropertyById[0]->unithospitaldist != ""){
					$hospital1 = $getPropertyById[0]->near_by_hospital." ".$getPropertyById[0]->unithospitaldist;
				}else{
					$hospital1 = "N/A";
				}
				?>
				<i class="fa fa-bed"></i> Nearest Hospital : <?php echo $hospital1;?> </li>-->  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php 
  }else{
  	$location = get_site_url() . "/";
	wp_redirect( $location, 301 );
	exit;
  }
 }else{
 	$location = get_site_url() . "/";
	wp_redirect( $location, 301 );
	exit;
 }
?>
<script>
setInterval(function(){
    if($('#login_txt__ , #login_txt__ a').hasClass('divClassRed')){
        $('#login_txt__ , #login_txt__ a').addClass('divClassBlue').removeClass('divClassRed');
        
    }else{
               $('#login_txt__ , #login_txt__ a').addClass('divClassRed').removeClass('divClassBlue');
    }

},1000);
</script>
<?php get_footer(); ?>
