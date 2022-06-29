<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {

	public $model;
	public $base;

	function __construct() {
		parent::__construct();
		
		$this->model = 'm_orders';
		$this->base = 'orders';
		$this->load->model($this->model);
	}

	function index() {
		$this->load->view('admin/orders_v');
	}
	
	function add() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$date = date('Y-m-d H:i:s');
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'sku' => $this->security->xss_clean(trim($this->input->post('sku'))),
				'product_name' => $this->security->xss_clean(trim($this->input->post('product_name'))),
				'quantity' => $this->security->xss_clean(trim($this->input->post('quantity'))),
				'unit_price' => $this->security->xss_clean(trim($this->input->post('unit_price'))),
				'total_price' => $this->security->xss_clean(trim($this->input->post('total_price'))),
				'additional_notes' => $this->security->xss_clean(trim($this->input->post('additional_notes'))),
				'status' => 'pending',
				'full_name' => $this->security->xss_clean(trim($this->input->post('full_name'))),
				'mailing_addr' => $this->security->xss_clean(trim($this->input->post('mailing_addr'))),
				'mailing_addr2' => $this->security->xss_clean(trim($this->input->post('mailing_addr2'))),
				'city' => $this->security->xss_clean(trim($this->input->post('city'))),
				'postcode' => $this->security->xss_clean(trim($this->input->post('postcode'))),
				'state' => $this->security->xss_clean(trim($this->input->post('state'))),
				'email' => $this->security->xss_clean(trim($this->input->post('email'))),
				'contact_no' => $this->security->xss_clean(trim($this->input->post('contact_no'))),
				'expired_date' => date("Y-m-d H:i:s", strtotime('+3 days')),
				'insert_by' => $this->session->userdata('user_id'),
				'insert_date' => $date,
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => $date
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			//$this->save($data);
			$save = $this->{$this->model}->save($data);
			if($save !== FALSE) {
				$order_id = $save['id'];
				$tojson = array(
							'order_id' => $order_id, 
							'user' => $this->session->userdata('username'), 
							'date' => $date
						);
				$encoded_key = urlencode(base64_encode(json_encode($tojson)));
				$this->{$this->model}->save(array('id' => $order_id, 'encoded_key' => $encoded_key));
			}
			
			redirect($this->base);
		}
	}
	
	function edit() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'sku' => $this->security->xss_clean(trim($this->input->post('sku'))),
				'product_name' => $this->security->xss_clean(trim($this->input->post('product_name'))),
				'quantity' => $this->security->xss_clean(trim($this->input->post('quantity'))),
				'unit_price' => $this->security->xss_clean(trim($this->input->post('unit_price'))),
				'total_price' => $this->security->xss_clean(trim($this->input->post('total_price'))),
				'additional_notes' => $this->security->xss_clean(trim($this->input->post('additional_notes'))),
				'status' => $this->security->xss_clean(trim($this->input->post('status'))),
				'full_name' => $this->security->xss_clean(trim($this->input->post('full_name'))),
				'mailing_addr' => $this->security->xss_clean(trim($this->input->post('mailing_addr'))),
				'mailing_addr2' => $this->security->xss_clean(trim($this->input->post('mailing_addr2'))),
				'city' => $this->security->xss_clean(trim($this->input->post('city'))),
				'postcode' => $this->security->xss_clean(trim($this->input->post('postcode'))),
				'state' => $this->security->xss_clean(trim($this->input->post('state'))),
				'email' => $this->security->xss_clean(trim($this->input->post('email'))),
				'contact_no' => $this->security->xss_clean(trim($this->input->post('contact_no'))),
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
	
	function get_order() {
		if(isset($_POST['id']) && $_POST['id'] != '') {
			$row = $this->{$this->model}->get_row( $this->security->xss_clean($_POST['id']) );
			
			echo json_encode( array('result' => $row) );
		}
	}
}