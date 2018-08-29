<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Login Page (no sidebar)
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

require_once 'fbconfig.php';
if (isset($_SESSION['access_token'])) {
	//header('Location: https://www.google.com');
	//exit();
	//echo "FB Login Successfull."; exit;
	//echo "<pre>"; print_r($_SESSION); exit;
}
$redirectURL = "https://desihomes.co.uk/facebook-callback/";
$permissions = ['email'];
$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
//echo $loginURL; exit;
?>

<div class="clearfix"></div>

<div class="banner login-banner">
  <div class="container">
   <div class="form-wrapper">
	 <div class="form-wrapper-inner">
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
			<?php 
			if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
				$page = get_page_by_title('dashboard');
				wp_redirect(get_permalink($page->ID));
				exit;
			}
			if(isset($_POST['submit']) && $_POST['submit'] != ''){
				//echo "<pre>"; print_r($_SESSION); exit;
				if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
					$secret = '6LdxGF8UAAAAAPyqSfJXzhQaryL-pR9U7bxVffLl';
					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
					$responseData = json_decode($verifyResponse);
					$login = userLogin($_POST);
					if($responseData->success){
						if(!empty($login)){
							if($_SESSION['property_type'] == "" && $_SESSION['postcode'] == "" && $_SESSION['property_id'] == ""){
								
								//echo "<pre>"; print_r($login); exit;
								
								$_SESSION['user_id'] = $login[0]->id;
								$_SESSION['name'] = $login[0]->name;
								$_SESSION['email'] = $login[0]->email;
								$_SESSION['mobile'] = $login[0]->mobile;
								$_SESSION['loginwith'] = $login[0]->loginwith;
								$location1 = get_site_url();
								wp_redirect( $location1, 301 );
								exit;
							}else if($_SESSION['property_type'] != "" && $_SESSION['postcode'] != "" && $_SESSION['property_id'] == ""){
								$_SESSION['user_id'] = $login[0]->id;
								$_SESSION['name'] = $login[0]->name;
								$_SESSION['email'] = $login[0]->email;
								$_SESSION['mobile'] = $login[0]->mobile;
								$_SESSION['loginwith'] = $login[0]->loginwith;
								$location1 = SITEURL . "property-list";
								wp_redirect( $location1, 301 );
								exit; 
							}else if($_SESSION['property_id'] != ""){
								$getPropertySlugTitle = getPropertySlugTitle($_SESSION['property_id']);
								$_SESSION['user_id'] = $login[0]->id;
								$_SESSION['name'] = $login[0]->name;
								$_SESSION['email'] = $login[0]->email;
								$_SESSION['mobile'] = $login[0]->mobile;
								$_SESSION['loginwith'] = $login[0]->loginwith;
								$location1 = SITEURL . "view-property-details/?slug=".$getPropertySlugTitle[0]->slug."&title=".$getPropertySlugTitle[0]->title."&id=".$_SESSION['property_id'];
								wp_redirect( $location1, 301 );
								exit; 
							}
						}else{
							$_SESSION['info'] = "<font color='#FF0000'>Wrong Email or Password.</font>";
						}
					}else{
						$_SESSION['info'] = "<font color='#FF0000'>Invalid Captcha.</font>";
					}
			  	}else{
					$_SESSION['info'] = "<font color='#FF0000'>Robots not allowed. Try again !!!</font>";
				}	
			}
			?>
			
			<form action="" method="post" id="login_form">
				<div class="input-box related_login">
					<label>Email :</label>
					<input type="text" name="email" id="email" /></div>
					<div class="clearfix"></div>
					<div class="input-box related_login">
					<label>Password:</label>
					 <input type="password" name="password" id="password" /></p>
					</div>
					<?php 
					if(isset($_SESSION['info']) && $_SESSION['info'] != ""){
					?>
					<span style="color:#006600;"><?php echo $_SESSION['info'];?></span>
					<?php
					$_SESSION['info'] = "";
					}
					?>
					<div class="clearfix"></div>
					<div class="input-box clearfix po_relative">
					  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
					  <div class="g-recaptcha" data-sitekey="6LdxGF8UAAAAADS85HkSPEfBujYBt5U1AsN_-NR4" data-callback="recaptchaCallback">
					  </div>
					  <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
					  <span id="captchaerrmsg" class="error_msg_"></span>
					  </div>
					  <div class="clearfix"></div>
					<div class="input-box">
						<input type="submit" name="submit" id="submit" class="submit-btn reg_btn" value="Login"/>
					</div>
					<a href="<?php echo SITEURL;?>forgot-password" class="forgot-password">Forgot Password</a>
					<!--<a href="<?php echo SITEURL?>fblogin/fbconfig.php" class="login-width-fb">Login with Facebook <i class="fa fa-facebook"></i></a>-->
					<!-- <a href="#" onClick="window.location = '<?php echo $loginURL;?>'" class="login-width-fb">Login with Facebook <i class="fa fa-facebook"></i></a> -->
<a href="#" onClick="window.location = '<?php echo $loginUrl;?>'" class="login-width-fb">Login with Facebook <i class="fa fa-facebook"></i></a>					
<!--<input class="login-width-fb" type="button" name="fblogin" id="fblogin" value="Login with Facebook" onclick="window.location = '<?php echo $loginURL;?>'"/><i class="fa fa-facebook"></i>-->
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
			</div><!-- end of #content-full -->
		  </div>
		 </div>
		<?php get_footer(); ?>