<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Admin_Controller {

	public $model;
	public $base;

	function __construct() {
		parent::__construct();
		
		$this->model = 'm_products_category';
		$this->base = 'category';
		$this->load->model($this->model);
	}

	function index() {
		$this->load->view('admin/product_category_v');
	}
	
	function get_category() {
		if(isset($_POST['id']) && $_POST['id'] != '') {
			$row = $this->{$this->model}->get_category( $_POST['id'] );
			
			echo json_encode( array('result' => $row) );
		}
	}
	
	function category_add() {
		if(isset($_POST) && (count($_POST) > 0)) {
			//$username = $this->m_products->find_username($this->session->userdata('user_id'));
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'category' => $this->security->xss_clean(trim($this->input->post('category'))),
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
	
	function category_edit() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'category' => $this->security->xss_clean(trim($this->input->post('category'))),
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
	
}