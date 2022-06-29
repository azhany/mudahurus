<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Admin_Controller {

	public $data = array();

	function __construct() {
		parent::__construct();
		
		$this->ci =& get_instance();
        header('Content-type: application/json');
        
        $this->data['limit'] = $this->ci->input->get('perPage');
        $this->data['offset'] = $this->ci->input->get('offset');
        $this->data['queries'] = $this->ci->input->get('queries');
        $this->data['sorts'] = $this->ci->input->get('sorts');
                
        if (!is_array($this->data['queries'])) {
            unset($this->data['queries']);
        }
        
        if (!is_array($this->data['sorts'])) {
            unset($this->data['sorts']);
        }
        
        if ($this->data['limit'] == '') { unset($this->data['limit']); }
        if ($this->data['offset'] == '') { unset($this->data['offset']); }
	}

	function products() {
        $this->ci->load->model('m_products');
        echo json_encode( $this->ci->m_products->get_all( $this->data) );
		exit();
    }
	
	function product_category() {
        $this->ci->load->model('m_products_category');
        echo json_encode( $this->ci->m_products_category->get_all( $this->data) );
		exit();
    }
	
	function coupons() {
        $this->ci->load->model('m_coupons');
        echo json_encode( $this->ci->m_coupons->get_all( $this->data) );
		exit();
    }
	
	function orders() {
        $this->ci->load->model('m_orders');
        echo json_encode( $this->ci->m_orders->get_all( $this->data) );
		exit();
    }
	
	function pending_orders() {
        $this->ci->load->model('m_orders');
        echo json_encode( $this->ci->m_orders->get_all( $this->data, array( 'pending', 'payment_received', 'payment_accepted' ) ) );
		exit();
    }
	
	function customers() {
        $this->ci->load->model('m_customers');
        echo json_encode( $this->ci->m_customers->get_all( $this->data) );
		exit();
    }
}