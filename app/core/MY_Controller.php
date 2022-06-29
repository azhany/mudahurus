<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	var $data;

	function __construct() {
		parent::__construct();
		
		$this->load->helper('log_helper');
		$this->load->helper('general_helper');
	}

	function index() {

	}
}