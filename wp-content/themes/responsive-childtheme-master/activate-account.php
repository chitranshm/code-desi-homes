<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Activate Account Date Page (no sidebar)
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

//echo "z"; exit;
$registration_link = $_GET['activation_link'];
//echo $registration_link; exit;
$activeUser = activeUser($registration_link);
if($activeUser == "activated"){
	$_SESSION['info'] = "Your account is activated now. You can login";
}else{
	$_SESSION['info'] = "Account not activated.";
}
$location1 = SITEURL . "/login";
wp_redirect( $location1, 301 );
exit;
?> 