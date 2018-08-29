<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Forgot Password Page (no sidebar)
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
if(isset($_POST['submit'])){
	$resetPasswordLink = resetPasswordLink($_POST);
	if(!empty($resetPasswordLink)){
		$_SESSION['info'] = "Reset Password link has been sent to your email";
	}else{
		$_SESSION['info'] = "Email doesn't exist in our system";
	}
}
?>
<div class="clearfix"></div>
<div class="sufee-login d-flex align-content-center flex-wrap">
	<div class="container">
		<div class="login-content">
			<div class="login-form">
				<?php 
				if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
				?>
					<span style="color:#006600;"><?php echo $_SESSION['info'];?></span>
				<?php
				$_SESSION['info'] = "";
				}
				?>
				<form action="" method="post" id="forgot_password_form">
					<div class="form-group">
						<label>Email address</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email">
					</div>
					<button type="submit" name="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>