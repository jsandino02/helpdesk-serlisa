<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
        $this->load->model('configuraciones_m');
	}

	
	public function session_action()
    {
      $key   = $this->input->post('key');
      $value = $this->input->post('value');
      $this->session->set_userdata($key,$value);   
    }
}