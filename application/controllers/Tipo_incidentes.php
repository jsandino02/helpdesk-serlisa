<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_incidentes extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('tipo_incidentes_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $d = array();
		$d['title'] = "Tipos de incidentes";

		$data = array();

		$d['tipo_incidentes'] = $this->tipo_incidentes_m->get_tipoincidentes();
		$data['subview'] = $this->load->view('tipo_incidentes/index', $d, true);
		$data['controlador'] = 'tipo_incidentes';
		$data['accion'] = 'index';

		$this->layout_library->load_layout($data);
	}

	public function create()
	{
        $d = array();
		$d['title'] = "Crear tipo de incidente";
		$data = array();
		$data['subview'] = $this->load->view('tipo_incidentes/create', $d, true);
        $data['controlador'] = 'tipo_incidentes';
        $data['accion'] = 'create';
		$this->layout_library->load_layout($data);
	}

	public function create_action()
    {
        $data = array('descripcion' => $this->input->post('nombre'));        
        $this->db->insert('tbl_tipo_incidente', $data);
        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar tipo de incidente";

            $d['tipo_incidente'] = $this->tipo_incidentes_m->get_by_id($id);

            $data['subview'] = $this->load->view('tipo_incidentes/edit', $d, true);
            $data['controlador'] = 'tipo_incidentes';
            $data['accion'] = 'edit';

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('descripcion', $this->input->post('nombre'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_tipo_incidente');
        echo 1;
    }

    public function detail($id = NULL)
    {
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle de tipo de incidente";
            $d['tipo_incidente'] = $this->tipo_incidentes_m->get_by_id($id);
            $data['subview'] = $this->load->view('tipo_incidentes/detail', $d, true);
            $data['controlador'] = 'tipo_incidentes';
            $data['accion'] = 'detail';
            $this->layout_library->load_layout($data);
        }
    }
}