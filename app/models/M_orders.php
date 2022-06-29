<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_orders extends MY_Model {
	public $table;
	public $primary_key;
	
	function __construct() {
		
		$this->table = 'mudahurus_orders';
		$this->primary_key = 'id';
	}
	
	function get_all($data, $where=array()) {
		$cols = array(
			'id' => $this->table . '.id',
			'sku' => $this->table . '.sku',
			'quantity' => $this->table . '.quantity',
			'total_price' => 'FORMAT(' . $this->table . '.total_price, 2)',
			'status' => $this->table . '.status',
            'btn' => 'concat("<a class=\"btn btn-warning\" href=\"javascript:void(0);\" onclick=\"getOrder(",mudahurus_orders.id,")\"><i class=\"fa fa-pencil\"></i></a> <a class=\"btn btn-danger\" href=\"' . site_url('admin/orders/delete/",mudahurus_orders.id,"') . '\"><i class=\"fa fa-trash\"></i></a>")'
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
                        
                        if ($ckey == 'full_name') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.full_name',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.full_name',$search);
                            }                        
                        }
                        if ($ckey == 'id') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.id',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.id',$search);
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
								if ($ckey == 'sku') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.sku',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.sku',$search);
                            }                        
                        }
								if ($ckey == 'status') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.status',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.status',$search);
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
		
		if(!empty($where))
			$this->db->where_in('status', $where);
        
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