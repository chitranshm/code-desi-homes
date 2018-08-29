<?php
unset($_SESSION['user_id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['mobile']);
unset($_SESSION['property_type']);
unset($_SESSION['postcode']);
session_destroy();
$location1 = SITEURL . "/login";
wp_redirect( $location1, 301 );
exit;
?> 