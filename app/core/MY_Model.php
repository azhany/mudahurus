<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	var $table;
	var $joined_table;
	var $primary_key;
	var $foreign_key;
	var $unique_key;
	var $save;

	function __construct() {
		parent::__construct();
		
		$this->load->database();
	}

	function index() {

	}

	function save($data) {
		if(!empty($data)) {
        	if (isset($data[$this->primary_key])) {
            		$this->db->where(array($this->primary_key => $data[$this->primary_key], 'user_id' => $this->session->userdata('user_id')));
            		$this->db->update($this->table, $data);
        	} else {
            		$this->db->insert($this->table, $data);
            		$data[$this->primary_key] = $this->db->insert_id();
        	}

        	return $data;   
		}
		
		return FALSE;
	}

	function remove($id) {
        	$res = $this->db->delete($this->table, array($this->primary_key => $id, 'user_id' => $this->session->userdata('user_id')));
        	return true;
	}
	
	function get_row($id) {
        	$res = $this->db->get_where($this->table, array($this->primary_key => $id, 'user_id' => $this->session->userdata('user_id')));
        	return ($res->num_rows() > 0) ? $res->row_array() : false;
	}
}