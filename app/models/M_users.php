<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends MY_Model {
	public $table;
	public $primary_key;
	
	function __construct() {
		
		$this->table = 'users';
		$this->primary_key = 'id';
	}

	function get_profile($user_id) {
		return $this->db->query("SELECT * FROM `" . $this->table . "` WHERE `id` = " . (int)$user_id . " LIMIT 1")->row();
	}
}