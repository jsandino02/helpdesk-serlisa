<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('areas_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

        $this->controlador = 'areas';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';

        $d = array();
		$d['title'] = "Areas";

		$data = array();

		$d['areas'] = $this->areas_m->get_areas();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

	public function create()
	{
        $accion = 'create';

        $d = array();
		$d['title'] = "Crear area";

		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

	public function create_action()
    {
        $data = array(
            'descripcion' => $this->input->post('nombre_area'),
            'inactiva' => 0
        );
        
        $this->db->insert('tbl_areas', $data);
        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
        $accion = 'edit';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar area";

            $d['area'] = $this->areas_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('descripcion', $this->input->post('nombre'));
        $this->db->set('creado', 'NOW()', FALSE);
        $this->db->set('inactiva', 0);

        $this->db->where('id', $this->input->post('id'));

        $this->db->update('tbl_areas');

        echo 1;
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle del area";

            $d['area'] = $this->areas_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }
}