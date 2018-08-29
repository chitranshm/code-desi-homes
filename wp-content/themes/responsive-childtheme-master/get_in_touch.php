<?php
//Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Get in touch Page (no sidebar)
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
$user_id = $_SESSION['user_id'];
if($user_id != ''){	
	$getUserDetailsByID = getUserDetailsByID($user_id);
	//echo "<pre>"; print_r($getUserDetailsByID); exit;
}
?>
<script type="text/javascript">
</script>
<div class="clearfix additional_form_css">
<!-- Left Panel -->
	<!-- /#left-panel -->
    <div id="" class="">
		<div class="content mt-12">
            <div class="animated fadeIn">
                <div class="col-sm-12 container getin_container">
                  <!--/.col-->
                  <div class="col-lg-12 getin_form_wrapper" style="margin-top: 8%;margin-bottom: 8%;">
                    <div class="form-wrapper-inner">
                      <div class="card-header">
                        Get in Touch
                      </div>
					  <form action="javascript:void(0)" method="post" class="form-horizontal getin_form" id="get_in_touch_form" enctype="multipart/form-data" style="width: 100%;">
					  <!--<form action="" method="post" class="form-horizontal" id="profile_form">-->
                      <div class="col-sm-8 getincard card-body card-block" style="max-width: 80%;">
                          <div class="row form-group">
                            <div class="col col-md-5 ad_prpty_fld"><label for="name" class=" form-control-label">Name*:</label></div>
                            <div class="col-12 col-md-7 ad_prpty_fld1" style="padding:0px;"><input type="text" id="name" name="name" value="<?php echo stripslashes($getUserDetailsByID[0]->name);?>" placeholder="Enter Name..." class="form-control txtOnly" required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5 ad_prpty_fld"><label for="email" class=" form-control-label">Email*:</label></div>
                            <div class="col-12 col-md-7 ad_prpty_fld1" style="padding:0px;"><input type="email" id="email" name="email" value="<?php echo stripslashes($getUserDetailsByID[0]->email);?>" placeholder="Enter Email..." class="form-control"></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-5 ad_prpty_fld"><label for="mobile" class=" form-control-label">Mobile:</label></div>
                            <div class="col-12 col-md-7 ad_prpty_fld1" style="padding:0px;"><input type="text" id="mobile" name="mobile" value="<?php echo $getUserDetailsByID[0]->mobile;?>" placeholder="Enter Mobile..." class="form-control" onkeypress="return isNumber(event);" maxlength="15"></div>
                          </div>
						</div>  
					  
                    
					
						<div class="row form-group">
                            <div class="col col-md-5 ad_prpty_fld "><label for="message"  class=" form-control-label get_msg_txt">Message:</label></div>
                            <div class="col-12 col-md-7 ad_prpty_fld1 mobile_get_msg"><textarea class="getin_textarea form-horizontal" name="message" id="message" style="width:650px" rows="10" placeholder="Enter Message..."></textarea></div>
                          </div>
						  <div class="card-footer getin_footer">
							 <input type="submit" name="submit" class="btn btn-primary btn-sm gettouchbtn"> 
						  </div>
						  </form>
                  </div>
                </div>
            </div><!-- .animated -->
        </div>
	 <!-- .content -->
    </div><!-- /#right-panel -->
</div>
<script>
$(function(){
/*Form Submission Validation Starts*/
	$("#get_in_touch_form").submit(function(){
		//alert('Hey');
		var errormsg = "";
		var error = true;
		var name = $("#name").val();
		var email = $("#email").val();
		var phone = $("#mobile").val();
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
		if(error == true){
			$.ajax({
				url:'<?php echo SITEURL?>submit_get_in_touch.php',
				type:'POST',
				data:$('#get_in_touch_form').serialize(),
				cache:false,
				async:false,
				success:function(html){
					html = html.trim();
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
});
</script>
<?php get_footer(); ?>