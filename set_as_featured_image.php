<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
//echo "Data ".$_POST['image'].$_POST['id'];
$featured_image = $_POST['image'];
$id = $_POST['id'];
global $wpdb;
$wpdb->query($wpdb->prepare("UPDATE `wp_add_property` SET featured_image = %s WHERE id = %d",$featured_image,$id));
echo "Featured Image Updated";
?>