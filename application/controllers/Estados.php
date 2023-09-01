<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estados extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('estados_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

        $this->controlador = 'estados';

        $this->table = 'tbl_estados';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';

        $d = array();
		$d['title'] = "Estados";

		$data = array();

		$d['estados'] = $this->estados_m->get_estados();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

    public function edit($id = NULL)
    {
        $accion = 'edit';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar nombre del estado";

            $d['estado'] = $this->estados_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('descripcion', $this->input->post('nombre'));

        $this->db->where('id', $this->input->post('id'));

        $this->db->update($this->table);

        echo 1;
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Descripcion";

            $d['estado'] = $this->estados_m->get_by_id($id);

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }
}