<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'tbl_configuracion';
    }

    public function get_by_id($id)
    {
        $query = $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_key($key)
    {
        $this->db->select("valor");
        $this->db->from("tbl_configuracion");
        $this->db->where("descripcion", $key);
        $query = $this->db->get(); 
        //log_message("error", $this->db->last_query());
        return $query->row()->valor;
    }
}