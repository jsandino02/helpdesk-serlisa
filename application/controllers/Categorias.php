<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('categorias_m');
        $this->load->model('catalogos_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

        $this->controlador = 'categorias';

        if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';
        $d = array();
		$d['title'] = "Categorias";
        $d['categorias'] = $this->categorias_m->get_categorias();

		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;
		$this->layout_library->load_layout($data);
	}

	public function create()
	{
		$accion = 'create';

        $d = array();
		$d['title'] = "Categorias";
        $d['tipos_caso'] = $this->catalogos_m->get_list("tipo_incidente");

		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}

	public function create_action()
    {
        $data = array(
            'descripcion' => $this->input->post('categoria'),
            'id_tipo_caso' => $this->input->post('id_tipo_caso'),
            'inactiva'     => 0
        );
        
        $this->db->insert('tbl_categoria_incidente', $data);
        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
        $accion = 'edit';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar categoria";
            $d['categoria'] = $this->categorias_m->get_by_id($id);

            $data = array();
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
        $this->db->update('tbl_categoria_incidente');
        echo 1;
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle de la categoria";
            $d['categoria'] = $this->categorias_m->get_by_id($id);
            
            $data = array();
            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;
            $this->layout_library->load_layout($data);
        }
    }

    public function get_categorias_by_tipocaso()
    {
        $id_tipo_caso = $this->input->post('id');
        echo json_encode($this->catalogos_m->get_list_by_id("categoria_incidente", "id_tipo_caso", $id_tipo_caso));
    }
}