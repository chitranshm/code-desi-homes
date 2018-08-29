<?php

// Exit if accessed directly

if ( !defined( 'ABSPATH' ) ) {

	exit;

}

/**

 * Full Content Template

 *

Template Name:  Reset Password Page (no sidebar)

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

if(isset($_SESSION['user_id']) || $_SESSION['user_id'] != ""){

	$location1 = SITEURL . "/dashboard";

	wp_redirect( $location1, 301 );

	exit;

}



if(isset($_POST['submit'])){

	$resetPassword = resetPassword($_REQUEST);

	if(!empty($resetPassword)){

		$_SESSION['info'] = "Your password is updated successfully";

	}else{

		$_SESSION['info'] = "Password is not updated";

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

				<form action="" method="post" id="reset_password_form">

					<div class="form-group">

						<label>New Password</label>

						<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password">

					</div>

					<div class="form-group">

						<label>Confirm New Password</label>

						<input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Confirm new password">

					</div>

					<button type="submit" name="submit" class="btn btn-primary btn-flat m-b-15">Change Password</button>

				</form>

			</div>

		</div>

	</div>

</div>

<?php get_footer(); ?>