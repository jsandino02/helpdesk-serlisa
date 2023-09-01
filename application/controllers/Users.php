<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
        //$this->load->model('areas_m');
        $this->load->model('catalogos_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');
        $this->controlador = 'users';
        if(!$this->logged_in)
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';
        $d = array();
		$d['title'] = "Usuarios";

        $d['perfiles'] = $this->catalogos_m->get_list('perfiles');
        $d['areas'] = $this->catalogos_m->get_list('areas');

		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
		$this->layout_library->load_layout($data);
	}

	public function ajax_list()
    {
        $list = $this->user_m->get_users();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) 
        {
            $row = array();
            $date   = new DateTime($users->fecha_creacion);
            $row[]  = $date->format('d/m/Y h:i:s a');
            $row[]  = '<a href="'.site_url('users/detail/').$users->id.'">'.$users->nombre_usuario.'</a>';
            $row[]  = $users->nombre_acceso;
            $row[]  = $users->correo;
            $row[]  = $users->perfil;
            $row[]  = $users->area;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_m->count_all(),
            "recordsFiltered" => $this->user_m->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function create()
    {
    	$accion = 'create';
        $d = array();
		$d['title'] = "Crear usuario";
        $d['perfiles'] = $this->catalogos_m->get_list('perfiles');
        $d['areas'] = $this->catalogos_m->get_list('areas');
        $d['coordinadores'] = $this->user_m->get_coordinadores();
        
		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
		$this->layout_library->load_layout($data);
    }

    public function create_action()
    {
        $this->db->set('nombre_usuario', $this->input->post('nombre'));
        $this->db->set('correo', $this->input->post('correo'));
        $this->db->set('nombre_acceso', $this->input->post('acceso'));
        $this->db->set('clave_acceso', md5('Cifnic20201010'));
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->set('telefono', $this->input->post('telefono'));
        $this->db->set('cargo', $this->input->post('cargo'));
        $this->db->set('perfil_id', $this->input->post('perfil'));

        // if($this->input->post('perfil') == 2)
        // {
        //     $this->db->set('area_id', $this->input->post('area_id'));
        // }

        if($this->input->post('perfil') == 2 || $this->input->post('perfil') == 3)
        {
            $this->db->set('area_id', $this->input->post('area_id'));
        }

        $this->db->insert('tbl_usuarios');

        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
        $accion = 'edit';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar usuario";

            $d['perfiles'] = $this->catalogos_m->get_list('perfiles');
            $d['areas'] = $this->catalogos_m->get_list('areas');

            $d['usuario'] = $this->user_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('nombre_usuario', $this->input->post('nombre'));
        $this->db->set('correo', $this->input->post('correo'));
        $this->db->set('telefono', $this->input->post('telefono'));
        $this->db->set('cargo', $this->input->post('cargo'));
        $this->db->set('perfil_id', $this->input->post('perfil'));

        if( $this->input->post('perfil') == "2" || $this->input->post('perfil') == "3") {
            $this->db->set('area_id', $this->input->post('area'));
        }
        else {
            $this->db->set('area_id', 'NULL', false);
        }
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_usuarios');
        echo 1;
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle de usuario";

            $d['usuario'] = $this->user_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function miperfil()
    {
        $accion = 'miperfil';
        $d = array();
        $d['title'] = "Detalle de usuario";
        $d['usuario'] = $this->user_m->get_by_id($this->session->userdata('user_id'));
        $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
        $this->layout_library->load_layout($data);
    }

    public function editarperfil()
    {
        $accion = 'editarperfil';
        $d = array();
        $d['title'] = "Modificar mis datos";
        $d['usuario'] = $this->user_m->get_by_id($this->session->userdata('user_id'));
        $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
        $this->layout_library->load_layout($data);
    }

    public function editarperfil_action()
    {
        $this->db->set('nombre_usuario', $this->input->post('nombre'));
        $this->db->set('correo', $this->input->post('correo'));
        $this->db->set('telefono', $this->input->post('telefono'));
        $this->db->set('cargo', $this->input->post('cargo'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_usuarios');
        echo 1;
    }

    public function cambiar_miclave()
    {
        $accion = 'cambiar_miclave';
        $d = array();
        $d['title'] = "Cambiar mi clave de acceso";
        $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
        $this->layout_library->load_layout($data);
    }

    public function cambiar_miclave_action()
    {
        $user = $this->user_m->get_by_id($this->session->userdata('user_id'));
        if($user[0]->clave_acceso == md5($this->input->post('clave_actual')))
        {
            $this->db->set('clave_acceso', md5($this->input->post('nueva_clave')));
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('tbl_usuarios');
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    public function reset_clave_action()
    {
        $this->db->set('clave_acceso', md5('Cifnic20201010'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_usuarios');
        echo 1;
    }
}