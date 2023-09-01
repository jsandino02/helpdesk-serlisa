<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_menu';
        $this->load->model('user_m');
    }

    public function get_menu_items($perfil_id, $id_menu = 0)
    {
        if($perfil_id > 0)
        {
            //Si es administrador mostramos todo
            if($perfil_id == 1)
            {
                $this->db->from($this->table);
                $this->db->where('estado', 1);

                if($id_menu > 0)
                {
                    $this->db->where('id_padre', $id_menu);
                }

                $this->db->order_by('orden', 'asc');
                $query = $this->db->get();

                if( $this->db->count_all_results() )
                {
                    return $query->result();
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                $this->db->from($this->table);
                $this->db->join('tbl_accesos','tbl_accesos.menu_id = tbl_menu.id');
                $this->db->where('estado', 1);
                $this->db->where('tbl_accesos.perfil_id', $perfil_id);

                if($id_menu > 0)
                {
                    $this->db->where('id_padre', $id_menu);
                }

                $this->db->order_by('orden', 'asc');
                $query = $this->db->get();

                if( $this->db->count_all_results() )
                {
                    return $query->result();
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function get_dashboard_tiles()
    {
        $txtquery = 'dt.id, dt.perfil_id,dt.estado_id,dt.titulo,dt.color,dt.tamano,dt.icono,dt.orden,dt.filtro';

        $mostrar = 0;
        $perfil_id = $this->session->userdata('perfil');

        //Parametros mostrar
        //1 - CASOS REPORTADOS POR MI
        //2 - CASOS ASIGNADOS
        if($this->session->userdata('mostrar') != null)
        {
            $mostrar = (int) $this->session->userdata('mostrar');
        }        
        
        if($perfil_id == 4 || $mostrar == 1)
        {
            $user = $this->user_m->get_by_id($this->session->userdata('user_id'));
            $user_id = $user->id;

            $txtquery .= ',(select count(i.id) from tbl_incidentes i where i.cerrado = 0 and i.estado_id = dt.estado_id and i.creado_por = '.$user_id.') as total';
        }
        else
        {
            //Si es administrador
            if($perfil_id == 1)
            {
                $txtquery .= ',(select count(i.id) from tbl_incidentes i where i.cerrado = 0 and i.estado_id = dt.estado_id) as total';
            }
            //Si es coordinador
            else if($perfil_id == 2)
            {
                $txtquery .= ',(SELECT COUNT(i.id) FROM tbl_incidentes i WHERE i.cerrado = 0 AND i.estado_id = dt.estado_id) total';
            }
            //Si es analista
            else if($perfil_id == 3)
            {
                $user = $this->user_m->get_by_id($this->session->userdata('user_id'));
                $user_id = $user->id;

                $txtquery .= ',(select count(i.id) from tbl_incidentes i where i.cerrado = 0 and i.estado_id = dt.estado_id and i.asignado = '.$user_id.') as total';
            }
            else
            {
                $txtquery .= ',0 as total';
            }
        }        

        $this->db->select($txtquery);
        $this->db->where('perfil_id', $perfil_id);
        $this->db->from('tbl_dashboard_tiles dt');
        $this->db->order_by('orden', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}