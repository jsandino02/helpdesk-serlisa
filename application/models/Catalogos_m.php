<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_list($table, $deleted = false)
    {
        if($deleted)
        {
            $this->db->where('deleted', 0);
        }
        
        $query = $this->db->get("tbl_".$table);
        return $query->result();
    }

    function get_by_id($table, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_'.$table);
        return $query->row();
    }

    function get_list_by_id($table, $campo, $valor)
    {
        $this->db->where($campo, $valor);
        $query = $this->db->get('tbl_'.$table);
        return $query->result();
    }
}