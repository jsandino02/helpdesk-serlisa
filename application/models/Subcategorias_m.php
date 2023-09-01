<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_subcategoria_incidente';
    }

    public function get_subcategorias()
    {
        $this->db->select('s.id, s.descripcion, ci.id as id_categoria, ci.descripcion as categoria');
        $this->db->from('tbl_subcategoria_incidente s');
        $this->db->join('tbl_categoria_incidente ci','ci.id = s.categoria_id');
        $this->db->where('s.inactiva', 0);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('s.*, ci.id as id_categoria, ci.descripcion as categoria');
        $this->db->from('tbl_subcategoria_incidente s');
        $this->db->join('tbl_categoria_incidente ci','ci.id = s.categoria_id');
        $query = $this->db->where('s.id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_by_category_id($id)
    {
        $query = $this->db->where('categoria_id', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}