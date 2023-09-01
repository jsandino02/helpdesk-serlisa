<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE ;
		$this->load->library('layout_library');

		$this->load->model('menu_m');
		$this->load->model('incidentes_m');
		$this->controlador = 'home';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index()
	{
		$accion = 'index';

		$d = array();
		$d['title'] = "Inicio";
		//Cuadro de resumen
        $resumen = null;

        if($this->session->userdata('perfil') < 3)
        {
            $resumen = $this->incidentes_m->resumen_por_analistas();
        }

        $d['resumen'] = $resumen;

		$data = array();
		$data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;

		$this->layout_library->load_layout($data);
	}
	
	public function getdashboard()
	{
		//$param_mostrar = htmlspecialchars($_GET["mostrar"]);
		//$this->session->set_userdata('mostrar', $param_mostrar);

		//log_message('error',"param_mostrar->$param_mostrar");

		$d = array();
		$d['tiles'] = $this->menu_m->get_dashboard_tiles();

		//Cuadro de resumen
        $resumen = null;

        if($this->session->userdata('perfil') < 3)
        {
            $resumen = $this->incidentes_m->resumen_por_analistas();
        }

        $d['resumen'] = $resumen;
        echo json_encode($d, JSON_NUMERIC_CHECK);
    }
}

