<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('catalogos_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

        $this->controlador = 'catalogos';

        if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

    public function get_list()
    {
        $tabla = $this->input->post('tabla');
        $deleted = $this->input->post('deleted');
        echo json_encode($this->catalogos_m->get_list($tabla, $deleted));
    }

    public function get_list_filter()
    {
        $tabla = $this->input->post('tabla');
        $campo = $this->input->post('campo');
        $valor = $this->input->post('valor');
        echo json_encode($this->catalogos_m->get_list_by_id($tabla, $campo, $valor));
    }

    public function get_analistas_by_area()
    {
        $id_area = $this->input->post('id_area');
        $this->load->model('user_m');
        echo json_encode($this->user_m->get_analistas_by_area($id_area));
    }
}