<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_areas';
    }

    public function get_areas()
    {
        $this->db->where('inactiva', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}