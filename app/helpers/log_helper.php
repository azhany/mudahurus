<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function general_log($ip_address="", $http_referrer="", $current_url="", $uri_string="") {
	$CI =& get_instance();
	
	$ip_address = $CI->db->escape($ip_address);
	$http_referrer = $CI->db->escape($http_referrer);
	$current_url = $CI->db->escape($current_url);
	$uri_string = $CI->db->escape($uri_string);
	
	$sql = "INSERT INTO general_logs SET `ip_address` = $ip_address, `http_referrer` = $http_referrer, `current_url` = $current_url, `uri_string` = $uri_string, `time` = DATE_FORMAT(NOW(), '%Y-%m-%d %T')";
	$query = $CI->db->query($sql);
	
	return $CI->db->insert_id();
}

function orders_log($order_id, $user_id, $customer_id) {
	$CI =& get_instance();
	
	$sql = "INSERT INTO orders_log SET `order_id` = $order_id, `user_id` = $user_id, `customer_id` = $customer_id, `payment_date` = DATE_FORMAT(NOW(), '%Y-%m-%d %T'), `time` = DATE_FORMAT(NOW(), '%Y-%m-%d %T')";
	$query = $CI->db->query($sql);
	
	return $CI->db->insert_id();
}

?>