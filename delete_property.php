<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$sql = "DELETE FROM `wp_add_property` WHERE id = '".$id."' ";
$wpdb->query($sql);
header('Location:'.$_SERVER['HTTP_REFERER']);
exit;
?>