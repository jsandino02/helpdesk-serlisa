<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_categoria_incidente';
    }

    public function get_categorias()
    {
        $select = "c.id, c.descripcion, t.descripcion tipo_caso";
        $this->db->select($select);
        $this->db->from('tbl_categoria_incidente c');
        $this->db->join('tbl_tipo_incidente t','t.id = c.id_tipo_caso');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $select = "c.id, c.descripcion, t.descripcion tipo_caso";
        $this->db->select($select);
        $this->db->from('tbl_categoria_incidente c');
        $this->db->join('tbl_tipo_incidente t','t.id = c.id_tipo_caso');
        $query = $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}