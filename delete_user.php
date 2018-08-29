<?php
ob_start();
require_once('wp-config.php');
global $wpdb;
$id = $_GET['id'];
$sql = "DELETE FROM `wp_register_users` WHERE id = '".$id."' ";
$wpdb->query($sql);
header('Location:'.$_SERVER['HTTP_REFERER']);
exit;
?>