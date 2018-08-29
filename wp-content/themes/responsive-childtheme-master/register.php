<?php
//Exit if accessed directly
if(!defined( 'ABSPATH')){
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Registraion Page (no sidebar)
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
<div class="clearfix"></div>
<div class="banner register-banner">
  <div class="container">
    <div class="form-wrapper">
      <div class="form-wrapper-inner">
        <!--<div class="form-col">
          <div class="logo-section"> <img src="/demo/listingwebsite/wp-content/uploads/2018/04/logo.png" alt="logo">
            <p> Find the best matches as              
              per your requirements. </p>
          </div>
        </div> -->
        <div class="form-col">
          <div class="heeding_outer_rgster">
            <h4>Create your Desi Homes account</h4>
          </div>
          <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
          <?php //get_template_part( 'loop-header', get_post_type() ); ?>
          <?php responsive_entry_before(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php responsive_entry_top(); ?>
            <?php get_template_part( 'post-meta', get_post_type() ); ?>
            <div class="post-entry">
              <?php responsive_page_featured_image(); ?>
              <?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
              <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
            </div>
            <div id="success"></div>
            <!--<form action="javascript:void(0)" method="post" id="registration_form">-->
            <?php 
		if($_SESSION['error_msgs'] != "" && $_SESSION['success_msg'] == ""){
			$color = "#FF0000;";
		}
		else if($_SESSION['success_msg'] != "" && $_SESSION['error_msgs'] == ""){
			$color = "#009900;";
		}else{
			$color = "#000000";
		}
		?>
        <div class="errmsgs" style="color:<?php echo $color;?>">
        <?php 
		$formhide = "";
		if($_SESSION['error_msgs'] != ""){
			echo $_SESSION['error_msgs']; $_SESSION['error_msgs'] = "";
		}
		if($_SESSION['success_msg'] != ""){
			echo $_SESSION['success_msg']; $_SESSION['success_msg'] = "";
			$formhide = 'style="display:none"';
		}
		?>
       </div>
       
  <form action="<?php echo SITEURL;?>register-user.php" method="post" id="registration_form" <?php echo $formhide;?> >
            <div class="popup_top_error_outer">
            <div class="popup_top_error">
			   <span id="nameerrmsg" class="error_msg_"></span>
			   <span id="emailerrmsg" class="error_msg_"></span>
			   <span id="mobileerrmsg" class="error_msg_"></span>
			   <span id="passworderrmsg" class="error_msg_"></span>
			   <span id="confirmpassworderrmsg" class="error_msg_"></span>
			   <span id="terms_conditionsmsg" class="error_msg_"></span>
			   <span id="captchaerrmsg" class="error_msg_"></span>
	   
       <a href="javascript:void(0);" class="hidden_popup_">OK</a>
       </div>
       </div>
              <div class="input-box clearfix po_relative">
                <label>Name<span class="mandatory_fields">*</span>:</label>
                <input type="text" name="name" id="name" value="" class="txtOnly"/>
                 </div>
              <div class="input-box clearfix po_relative">
                <label>Email<span class="mandatory_fields">*</span>:</label>
                <input type="text" name="email" id="email" />
                 </div>
              <div class="input-box clearfix po_relative">
                <label>Mobile:</label>
                <input type="text" name="mobile" id="mobile" maxlength="13" onkeypress="return isNumber(event);"/>
               </div>
              <div class="input-box clearfix po_relative">
                <label>Password<span class="mandatory_fields">*</span>:</label>
                <input type="password" name="password" id="password" maxlength="15"/>
                 </div>
              <div class="input-box clearfix po_relative">
                <label>Confirm Password<span class="mandatory_fields">*</span>:</label>
                <input type="password" id="confirm_password" name="confirm_password" maxlength="15"/>
              </div>
              <div class="col-sm-12" style=" text-align:  center; ">
			 	<input type="checkbox" id="terms_conditions" name="terms_conditions"/ style="width: 10%;
    margin-top: 2px; zoom: 1.5; ">
                <p style=" font-size: 14px;">I accept <a href="<?php echo SITEURL;?>terms-and-conditions" target="_blank">Terms & Conditions</a> , <a href="<?php echo SITEURL;?>privacy-policy" target="_blank">Privacy Policy</a> & <a href="<?php echo SITEURL;?>cookie-policy" target="_blank">Cookie Policy</a></p>
              </div>
			  <!--<div class="input-box clearfix"><button type="submit" class="submit-btn connect-with-fb-btn">Connect with <i class="fa fa-facebook"></i></button></div>-->
			   <div class="col-sm-12 input-box clearfix po_relative cap_parent">
			  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
              <div class="g-recaptcha" data-sitekey="6LdxGF8UAAAAADS85HkSPEfBujYBt5U1AsN_-NR4"></div>
			  </div>
			  
			  
			  
			  </div>
			   
              <div class="input-box clearfix submit_parent">
                <input type="submit" name="submit" id="submit" class="getin_reg reg_btn" value="Register"/>
              </div>
			  
			  
			  
            </form>
            <!-- end of .post-entry -->
            <?php get_template_part( 'post-data', get_post_type() ); ?>
            <?php responsive_entry_bottom(); ?>
          </div>
          <!-- end of #post-<?php the_ID(); ?> -->
          <?php responsive_entry_after(); ?>
          <?php responsive_comments_before(); ?>
          <?php comments_template( '', true ); ?>
          <?php responsive_comments_after(); ?>
          <?php
			endwhile; 
		  ?>
          <?php
			get_template_part( 'loop-nav', get_post_type() );
			else:
			get_template_part( 'loop-no-posts', get_post_type() );
			endif;
			?>
        </div>
      </div>
    </div>
  </div>
  <!-- end of #content-full -->
</div>
<?php get_footer(); ?>