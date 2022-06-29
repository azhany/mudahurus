<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

	public $data;
	var $model;
	var $base;

	function __construct() {
		parent::__construct();
		
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('login', 'refresh');
		}
	}

	function index() {

	}

	function save($data, $option = false) {
		$id = $this->{$this->model}->save($data);
		
		if($option)
			return $id;
		
		redirect($this->base);
	}

	function delete() {
		$id = $this->uri->segment(4);
	    if($id != ''){
		    $this->{$this->model}->remove($id);
		    
		    redirect($this->base);
	    }
	}
}