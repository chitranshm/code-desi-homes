<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Delete Property Featured Image Page (no sidebar)
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
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ""){
	$location1 = SITEURL . "/login";
	wp_redirect( $location1, 301 );
	exit;
}
$user_id = $_SESSION['user_id'];
//echo "<pre>"; print_r($_GET); exit;
$getPropertyVendor = getPropertyVendor($_GET['property_id']);
if(!empty($getPropertyVendor)){
	if($getPropertyVendor[0]->added_by != $_SESSION['user_id']){
		$location1 = SITEURL . "/my-properties/";
		wp_redirect( $location1, 301 );
		exit;
	}
}else{
	$location1 = SITEURL . "/my-properties/";
	wp_redirect( $location1, 301 );
	exit;
}
if($_GET['property_id'] != "" && $_GET['featured_image'] != ""){
	$deletePropertyFeaturedImage = deletePropertyFeaturedImage($_GET['property_id'],$_GET['featured_image']);
	if($deletePropertyFeaturedImage == "removed"){
		$_SESSION['info'] = "Image deleted successfully";
	}else{
		$_SESSION['info'] = "Image not deleted";
	}
	$location1 = SITEURL . "/edit-property/?id=".$_GET['property_id']."&type=photos";
	wp_redirect( $location1, 301 );
	exit;
}else{
	$location1 = SITEURL . "/my-properties/";
	wp_redirect( $location1, 301 );
	exit;
}
?> 