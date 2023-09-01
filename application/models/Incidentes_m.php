<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Incidentes_m extends CI_Model
{
    // var $table = 'tbl_incidentes';
    // var $column_order = array('tbl_incidentes.id','fecha_creacion','asunto','tbl_incidentes.descripcion');
    // var $column_search = array('tbl_incidentes.id','e.descripcion','asunto','tbl_incidentes.descripcion');
    // var $order = array('tbl_incidentes.id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = "tbl_incidentes i";

        $this->load->model('user_m');
    }

    public function get_by_id($id)
    {
        $select = "i.id, i.fecha_creacion, DATE_FORMAT(i.fecha_creacion, '%d/%m/%Y %I:%i %p') fechaF, ". 
        "i.asunto, i.descripcion, i.estado_id, i.creado_por, i.area_id, ".
        "i.tipo_incidente_id, IFNULL(i.asignado, '') id_asignado_a, i.sub_categoria_id, i.cerrado, ". 
        "i.prioridad_id, i.observacion_cierre, i.fecha_cierre, i.cerrado_por id_cerrado_por, ".
        "e.descripcion estado, ".
        "a.descripcion area, ". 
        "ci.descripcion categoria, ".
        "si.descripcion subcategoria, ".
        "pi.descripcion prioridad, ".
        "u.nombre_usuario creado_por, ".
        "u.correo correo_creado_por, ".        
        "IFNULL(u1.nombre_usuario, '') asignado_a, ".
        "IFNULL(u1.correo, '') correo_asignado_a, ".
        "IFNULL(u2.nombre_usuario, '') cerrado_por, ".
        "IFNULL(u2.correo, '') correo_cerrado_por ";      

        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->join('tbl_estados e','e.id = i.estado_id');
        $this->db->join('tbl_subcategoria_incidente si','si.id = i.sub_categoria_id', 'left');
        $this->db->join('tbl_categoria_incidente ci','ci.id = si.categoria_id', 'left');
        $this->db->join('tbl_prioridad_incidente pi','pi.id = i.prioridad_id','left');
        $this->db->join('tbl_usuarios u','u.id = i.creado_por');
        $this->db->join('tbl_usuarios u1','u1.id = i.asignado', 'left');
        $this->db->join('tbl_usuarios u2','u2.id = i.cerrado_por', 'left');
        $this->db->join('tbl_areas a','a.id = i.area_id', 'left');
        
        $this->db->where('i.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_incidentes($caso_estado = 1)
    {
        $select = "i.id, i.asunto, " .
        "i.fecha_creacion, " .
        "i.descripcion, " . 
        "i.estado_id, e.descripcion estado, ".
        "i.area_id, a.descripcion area, ".
        "i.creado_por, u.nombre_usuario creado_por, " .
        "i.asignado, IFNULL(u1.nombre_usuario, '') asignado";

        $this->db->select($select);
        $this->db->from($this->table);

        $this->db->join('tbl_estados e','e.id = i.estado_id');
        $this->db->join('tbl_usuarios u','u.id = i.creado_por');        
        $this->db->join('tbl_usuarios u1','u1.id = i.asignado', 'left');
        $this->db->join('tbl_areas a','a.id = u1.area_id', 'left');

        $this->db->where('i.eliminado', 0);

        if($caso_estado == 1)
        {
            $this->db->where('i.cerrado', 0);
        }
        else
        {
            $this->db->where('i.cerrado', 1);
        }

        //Filtro del ticket
        if(isset($_POST['searchTicket']))
        {
            if($_POST['searchTicket'] > 0)
            {
                $this->db->where('i.id', $_POST['searchTicket']);
            }
        }

        //Filtro de la fecha
        if(isset($_POST['searchCreado']))
        {
            if($_POST['searchCreado'] != "")
            {
                //Vamos a formatear la hora
                $fecha_bruta = $_POST['searchCreado'];
                $arr1 = explode("-", $fecha_bruta);

                $parte1 = trim($arr1[0]);
                $parte2 = trim($arr1[1]);

                //Con la primera fecha
                $fecha1 = explode("/", $parte1);
                $d = $fecha1[0];
                $m = $fecha1[1];
                $a = $fecha1[2];

                $f_desde = $a."-".$m."-".$d." 00:00:00";

                //Con la segunda fecha
                $fecha2 = explode("/", $parte2);
                $d = $fecha2[0];
                $m = $fecha2[1];
                $a = $fecha2[2];

                $f_hasta = $a."-".$m."-".$d." 23:59:59";

                $this->db->where('i.fecha_creacion >=', $f_desde);
                $this->db->where('i.fecha_creacion <=', $f_hasta);
            }
        }

        //Filtro del asunto o nombre del cliente
        if(isset($_POST['searchAsunto']))
        {
            $this->db->like("i.asunto", $_POST['searchAsunto']);
        }

        //Filtro por el estado
        if(isset($_POST['searchEstado']))
        {
            if($_POST['searchEstado'] > 0)
            {
                $this->db->where('i.estado_id', $_POST['searchEstado']);
            }
        }
        //Filtramos lo correspondiente
        $perfil = $this->session->userdata('perfil');
        $usuario = $this->session->userdata('user_id');

        //Filtro por tipos de casos
        if(isset($_POST['tiposDeCasos']))
        {
            if($_POST['tiposDeCasos'] == "REPORTADOS")
            {
                $this->db->where('i.creado_por', $usuario);
            }
        }
        else {
            //Coordinador
            if($perfil == 2)
            {
                $this->db->where('i.area_id', $this->session->userdata('area_id'));
            }

            //Analista
            if($perfil == 3)
            {
                $this->db->where('i.asignado', $usuario);
            }

            //Cliente
            if($perfil == 4)
            {
                $this->db->where('i.creado_por', $usuario);
            }
        }
        $this->db->order_by('i.id', 'desc');
    }

    public function get_incidentes($caso_estado = 1)
    {
        $this->get_all_incidentes($caso_estado);

        // if($_POST['length'] != -1)
        //     $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        //log_message("error", $this->db->last_query());

        return $query->result();
    }

    public function count_filtered()
    {
        $this->get_all_incidentes();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_all_incidentes_detalles($id)
    {
         $this->db->select('d.*, e.descripcion as estado, u.nombre_usuario as modificado_por, IFNULL(u1.nombre_usuario,0) as asignado');

        $this->db->join('tbl_estados e','e.id = d.estado_id');
        $this->db->join('tbl_usuarios u','u.id = d.modificado_por');
        $this->db->join('tbl_usuarios u1','u1.id = d.asignado', 'left');

        $this->db->from('tbl_incidentes_detalles d');
        $this->db->where('d.incidente_id', $id);

        $this->db->order_by('id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_ultimo_incidentes_detalle($id)
    {
        $select = "d.*, e.descripcion estado, u.nombre_usuario modificado_por, ".
        "IFNULL(u1.nombre_usuario,0) asignado";
        $this->db->select($select);
        $this->db->join('tbl_estados e','e.id = d.estado_id');
        $this->db->join('tbl_usuarios u','u.id = d.modificado_por');
        $this->db->join('tbl_usuarios u1','u1.id = d.asignado', 'left');
        $this->db->from('tbl_incidentes_detalles d');
        $this->db->where('d.incidente_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_dates($date)
    {
        if($date != '')
        {
            $fechas = explode('_', $date);            

            //Fecha desde
            $f1 = $fechas[0];
            $f_desde = explode('-', $f1);
            $d = $f_desde[0];
            $m = $f_desde[1];
            $a = $f_desde[2];

            $desde = $a.'-'.$m.'-'.$d.' 00:00:00';

            //Fecha hasta
            $f2 = $fechas[1];
            $f_hasta = explode('-', $f2);
            $d = $f_hasta[0];
            $m = $f_hasta[1];
            $a = $f_hasta[2];

            $hasta = $a.'-'.$m.'-'.$d.' 23:59:59';


            $this->db->select('i.*, e.descripcion estado_actual, u.nombre_usuario creado_por, a.descripcion area, i.asignado, IFNULL(u1.nombre_usuario,0) asignado_a, i.prioridad_id, ci.descripcion categoria, si.descripcion subcategoria, pi.descripcion prioridad,IFNULL(u2.nombre_usuario,0) cerrado_por_usuario, ti.descripcion tipo_caso, det.comentario, det.modificado, u3.nombre_usuario modificado_por, e1.descripcion  estado_seguimiento');

            $this->db->join('tbl_incidentes_detalles det','det.incidente_id = i.id');
            $this->db->join('tbl_estados e','e.id = i.estado_id');
            $this->db->join('tbl_estados e1','e1.id = det.estado_id');
            $this->db->join('tbl_usuarios u','u.id = i.creado_por');
            $this->db->join('tbl_subcategoria_incidente si','si.id = i.sub_categoria_id', 'left');
            $this->db->join('tbl_categoria_incidente ci','ci.id = si.categoria_id', 'left');
            $this->db->join('tbl_tipo_incidente ti','ti.id = i.tipo_incidente_id');
            $this->db->join('tbl_prioridad_incidente pi','pi.id = i.prioridad_id','left');
            $this->db->join('tbl_usuarios u1','u1.id = i.asignado', 'left');
            $this->db->join('tbl_usuarios u2','u2.id = i.cerrado_por', 'left');
            $this->db->join('tbl_usuarios u3','u3.id = det.modificado_por', 'left');
            $this->db->join('tbl_areas a',' a.id = u1.area_id', 'left');

            $this->db->from($this->table);

            if($this->session->userdata('perfil') == 2)
            {
                $this->db->where('i.area_id =', $this->session->userdata('area_id'));
            }
            else if($this->session->userdata('perfil') == 3)
            {
                $this->db->where('i.asignado =', $this->session->userdata('user_id'));
            }
            else if($this->session->userdata('perfil') == 4)
            {
                $this->db->where('i.creado_por =', $this->session->userdata('user_id'));
            }

            $this->db->where('i.fecha_creacion >=', $desde);
            $this->db->where('i.fecha_creacion <=', $hasta);

            $this->db->order_by('i.id, det.id', 'asc');
            $query = $this->db->get();
            log_message("error", $this->db->last_query());

            return $query->result();
        }

        return null;

    }

    public function resumen_por_analistas()
    {
        $perfil = $this->session->userdata('perfil');

        if($perfil < 3)
        {
            $select = "u.nombre_usuario,  
            SUM(CASE WHEN (i.estado_id = 2) THEN 1 ELSE 0 END) AS en_proceso,
            SUM(CASE WHEN (i.estado_id = 3) THEN 1 ELSE 0 END) AS notificado,
            SUM(CASE WHEN (i.estado_id = 4) THEN 1 ELSE 0 END) AS resuelto,
            SUM(CASE WHEN (i.estado_id = 5) THEN 1 ELSE 0 END) AS revision";
            
            $this->db->select($select);

            $this->db->from('tbl_incidentes i');
            $this->db->join('tbl_usuarios u', 'u.id = i.asignado');
            $this->db->where('i.eliminado', 0);
            $this->db->where('i.cerrado', 0);

            //Si es coordinador filtramos por area
            // if($perfil == 2)
            // {
            //     $this->db->where('i.area_id', $this->session->userdata('area_id'));
            // }
            
            $this->db->group_by('u.nombre_usuario');

            $query = $this->db->get(); 
            return $query->result();
        }
        else
        {
            return null;
        }
    }
}