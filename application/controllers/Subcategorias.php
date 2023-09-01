<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('categorias_m');
        $this->load->model('catalogos_m');
		$this->load->model('subcategorias_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

		$this->controlador = 'subcategorias';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
        $accion = 'index';
        $d = array();
		$d['title'] = "Subcategorias";
		$data = array();
		$d['subcategorias'] = $this->subcategorias_m->get_subcategorias();
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
        $d['categorias'] = $this->categorias_m->get_categorias();
		$data = array();        
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;
		$this->layout_library->load_layout($data);
	}

	public function create_action()
    {
        $data = array(
            'descripcion'  => $this->input->post('descripcion'),
            'categoria_id' => $this->input->post('categoria_id'),
            'inactiva'     => 0
        );
        
        $this->db->insert('tbl_subcategoria_incidente', $data);
        echo $this->db->insert_id();
    }

    public function edit($id = NULL)
    {
        $accion = 'edit';
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Modificar subcategoria";
            $d['subcategoria'] = $this->subcategorias_m->get_by_id($id);
            $d['categorias'] = $this->categorias_m->get_categorias();

            $data = array();
            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function edit_action()
    {
        $this->db->set('descripcion', $this->input->post('descripcion'));
        $this->db->set('categoria_id', $this->input->post('categoria_id'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_subcategoria_incidente');
        echo 1;
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle de la subcategoria";
            $d['subcategoria'] = $this->subcategorias_m->get_by_id($id);

            $data = array();
            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;
            $this->layout_library->load_layout($data);
        }
    }

    public function get_subcategorias_by_categoria_id()
    {
        $cat_id = $this->input->post('id');
        echo json_encode($this->subcategorias_m->get_by_category_id($cat_id));
    }
}