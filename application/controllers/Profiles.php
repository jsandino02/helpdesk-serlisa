<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('profiles_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

		$this->controlador = 'profiles';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';

        $d = array();

		$d['title'] = "Perfiles de usuario";

		$data = array();

		$d['perfiles'] = $this->profiles_m->get_perfiles();
		$data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

	public function create()
	{
		$accion = 'create';

        $d = array();
		$d['title'] = "Crear nuevo perfil";

		$data = array();
		$data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

	public function create_action()
    {
        $data = array(
            'descripcion' => $this->input->post('descripcion')
        );
        
        $this->db->insert('tbl_perfiles', $data);
        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
    	$accion = 'edit';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar nombre del perfil";

            $d['perfil'] = $this->profiles_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('descripcion', $this->input->post('descripcion'));

        $this->db->where('id', $this->input->post('id'));

        $this->db->update('tbl_perfiles');

        echo 1;
    }

    public function detail($id = NULL)
    {
    	$accion = 'detail';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle del perfil";

            $d['perfil'] = $this->profiles_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }
}