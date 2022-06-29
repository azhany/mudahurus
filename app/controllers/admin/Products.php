<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {

	public $model;
	public $base;

	function __construct() {
		parent::__construct();
		
		$this->model = 'm_products';
		$this->base = 'products';
		$this->load->model($this->model);
	}

	function index() {
		$this->load->model('m_products_category');
		$data['categories'] = $this->m_products_category->get_categories();
		$this->load->view('admin/products_v', $data);
	}
	
	function add() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$username = $this->m_products->find_username($this->session->userdata('user_id'));
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'sku' => $this->security->xss_clean(trim($this->input->post('sku'))),
				'category_id' => $this->security->xss_clean(trim($this->input->post('category_id'))),
				'product_name' => $this->security->xss_clean(trim($this->input->post('product_name'))),
				'description' => $this->security->xss_clean(trim($this->input->post('description'))),
				//'url_slug' => base_url() . 'store/' . $username['username'] . '/' . str_replace(" ", "-", strtolower(trim($this->input->post('product_name')))),
				'unit_price' => $this->security->xss_clean(trim($this->input->post('unit_price'))),
				'file_name' => '',
				'status' => $this->security->xss_clean(trim($this->input->post('status'))),
				'insert_by' => $this->session->userdata('user_id'),
				'insert_date' => date('Y-m-d H:i:s'),
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => date('Y-m-d H:i:s')
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			$product_id = $this->save($data, true);
			
			if($_FILES['files']['tmp_name'] != "" && $this->security->xss_clean($_FILES['files']['tmp_name'], TRUE)) {
				$accepted_mime = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
				$file_info = getimagesize($_FILES['files']['tmp_name']);
				$file_mime = $file_info['mime'];
				if(in_array($file_mime, $accepted_mime)) {
					$file_name = $this->upload_product_image($username['username'], $product_id['id']);
					$this->db->update('mudahurus_products', array( 'file_name' => $file_name ), array('id' => $product_id['id']));

				}
			}
			
			redirect($this->base);
		}
	}
	
	function edit() {
		if(isset($_POST) && (count($_POST) > 0)) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'sku' => $this->security->xss_clean(trim($this->input->post('sku'))),
				'category_id' => $this->security->xss_clean(trim($this->input->post('category_id'))),
				'product_name' => $this->security->xss_clean(trim($this->input->post('product_name'))),
				'description' => $this->security->xss_clean(trim($this->input->post('description'))),
				'unit_price' => $this->security->xss_clean(trim($this->input->post('unit_price'))),
				'status' => $this->security->xss_clean(trim($this->input->post('status'))),
				'modified_by' => $this->session->userdata('user_id'),
				'modified_date' => date('Y-m-d H:i:s')
			);
			
			if($this->uri->segment(4) != NULL) {
				$id = $this->uri->segment(4);
				$data['id'] = (int)$id;
			}
			
			if($_FILES['files']['tmp_name'] != "" && $this->security->xss_clean($_FILES['files']['tmp_name'], TRUE)) {
				$accepted_mime = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
				$file_info = getimagesize($_FILES['files']['tmp_name']);
				$file_mime = $file_info['mime'];
				if(in_array($file_mime, $accepted_mime)) {
					$username = $this->m_products->find_username($this->session->userdata('user_id'));
					$data['file_name'] = $this->upload_product_image($username['username'], $data['id']);

				}
			}
			
			$this->save($data);
		}
	}
	
	function upload_product_image($username, $product_id) {
		$filename = 'Product_ID-' . $product_id . '.' . pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
		$options = array(
			'script_url' => APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'UploadHandler.php', 
			'upload_dir' => FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $username . DIRECTORY_SEPARATOR, 
			'upload_url' => base_url('uploads/products/' . $username) . "/",
			'print_response' => false,
		);
		if(file_exists($options['upload_dir'] . $file_name)) {
			unlink($options['upload_dir'] . $file_name);
			unlink($options['upload_dir'] . 'thumbnail' . DIRECTORY_SEPARATOR . $file_name);
		}
		
		require(APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'UploadHandler.php');
		$upload_handler = new UploadHandler($filename, $options);
		
		return $filename;
	}
	
	function get_product() {
		if(isset($_POST['id']) && $_POST['id'] != '') {
			$row = $this->{$this->model}->get_row( $this->security->xss_clean($_POST['id']) );
			
			echo json_encode( array('result' => $row) );
		}
	}
	
}