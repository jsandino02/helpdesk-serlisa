<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estados_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_estados e';
    }

    public function get_estados()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_estados_by_status($estado_actual = 0)
    {
        $perfil = $this->session->userdata('perfil');

        if($perfil > 0 && $estado_actual > 0)
        {
            $this->db->select('f.estados_disponibles id, e.descripcion descripcion');
            $this->db->from('tbl_flujos_estado f');
            $this->db->join('tbl_estados e','e.id = f.estados_disponibles');
            $this->db->where('f.perfil_id', $perfil);
            $this->db->where('f.estado_actual', $estado_actual);

            $this->db->order_by('orden', 'asc');

            $query = $this->db->get();
        
            return $query->result();
        }
    }
}