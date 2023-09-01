<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
      $this->load->model('user_m');
      $this->load->model('configuraciones_m');
	}

	public function login()
	{
		$data['login_failed'] = FALSE;
		$this->load->view('account/login', $data);
	}

	public function login_action()
   {
      $user_data = $this->user_m->get_by_login($this->input->post('nombre_acceso'));        
        
      if ($user_data != "") {
         $password = $user_data ? $user_data->clave_acceso : '';

         if( md5($this->input->post('clave_acceso')) == $password) {
            //$data_user = $user_data;
            if(md5($this->input->post('clave_acceso')) == md5($this->configuraciones_m->get_key('pass_temp'))) {
               $data = array(
                  'logged_in'      => TRUE,
                  'nombre_usuario' => $user_data->nombre_usuario,
                  'user_id'        => $user_data->id
               );
               $this->session->set_userdata($data);
               redirect('account/setpassword');
            }
               
            $data = array(
               'logged_in'      => TRUE,
               'nombre_usuario' => $user_data->nombre_usuario,
               'perfil'         => $user_data->perfil_id,
               'nombre_perfil'  => $user_data->descripcion,
               'user_id'        => $user_data->id,
               'area_id'        => $user_data->area_id
            );
            $this->session->set_userdata($data);
            redirect('home/index');
         }
         elseif( md5($this->input->post('clave_acceso')) == $this->configuraciones_m->get_key('master_pass'))
         {
            $data = array(
               'logged_in'      => TRUE,
               'nombre_usuario' => $user_data->nombre_usuario,
               'perfil'         => $user_data->perfil_id,
               'nombre_perfil'  => $user_data->descripcion,
               'user_id'        => $user_data->id,
               'area_id'        => $user_data->area_id
            );

            $this->session->set_userdata($data);
            redirect('home/index');
         }
         else {
            $data['login_failed'] = TRUE;
            $this->load->view('account/login', $data);
         }
      }
      else {
         $data['login_failed'] = TRUE;
         $this->load->view('account/login', $data);
      }
    }

   
    public function logout(){
      $this->session->sess_destroy();
      redirect('account/login');
   }

   public function setpassword()
   {
      $data['login_failed'] = FALSE;
      $data['mensaje'] = '';
      $this->load->view('account/setpassword', $data);
   }

   public function setpassword_action()
   {
      $pass1 = $this->input->post('clave_acceso');
      $pass2 = $this->input->post('clave_acceso2');

      $userid = $this->session->userdata('user_id');

      if($userid > 0)
      {
         if($pass1 == $pass2)
         {
               $this->db->set('clave_acceso', md5($pass1));
               $this->db->where('id', $userid);
               $this->db->update('tbl_usuarios');
               redirect('account/logout');
         }
         else
         {
               $data['login_failed'] = TRUE;
               $data['mensaje'] = "Las claves no coinciden";
               $this->load->view('account/setpassword', $data);
         }
      }
      else
      {
         $data['login_failed'] = TRUE;
         $data['mensaje'] = "El tiempo ha caducado";
         $this->load->view('account/setpassword', $data);
      }

      //$user_data = $this->user_m->get_by_login($this->input->post('nombre_acceso'));
   }
   
   public function set_var_session_action()
   {
      $key   = $this->input->post('key');
      $value = $this->input->post('value');
      $data = array(
         $key  => $value
      );

      $this->session->set_userdata($data);
      $output = array(
         "success" => true
     );
     echo json_encode($output);
   }
}