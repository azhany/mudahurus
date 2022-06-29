<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('m_counts');
	}

	function index() {
		$data['this_month_orders'] = $this->m_counts->count_orders(date("m"));
		$data['total_orders'] = $this->m_counts->count_orders();
		$data['this_month_sales'] = $this->m_counts->count_orders(date("m"), "sales");
		$data['total_sales'] = $this->m_counts->count_orders("", "sales");
		
		$this->load->view('admin/main', $data);
	}
	
	function profile() {
		$this->load->model('m_users');
		echo json_encode( $this->m_users->get_profile( $this->security->xss_clean($_GET['user_id']) ));
		exit();
	}
}