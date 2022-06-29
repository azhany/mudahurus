<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coupons extends Admin_Controller {

	public $model;
	public $base;

	function __construct() {
		parent::__construct();
		
		$this->model = 'm_coupons';
		$this->base = 'coupons';
		$this->load->model($this->model);
	}

	function index() {
		$this->load->view('admin/coupons_v');
	}
	
	function add() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'campaign' => $this->security->xss_clean(trim($this->input->post('campaign'))),
				'product_id' => '',
				'description' => $this->security->xss_clean(trim($this->input->post('description'))),
				'expired_date' => $this->security->xss_clean(trim($this->input->post('expired_date'))),
				'insert_by' => $this->session->userdata('user_id'),
				'insert_date' => date('Y-m-d H:i:s'),
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => date('Y-m-d H:i:s')
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			$this->save($data);
		}
	}
	
	function edit() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'campaign' => $this->security->xss_clean(trim($this->input->post('campaign'))),
				'product_id' => '',
				'description' => $this->security->xss_clean(trim($this->input->post('description'))),
				'expired_date' => $this->security->xss_clean(trim($this->input->post('expired_date'))),
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => date('Y-m-d H:i:s')
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			$this->save($data);
		}
	}
	
	function get_coupon() {
		if(isset($_POST['id']) && $_POST['id'] != '') {
			$row = $this->{$this->model}->get_row( $this->security->xss_clean($_POST['id']) );
			
			echo json_encode( array('result' => $row) );
		}
	}
}