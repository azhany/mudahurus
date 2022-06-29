<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$ip_address = "";
		if(isset($_SERVER['REMOTE_ADDR']))
			$ip_address = $_SERVER['REMOTE_ADDR'];
		
		$http_referrer = "";
		if(isset($_SERVER['HTTP_REFERER']))
			$http_referrer = $_SERVER['HTTP_REFERER'];
		
		general_log($ip_address, $http_referrer, current_url(), uri_string());
		
		$this->load->view('homepage_v');
	}
}