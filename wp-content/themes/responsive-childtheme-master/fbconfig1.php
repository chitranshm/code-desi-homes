<?php 
session_start();
require_once "Facebook/autoload.php";
$FB = new \Facebook\Facebook([
	'app_id' => '216000972346347',
	'app_secret' => '1fa53e84b28a5f1e67b39bce5b707c5e',
	'default_graph_version' => 'v3.0'
]);
$helper = $FB->getRedirectLoginHelper();
?>