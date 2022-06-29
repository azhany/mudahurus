<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends Public_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';
		$ip_address = "";
		if(isset($_SERVER['REMOTE_ADDR']))
			$ip_address = $_SERVER['REMOTE_ADDR'];
		
		$http_referrer = "";
		if(isset($_SERVER['HTTP_REFERER']))
			$http_referrer = $_SERVER['HTTP_REFERER'];
		
		if($this->uri->segment(2) != NULL) {
			$username = $this->uri->segment(2);
			$this->load->model('m_products');
			$user_id = $this->m_products->find_userid($username);
			
			$this->load->database('default', TRUE);
			if($this->uri->segment(3) != NULL) {
				$product_id = $this->uri->segment(3);
				$data['user_id'] = $user_id['id'];
				$data['result'] = $this->db->get_where('mudahurus_products', array('user_id'=>$user_id['id'],'id'=>$product_id))->row_array();
				
				if(!empty($data['result']) && sizeof($data['result']) > 0 && $data['result']['status'] != 'inactive') {
					general_log($ip_address, $http_referrer, current_url(), uri_string());
					$this->load->view('store_v', $data);
				} else {
					redirect('store/' . $username);
				}
			} else {
				$this->db->select('users.username, mudahurus_products.*, mudahurus_products_category.category');
				$this->db->join('mudahurus_products_category', 'mudahurus_products_category.id=mudahurus_products.category_id', 'left');
				$this->db->join('users', 'users.id=mudahurus_products.user_id', 'left');
				$this->db->order_by('mudahurus_products.id DESC');
				$data['products'] = $this->db->get_where('mudahurus_products', array('mudahurus_products.user_id'=>$user_id['id'],'status'=>'active'))->result_array();
				
				$this->db->select('users.*');
				$data['store_name'] = $this->db->get_where('users', array('id'=>$user_id['id']))->row_array();
				
				general_log($ip_address, $http_referrer, current_url(), uri_string());
				$this->load->view('page_store_v', $data);
			}
		} else {
			general_log($ip_address, $http_referrer, current_url(), uri_string());
			$this->load->view('search_v');
		}
	}
	
	function submit_order() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$date = date('Y-m-d H:i:s');
			$data = array(
				'user_id' => $this->security->xss_clean(trim($this->input->post('user_id'))),
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
				'insert_by' => $this->security->xss_clean(trim($this->input->post('user_id'))),
				'insert_date' => $date,
				'modified_by' => $this->security->xss_clean(trim($this->input->post('user_id'))),
				'modified_date' => $date
			);
			
			$user = $this->security->xss_clean($this->input->post('user'));
			
			$this->load->model('m_orders');
			$save = $this->m_orders->save($data);
			if($save !== FALSE) {
				$order_id = $save['id'];
				$tojson = array(
							'order_id' => $order_id, 
							'user' => $user, 
							'date' => $date
						);
				$encoded_key = urlencode(base64_encode(json_encode($tojson)));
				$this->m_orders->save(array('id' => $order_id, 'encoded_key' => $encoded_key));
			}
			
			if(isset($_POST['customer_type']) && $_POST['customer_type'] == "new") {
				$cus = array(
					'user_id' => $this->security->xss_clean(trim($this->input->post('user_id'))),
					'type' => 'prospect',
					'full_name' => $this->security->xss_clean(trim($this->input->post('full_name'))),
					'mailing_addr' => $this->security->xss_clean(trim($this->input->post('mailing_addr'))),
					'mailing_addr2' => $this->security->xss_clean(trim($this->input->post('mailing_addr2'))),
					'city' => $this->security->xss_clean(trim($this->input->post('city'))),
					'postcode' => $this->security->xss_clean(trim($this->input->post('postcode'))),
					'state' => $this->security->xss_clean(trim($this->input->post('state'))),
					'email' => $this->security->xss_clean(trim($this->input->post('email'))),
					'contact_no' => $this->security->xss_clean(trim($this->input->post('contact_no'))),
					'insert_by' => $this->security->xss_clean(trim($this->input->post('user_id'))),
					'insert_date' => $date,
					'modified_by' => $this->security->xss_clean(trim($this->input->post('user_id'))),
					'modified_date' => $date
				);
				
				$this->load->model('m_customers');
				$save_cus = $this->m_customers->save($cus);
				if($save_cus !== FALSE) {
					$customer_id = $save_cus['id'];
					$this->m_customers->save(array('id' => $customer_id, 'customer_loyalty_code' => $user . "-" . $customer_id));
					$this->m_orders->save(array('id' => $order_id, 'customer_id' => (int)$customer_id));
				}
			}
			
			redirect('invoice/' . $encoded_key);
		}
	}
	
	function invoice() {
		if($this->uri->segment(2) != null) {
			$ot = json_decode(base64_decode(urldecode($this->uri->segment(2))), true);
			
			if(!empty($ot)) {
				$order_id = $ot['order_id'];
				$user = $ot['user'];
				$date = $ot['date'];
				
				if($order_id != '' && $user != '' && $date != '') {
					$this->load->database('default', TRUE);
					$data['order'] = $this->db->get_where('mudahurus_orders', array('id'=>$order_id))->row_array();
					$data['user'] = $this->db->get_where('users', array('id'=>$data['order']['user_id']))->row_array();
					if(!empty($data['order']) && sizeof($data['order']) > 0) {
						$this->load->view('invoice_v', $data);
					} else {
						redirect('store/' . $user);
					}
				} else {
					redirect('store/' . $user);
				}
			} else {
				redirect('store');
			}
		}
	}
	
	function upload_payment($username, $order_id) {
		$filename = 'Order_ID-' . $order_id . '.' . pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
		$options = array('script_url' => APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'UploadHandler.php', 'upload_dir' => FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'payments' . DIRECTORY_SEPARATOR . $username . DIRECTORY_SEPARATOR, 'upload_url' => base_url('uploads/payments/' . $username) . "/");
		
		require(APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'UploadHandler.php');
		$upload_handler = new UploadHandler($filename, $options);
	}
	
	function submit_payment() {
		if(isset($_POST) && !empty($_POST)) {
			$user_id = $this->security->xss_clean(trim($_POST['user_id']));
			$order_id = $this->security->xss_clean(trim($_POST['order_id']));
			$payment_proof = $this->security->xss_clean(trim($_POST['payment_image_proof']));
			$status = "payment_received";
			$data_encoded = $_POST['encoded'];
			
			$data = array('id' => $order_id, 'payment_image_proof' => $payment_proof, 'status' => $status);
			
			$this->load->model('m_orders');
			$this->m_orders->save($data);
			
			$get_customer = $this->db->get_where('mudahurus_orders', array('id' => (int)$order_id))->row_array();
			$this->load->model('m_customers');
			$this->m_customers->save(array('id' => (int)$get_customer['customer_id'], 'type' => 'customer'));
			
			orders_log($order_id, $user_id, (int)$get_customer['customer_id']);
			
			redirect('invoice/' . $data_encoded);
		} else {
			redirect('store');
		}
	}
	
	function get_customer_by_code() {
		$this->load->model('m_products');
		$user_id = $this->m_products->find_userid( $this->security->xss_clean($_GET['user']) );
		$this->load->model('m_customers');
		echo json_encode( $this->m_customers->get_customer_by_code($user_id['id'], $this->security->xss_clean($_GET['customer_loyalty_code'])) );
		exit();
	}
	
	function get_product_by_sku() {
		$this->load->model('m_products');
		echo json_encode( $this->m_products->get_product_by_sku( $this->security->xss_clean($_GET['user_id']), $this->security->xss_clean($_GET['sku'])) );
		exit();
	}
}