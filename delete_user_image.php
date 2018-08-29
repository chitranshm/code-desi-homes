<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$image = $_GET['image'];
$image1 = "";
$wpdb->query($wpdb->prepare("UPDATE `wp_register_users` SET image = %s WHERE id = %d ",$image1,$id));
unlink('./images/user_images/'.$image);
$page = get_page_by_title('profile');
wp_redirect(get_permalink($page->ID));
$location1 = SITEURL . "/profile";
wp_redirect( $location1, 301 );
exit;
?>