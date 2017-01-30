<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program_sub_model extends CI_Model {

    var $table = 'program_sub';
    var $table_id = 'id_program_sub';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    function create($param)
    {
        $this->db->set($this->table_id, 'UUID_SHORT()', FALSE);
		$query = $this->db->insert($this->table, $param);
		return $query;
    }
	
	function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $query = $this->db->delete($this->table);
        return $query;
    }
    
    function info($param)
    {
        $where = array();
		if (isset($param['id_program_sub']) == TRUE)
		{
			$where += array('id_program_sub' => $param['id_program_sub']);
		}
		if (isset($param['slug']) == TRUE)
		{
			$where += array($this->table.'.slug' => $param['slug']);
		}
        
        $this->db->select('id_program_sub, '.$this->table.'.id_program, '.$this->table.'.name,
						  '.$this->table.'.slug, program_objective, training_purpose,
						  requirements_of_participant, training_material, others,
						  '.$this->table.'.created_date, '.$this->table.'.updated_date');
        $this->db->from($this->table);
        $this->db->join('program', $this->table.'.id_program = program.id_program');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        $order = 'created_date';
        $sort = 'desc';
        $offset = 0;
        $limit = 20;
        
        if (isset($param['order']) == TRUE)
        {
            $order = $param['order'];
        }
        if (isset($param['sort']) == TRUE)
        {
            $sort = $param['sort'];
        }
        if (isset($param['limit']) == TRUE)
        {
            $limit = $param['limit'];
        }
        if (isset($param['offset']) == TRUE)
        {
            $offset = $param['offset'];
        }
        if (isset($param['id_program']) == TRUE)
        {
            $where += array('id_program' => $param['id_program']);
        }
        
        $this->db->select('id_program_sub, id_program, name, slug, program_objective, training_purpose,
						  requirements_of_participant, training_material, others, created_date,
						  updated_date');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by($order, $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query;
    }
    
    function lists_count($param)
    {
        $where = array();
        if (isset($param['id_program']) == TRUE)
        {
            $where += array('id_program' => $param['id_program']);
        }
        
        $this->db->select($this->table_id);
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->count_all_results();
        return $query;
    }
}