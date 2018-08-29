<?php
// Exit if accessed directly
if(!defined('ABSPATH')){
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Edit Property Page (no sidebar)
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

/*$getPropertyAvailableDates = getPropertyAvailableDates($_GET['id']);
$available_date_arr = array();
if(!empty($getPropertyAvailableDates)){
	$available_date_arr = explode(",",$getPropertyAvailableDates[0]->all_available_dates);
	if(!empty($booked_date_arr)){
		$available_date_arr = array_values(array_diff($available_date_arr,$booked_date_arr));
	}
}*/

//echo "DATA<pre>"; print_r($available_date_arr); exit;

?>
<style>
 .dp-highlight .ui-state-default {
	  background: #00CC00 !important;
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
//echo "<pre>"; print_r($_SESSION); exit;
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
	$page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
	exit;
}
$user_id = $_SESSION['user_id'];
//echo $user_id; exit; 
$getPropertyVendor = getPropertyVendor($_GET['id']);

//echo "Data 1 ".$getPropertyVendor[0]->added_by." Data 2 ".$_SESSION['user_id']; exit;

if(!empty($getPropertyVendor)){
	if($getPropertyVendor[0]->added_by != $_SESSION['user_id']){
		
		//echo "<pre>"; print_r($getPropertyVendor);
		
		
		//echo $_SESSION['user_id']; exit;
		
		//echo "Not your Property"; exit;
		//echo "Hi"; exit;
		$location1 = SITEURL . "/dashboard/";
		wp_redirect( $location1, 301 );
		exit;
	}
}else{
//echo "TEst2"; exit;
	//echo "Hello"; exit;
	//$location1 = SITEURL . "/dashboard/";
	//wp_redirect( $location1, 301 );
	//exit;
}
$getPropertyById = getPropertyByIdForVendor($_GET['id']);
//echo "<pre>"; print_r($getPropertyById); exit;
if(empty($getPropertyById)){
	//echo "Heya"; exit;
	$location1 = SITEURL . "/dashboard/";
	wp_redirect( $location1, 301 );
	exit;
}
?>
<link rel="stylesheet" href="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/css/tabstyle.css">
<script src="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/js/plugins.js"></script>
<script src="<?php echo SITEURL;?>/wp-content/themes/responsive-childtheme-master/core/js/ibox.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>
<script type="text/javascript">
var i = 1;
/*function getMap(){
	var latitude = $("#latitude").val();
	var longitude = $("#longitude").val();
	var propertyid = $("#addid").val();
	//alert(latitude+" "+longitude+" "+propertyid);
	window.location.href = "<?php echo SITEURL;?>getmapold.php?latitude="+latitude+"&longitude="+longitude+"&propertyid="+propertyid;
	return false;
}*/

function showName(i){
	$("#file_name_"+i).show();
	var fullPath = $("#img_"+i).val();
	if(fullPath){
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);
		filename = filename.substring(1);
	}
	$("#file_name_"+i).css("width","200px");
	$("#file_name_"+i).val(filename);
}

function mshowName(i){
	$("#file_name__"+i).show();
	var fullPath = $("#img__"+i).val();
	if(fullPath){
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);
		filename = filename.substring(1);
	}
	$("#file_name__"+i).css("width","100%");
	$("#file_name__"+i).css("margin-top","7%");
	$("#file_name__"+i).val(filename);
}

function getmm(){
	var j = getNoOfImages();
	//alert(j);
	var scntDiv = $('#p_scents');
	if(j<15 && j<=10){
		var html = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents");
		++i;
		var html3 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html3).appendTo("#p_scents");
		++i;
		var html4 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html4).appendTo("#p_scents");
		$("#add_more_field_btn").hide();
		$('.my_submit_photos').show();
		//alert(i);
		}
		else if(j<15 && j==11){
			var html = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents");
		++i;
		var html3 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html3).appendTo("#p_scents");
		$("#add_more_field_btn").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==12){
			var html = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents");
		$("#add_more_field_btn").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==13){
			var html = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents");
		$("#add_more_field_btn").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==14){
			var html = '<div class="col-12 col-md-9 appendar_desktp" id="tt_'+i+'"><label class="feat_img_lbl" for="img_'+i+'">Choose File<input name="image[]" id="img_'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="showName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name_'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents");
		$("#add_more_field_btn").hide();
		$('.my_submit_photos').show();
		}else{
			alert("You can't add more than 15 pics.");
		}
	return false;
}




/*mobile */


function getmm_(){
	var j = getNoOfImages();
	var scntDiv = $('#p_scents_');
	if(j<15 && j<=10){
		var html = '<div class="col-12 col-md-9 col-xs-12 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents_");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents_");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents_");
		++i;
		var html3 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html3).appendTo("#p_scents_");
		++i;
		var html4 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html4).appendTo("#p_scents_");
		$("#add_more_field_btn_").hide();
		$('.my_submit_photos').show();
		//alert(i);
		}else if(j<15 && j==11){
			var html = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents_");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents_");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents_");
		++i;
		var html3 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html3).appendTo("#p_scents_");
		$("#add_more_field_btn_").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==12){
			var html = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents_");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents_");
		++i;
		var html2 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html2).appendTo("#p_scents_");
		$("#add_more_field_btn_").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==13){
			var html = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents_");
		++i;
		var html1 = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html1).appendTo("#p_scents_");
		$("#add_more_field_btn_").hide();
		$('.my_submit_photos').show();
		}else if(j<15 && j==13){
			var html = '<div class="col-12 col-md-9 appendar_mobile" id="tt__'+i+'"><label class="feat_img_lbl" for="img__'+i+'">Choose File<input name="image[]" id="img__'+i+'" type="file" class="form-control" accept=".jpg,.jpeg,.png,.gif" onchange="mshowName('+i+')"></label><strong>&nbsp;</strong><input type="text" name="file_name_'+i+'" id="file_name__'+i+'" style="display:none" readonly></div>'
		$(html).appendTo("#p_scents_");
		$("#add_more_field_btn_").hide();
		$('.my_submit_photos').show();
		}else{
			alert("You can't add more than 15 pics.");
		}
	return false;
}


/* ends here*/

function setAsFeaturedImage(image,id){
	//alert('Image is '+image+" Id is "+id);
	if(image != "" && id != ""){
		$.ajax({
			url:'<?php echo SITEURL;?>set_as_featured_image.php',
			type:'POST',
			data:{image:image,id:id},
			async:false,
			cache:false,
			success:function(html){
				//alert(html);
				//location.reload();
				window.location.href = '<?php echo SITEURL?>edit-property/?id=<?php echo $getPropertyById[0]->id?>&type=photos';
			}
		});
		$("#featured_image_msg").html(html).css('color','green');
		$("#featured_image_msg_").html(html).css('color','green');
	}
	return false;
	
}


function deleteImage(image,id,property_id){
	var featured_image = '<?php echo $getPropertyById[0]->featured_image?>';
	//alert(featured_image);
	if(image != "" && id != "" && property_id != ""){
		if(image != featured_image){
			if(confirm('Are you sure to delete this image ?')){
				//window.location.href = "delete_property_image.php?id="+id+"&image="+image;
				window.location.href = "<?php echo SITEURL;?>delete-property-image/?image="+image+"&property_id="+property_id+"&id="+id;
			}
		}else{
			alert("Featured Image can't be deleted");
		}
	}
	return false;
}

function deleteFeaturedImage(image,property_id){
	//alert('Heii'+image+"  "+property_id);
	if(image != "" && property_id != ""){
		if(confirm('Are you sure to delete this image ?')){
			//window.location.href = "delete_property_image.php?id="+id+"&image="+image;
			window.location.href = "<?php echo SITEURL;?>delete-property-feature-image/?featured_image="+image+"&property_id="+property_id;
		}
	}else{
		//alert('tyrytrttrt');
	}
	return false;
}

function checkpostcode(postcode){
	if(postcode != ""){
		//alert("Post code from check post code "+postcode);
		$.ajax({
			url:'<?php echo SITEURL;?>checkpostcode.php',
			type:"POST",
			data:{postcode:postcode},
			cache:false,
			async:false,
			success:function(html){
				//alert("fdsa "+html);
				html = html.trim();
				if(html != ""){
					$("#save_address").removeAttr('disabled');
					$("#save_next_address").removeAttr('disabled');
					$("#wrong_postcode").html("");
					//alert("Postcode is "+postcode);
					$.ajax({
						url:'<?php echo SITEURL?>getaddress.php',
						type:'POST',
						data:{postcode:postcode},
						cache:false,
						async:false,
						success:function(result){
							//$("#wrong_postcode").html(result);
							//alert(result);
							hideMap();
							$("#location1").hide();
							$("#location3").hide();
							$("#location").show();
							$("#location2").show();
							$("#location").html(result);
							$("#location2").html(result);
						}
					});
				}else{
					$("#wrong_postcode").css('color','red');
					$("#wrong_postcode").html("Please enter correct or complete postcode");
					$("#save_address").attr('disabled','disabled');
					$("#save_next_address").attr('disabled','disabled');
				}
			}
		});
	}else{
		return "";
	}
}

function hideMap(){
	$(".get_map_link").hide();
	$("#map_canvas").hide();
}
</script>
<!-- Left Panel -->
<div class="clearfix additional_form_css">
  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
      <div id="main-menu" class="main-menu collapse navbar-collapse"> <span class="mobile_nav_icon"><i class="fa fa-bars"></i></span>
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
          <!--<li class=""><a href="<?php echo SITEURL?>my-properties"> <i class="menu-icon fa fa-building"></i>My Properties</a></li>-->
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
  </aside>
  <!-- /#left-panel -->
  <!-- Left Panel -->
  <!-- Right Panel -->
  <div id="right-panel" class="right-panel full_width_">
    <?php
		if(isset($_POST['submit']) || isset($_POST['save_next'])){
			//echo "<pre>"; print_r($_POST); exit;
			$updateProperty = updateProperty($_POST);
			if($updateProperty == "updated"){
				$_SESSION['info'] = "";
			}else if($updateProperty == "already"){
				$_SESSION['info'] = "<font color='#FF0000'>Looks like you have already advertised this property, please check if your property is pending for approval or change the title</font></font>";
			}else{
				$_SESSION['info'] = "";
			}
			if($_POST['type'] == "general"){
				if($_POST['save_next'] == "save_next"){
					if($updateProperty == "already"){
						$type = $_POST['type'];
					}else{
						$type = "facilities";
					}
				}else{
					$type = $_POST['type'];
				}
			}
			if($_POST['type'] == "facilities"){
				if($_POST['save_next'] == "save_next"){
					$type = "address";
				}else{
					$type = $_POST['type'];
				}
			}
			if($_POST['type'] == "address"){
				if($_POST['save_next'] == "save_next"){
					$type = "calendar";
				}else{
					$type = $_POST['type'];
				}
			}
			if($_POST['type'] == "calendar"){
				if($_POST['save_next'] == "save_next"){
					$type = "nearby";
				}else{
					$type = $_POST['type'];
				}
			}
			if($_POST['type'] == "nearby"){
				if($_POST['save_next'] == "save_next"){
					$type = "photos";
				}else{
					$type = $_POST['type'];
				}
			}
			if($_POST['type'] == "photos"){
				$_SESSION['info'] = "Your property has been submitted for review. We will get back to you within 24 hours";
				$type = "photos";
			}
			$_SESSION['longitude'] = "";
			$_SESSION['latitude'] = "";
			$_SESSION['county'] = "";
			$_SESSION['district'] = "";
			$_SESSION['country'] = "";
			$location1 = SITEURL . "/edit-property/?id=".$_GET['id']."&type=".$type;
			wp_redirect( $location1, 301 );
			exit;
		}
		?>
    <div class="content mt-12">
      <div class="animated fadeIn">
        <div class="row">
          <!--/.col-->
          <!--Start Tabs -->
          <div class="col-lg-12" style="padding: 0px 0px 0px 10px;">
            <div class="card">
              <div class="card-header">
                <h4><strong>Property Details</strong></h4>
              </div>
              <?php 
								  if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
								  ?>
              <span class="updated_msg"><?php echo stripslashes($_SESSION['info']); $_SESSION['info'] = "";?></span>
              <?php
								  }
								 ?>
              <div class="card-body">
                <div class="default-tab hide_tab_mobile">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <?php 
												$class = "active show";
												?>
                      <a class="nav-item nav-link <?php if($_GET['type'] == "general" || $_GET['type'] == ""){ echo $class;}?>" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">General</a> <a class="nav-item nav-link <?php if($_GET['type'] == "facilities"){ echo $class;}?>" id="nav-facilities-tab" data-toggle="tab" href="#nav-facilities" role="tab" aria-controls="nav-facilities" aria-selected="false">Facilities</a> <a class="nav-item nav-link <?php if($_GET['type'] == "address"){ echo $class;}?>" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Address</a> <a class="nav-item nav-link <?php if($_GET['type'] == "calendar"){ echo $class;}?>" id="nav-calendar-tab" data-toggle="tab" href="#nav-calendar" role="tab" aria-controls="nav-calendar" aria-selected="false">Availability Calendar</a> <a class="nav-item nav-link <?php if($_GET['type'] == "nearby"){ echo $class;}?>" id="nav-nearby-tab" data-toggle="tab" href="#nav-nearby" role="tab" aria-controls="nav-nearby" aria-selected="false">Near By</a> <a class="nav-item nav-link <?php if($_GET['type'] == "photos"){ echo $class;}?>" id="nav-photos-tab" data-toggle="tab" href="#nav-photo" role="tab" aria-controls="nav-photo" aria-selected="false">Photographs</a> </div>
                  </nav>
                  <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade <?php if($_GET['type'] == "general" || $_GET['type'] == ""){ echo $class;}?>" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                      <form action="" method="post" class="form-horizontal prpty_dtls_tbl" id="property_general_form_edit" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="general"/>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="name" class=" form-control-label">Property Type</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <?php 
								$getAllPropertyType = getAllPropertyType();
								//echo "<pre>"; print_r($getAllPropertyType); exit;
								if(!empty($getAllPropertyType)){
								?>
                              <select name="property_type" id="property_type" class="form-control input_width" >
                                <option value="">Select Property Type</option>
                                <?php 
								foreach($getAllPropertyType as $getAllPropertyType){
								?>
                                <option value="<?php echo $getAllPropertyType->id?>" <?php if($getPropertyById[0]->property_type_id == $getAllPropertyType->id){ echo "selected";}?>><?php echo stripslashes($getAllPropertyType->type);?></option>
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
                            <div class="col col-md-3">
                              <label for="name" class=" form-control-label">Title</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="title" name="title" placeholder="Enter Title..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->title);?>"  maxlength="200">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="description" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <textarea id="description" name="description" placeholder="Enter Description..." class="form-control" maxlength="2000" style="resize: none; width:100% !important;" rows="10" ><?php echo stripslashes($getPropertyById[0]->description);?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer" style="border:none; background:none;">
                          <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                          <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade <?php if($_GET['type'] == "facilities"){ echo $class;}?>" id="nav-facilities" role="tabpanel" aria-labelledby="nav-facilities-tab">
                      <form action="" method="post" class="form-horizontal" id="property_facilities_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="facilities"/>
                        <div class=" card-body card-block">
                          <div class="row form-group">
                            <!--<div class="col col-md-3"><label for="price" class=" form-control-label">Facilities</label></div> -->
                            <div class="col-12 col-md-12">
                              <ul class="facility_list clearfix">
                                <li> <i class="fa fa-archive"></i> Washing Machine
                                  <input id="" name="is_washing" type="checkbox" value="t" <?php if($getPropertyById[0]->is_washing == "t"){ echo "checked";}?>>
                                </li>
                                <li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/dishwashe.png" class="icon_img_dishwasr edit_minus_ico" /> Dishwasher
                                  <input id="" name="is_dishwasher" type="checkbox" value="t" <?php if($getPropertyById[0]->is_dishwasher == "t"){ echo "checked";}?>>
                                </li>
								<li> <i class="fa fa-tachometer"></i> Microwave
                                  <input id="" name="is_microwave" type="checkbox" value="t" <?php if($getPropertyById[0]->is_microwave == "t"){ echo "checked";}?>>
                                </li>
								<li> <i class="fa fa-car"></i> Parking
                                  <input id="" name="is_parking" type="checkbox" value="t" <?php if($getPropertyById[0]->is_parking == "t"){ echo "checked";}?>>
                                </li>
								<li> <i class="fa fa-certificate"></i> Central Heating
                                  <input id="" name="is_centralheating" type="checkbox" value="t" <?php if($getPropertyById[0]->is_centralheating == "t"){ echo "checked";}?>>
                                </li>
								<li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/house-alarm.png" class="icon_img_dishwasr" /> House Alarm
                                    <input id="" name="house_alarm" type="checkbox" value="t" <?php if($getPropertyById[0]->house_alarm == "t"){ echo "checked";}?>>
                                  </li>
								<li> <i class="fa fa-tv"></i> Satellite TV
                                  <input id="" name="is_cable" type="checkbox" value="t" <?php if($getPropertyById[0]->is_cable == "t"){ echo "checked";}?>>
                                </li>
								<li> <i class="fa fa-wifi"></i> Wi-Fi
                                  <input id="" name="is_wifi" type="checkbox" value="t" <?php if($getPropertyById[0]->is_wifi == "t"){ echo "checked";}?>>
                                </li>
                                <li> <i class="fa fa-tree"></i> Garden
                                  <input id="" name="is_garden" type="checkbox" value="t" <?php if($getPropertyById[0]->is_garden == "t"){ echo "checked";}?>>
                                </li>
                                <li> <i class="fa fa-bolt extra_margin_ico"></i> AC
                                  <input id="" name="is_ac" type="checkbox" value="t" <?php if($getPropertyById[0]->is_ac == "t"){ echo "checked";}?>>
                                </li>
                                <li> <i class="fa fa-anchor"></i> Dryer
                                  <input id="" name="is_dryer" type="checkbox" value="t" <?php if($getPropertyById[0]->is_dryer == "t"){ echo "checked";}?>>
                                </li>
								<li> <i class="fa fa-paw"></i> Pets Allowed
                                  <input id="" name="pets" type="checkbox" value="t" <?php if($getPropertyById[0]->pets == "t"){ echo "checked";}?>>
                                </li>
								<li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/no-smoking.png" class="icon_img_dishwasr no_smking_ico" /> No Smoking  
                                  <input id="" name="nosmoking" type="checkbox" value="t" <?php if($getPropertyById[0]->nosmoking == "t"){ echo "checked";}?>>
                                </li>
                                
                              </ul>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="no_of_bedrooms" class=" form-control-label">Number of Bedrooms</label>
                            </div>
                            <div class="col-12 col-md-1">
								<?php 
								if($getPropertyById[0]->no_of_bedrooms != ""){
								 $no_of_bedrooms = $getPropertyById[0]->no_of_bedrooms;
								}else{
									$no_of_bedrooms = "1";
								}
								?>
                              <!--<input type="number" id="no_of_bedrooms" name="no_of_bedrooms" class="form-control" maxlength="1" value="<?php echo stripslashes($no_of_bedrooms);?>" min="1" max="5">-->
                            <select name="no_of_bedrooms" id="no_of_bedrooms" class="form-control">
								<option value="1" <?php if($no_of_bedrooms == 1){ echo "selected";}?>>1</option>
								<option value="2" <?php if($no_of_bedrooms == 2){ echo "selected";}?>>2</option>
								<option value="3" <?php if($no_of_bedrooms == 3){ echo "selected";}?>>3</option>
								<option value="4" <?php if($no_of_bedrooms == 4){ echo "selected";}?>>4</option>
								<option value="5" <?php if($no_of_bedrooms == 5){ echo "selected";}?>>5</option>
							</select>
							</div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="no_of_bathrooms" class=" form-control-label">Number of Bathrooms</label>
                            </div>
                            <div class="col-12 col-md-1">
                              <?php 
								if($getPropertyById[0]->no_of_bathrooms != ""){
								 $no_of_bathrooms = $getPropertyById[0]->no_of_bathrooms;
								}else{
									$no_of_bathrooms = "1";
								}
								?>
							  <!--<input type="number" id="no_of_bathrooms" name="no_of_bathrooms" class="form-control" maxlength="1" value="<?php echo stripslashes($no_of_bathrooms); ?>" min="1" max="5">-->
                            <select name="no_of_bathrooms" id="no_of_bathrooms" class="form-control">
								<option value="1" <?php if($no_of_bathrooms == 1){ echo "selected";}?>>1</option>
								<option value="2" <?php if($no_of_bathrooms == 2){ echo "selected";}?>>2</option>
								<option value="3" <?php if($no_of_bathrooms == 3){ echo "selected";}?>>3</option>
								<option value="4" <?php if($no_of_bathrooms == 4){ echo "selected";}?>>4</option>
								<option value="5" <?php if($no_of_bathrooms == 5){ echo "selected";}?>>5</option>
							</select>
							</div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="price" class=" form-control-label">Rent (&#xa3;)</label>
                            </div>
                            <div class="col-12 col-md-2">
                              <input type="text" id="price" name="price" placeholder="Enter Price..." class="form-control" maxlength="6" style="width:62% !important;" value="<?php echo stripslashes($getPropertyById[0]->price);?>" min="1" onkeypress="return isNumber(event);"/>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer" style="background:none; border:none;">
                          <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                          <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade <?php if($_GET['type'] == "address"){ echo $class;}?>" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                    <form action="" method="post" class="form-horizontal" id="property_address_form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="addid" value="<?php echo $getPropertyById[0]->id;?>"/>
                      <input type="hidden" name="type" id="type" value="address"/>
                      <div class="card-body card-block">
                        <div class="row form-group prpty_dtls_tbl">
							<div class="col col-md-2">
								<label for="postcode" class=" form-control-label">Postcode</label>
							</div>
							<div class="col-12 col-md-2 related_box" style="padding-left:0px;">
								<input type="text" id="postcode" name="postcode" placeholder="Enter Postcode..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->postcode);?>" maxlength="10" onBlur="checkpostcode(this.value);" style="margin: 0 auto;
    display: block; min-width:18%;">
								
							</div><div id="wrong_postcode"></div>
							<div class="col-12 col-md-2 related_box" style="padding:0px;">
								<button class="btn btn-primary btn-sm find_adrs_btn" type="button" onclick="hideMap();" style="margin-left: 18px;margin-top: 3px;">Find Address</button>
							</div>
							<div class="col-12 col-md-2" style="padding:0px;">
								<select name="location" id="location" class="form-control" <?php if($getPropertyById[0]->location != ""){?> style="display:none;"<?php }?> onchange="return showMapNow();">
									<option value="">Select your address</option>
								</select>
                           
						    <?php 
							$crrctLoc = $getPropertyById[0]->location;
							$ar = explode(",",$crrctLoc);
							//echo "Data<pre>"; print_r($ar);
							$countyloc = $ar[2];
							$ar2 = explode("-",$countyloc);
							//echo "Data<pre>"; print_r($ar2); exit;
							$showloc = $ar[0].",".$ar[1].",".$ar2[0];
							?>
                            <input type="text" id="location1" class="form-control" name="locationnew" value="<?php echo stripslashes($showloc);?>" <?php if($getPropertyById[0]->location == ""){?> style="display:none;"<?php }?> readonly/>
                            <!--<input type="text" id="location" name="location" placeholder="Enter Location..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->
                            location);?>" />--> </div>
						  
                        </div>
                        
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-2">
                            <label for="first_address_line" class=" form-control-label">Address Line 1</label>
                          </div>
                          <div class="col-12 col-md-4" style="padding:0px;">
                            <input type="text" id="first_address_line" name="first_address_line" placeholder="Enter First Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->first_address_line);?>" >
                          </div>
                        </div>
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-2">
                            <label for="second_address_line" class=" form-control-label">Address Line 2</label>
                          </div>
                          <div class="col-12 col-md-4" style="padding:0px;">
                            <input type="text" id="second_address_line" name="second_address_line" placeholder="Enter Second Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->second_address_line);?>" >
                          </div>
                        </div>
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-2">
                            <label for="third_address_line" class=" form-control-label">Address Line 3</label>
                          </div>
                          <div class="col-12 col-md-4" style="padding:0px;">
                            <input type="text" id="third_address_line" name="third_address_line" placeholder="Enter Third Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->third_address_line);?>" >
                          </div>
                        </div>
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-2">
                            <label for="city" class=" form-control-label">Town</label>
                          </div>
                          <div class="col-12 col-md-4" style="padding:0px;">
                            <input type="text" id="city" name="city" placeholder="Enter Town" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->city);?>" >
                          </div>
                        </div>
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-2">
                            <label for="county" class=" form-control-label">County</label>
                          </div>
                          <div class="col-12 col-md-4" style="padding:0px;">
                            <input type="text" id="county" name="county" placeholder="Enter County" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->county);?>" >
                          </div>
                        </div>
                        <!--<div class="row form-group">

															<div class="col col-md-3"><label for="country" class=" form-control-label">Country</label></div>

															<?php 

															if($getPropertyById[0]->
                        country != ""){
                        
                        $country = $getPropertyById[0]->country;
                        
                        }else{
                        
                        $country = $_SESSION['country'];
                        
                        }
                        
                        ?>
                        <div class="col-12 col-md-9">
                          <input type="text" id="country" name="country" placeholder="Enter Country" class="form-control" value="<?php echo stripslashes($country);?>" required>
                        </div>
                      </div>
                      -->
                      <input size="20" type="hidden" id="latbox" name="latitude" value="<?php echo $getPropertyById[0]->latitude?>">
                      <input size="20" type="hidden" id="lngbox" name="longitude" value="<?php echo $getPropertyById[0]->longitude?>">
                      <div class="row form-group" id="mapdiv" <?php if($getPropertyById[0]->postcode == ""){ ?>style="display:none;"<?php } ?>>
                        <div class="col col-md-3">
                          <label for="map" class=" form-control-label">Map</label>
                        </div>
                        <div class="col-12 col-md-9"><br />
                          <?php 
							if($getPropertyById[0]->latitude == "" && $getPropertyById[0]->longitude == ""){
								if($_SESSION['latitude'] != "" && $_SESSION['longitude'] != ""){
									$latitude = $_SESSION['latitude'];
									$longitude = $_SESSION['longitude'];
								}else{
									$latitude = 51.7920669594304;
									$longitude = 0.630501346634837;
								}
							}else{
								$latitude = $getPropertyById[0]->latitude;
								$longitude = $getPropertyById[0]->longitude;
							}
							?>
                          <a href="#" id="gmaplink" onClick="return getMap();" class="btn btn-success btn-sm get_map_link">Get Map</a>
                          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>
                          <script type="text/javascript">
																	var map;
																	function getMap(){
																		var latitude = $("#latbox").val();
																		var longitude = $("#lngbox").val();
																		$("#map_canvas").show();
																		//alert("Latitude is "+latitude+" Longitude is "+longitude);
																		var myLatlng = new google.maps.LatLng(latitude,longitude);
																		var myOptions = {
																			 zoom: 15,
																			 center: myLatlng,
																			 mapTypeId: google.maps.MapTypeId.ROADMAP
																		}
																		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
																		 var marker = new google.maps.Marker({
																			draggable: true,
																			position: myLatlng, 
																			map: map,
																			title: "<?php echo stripslashes($getPropertyById[0]->title);?>",
																			icon: "<?php echo SITEURL;?>images/mapicon.png"
																		  });
																		  google.maps.event.addListener(marker, 'dragend', function (event) {
																			document.getElementById("latbox").value = this.getPosition().lat();
																			document.getElementById("lngbox").value = this.getPosition().lng();
																			document.getElementById("latbox1").value = this.getPosition().lat();
																			document.getElementById("lngbox1").value = this.getPosition().lng();
																		});
																		return false;
																	}
																</script>
                          <div id="map_canvas" class="hide_show_map_box" style="width:100%; height:400px"></div>
                        </div>
                      </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" id="save_address" name="submit" class="btn btn-primary btn-sm" id="saveaddressbtn" value="save">
                        <i class="fa fa-dot-circle-o"></i> Save
                        </button>
                        <button type="submit" id="save_next_address" name="save_next" class="btn btn-primary btn-sm" id="savenextaddressbtn" value="save_next">
                        <i class="fa fa-dot-circle-o"></i> Save & Next
                        </button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade <?php if($_GET['type'] == "calendar"){ echo $class;}?>" id="nav-calendar" role="tabpanel" aria-labelledby="nav-calendar-tab">
                    <form action="" method="post" class="form-horizontal" id="property_calendar_form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                      <input type="hidden" name="type" id="type" value="calendar"/>
                      <div class="card-body card-block">
                        <div class="col-md-12">
                          <div class="row form-group prpty_dtls_tbl">
                            <!--<div class="col col-md-2">
                              <label for="available_from" class=" form-control-label">From</label>
                            </div>-->
                            <div class="col-12 col-md-12">
                              <div id="datesel"></div>
							 
							  <!--<input type="text" id="available_from" name="available_from" placeholder="Available From" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->available_from);?>" >-->
                            </div>
                          </div>
                        </div>
                        <!--<div class="col-md-5 col-md-offset-1">
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-2">
                              <label for="available_to" class=" form-control-label">To</label>
                            </div>
                            <div class="col-12 col-md-10">
                              <input type="text" id="available_to" name="available_to" placeholder="Available To" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->available_to);?>" >
                            </div>
                          </div>
                        </div>-->
                      </div>
					  
					<input type="hidden" name="available_from" id="checkinDate"/>
					<input type="hidden" name="available_to" id="checkoutDate">   
					  
                      <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                        <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                      </div>
					  
					 
					  
                    </form>
					
					 
					
                  </div>
				  
				  
				  
                  <div class="tab-pane fade <?php if($_GET['type'] == "nearby"){ echo $class;}?>" id="nav-nearby" role="tabpanel" aria-labelledby="nav-nearby-tab">
                    <form action="" method="post" class="form-horizontal" id="property_nearby_form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                      <input type="hidden" name="type" id="type" value="nearby"/>
                      <div class="card-body card-block">
					  
					  <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3">
                            <label for="near_by_busstop" class=" form-control-label">Near By Bus Stop</label>
                          </div>
						  <div class="col-12 col-md-4">
                              <input type="text" id="near_by_busstop_name" name="near_by_busstop_name" placeholder="Bus Stop Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_busstop_name);?>" maxlength="50">
                            </div>
                          <div class="prprty_det_dist">
                            <input type="text" id="near_by_busstop" name="near_by_busstop" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_busstop);?>" onkeypress="return isNumber(event);" maxlength="2">
                          </div>
                          <div class="prprty_det_dist">
                            <select name="unitbusstopdist" class="form-control">
							<option value="Meters" <?php if($getPropertyById[0]->unitbusstopdist == "Meters"){ echo "selected";}?>>Miles</option>
                              <option value="Kms" <?php if($getPropertyById[0]->unitbusstopdist == "Kms"){ echo "selected";}?>>Kms</option>
                              
                            </select>
                          </div>
                        </div>
					  
					  <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3">
                            <label for="near_by_station" class=" form-control-label">Near By Station</label>
                          </div>
						  <div class="col-12 col-md-4">
                              <input type="text" id="near_by_station_name" name="near_by_station_name" placeholder="Railway Station Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_station_name);?>" maxlength="50">
                            </div>
                          <div class="prprty_det_dist" >
                            <input type="text" id="near_by_station" name="near_by_station" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_station);?>" onkeypress="return isNumber(event);" maxlength="2">
                          </div>
                          <div class="prprty_det_dist" >
                            <select name="unittraindist" class="form-control">
							<option value="Meters" <?php if($getPropertyById[0]->unittraindist == "Meters"){ echo "selected";}?>>Miles</option>
                              <option value="Kms" <?php if($getPropertyById[0]->unittraindist == "Kms"){ echo "selected";}?>>Kms</option>
                              
                            </select>
                          </div>
                        </div>
					  
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3">
                            <label for="near_by_school" class=" form-control-label">Near By School</label>
                          </div>
						  <div class="col-12 col-md-4">
                              <input type="text" id="near_by_school_name" name="near_by_school_name" placeholder="School Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_school_name);?>" maxlength="50">
                            </div>
                          <div class="prprty_det_dist" >
                            <input type="text" id="near_by_school" name="near_by_school" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_school);?>" onkeypress="return isNumber(event);" maxlength="2">
                          </div>
                          <div class="prprty_det_dist" >
                            <select name="unitschooldist" class="form-control">
							<option value="Meters" <?php if($getPropertyById[0]->unitschooldist == "Meters"){ echo "selected";}?>>Miles</option>
                              <option value="Kms" <?php if($getPropertyById[0]->unitschooldist == "Kms"){ echo "selected";}?>>Kms</option>
							   
                            </select>
                          </div>
                        </div>
                        
                        
                        <!--<div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3">
                            <label for="near_by_hospital" class=" form-control-label">Near By Hospital</label>
                          </div>
                          <div class="col-12 col-md-2">
                            <input type="text" id="near_by_hospital" name="near_by_hospital" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_hospital);?>" onkeypress="return isNumber(event);">
                          </div>
                          <div class="col-12 col-md-2">
                            <select name="unithospitaldist" class="form-control">
                              <option value="Kms" <?php if($getPropertyById[0]->unithospitaldist == "Kms"){ echo "selected";}?>>Kms</option>
                              <option value="Meters" <?php if($getPropertyById[0]->unithospitaldist == "Meters"){ echo "selected";}?>>Meters</option>
                            </select>
                          </div>
                        </div>-->
                        <div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3" >
                            <label for="near_by_grocery" class=" form-control-label">Near By Grocery Shop</label>
                          </div>
						  <div class="col-12 col-md-4">
                              <input type="text" id="near_by_grocery_name" name="near_by_grocery_name" placeholder="Shop Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_grocery_name);?>" maxlength="50">
                            </div>
                          <div class="prprty_det_dist" >
                            <input type="text" id="near_by_grocery" name="near_by_grocery" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_grocery);?>" onkeypress="return isNumber(event);" maxlength="2">
                          </div>
                          <div class="prprty_det_dist" >
                            <select name="unitgrocerydist" class="form-control">
							<option value="Meters" <?php if($getPropertyById[0]->unitgrocerydist == "Meters"){ echo "selected";}?>>Miles</option>
                              <option value="Kms" <?php if($getPropertyById[0]->unitgrocerydist == "Kms"){ echo "selected";}?>>Kms</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                        <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                        <!--<button type="reset" class="btn btn-danger btn-sm">

													  <i class="fa fa-ban"></i> Reset

													</button>-->
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade <?php if($_GET['type'] == "photos"){ echo $class;}?>" id="nav-photo" role="tabpanel" aria-labelledby="nav-photos-tab">
					<div id="featured_image_msg"></div>
					<form action="" method="post" class="form-horizontal" id="property_photos_form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                      <input type="hidden" name="type" id="type" value="photos"/>
                      <div class="card-body card-block">
                        <!--<div class="row form-group prpty_dtls_tbl">
                          <div class="col col-md-3">
                            <label class=" form-control-label">Featured Image 1</label>
                          </div>
                          <?php 
						if($getPropertyById[0]->featured_image != "" && file_exists('./images/property_images/'.$getPropertyImages->featured_image)){
						?>
					  <div class="col-12 col-md-6 text-center feat_img_box_out"> <img src="<?php echo SITEURL;?>images/property_images/<?php echo $getPropertyById[0]->featured_image;?>"/><br/>
						<a href="#" onclick="return deleteFeaturedImage('<?php echo $getPropertyById[0]->featured_image;?>','<?php echo $getPropertyById[0]->id?>');" class="del_img_">Delete Featured Image</a> </div>
					  <?php 
							}else{
							?>
					  <div class="col-12 col-md-6">
						<label for="featured_image" class="feat_img_lbl">
						<input name="featured_image" id="featured_image" type="file" class="form-control image_uploader" accept=".jpg,.jpeg,.png,.gif">
						Choose File</label>
						[500px X 300px] </div>
					  <?php
						}
						?>
                        </div>-->
                        <div class="col-md-12 text-right add_mr_outer_">
                        <a href="#" id="add_more_field_btn" class="btn btn-primary btn-sm" onclick="return getmm();">Add Photos</a>
                        </div>
                        <div class="row form-group prpty_dtls_tbl add_more_tbl_btns">
                          <div class="col-12 col-md-9" id="p_scents">
                            <!--<label for="image_chooser" class="feat_img_lbl"> Choose File
                            <input name="image[]" type="file" class="form-control image_uploader" accept=".jpg,.jpeg,.png,.gif" id="image_chooser">
                            </label>-->
                         
                          </div>
                           <div class="col-md-12">
                          <button type="submit" name="submit" class="btn btn-primary btn-sm my_submit_photos" value="save"> <i class="fa fa-dot-circle-o"></i> Submit </button></div>
                        </div>
						<?php 
						$getPropertyImages = getPropertyImages($getPropertyById[0]->id);
						$noOfImages = 0;
						if(!empty($getPropertyImages)){
						?>
						<div class="row form-group prpty_dtls_tbl col-md-12">
                          
                          <div class="col-md-12">
                            <ul class="imgs_list_feat clearfix">
                              <?php 
							//echo "<pre>"; print_r($getPropertyImages); exit;
								foreach($getPropertyImages as $getPropertyImages){
									if($getPropertyImages->image != "" && file_exists('./images/property_images/'.$getPropertyImages->image)){
										++$noOfImages;
									?>
                              <li> <img src="<?php echo SITEURL;?>images/property_images/<?php echo $getPropertyImages->image;?>" width="200" height="200"/><br/>
                                <span class="set_feat_img_" onclick="return setAsFeaturedImage('<?php echo $getPropertyImages->image;?>','<?php echo $_GET['id'];?>')"><input type="radio" class="" <?php if($getPropertyImages->image == $getPropertyById[0]->featured_image){ echo "checked";}?>/> Set as Featured Image</span>
								<a href="#" onClick="return deleteImage('<?php echo $getPropertyImages->image;?>','<?php echo $getPropertyImages->id?>','<?php echo $getPropertyById[0]->id?>')">Delete Image</a> </li>
                              <?php
									}
								}	
								?>
                            </ul>
                          </div>
                        </div>
						<?php 
						}
						?>
                        
                        <div class="card-footer col-md-12">
                          
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="default-tab show_tab_mobile">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <i class="more-less fa fa-plus"></i> General </a> </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse <?php if($_GET['type'] == "general" || $_GET['type'] == ""){ echo "show";}?>" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <form action="" method="post" class="form-horizontal prpty_dtls_tbl" id="property_general_form" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                          <input type="hidden" name="type" id="type" value="general"/>
                          <div class="card-body card-block">
                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="name" class=" form-control-label">Property Type</label>
                              </div>
                              <div class="col-12 col-md-9">
                                <?php 
																$getAllPropertyType = getAllPropertyType();
																//echo "<pre>"; print_r($getAllPropertyType); exit;
																if(!empty($getAllPropertyType)){
																?>
                                <select name="property_type" id="property_type" class="form-control " >
                                  <option value="">Select Property Type</option>
                                  <?php 
																	foreach($getAllPropertyType as $getAllPropertyType){
																	?>
                                  <option value="<?php echo $getAllPropertyType->id?>" <?php if($getPropertyById[0]->property_type_id == $getAllPropertyType->id){ echo "selected";}?>><?php echo stripslashes($getAllPropertyType->type);?></option>
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
                              <div class="col col-md-3">
                                <label for="name" class=" form-control-label">Title</label>
                              </div>
                              <div class="col-12 col-md-9">
                                <input type="text" id="title" name="title" placeholder="Enter Title..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->title);?>"  maxlength="30">
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="description" class=" form-control-label">Description</label>
                              </div>
                              <div class="col-12 col-md-9">
                                <textarea id="description" name="description" placeholder="Enter Description..." class="form-control" maxlength="300" style="resize: none;" rows="6"><?php echo stripslashes($getPropertyById[0]->description);?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer" style="border:none; background:none;">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                            <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <i class="more-less fa fa-plus"></i> Facilities </a> </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse <?php if($_GET['type'] == "facilities"){ echo "show";}?>" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        <form action="" method="post" class="form-horizontal" id="property_facilities_form" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                          <input type="hidden" name="type" id="type" value="facilities"/>
                          <div class="card-body card-block">
                            <div class="row form-group">
                              <!--<div class="col col-md-3"><label for="price" class=" form-control-label">Facilities</label></div> -->
                              <div class="col-12 col-md-12">
                                <ul class="facility_list clearfix">
                                  <li> <i class="fa fa-archive"></i> Washing Machine
                                    <input id="" name="is_washing" type="checkbox" value="t" <?php if($getPropertyById[0]->is_washing == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/dishwashe.png" class="icon_img_dishwasr edit_minus_ico" /> Dishwasher
                                    <input id="" name="is_dishwasher" type="checkbox" value="t" <?php if($getPropertyById[0]->is_dishwasher == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-tachometer"></i> Microwave
                                    <input id="" name="is_microwave" type="checkbox" value="t" <?php if($getPropertyById[0]->is_microwave == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-car"></i> Parking
                                    <input id="" name="is_parking" type="checkbox" value="t" <?php if($getPropertyById[0]->is_parking == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-certificate"></i> Central Heating
                                    <input id="" name="is_centralheating" type="checkbox" value="t" <?php if($getPropertyById[0]->is_centralheating == "t"){ echo "checked";}?>>
                                  </li>
								   <li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/house-alarm.png" class="icon_img_dishwasr mobile_house_alrm" /> House Alarm
                                    <input id="" name="house_alarm" type="checkbox" value="t" <?php if($getPropertyById[0]->house_alarm == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-tv"></i> Satellite TV
                                    <input id="" name="is_cable" type="checkbox" value="t" <?php if($getPropertyById[0]->is_cable == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-wifi"></i> Wi-Fi
                                    <input id="" name="is_wifi" type="checkbox" value="t" <?php if($getPropertyById[0]->is_wifi == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-tree"></i> Garden
                                    <input id="" name="is_garden" type="checkbox" value="t" <?php if($getPropertyById[0]->is_garden == "t"){ echo "checked";}?>>
                                  </li>
                                  <li> <i class="fa fa-bolt mobile_ac_ico"></i> AC
                                    <input id="" name="is_ac" type="checkbox" value="t" <?php if($getPropertyById[0]->is_ac == "t"){ echo "checked";}?>>
                                  </li>
                                  <li> <i class="fa fa-anchor"></i> Dryer
                                    <input id="" name="is_dryer" type="checkbox" value="t" <?php if($getPropertyById[0]->is_dryer == "t"){ echo "checked";}?>>
                                  </li>
								  <li> <i class="fa fa-paw"></i> Pets Allowed
                                  <input id="" name="pets" type="checkbox" value="t" <?php if($getPropertyById[0]->pets == "t"){ echo "checked";}?>>
                                </li>
								<li> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/05/no-smoking.png" class="icon_img_dishwasr mobile_no_smking" /> No Smoking
                                  <input id="" name="nosmoking" type="checkbox" value="t" <?php if($getPropertyById[0]->nosmoking == "t"){ echo "checked";}?>>
                                </li>
                                </ul>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="no_of_bedrooms" class=" form-control-label">Number of Bedrooms</label>
                              </div>
                              <div class="col-12 col-md-2">
                                <?php 
								if($getPropertyById[0]->no_of_bedrooms != ""){
								 $no_of_bedrooms = $getPropertyById[0]->no_of_bedrooms;
								}else{
									$no_of_bedrooms = "1";
								}
								?>
								<!--<input type="number" id="no_of_bedrooms" name="no_of_bedrooms" class="form-control" maxlength="1" value="<?php echo stripslashes($no_of_bedrooms);?>" min="1" max="5">-->
                              <select name="no_of_bedrooms" id="no_of_bedrooms" class="form-control">
								<option value="1" <?php if($no_of_bedrooms == 1){ echo "selected";}?>>1</option>
								<option value="2" <?php if($no_of_bedrooms == 2){ echo "selected";}?>>2</option>
								<option value="3" <?php if($no_of_bedrooms == 3){ echo "selected";}?>>3</option>
								<option value="4" <?php if($no_of_bedrooms == 4){ echo "selected";}?>>4</option>
								<option value="5" <?php if($no_of_bedrooms == 5){ echo "selected";}?>>5</option>
							</select>
							  </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="no_of_bathrooms" class=" form-control-label">Number of Bathrooms</label>
                              </div>
                              <div class="col-12 col-md-2">
                                 <?php 
								if($getPropertyById[0]->no_of_bathrooms != ""){
								 $no_of_bathrooms = $getPropertyById[0]->no_of_bathrooms;
								}else{
									$no_of_bathrooms = "1";
								}
								?>
							<!--<input type="number" id="no_of_bathrooms" name="no_of_bathrooms" class="form-control" maxlength="1" value="<?php echo stripslashes($no_of_bathrooms); ?>" min="1" max="5">-->
                              <select name="no_of_bathrooms" id="no_of_bathrooms" class="form-control">
								<option value="1" <?php if($no_of_bathrooms == 1){ echo "selected";}?>>1</option>
								<option value="2" <?php if($no_of_bathrooms == 2){ echo "selected";}?>>2</option>
								<option value="3" <?php if($no_of_bathrooms == 3){ echo "selected";}?>>3</option>
								<option value="4" <?php if($no_of_bathrooms == 4){ echo "selected";}?>>4</option>
								<option value="5" <?php if($no_of_bathrooms == 5){ echo "selected";}?>>5</option>
							</select>
							  </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="price" class=" form-control-label">Rent (&#xa3;)</label>
                              </div>
                              <div class="col-12 col-md-2">
                                <input type="text" id="price" name="price" placeholder="Enter Price..." class="form-control" maxlength="6" value="<?php echo stripslashes($getPropertyById[0]->price);?>" min="1" onkeypress="return isNumber(event);"/>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer" style="background:none; border:none;">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                            <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <i class="more-less fa fa-plus"></i> Address </a> </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse <?php if($_GET['type'] == "address"){ echo "show";}?>" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                      <form action="" method="post" class="form-horizontal" id="property_address_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="addid" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="address"/>
                        <div class="card-body card-block">
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="postcode" class=" form-control-label">Postcode</label>
                            </div>
                            <div class="col-12 col-md-9 related_box">
                              <input type="text" id="postcode" name="postcode" placeholder="Enter Postcode..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->postcode);?>" maxlength="10" onBlur="checkpostcode(this.value);" >
                              <div id="wrong_postcode"></div>
                            </div>
							 <div class="col-12 col-md-3 related_box">
								<button class="btn btn-primary btn-sm find_adrs_btn" type="button" onclick="hideMap();">Find Address</button>
							  </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <!--<div class="col col-md-3">
                              <label for="location" class=" form-control-label">Field Name</label>
                            </div>-->
                            <div class="col-12 col-md-9">
                              <select name="location" id="location2" class="form-control" style="display:none;">
                                <option value="">Select your address</option>
                              </select>
                              <?php 
								$crrctLoc = $getPropertyById[0]->location;
								$ar = explode(",",$crrctLoc);
								//echo "Data<pre>"; print_r($ar);
								$countyloc = $ar[2];
								$ar2 = explode("-",$countyloc);
								//echo "Data<pre>"; print_r($ar2); exit;
								$showloc = $ar[0].",".$ar[1].",".$ar2[0];
							?>
                              <input type="text" id="location3" class="form-control" name="locationnew" value="<?php echo stripslashes($showloc);?>" <?php if($getPropertyById[0]->location == ""){?> style="display:none;"<?php }?> readonly/>
                              <!--<input type="text" id="location" name="location" placeholder="Enter Location..." class="form-control" value="<?php echo stripslashes($getPropertyById[0]->
                              location);?>" />--> </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="first_address_line" class=" form-control-label">Address Line 1</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="first_address_line" name="first_address_line" placeholder="Enter First Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->first_address_line);?>" >
                            </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="second_address_line" class=" form-control-label">Address Line 2</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="second_address_line" name="second_address_line" placeholder="Enter Second Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->second_address_line);?>" >
                            </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="third_address_line" class=" form-control-label">Address Line 3</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="third_address_line" name="third_address_line" placeholder="Enter Third Address Line" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->third_address_line);?>" >
                            </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="city" class=" form-control-label">Town</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="city" name="city" placeholder="Enter Town" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->city);?>" >
                            </div>
                          </div>
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="county" class=" form-control-label">County</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="county" name="county" placeholder="Enter County" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->county);?>" >
                            </div>
                          </div>
                          <!--<div class="row form-group">

															<div class="col col-md-3"><label for="country" class=" form-control-label">Country</label></div>

															<?php 

															if($getPropertyById[0]->
                          country != ""){
                          
                          $country = $getPropertyById[0]->country;
                          
                          }else{
                          
                          $country = $_SESSION['country'];
                          
                          }
                          
                          ?>
                          <div class="col-12 col-md-9">
                            <input type="text" id="country" name="country" placeholder="Enter Country" class="form-control" value="<?php echo stripslashes($country);?>" required>
                          </div>
                        </div>
                        -->
                        <input size="20" type="hidden" id="latbox1" name="latitude" value="<?php echo $getPropertyById[0]->latitude?>">
                        <input size="20" type="hidden" id="lngbox1" name="longitude" value="<?php echo $getPropertyById[0]->longitude?>">
                        <div class="row form-group" id="mapdiv_" <?php if($getPropertyById[0]->postcode == ""){ ?>style="display:none;"<?php } ?>>
                          <div class="col col-md-3">
                            <label for="map" class=" form-control-label">Map</label>
                          </div>
                          <div class="col-12 col-md-9"><br />
                            <?php 
							if($getPropertyById[0]->latitude == "" && $getPropertyById[0]->longitude == ""){
								if($_SESSION['latitude'] != "" && $_SESSION['longitude'] != ""){
									$latitude = $_SESSION['latitude'];
									$longitude = $_SESSION['longitude'];
								}else{
									$latitude = 51.7920669594304;
									$longitude = 0.630501346634837;
								}
							}else{
								$latitude = $getPropertyById[0]->latitude;
								$longitude = $getPropertyById[0]->longitude;
							}
							?>
                            <!--<a href="<?php echo SITEURL;?>getmapold.php?latitude=<?php echo $latitude?>&longitude=<?php echo $longitude?>&propertyid=<?php echo $getPropertyById[0]->
                            id;?>" class="btn btn-success btn-sm" id="getmap">Get Map</a>--> 
                            <a href="#" onClick="return getMap1();" class="btn btn-success btn-sm get_map_btn_">Get Map</a>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkAz2dqQ8oXrfbqVHGP3B8tFD6dapqEuQ&sensor=true" type="text/javascript"></script>
                            <script type="text/javascript">
																	var map;
																	function getMap1(){
																		var latitude1 = $("#latbox1").val();
																		var longitude1 = $("#lngbox1").val();
																		//alert("Latitude is "+latitude1+" Longitude is "+longitude1);
																		$("#map_canvas1").show();
																		var myLatlng = new google.maps.LatLng(latitude1,longitude1);
																		var myOptions = {
																			 zoom: 15,
																			 center: myLatlng,
																			 mapTypeId: google.maps.MapTypeId.ROADMAP
																		}
																		map = new google.maps.Map(document.getElementById("map_canvas1"), myOptions);
																		 var marker = new google.maps.Marker({
																			draggable: true,
																			position: myLatlng, 
																			map: map,
																			title: "<?php echo stripslashes($getPropertyById[0]->title);?>",
																			icon: "<?php echo SITEURL;?>images/mapicon.png"
																		  });
																		  google.maps.event.addListener(marker, 'dragend', function (event) {
																			document.getElementById("latbox1").value = this.getPosition().lat();
																			document.getElementById("lngbox1").value = this.getPosition().lng();
																			document.getElementById("latbox").value = this.getPosition().lat();
																			document.getElementById("lngbox").value = this.getPosition().lng();
																		});
																		return false;
																	}
																</script>
                            <div id="map_canvas1" style="width:100%; height:400px"></div>
                          </div>
                        </div>
                        </div>
                        <div class="card-footer">
                          <button type="submit" id="save_address" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                          <button type="submit" id="save_next_address" name="save_next" class="btn btn-primary btn-sm"  value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingfour">
                    <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour"> <i class="more-less fa fa-plus"></i> Availability Calendar </a> </h4>
                  </div>
                  <div id="collapsefour" class="panel-collapse collapse <?php if($_GET['type'] == "calendar"){ echo "show";}?>" role="tabpanel" aria-labelledby="headingfour">
                    <div class="panel-body">
                      <form action="" method="post" class="form-horizontal" id="property_calendar_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="calendar"/>
                        <div class="card-body card-block">
						<div id="datesel1"></div>
                          <!--<div class="col-md-6">
                            <div class="row form-group prpty_dtls_tbl">
                              <div class="col col-md-2">
                                <label for="available_from_" class=" form-control-label">From</label>
                              </div>
                              <div class="col-12 col-md-10">
                                <input type="text" id="available_from_" name="available_from" placeholder="Available From" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->available_from);?>" >
                              </div>
                            </div>
                          </div>-->
                          <!--<div class="col-md-5 col-md-offset-1">
                            <div class="row form-group prpty_dtls_tbl">
                              <div class="col col-md-2">
                                <label for="available_to_" class=" form-control-label">To</label>
                              </div>
                              <div class="col-12 col-md-10">
                                <input type="text" id="available_to_" name="available_to" placeholder="Available To" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->available_to);?>" >
                              </div>
                            </div>
                          </div>-->
                        </div>
						
						<input type="hidden" name="available_from" id="checkinDate_"/>
						<input type="hidden" name="available_to" id="checkoutDate_"> 
						
                        <div class="card-footer">
                          <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                          <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingfive">
                    <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive"> <i class="more-less fa fa-plus"></i> Near By </a> </h4>
                  </div>
                  <div id="collapsefive" class="panel-collapse collapse <?php if($_GET['type'] == "nearby"){ echo "show";}?>" role="tabpanel" aria-labelledby="headingfive">
				  
                    <div class="panel-body">
                      <form action="" method="post" class="form-horizontal" id="property_nearby_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="nearby"/>
                        <div class="card-body card-block">
						<div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="near_by_busstop" class=" form-control-label">Near By Bus Stop</label>
                            </div>
							<div class="col-12 col-md-4">
                              <input type="text" id="near_by_busstop_name" name="near_by_busstop_name" placeholder="Bus Stop Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_busstop_name);?>" maxlength="50">
                            </div>
                            <div class="col-12 col-md-2">
                              <input type="text" id="near_by_busstop" name="near_by_busstop" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_busstop);?>" onkeypress="return isNumber(event);" maxlength="2">
                            </div>
                            <div class="col-12 col-md-2">
                              <select name="unitbusstopdist" class="form-control">
							  <option value="Meters" <?php if($getPropertyById[0]->unitbusstopdist == "Meters"){ echo "selected";}?>>Miles</option>
                                <option value="Kms" <?php if($getPropertyById[0]->unitbusstopdist == "Kms"){ echo "selected";}?>>Kms</option>
                                
                              </select>
                            </div>
                          </div>
						
							<div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="near_by_station" class=" form-control-label">Near By Station</label>
                            </div>
							<div class="col-12 col-md-4">
                              <input type="text" id="near_by_station_name" name="near_by_station_name" placeholder="Railway Station Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_station_name);?>" maxlength="50">
                            </div>
                            <div class="col-12 col-md-2">
                              <input type="text" id="near_by_station" name="near_by_station" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_station);?>" onkeypress="return isNumber(event);" maxlength="2">
                            </div>
                            <div class="col-12 col-md-2">
                              <select name="unittraindist" class="form-control">
							   <option value="Meters" <?php if($getPropertyById[0]->unittraindist == "Meters"){ echo "selected";}?>>Miles</option>
                                <option value="Kms" <?php if($getPropertyById[0]->unittraindist == "Kms"){ echo "selected";}?>>Kms</option>
                               
                              </select>
                            </div>
                          </div>
						
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="near_by_school" class=" form-control-label">Near By School</label>
                            </div>
                            <div class="col-12 col-md-4">
                              <input type="text" id="near_by_school_name" name="near_by_school_name" placeholder="School Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_school_name);?>" maxlength="50">
                            </div>
							<div class="col-12 col-md-2">
                              <input type="text" id="near_by_school" name="near_by_school" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_school);?>" onkeypress="return isNumber(event);" maxlength="2">
                            </div>
                            <div class="col-12 col-md-2">
                              <select name="unitschooldist" class="form-control">
							  <option value="Meters" <?php if($getPropertyById[0]->unitschooldist == "Meters"){ echo "selected";}?>>Miles</option>
                                <option value="Kms" <?php if($getPropertyById[0]->unitschooldist == "Kms"){ echo "selected";}?>>Kms</option>
								
                              </select>
                            </div>
                          </div>
                          <!--<div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label for="near_by_hospital" class=" form-control-label">Near By Hospital</label>
                            </div>
                            <div class="col-12 col-md-2">
                              <input type="text" id="near_by_hospital" name="near_by_hospital" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_hospital);?>" onkeypress="return isNumber(event);">
                            </div>
                            <div class="col-12 col-md-2">
                              <select name="unithospitaldist" class="form-control">
                                <option value="Kms" <?php if($getPropertyById[0]->unithospitaldist == "Kms"){ echo "selected";}?>>Kms</option>
                                <option value="Meters" <?php if($getPropertyById[0]->unithospitaldist == "Meters"){ echo "selected";}?>>Meters</option>
                              </select>
                            </div>
                          </div>-->
                          <div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3" style="padding-right:0px;">
                              <label for="near_by_grocery" class=" form-control-label">Near By Grocery Shop</label>
                            </div>
							<div class="col-12 col-md-2">
                              <input type="text" id="near_by_grocery_name" name="near_by_grocery_name" placeholder="Shop Name" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_grocery_name);?>" maxlength="50">
                            </div>
                            <div class="col-12 col-md-2">
                              <input type="text" id="near_by_grocery" name="near_by_grocery" placeholder="Distance" class="form-control" value="<?php echo stripslashes($getPropertyById[0]->near_by_grocery);?>" onkeypress="return isNumber(event);" maxlength="2">
                            </div>
                            <div class="col-12 col-md-2">
                              <select name="unitgrocerydist" class="form-control">
							   <option value="Meters" <?php if($getPropertyById[0]->unitgrocerydist == "Meters"){ echo "selected";}?>>Miles</option>
                                <option value="Kms" <?php if($getPropertyById[0]->unitgrocerydist == "Kms"){ echo "selected";}?>>Kms</option>
                               
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer">
                          <button type="submit" name="submit" class="btn btn-primary btn-sm" value="save"> <i class="fa fa-dot-circle-o"></i> Save </button>
                          <button type="submit" name="save_next" class="btn btn-primary btn-sm" value="save_next"> <i class="fa fa-dot-circle-o"></i> Save & Next </button>
                          <!--<button type="reset" class="btn btn-danger btn-sm">
						  <i class="fa fa-ban"></i> Reset
						</button>-->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingsix">
                    <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix"> <i class="more-less fa fa-plus"></i> Photographs </a> </h4>
                  </div>
                  <div id="collapsesix" class="panel-collapse collapse <?php if($_GET['type'] == "photos"){ echo "show";}?>" role="tabpanel" aria-labelledby="headingsix">
                    <div class="panel-body">
                      <div id="featured_image_msg_"></div>
					  <form action="" method="post" class="form-horizontal" id="property_photos_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo $getPropertyById[0]->id;?>"/>
                        <input type="hidden" name="type" id="type" value="photos"/>
                        <div class="card-body card-block clearfix">
                          <!--<div class="row form-group prpty_dtls_tbl">
                            <div class="col col-md-3">
                              <label class=" form-control-label">Featured Image 2</label>
                            </div>
                            <?php 
							if($getPropertyById[0]->featured_image != "" && file_exists('./images/property_images/'.$getPropertyImages->featured_image)){
							?>
                            <div class="col-12 col-md-6 text-center feat_img_box_out"> <img src="<?php echo SITEURL;?>images/property_images/<?php echo $getPropertyById[0]->featured_image;?>"/><br/>
                              <a href="#" onclick="return deleteFeaturedImage('<?php echo $getPropertyById[0]->featured_image;?>','<?php echo $getPropertyById[0]->id?>');" class="del_img_">Delete Featured Image</a> </div>
                            <?php 
							}else{
							?>
                            <div class="col-12 col-md-6">
                              <label for="featured_image" class="feat_img_lbl">
                              <input name="featured_image" id="featured_image" type="file" class="form-control image_uploader" accept=".jpg,.jpeg,.png,.gif">
                              Choose File</label>
                              [500px X 300px] </div>
                            <?php
							}
							?>
                          </div>-->
                          <div class="col-md-12">
                          <a href="#" id="add_more_field_btn_" class="btn btn-primary btn-sm" onclick="return getmm_();">Add More</a></div>
                          
                          
                          <div class="row form-group prpty_dtls_tbl col-md-12">
                            <div class="col-12 col-md-9" id="p_scents_">
                             <!-- <label for="image_chooser" class="feat_img_lbl"> Choose File
                              <input name="image[]" type="file" class="form-control image_uploader" accept=".jpg,.jpeg,.png,.gif" id="image_chooser">
                              </label>-->
                              
                              </div>
                              <div class="col-md-12">
                              <button type="submit" name="submit" class="btn btn-primary btn-sm my_submit_photos" value="save"> <i class="fa fa-dot-circle-o"></i> Submit </button></div>
                          </div>
						  <?php 
						  $getPropertyImages = getPropertyImages($getPropertyById[0]->id);
						  $noOfImages = 0;
						  //echo "<pre>"; print_r($getPropertyImages); exit;
						  if(!empty($getPropertyImages)){
						  ?>
						  <div class="row form-group prpty_dtls_tbl col-md-12">
                            
                            <div class="">
                              <ul class="imgs_list_feat clearfix">
                                <?php 
									foreach($getPropertyImages as $getPropertyImages){
										if($getPropertyImages->image != "" && file_exists('./images/property_images/'.$getPropertyImages->image)){
											++$noOfImages;
										?>
                                <li> <img src="<?php echo SITEURL;?>images/property_images/<?php echo $getPropertyImages->image;?>" width="200" height="200"/><br/>
                                  <span class="set_feat_img_" onclick="return setAsFeaturedImage('<?php echo $getPropertyImages->image;?>','<?php echo $_GET['id'];?>')" ><input type="radio" class="" <?php if($getPropertyImages->image == $getPropertyById[0]->featured_image){ echo "checked";}?>/> Set as Featured Image</span>
								  <a href="#" onClick="return deleteImage('<?php echo $getPropertyImages->image;?>','<?php echo $getPropertyImages->id?>','<?php echo $getPropertyById[0]->id?>')">Delete Image</a> </li>
                                <?php
									}
								} 
								?>
                              </ul>
                            </div>
                          </div>
						  <?php 
						  }
						  ?>
                          
                          <div class="card-footer col-md-12">
                           
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Tabs -->
    </div>
  </div>
  <!-- .animated -->
</div>
<!-- .content -->
</div>
<!-- /#right-panel -->
</div>
</div>
<script type="text/javascript">
function getNoOfImages(){
	return <?php echo $noOfImages?>;
}
</script>
<script>
$(document).ready(function(){
	$('.mobile_nav_icon').click(function(){
		$(this).closest('#main-menu').find('.navbar-nav').slideToggle(1000);
	});
});
function toggleIcon(e){
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa-plus fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<?php get_footer(); ?>