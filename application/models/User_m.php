<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{
    // var $table = 'tbl_usuarios';
    // var $column_order = array('nombre_usuario','correo','nombre_acceso');
    // var $column_search = array('nombre_usuario','correo','nombre_acceso');
    // var $order = array('id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = "tbl_usuarios u";
    }

    public function get_by_id($id)
    {
        $select = "u.id, u.fecha_creacion, u.nombre_usuario, u.correo, u.nombre_acceso, " .
        "u.telefono, u.cargo, u.perfil_id, u.clave_acceso, p.descripcion perfil, " .
        "u.area_id, IFNULL(a.descripcion,0) area, IFNULL(u1.nombre_usuario,0) coordinador";
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->join('tbl_perfiles p', 'p.id = u.perfil_id');
        $this->db->join('tbl_areas a', 'a.id = u.area_id', 'left');
        $this->db->join('tbl_usuarios u1', 'u1.id = u.userid', 'left');
        $this->db->where('u.id', $id);
        
        $query = $this->db->get();
        
        if( $this->db->count_all_results() )
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_login($login)
    {
        $select = "u.id, u.fecha_creacion, u.nombre_usuario, u.correo, u.nombre_acceso, " .
        "u.telefono, u.cargo, u.perfil_id, u.clave_acceso, p.descripcion, u.area_id";
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->join('tbl_perfiles p', 'p.id = u.perfil_id');
        $this->db->where('u.eliminado', 0);
        $this->db->where('u.nombre_acceso', $login);
        
        $query = $this->db->get(); //log_message('error', $this->db->last_query());

        if( $this->db->count_all_results() )
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_users_query()
    {
        $select = "u.id, u.nombre_usuario, u.correo, u.nombre_acceso, " . 
        "u.fecha_creacion, u.telefono, u.cargo, " .
        "u.perfil_id, p.descripcion perfil, " . 
        "u.area_id, IFNULL(a.descripcion,'-') area";
        $this->db->select($select);
        $this->db->join('tbl_perfiles p','p.id = u.perfil_id');
        $this->db->join('tbl_areas a','a.id = u.area_id', 'left');
        $this->db->from($this->table);

        $this->db->where('u.eliminado', 0);

        //Filtro del asunto o nombre del cliente
        if(isset($_POST['searchNombre']))
        {
            $this->db->like("CONCAT(u.nombre_usuario, u.nombre_acceso)", $_POST['searchNombre']);
        }

        //Filtro por perfil
        if(isset($_POST['searchPerfil']))
        {
            if($_POST['searchPerfil'] > 0)
            {
                $this->db->where('u.perfil_id', $_POST['searchPerfil']);
            }
        }

        //Filtro por area
        if(isset($_POST['searchArea']))
        {
            if($_POST['searchArea'] > 0)
            {
                $this->db->where('u.area_id', $_POST['searchArea']);
            }
        }

        // $i = 0;
        // foreach ($this->column_search as $item)
        // {
        //     if($_POST['search']['value'])
        //     {
        //         if($i===0)
        //         {
        //             $this->db->group_start();
        //             $this->db->like($item, $_POST['search']['value']);
        //         }
        //         else
        //         {
        //             $this->db->or_like($item, $_POST['search']['value']);
        //         }
 
        //         if(count($this->column_search) - 1 == $i)
        //             $this->db->group_end();
        //     }

        //     $i++;
        // }
         
        // if(isset($_POST['order']))
        // {
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } 
        // else if(isset($this->order))
        // {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }
    }

    public function get_users()
    {
        $this->get_users_query();

        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();

        return $query->result();
    }

    public function count_filtered()
    {
        $this->get_users_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_coordinadores()
    {
        $this->db->where('perfil_id', 2);
        $this->db->where('u.eliminado', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_analistas()
    {
        $select = "u.id, u.nombre_usuario, u.correo, a.descripcion area";
        $this->db->select($select);
        $this->db->from('tbl_usuarios u');
        $this->db->join("tbl_areas a", "a.id = u.area_id");
        $this->db->where('u.eliminado', 0);
        $this->db->where('perfil_id', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_coordinador_id($id)
    {
        $this->db->where('u.userid', $id);
        $this->db->where('u.eliminado', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_area_by_id($id)
    {
        $this->db->select('u.area_id');
        $this->db->from($this->table);
        $this->db->where('u.eliminado', 0);
        $this->db->where('u.id', $id);
        
        $query = $this->db->get();
        $row = $query->row();
        return $row[0]->area_id;
    }

    public function get_correos_coordinadores()
    {
        $select = "GROUP_CONCAT(u.correo, ',') correos";
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where("correo IS NOT NULL", NULL, FALSE);
        $this->db->where("TRIM(correo) <> ''", NULL, FALSE);
        $this->db->where('u.eliminado', 0);
        $this->db->where('perfil_id', 2);
        
        $query = $this->db->get();
        $row = $query->row();
        return $row->correos;   
    }

    public function get_analistas_by_area($id_area)
    {
        $select = "u.id, u.nombre_usuario, u.correo, a.descripcion area";
        $this->db->select($select);
        $this->db->from('tbl_usuarios u');
        $this->db->join("tbl_areas a", "a.id = u.area_id");
        $this->db->where('perfil_id', 3);
        $this->db->where('area_id', $id_area);
        $this->db->where('u.eliminado', 0);
        $query = $this->db->get();
        return $query->result();
    }
}