<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_customers extends MY_Model {
	public $table;
	public $primary_key;
	
	function __construct() {
		
		$this->table = 'mudahurus_customers';
		$this->primary_key = 'id';
	}
	
	function get_customer_by_code($user_id, $customer_loyalty_code) {
		return $this->db->query("SELECT * FROM `" . $this->table . "` WHERE `user_id` = " . (int)$user_id . " AND `customer_loyalty_code` = " . $this->db->escape($customer_loyalty_code) . " LIMIT 1")->row();
	}
	
	function get_all($data) {
		$cols = array(
			'id' => $this->table . '.id',
			'full_name' => $this->table . '.full_name',
			'customer_loyalty_code' => $this->table . '.customer_loyalty_code',
			'contact_no' => $this->table . '.contact_no',
			'email' => $this->table . '.email',
			'type' => $this->table . '.type',
            'btn' => 'concat("<a class=\"btn btn-warning\" href=\"javascript:void(0);\" onclick=\"getCustomer(",mudahurus_customers.id,")\"><i class=\"fa fa-pencil\"></i></a> <a class=\"btn btn-danger\" href=\"' . site_url('admin/customers/delete/",mudahurus_customers.id,"') . '\"><i class=\"fa fa-trash\"></i></a>")'
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
                        if ($ckey == 'type') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.type',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.type',$search);
                            }                        
                        }
                        if ($ckey == 'full_name') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.full_name',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.full_name',$search);
                            }                        
                        }
                        if ($ckey == 'customer_loyalty_code') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.customer_loyalty_code',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.customer_loyalty_code',$search);
                            }                        
                        }
                        if ($ckey == 'contact_no') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.contact_no',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.contact_no',$search);
                            }                        
                        }
								if ($ckey == 'email') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.email',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.email',$search);
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
		
			$this->db->where('user_id', (int)$this->session->userdata('user_id'));
        
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