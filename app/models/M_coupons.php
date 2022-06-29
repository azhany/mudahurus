<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_coupons extends MY_Model {
	public $table;
	public $primary_key;
	
	function __construct() {
		
		$this->table = 'mudahurus_coupons';
		$this->primary_key = 'id';
	}
	
	function get_all($data) {
		$cols = array(
			'id' => $this->table . '.id',
			'campaign' => $this->table . '.campaign',
			'description' => $this->table . '.description',
			'expired_date' => $this->table . '.expired_date',
            'btn' => 'concat("<a class=\"btn btn-warning\" href=\"javascript:void(0);\" onclick=\"getCoupon(",mudahurus_coupons.id,")\"><i class=\"fa fa-pencil\"></i></a> <a class=\"btn btn-danger\" href=\"' . site_url('admin/coupons/delete/",mudahurus_coupons.id,"') . '\"><i class=\"fa fa-trash\"></i></a>")'
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
                        
                        if ($ckey == 'campaign') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.campaign',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.campaign',$search);
                            }                        
                        }
                        if ($ckey == 'description') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.description',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.description',$search);
                            }                        
                        }
                        if ($ckey == 'expired_date') {
                            if ($thisfirst == 1) {
                                $this->db->like($this->table . '.expired_date',$search);
                                $thisfirst = 0;
                            } else {
                                $this->db->or_like($this->table . '.expired_date',$search);
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