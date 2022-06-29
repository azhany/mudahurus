<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller {

	public $model;
	public $base;

	function __construct() {
		parent::__construct();
		
		$this->model = 'm_customers';
		$this->base = 'customers';
		$this->load->model($this->model);
	}

	function index() {
		$this->load->view('admin/customers_v');
	}
	
	function add() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'customer_loyalty_code' => '',
				'full_name' => $this->security->xss_clean(trim($this->input->post('full_name'))),
				'ic_no' => $this->security->xss_clean(trim($this->input->post('ic_no'))),
				'dob' => $this->security->xss_clean(trim($this->input->post('dob'))),
				'mailing_addr' => $this->security->xss_clean(trim($this->input->post('mailing_addr'))),
				'postcode' => $this->security->xss_clean(trim($this->input->post('postcode'))),
				'city' => $this->security->xss_clean(trim($this->input->post('city'))),
				'state' => $this->security->xss_clean(trim($this->input->post('state'))),
				'contact_no' => $this->security->xss_clean(trim($this->input->post('contact_no'))),
				'email' => $this->security->xss_clean(trim($this->input->post('email'))),
				'insert_by' => $this->session->userdata('user_id'),
				'insert_date' => date('Y-m-d H:i:s'),
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => date('Y-m-d H:i:s')
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			//$this->save($data);
			$save = $this->{$this->model}->save($data);
			if($save !== FALSE) {
				$customer_id = $save['id'];
				$this->{$this->model}->save(array('id' => $customer_id, 'customer_loyalty_code' => $this->session->userdata('username') . "-" . $customer_id));
			}
			
			redirect($this->base);
		}
	}
	
	function edit() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'customer_loyalty_code' => $this->security->xss_clean(trim($this->input->post('customer_loyalty_code'))),
				'full_name' => $this->security->xss_clean(trim($this->input->post('full_name'))),
				'ic_no' => $this->security->xss_clean(trim($this->input->post('ic_no'))),
				'dob' => $this->security->xss_clean(trim($this->input->post('dob'))),
				'mailing_addr' => $this->security->xss_clean(trim($this->input->post('mailing_addr'))),
				'postcode' => $this->security->xss_clean(trim($this->input->post('postcode'))),
				'city' => $this->security->xss_clean(trim($this->input->post('city'))),
				'state' => $this->security->xss_clean(trim($this->input->post('state'))),
				'contact_no' => $this->security->xss_clean(trim($this->input->post('contact_no'))),
				'email' => $this->security->xss_clean(trim($this->input->post('email'))),
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
	
	function get_customer() {
		if(isset($_POST['id']) && $_POST['id'] != '') {
			$row = $this->{$this->model}->get_row( $this->security->xss_clean($_POST['id']) );
			
			echo json_encode( array('result' => $row) );
		}
	}
}