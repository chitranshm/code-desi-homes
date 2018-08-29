<?php
	session_start();

	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '578608862540266',
		'app_secret' => '7b0dfd1fcb49c69bd1160ac0ee72b385',
		'default_graph_version' => 'v2.10'
	]);
	$helper = $FB->getRedirectLoginHelper();
	//echo "Data<pre>";print_r($helper); exit;
?>