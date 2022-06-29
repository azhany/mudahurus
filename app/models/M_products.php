<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_products extends MY_Model {

	public $table;
	public $joined_table;
	public $primary_key;
	public $foreign_key;
	public $unique_key;
	public $save;
	
	function __construct() {
		parent::__construct();
		
		$this->table = 'mudahurus_products';
		$this->joined_table = 'mudahurus_products_category';
		$this->primary_key = 'id';
		$this->foreign_key = 'category_id';
	}
	
	function get_product_by_sku($user_id, $sku) {
		return $this->db->query("SELECT * FROM `" . $this->table . "` WHERE `user_id` = " . (int)$user_id . " AND `sku` LIKE " . $this->db->escape($sku) . " LIMIT 1")->row();
	}
	
	function find_username($user_id) {
		if($user_id != "") {
			$q = $this->db->query("SELECT username FROM users WHERE id = " . (int)$user_id);
			
			if($q->num_rows() > 0)
				return $q->row_array();
		}
		
		return FALSE;
	}
	
	function find_userid($username) {
		if($username != "") {
			$q = $this->db->query("SELECT id FROM users WHERE username LIKE " . $this->db->escape($username));
			
			if($q->num_rows() > 0)
				return $q->row_array();
		}
		
		return FALSE;
	}
	
	function get_all($data) {
		$cols = array(
			'id' => $this->table . '.id',
			'sku' => $this->table . '.sku',
			'category' => $this->joined_table . '.category',
			'product_name' => $this->table . '.product_name',
			'unit_price' => 'FORMAT(' . $this->table . '.unit_price, 2)',
			'status' => $this->table . '.status',
			'btn' => 'concat("<a onclick=\"show_url(this)\" href=\"javascript:void(0);\" data-value=\"' . base_url('store') . "/" . $this->session->userdata('username') . '/",mudahurus_products.id,"\" class=\"btn btn-primary\"><i class=\"fa fa-share\"></i></a> <a class=\"btn btn-warning\" href=\"javascript:void(0);\" onclick=\"getProduct(",mudahurus_products.id,")\"><i class=\"fa fa-pencil\"></i></a> <a class=\"btn btn-danger\" href=\"' . site_url('admin/products/delete/",mudahurus_products.id,"') . '\"><i class=\"fa fa-trash\"></i></a>")'
        );
        
        $order_by = array(
            -1 => 'desc',
            1 => 'asc'
        );
        
        if (array_key_exists('queries', $data) && is_array($data['queries'])){
            if (array_key_exists('search', $data['queries'])) {
                
                $search = $data['queries']['search'];
                
                $this->db->group_start();
                            
                    $thisfirst = 1;
                    foreach($cols as $ckey => $cformat) {
                        
                        if ($ckey == 'sku') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.sku',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.sku',$search);
                            }                        
                        }
                        if ($ckey == 'category') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->joined_table . '.category',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->joined_table . '.category',$search);
                            }                        
                        }
                        if ($ckey == 'product_name') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.product_name',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.product_name',$search);
                            }                        
                        }
                        if ($ckey == 'unit_price') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.unit_price',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.unit_price',$search);
                            }                        
                        }
                    }
                
                $this->db->group_end();     
            }
        }
        
        if (array_key_exists('sorts', $data) && is_array($data['sorts'])){
            foreach($cols as $ckey => $cformat) {
                if (array_key_exists($ckey,$data['sorts'])) {
                    $this->db->order_by($cformat, $order_by[$data['sorts'][$ckey]]);
                } // if array_key_exists
            } // foreach
        } // if array_key exists
		else {
			$this->db->order_by($this->table . '.id', 'DESC');
		}
        
        foreach($cols as $ckey => $cformat) {
	        $this->db->select($cformat.' as '.$ckey, false);
        }
		
		$this->db->join($this->joined_table, $this->joined_table . '.' . $this->primary_key . '=' . $this->table . '.' . $this->foreign_key, 'left');
		
		$this->db->where($this->table . '.user_id', (int)$this->session->userdata('user_id'));
        
        $d['queryRecordCount'] = $this->db->count_all_results($this->table, FALSE);                                
                                
        if (array_key_exists('limit', $data) && array_key_exists('offset', $data)){
            $this->db->limit($data['limit'], $data['offset']);
        }
                                
        $d['totalRecordCount'] = $this->db->count_all_results('',false);
        
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $d['records'] = $res->result_array();
            $d['last_query'] = $this->db->last_query();
            return $d;
        }
        
        return array(
            'records' => array(),
            'queryRecordCount' => 0,
            'totalRecordCount' => 0,
        );
	}
}