<?php
/**
 * Plugin Name: Property Manage
 * Plugin URI: https://www.Reinventdigital.com
 * Description: Property Manage Plugin for WordPress.
  * Author: Rohit Srivastava
 * Author URI: https://www.facebook.com
 * Version: 1.0
 */ 

define('PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
define('PLUGIN_URL',plugins_url());
define('plugin_version', '1.0');

function property_assest(){

// css and js file here

	wp_enqueue_style(
		'cpt_style', // unique
		 PLUGIN_URL.'/property-manage/assets/css/style.css', // style.css path
		 '', // dependency of other file
         'plugin_version' // plugin version

		);

	

}

add_action('init','property_assest');




function add_property_menu(){

add_menu_page( 
	'allproperty', 
	'Property Manage', 
	'manage_options', 
    'all-property', 
    'all_prop_view_function' ,
    'dashicons-admin-home',
    '64'
     );

add_submenu_page( 
	'all-property', 
	'show All Property', 
	'All Property',
	'manage_options', 
    'all-property', 
    'all_prop_view_function' 
    
     );
/*add_submenu_page( 
	'all-property', 
	'Add New Property', 
	'add new Property',
	'manage_options', 
    'add-new-property', 
    'all_new_prop_function' 
    
     );*/
	add_submenu_page( 
	'all-property', 
	'show All Users', 
	'All Users',
	'manage_options', 
    'all-users', 
    'all_user_view_function' 
    
     );
}

add_action('admin_menu', 'add_property_menu');

function all_prop_view_function(){
include_once PLUGIN_DIR_PATH.'/views/all-property.php';
	
}

function all_user_view_function(){
include_once PLUGIN_DIR_PATH.'/views/all-users.php';
	
}

function all_new_prop_function(){

	include_once PLUGIN_DIR_PATH.'/views/add-new-property.php';


 } 


function add_property_table(){

global $wpdb;
require_once(ABSPATH. 'wp-admin/includes/upgrade.php');

if(count($wpdb->get_var('SHOW TABLES LIKE "wp_add_property"')) == 0){

	$sql_query_to_create_table ="CREATE TABLE `wp_add_property` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `property_type_id` int(11) NOT NULL,
 `title` varchar(255) NOT NULL,
 `description` text NOT NULL,
 `location` varchar(255) NOT NULL,
 `postcode` varchar(255) NOT NULL,
 `city` varchar(200) NOT NULL,
 `country` varchar(50) NOT NULL,
 `map` varchar(800) NOT NULL,
 `latitude` varchar(50) NOT NULL,
 `longitude` varchar(50) NOT NULL,
 `contact_details` varchar(500) NOT NULL,
 `status` enum('t','f') NOT NULL DEFAULT 'f',
 `no_of_bedrooms` int(20) DEFAULT NULL,
 `no_of_bathrooms` int(20) DEFAULT NULL,
 `is_garden` enum('t','f') NOT NULL DEFAULT 'f',
 `is_parking` enum('t','f') NOT NULL DEFAULT 'f',
 `is_centralheating` enum('t','f') DEFAULT 'f',
 `is_ac` enum('t','f') NOT NULL DEFAULT 'f',
 `is_wifi` enum('t','f') NOT NULL DEFAULT 'f',
 `is_cable` enum('t','f') NOT NULL DEFAULT 'f',
 `is_washing` enum('t','f') NOT NULL DEFAULT 'f',
 `is_dryer` enum('t','f') NOT NULL DEFAULT 'f',
 `is_dishwasher` enum('t','f') NOT NULL DEFAULT 'f',
 `is_microwave` enum('t','f') NOT NULL DEFAULT 'f',
 `price` float NOT NULL,
 `added_by` int(11) NOT NULL,
 `added_date` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	dbDelta($sql_query_to_create_table);
}



}


 register_activation_hook(__FILE__,'add_property_table');



 ?>