<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_counts extends MY_Model {

	function __construct() {
		
		
	}
	
	function count_orders($date="", $type="orders") {
		
		$where = " WHERE user_id = " . (int)$this->session->userdata('user_id');
		
		if($date != "") {
			if($where != "")
				$where .= " AND ";
			
			$where .= " DATE_FORMAT(insert_date, '%m') = " . $this->db->escape($date);
		}
		
		if($type == "sales") {
			if($where != "")
				$where .= " AND ";
			
			$where .= " status = 'shipped' ";
		}
		
		$result_count = $this->db->query("SELECT COUNT(id) AS counter FROM mudahurus_orders $where");
		
		if($result_count->num_rows() > 0)
			return $result_count->row_array();
		
		return "";
	}

}