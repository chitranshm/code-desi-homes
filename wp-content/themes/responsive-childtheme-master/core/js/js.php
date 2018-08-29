<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/jquery-uii.css">
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.hidden_popup_').click(function()
	{
		$(this).closest('.popup_top_error_outer').hide();
	});
	 
	//alert('yes');
	$(window).scroll(function(){
		if($(window).scrollTop()>100){
			$('#header').css('background','rgb(230, 230, 230)');	
		}else{
			$('#header').css('background','none');	
		}
	});
	
	$("[type='number']").keypress(function (evt) {
		evt.preventDefault();
	});
	
	/*$('#available_from,#available_from_').datepicker({
		minDate:0,
		numberOfMonths: [4, 3],
		inline:true,
		dateFormat:"dd-mm-yy",
		 onSelect: function(selected) {
          $("#available_to").datepicker("option","minDate", selected)
        }
	});
	
	 $("#available_to , #available_to_").datepicker({ 
        numberOfMonths: [4, 3],
		inline:true,
		dateFormat:"dd-mm-yy",
        onSelect: function(selected) {
           $("#available_from").datepicker("option","maxDate", selected)
        }
    }); */
	
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
	
	
	$("#datesel").datepicker({
		 dateFormat: "MM d, yy",
		 numberOfMonths: [2, 3],
		 maxDate: "+12M +0D",
		 minDate: 0,
		 beforeShowDay: dateRange,
		 onSelect: DRonSelect
	});
	
	$("#datesel1").datepicker({
		 dateFormat: "MM d, yy",
		 numberOfMonths: [2, 3],
		 maxDate: "+12M +0D",
		 minDate: 0,
		 beforeShowDay: dateRangeM,
		 onSelect: DRonSelectM
	});
	
	/* Profile Validation Starts*/
	$("#profile_form").validate({
		rules:{
			name:{
				required:true
			},
			email:{
				required:true,
				email:true
			},
			mobile:{
				number:true,
				minlength:10
			}
		},
		messages:{
			name:{
				required:"Please enter name"
			},
			email:{
				required:"Please enter email",
				email:'Please enter valid email'
			},
			mobile:{
				number:'Please enter only digits',
				minlength:'Please enter valid mobile number'
			}
		}
	});
	/* Profile Validation Ends*/
	
	
	/* Get in touch Validation Starts*/
	$("#get_in_touch_form").validate({
		rules:{
			name:{
				required:true
			},
			email:{
				required:true,
				email:true
			},
			mobile:{
				number:true,
				minlength:10
			},
			message:{
				required:true
			}
		},
		messages:{
			name:{
				required:"Please enter name"
			},
			email:{
				required:"Please enter email",
				email:'Please enter valid email'
			},
			mobile:{
				number:'Please enter only digits',
				minlength:'Please enter valid mobile number'
			},
			message:{
				required:"Please enter message"
			}
		}
	});
	/*Get in touch Validation Ends*/
	
	
	 /* Property General Form Validation Starts*/
	$("#property_general_form").validate({
		rules:{
			property_type:{
				required:true
			},
			title:{
				required:true,
				remote:{
					url:'<?php echo SITEURL;?>chkProperty.php',
					type:'POST'
					//data:{title: $('#title').val(),id: $('#id').val()}
				}
			},
			description:{
				required:true
			}
		},
		messages:{
			property_type:{
				required:"Please select property type"
			},
			title:{
				required:"Please enter title",
				remote:"Looks like you have already advertised this property,please check if your property is pending for approval or change the title"
			},
			description:{
				required:'Please enter description'
			}
		}
	});

	/* Propert General Form Validation Ends*/
	
	
	/* Property General Form Edit Validation Starts*/
	$("#property_general_form_edit").validate({
		rules:{
			property_type:{
				required:true
			},
			title:{
				required:true
			},
			description:{
				required:true
			}
		},
		messages:{
			property_type:{
				required:"Please select property type"
			},
			title:{
				required:"Please enter title",
				remote:"Looks like you have already advertised this property,please check if your property is pending for approval or change the title"
			},
			description:{
				required:'Please enter description'
			}
		}
	});

	/* Propert General Form Validation Ends*/
	
	 
	/*Property Facilities Form Validation Starts*/
	$("#property_facilities_form").validate({
		rules:{
			no_of_bedrooms:{
				required:true
			},
			no_of_bathrooms:{
				required:true
			},
			price:{
				required:true
			}
		},
		messages:{
			no_of_bedrooms:{
				required:"Please enter no of bedrooms"
			},
			no_of_bathrooms:{
				required:"Please enter no of bathrooms"
			},
			price:{
				required:'Please enter price'
			}
		}
	});
	/*Property Facilities Form Validation Ends*/
	
	/*Property Address Form Validation Starts*/
	$("#property_address_form").validate({
		rules:{
			postcode:{
				required:true
			},
			location:{
				required:true
			},
			first_address_line:{
				required:true
			}
		},
		messages:{
			postcode:{
				required:"Please enter postcode"
			},
			location:{
				required:"Please select address"
			},
			first_address_line:{
				required:'Please enter Address'
			}
		}
	});
	/*Property Address Form Validation Ends*/
	
	/*Property Availability Form Validation Starts*/
	$("#property_calendar_form").validate({
		rules:{
			available_from:{
				required:true
			},
			available_to:{
				required:true
			}
		},
		messages:{
			available_from:{
				required:"Please select availability start date"
			},
			available_to:{
				required:'Please select availability end date'
			}
		}
	});
	/*Property Availability Form Validation Ends*/
	
	
	/*Reset(Change) Password Form Starts*/
	$("#reset_password_form").validate({
		rules:{
			new_password:{
				required:true
				//minlength:6
			},
			confirm_new_password:{
				required:true,
				equalTo:'#new_password'
			}
		},
		messages:{
			new_password:{
				required:'Please enter new password'
				//minlength : 'Password should be minimum 6 character long & contain at least one capital letter, one number & one special character'
			},
			confirm_new_password:{
				required:'Please confirm your new password',
				equalTo:'Password Mismatch'
			}
		}
	});
	/* Reset(Change) Password Form Ends*/
	 
	 
	  /* Login Form Validation*/
	 $("#login_form").validate({
		ignore: ".ignore",
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true,
				minlength:6
			},hiddenRecaptcha:{
                required: function(){
                    if(grecaptcha.getResponse() == ''){
                       //$("#captchaerrmsg").show();
					   //$("#captchaerrmsg").text('Please check the box');
					   return true;
                    }else{
                       return false;
                    }
                }
            }
		},
		messages:{
			email:{
				required:"Please enter email",
				email:'Please enter valid email'
			},
			password:{
				required:'Please enter password',
				minlength : 'Password should contain atleast 6 characters'
			},
			hiddenRecaptcha:{
				required:"Robots not allowed :) Try again !!!"
			}
		}
	});
	/* Login Form Validation Ends*/
	/* New Registration Validation*/
	$("#registration_form").submit(function(){
		var errormsg = "";
		var error = true;
		var name = $("#name").val();
		var email = $("#email").val();
		var mobile = $("#mobile").val();
		var password = $("#password").val();
		var confirm_password = $("#confirm_password").val();
		//var term = $("#terms_conditions").val();
		  
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
				$("#emailerrmsg").text('Please enter valid email').css('color','#fff').show();
				error = false;
			}else{
				$.ajax({
					url:'<?php echo SITEURL;?>check_email.php',
					type:'POST',
					cache:false,
					data:{email:email},
					async:false,
					success:function(html){
						//alert(html);
						html = html.trim();
						if(html == "false"){
							$("#emailerrmsg").text('Email id already registered').css('color','#fff').show();;
							error = false;
						}else{
							$("#emailerrmsg").text('');
							$("#emailerrmsg").hide();	
						}
					}
				});
			}
		}
		if(mobile != "" && !/^[0-9\s]{10,16}/.test(mobile)){ 
			$("#mobileerrmsg").text('Please enter valid mobile number').css('color','#fff').show();;
			error = false;
		}else{
			$("#mobileerrmsg").text('');
			$("#mobileerrmsg").hide();
		}
		
		
		if(password == ''){
			$("#passworderrmsg").text('Please enter password').css('color','#fff').show();
			error = false;
		}else{
			if(!/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password)){
			   $("#passworderrmsg").html('Password should be minimum 6 character long & contain at least one capital letter, one number & one special character(!,@,#,$,%,^,&,*)').css('color','#fff').show();;
			   error = false;
			}else{
				$("#passworderrmsg").text('');
				$("#passworderrmsg").hide();
			}
		}
		if(confirm_password == ''){
			$("#confirmpassworderrmsg").text('Please confirm password').css('color','#fff').show();;
			error = false;
		}else{
			if(confirm_password != password){
				$("#confirmpassworderrmsg").text('Password and confirm password mismatch').css('color','#fff').show();;
			    error = false;
			}else{
				$("#confirmpassworderrmsg").text('');
				$("#confirmpassworderrmsg").hide();
			}
		}
		
		if($("#terms_conditions").prop('checked')){
			$("#terms_conditionsmsg").text('');
			$("#terms_conditionsmsg").hide();
		}else{
			$("#terms_conditionsmsg").text('Please accept our Terms & Conditions , Privacy Policy & Cookie Policy to proceed further').css('color','#fff').show();;
			error = false;
		}
		
		if(grecaptcha.getResponse() == ""){
			$("#captchaerrmsg").text('Robots not allowed :) Try again !!!').css('color','#fff').show();
			error = false;
		}else{
			$("#captchaerrmsg").text('');
			$("#captchaerrmsg").hide();
		}
		if(error == false){
			//$(".errmsgs").css('color','red')
			//$(".errmsgs").html(errormsg);
			$('.popup_top_error_outer').css('display','block');
			$('html,body').animate({scrollTop:0});
		}
		return error;
	});

	/* New Registration Validation Ends*/

	
	 /* Home Page Search Validation*/
	 $("#property_search").validate({
		rules:{
			property_type:{
				required:true
			},
			postcode:{
				required:true
			}
		},
		messages:{
			property_type:{
				required:"Please select property type"
			},
			postcode:{
				required:"Please enter postcode or town"
			}
		}
	});
	 /* End of Home Page Search Validation*/
	/* Validation of Adding Property Form Starts*/ 
	$("#location,#location2").change(function(){
		//alert('Yakku');
		var address = $("#location").val();
		//alert("Address is "+address)
		//getAddressLines(address);
		if(address != ""){
			var a = address.split(",");
			//alert(a);
			$("#first_address_line").val(a[0])
			if(a.length > 3){
				//alert('Hielaa');
				$("#second_address_line").val(a[1]);
				$("#city").val(a[2]);
				var splitlatlong = a[3].split("-");
				//alert(splitlatlong);
				$("#county").val(splitlatlong[0]);
				$("#latbox").val(splitlatlong[1]);
				$("#lngbox").val(splitlatlong[3]);
				$("#latbox1").val(splitlatlong[1]);
				$("#lngbox1").val(splitlatlong[3]);
				$("#mapdiv").show();
				$(".get_map_link").show();
				$("#mapdiv_").show();
				$(".get_map_btn_").show();
	//$("#map_canvas").hide();
			}else{
				//alert('Hola')
				//alert(a);
				var splitlatlong = a[2].split("-");
				//alert(splitlatlong);
				$("#city").val(a[1]);
				$("#county").val(splitlatlong[0]);
				$("#latbox").val(splitlatlong[1]);
				$("#lngbox").val(splitlatlong[3]);
				$("#latbox1").val(splitlatlong[1]);
				$("#lngbox1").val(splitlatlong[3]);
				$("#mapdiv").show();
				$(".get_map_link").show();
				$("#mapdiv_").show();
				$(".get_map_btn_").show();
			}
		}else{
			return "";
		}
	});

	
	/* Validation of Adding Property Form Ends*/ 
	
	/*Profile Form Validations Starts*/

	 $( ".txtOnly" ).keypress(function(e) {
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});
	/* Forgot password Form Validation Starts*/

	$("#forgot_password_form").validate({
		rules:{
			email:{
				required:true,
				email:true
			}
		},
		messages:{
			email:{
				required:"Please enter email",
				email:'Please enter valid email'
			}
		}
	});
	/* Forgot Password Form Validation Ends*/
    $('#bootstrap-data-table-export').DataTable();
	
	jQuery(".demo").customScrollbar();
		jQuery('.cross_icon').click(function()
		{
			$(this).closest('.contact_details').fadeOut();	
		});
});

function recaptchaCallback() {
  $('#hiddenRecaptcha').valid();
};

function removeThis(i){
	$("#tt_"+i).remove();
	return false;
}

function removeThis_(i){
	$("#tt__"+i).remove();
	return false;
}

function getAddressLines(address){
	if(address != ""){
		var a = address.split(",");
		$("#first_address_line").val(a[0])
		if(a.length > 3){
			$("#second_address_line").val(a[1]);
			$("#city").val(a[2]);
			$("#county").val(a[3]);
		}else{
			$("#city").val(a[1]);
			$("#county").val(a[2]);
		}
	}else{
		return "";
	}
}

function isNumber(evt) {
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
		return false;
	return true;
} 

function checkPassword(password){
	if(password != ""){
		if(!/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password)){
			var passerrmsg= "Password should be minimum 6 character long & contain at least one capital letter,<br/> one number & one special character";
			$("#passerr").css('color','red');
			$("#passerr").html(passerrmsg);
			return false;
		}else{
			$("#passerr").html('');
		}
	}
}

function dateRange(date){
	var string = $.datepicker.formatDate('yy-mm-dd', date);
    var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate").val());
    var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate").val());
    var isHighlight = date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2));
	//var isHighlight = eventDates[date];
      /*$(document).ready(function(){
  		// $("td.dp-highlight").text("Y");
	  });*/
	  
	 /* var highlight = eventDates[date];
	  if( highlight ) {
			 return [true, "event", highlight];
		} */
	  
   return [true, isHighlight ? "dp-highlight" : ""];
}

function DRonSelect(dateText, inst) {
   var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate").val());
   var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate").val());
      if (!date1 || date2) {
         $("#checkinDate").val(dateText);
	 $("#checkoutDate").val("");
         $("#datesel").datepicker();
      } 
      else {
         if ( $.datepicker.parseDate("MM d, yy", $("#checkinDate").val()) >= 
$.datepicker.parseDate("MM d, yy", dateText)) {
            $("#checkinDate").val(dateText);
            $("#checkoutDate").val("");
            $("#datesel").datepicker();
         }
         else {
	    $("#checkoutDate").val(dateText);
            $("#datesel").datepicker();
         }
      }   
}

function dateRangeM(date){
	var string = $.datepicker.formatDate('yy-mm-dd', date);
    var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate_").val());
    var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate_").val());
    var isHighlight = date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2));
      /*$(document).ready(function(){
  		// $("td.dp-highlight").text("Y");
	  });*/
   return [true, isHighlight ? "dp-highlight" : ""];
}

function DRonSelectM(dateText, inst) {
   var date1 = $.datepicker.parseDate("MM d, yy", $("#checkinDate_").val());
   var date2 = $.datepicker.parseDate("MM d, yy", $("#checkoutDate_").val());
      if (!date1 || date2) {
         $("#checkinDate_").val(dateText);
	 $("#checkoutDate_").val("");
         $("#datesel1").datepicker();
      } 
      else {
         if ( $.datepicker.parseDate("MM d, yy", $("#checkinDate_").val()) >= 
$.datepicker.parseDate("MM d, yy", dateText)) {
            $("#checkinDate_").val(dateText);
            $("#checkoutDate_").val("");
            $("#datesel1").datepicker();
         }
         else {
	    $("#checkoutDate_").val(dateText);
            $("#datesel1").datepicker();
         }
      }   
}

function chkProperty(id){
	var id = id;
	var title = $("#title").val();
	//alert(title+" id is "+id);
	if(title != ""){
		$.ajax({
			url:'<?php echo SITEURL;?>chkProperty.php',
			type:"POST",
			data:{id:id,title:title},
			async:false,
			cache:false,
			success:function(html){
				html = html.trim();
				if(html == 'false'){
					$("#savegen").attr('disabled');
					$("#savegennext").attr('disabled');
				}else{
					$("#savegen").removeAttr('disabled');
					$("#savegennext").removeAttr('disabled');
				}
			}
		});
	}
}
</script>