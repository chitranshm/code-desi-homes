<?php 
/*
session_start();
require_once "Facebook/autoload.php";
$FB = new \Facebook\Facebook([
	'app_id' => '578608862540266',
	'app_secret' => '7b0dfd1fcb49c69bd1160ac0ee72b385',
	'default_graph_version' => 'v3.0'
]);
$helper = $FB->getRedirectLoginHelper(); */?> 
<?php 
/***************Start code new *******************/

if(!session_id())
session_start();
require_once "Facebook/autoload.php";

$app_id = '191459264897941';
$app_secret = '153e1350a2abcfbceace9f94d5180402';
$permissions = ['email'];
$callbackurl = 'https://desihomes.co.uk/fb-callback.php/';

$fb = new Facebook\Facebook([
  'app_id' => $app_id, // Replace {app-id} with your app id
  'app_secret' => $app_secret,
  'default_graph_version' => 'v3.0',
  ]);

$helper = $fb->getRedirectLoginHelper();


$loginUrl = $helper->getLoginUrl($callbackurl, $permissions);

//echo $loginUrl; exit;

?>


