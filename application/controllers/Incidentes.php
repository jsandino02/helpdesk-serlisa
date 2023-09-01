<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('US/Central');

class Incidentes extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('incidentes_m');
        $this->load->model('catalogos_m');
        $this->load->model('configuraciones_m');
        $this->load->model('user_m');
        $this->load->model('estados_m');

		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;		
        $this->load->library('layout_library');
        $this->controlador = 'incidentes';
        if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

	public function index($estado_id = 0)
	{
        $accion = 'index';

        $d = array();
		$d['title'] = 'Casos reportados';

        $d['estado_id'] = $estado_id;
        $d['estados'] = $this->estados_m->get_estados();

        //$d['estado'] = $estado_id;

        // $estado = '';

        // if($estado_id > 0)
        // {
        //     $array_estado = $this->catalogos_m->get_by_id("estados", $estado_id);
        //     $estado = $array_estado->descripcion;
        // }

        // $d['estado'] = $estado;

		$data = array();
		$data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;
		
		$this->layout_library->load_layout($data);
	}

	public function ajax_list($caso_estado = 1)
    {
        $list = $this->incidentes_m->get_incidentes($caso_estado);
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $inc) 
        {
            $row = array();
            $row[]  = '<a href="'.site_url('incidentes/detail/').$inc->id.'">#'.$inc->id.'</a>';
            $date   = new DateTime($inc->fecha_creacion);
            $row[]  = $date->format('d/m/Y h:i:s a');
            $row[] 	= strtoupper($inc->asunto);            
            $row[]	= strtoupper($inc->creado_por);
            $row[]	= strtoupper($inc->estado);

            if($caso_estado==2) {
                if($inc->asignado == '0')
                {
                    $asignado = 'Sin asignar';
                }
                else
                {
                    $asignado = $inc->asignado;
                }

                $row[] = $asignado;
                $row[] = $inc->descripcion;
            }

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->incidentes_m->count_all(),
            "recordsFiltered" => $this->incidentes_m->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function create()
    {
        $accion = 'create';
        $d = array();
        $d['title'] = "Crear caso";

        $d['tipo_casos'] = $this->catalogos_m->get_list("tipo_incidente");
        $d['areas'] = $this->catalogos_m->get_list("areas");

        $data = array();
        $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
        $this->layout_library->load_layout($data);
    }

    public function create_action()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('America/Managua'));
        $fecha = $now->format('Y-m-d H:i:s');

        $this->db->set('fecha_creacion', $fecha);
        $this->db->set('asunto', $this->input->post('asunto'));
        $this->db->set('descripcion', $this->input->post('descripcion'));
        $this->db->set('area_id', $this->input->post('area'));
        $this->db->set('estado_id', 1);
        $this->db->set('creado_por', $this->session->userdata('user_id'));        
        $this->db->set('tipo_incidente_id', $this->input->post('tipo_id'));
        $this->db->set('sub_categoria_id', $this->input->post('subcategoria_id'));
        $this->db->set('prioridad_id', 1);

        if ($this->input->post('analista') != "") {
            $this->db->set('asignado', $this->input->post('analista'));
        }

        $this->db->insert('tbl_incidentes');
        $inc_id = $this->db->insert_id();

        //Insertamos el detalle
        $this->db->set('incidente_id', $inc_id);
        $this->db->set('comentario', $this->input->post('descripcion'));
        $this->db->set('modificado_por', $this->session->userdata('user_id'));
        $this->db->set('modificado', $fecha);
        $this->db->set('estado_id', 1);
        $this->db->set('prioridad_id', 1);

        if ($this->input->post('analista') != "") {
            $this->db->set('asignado', $this->input->post('analista'));
        }

        if($this->input->post('adjunto') != '')
        {
            $this->db->set('adjunto', $this->input->post('adjunto'));
        }

        $this->db->insert('tbl_incidentes_detalles');

        //Enviamos el correo
        $this->enviarCorreo($inc_id, 'creado');
        echo $inc_id;        
    }

    public function detail($id = NULL)
    {
        $accion = 'detail';
        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Detalle del caso";
            $d['incidente'] = $this->incidentes_m->get_by_id($id);
            $d['inc_detalles'] = $this->incidentes_m->get_all_incidentes_detalles($id);
            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;
            $this->layout_library->load_layout($data);
        }
    }

    public function add($id = NULL)
    {
        $accion = 'add';
        $analistas = "";

        if( $id != NULL && is_numeric($id))
        {
            $d = array();
            $d['title'] = "Seguimiento del caso ticket #".$id;
            $inc = $this->incidentes_m->get_by_id($id);

            $d['incidente'] = $inc;

            if( $this->session->userdata('perfil') == 2 )
            {
                $analistas = $this->user_m->get_analistas_by_area($inc->area_id);
            }

            $d['analistas'] = $analistas;
            $d['prioridades'] = $this->catalogos_m->get_list("prioridad_incidente");
            $estados = $this->estados_m->get_estados_by_status($inc->estado_id);
            $d['estados'] = $estados;

            $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
            $data['controlador'] = $this->controlador;
            $data['accion'] = $accion;

            $this->layout_library->load_layout($data);
        }
    }

    public function add_action()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('America/Managua'));
        $fecha = $now->format('Y-m-d H:i:s');

        //Obtenemos el registro actual
        $incidente = $this->incidentes_m->get_by_id($this->input->post('inc_id'));

        //Insertamos el detalle
        $this->db->set('incidente_id', $this->input->post('inc_id'));
        $this->db->set('comentario', $this->input->post('descripcion'));
        $this->db->set('modificado_por', $this->session->userdata('user_id'));
        $this->db->set('modificado', $fecha);

        //Para el campo asignado
        $asignado_actual = $incidente->id_asignado_a;
        $asignado = "";

        $enviar_correo = false;
        if($asignado_actual != $this->input->post('asignado')) {
            $enviar_correo = true;
        }

        if($this->input->post('asignado') != "")
        {
            $asignado = $this->input->post('asignado');
        }
        else if($asignado_actual != "")
        {
            $asignado = $asignado_actual;
        }

        if($asignado != "")
        {
            $this->db->set('asignado', $asignado);
        }

        //Para el campo Estado
        $estado_actual = $incidente->estado_id;
        $estado = 0;

        if($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 2)
        {
            if($estado_actual == 1 && $this->input->post('asignado') > 0)
            {
                $estado = 2;
            }
            else if($this->input->post('estado') > 0)
            {
                $estado = $this->input->post('estado');
            }
            else
            {
                $estado = $estado_actual;
            }
        }
        else if($this->session->userdata('perfil') == 3 && $this->input->post('estado') > 0)
        {
            $estado = $this->input->post('estado');
        }
        else if($this->session->userdata('perfil') == 4 && $this->input->post('estado') > 0)
        {
            $estado = $this->input->post('estado');
        }
        else
        {
            $estado = $estado_actual;
        }

        if($estado > 0)
        {
            $this->db->set('estado_id', $estado);
        }        

        //Prioridad
        if($this->input->post('prioridad') > 0)
        {
            $this->db->set('prioridad_id', $this->input->post('prioridad'));
        }

        if($this->input->post('adjunto') != '')
        {
            $this->db->set('adjunto', $this->input->post('adjunto'));
        }

        $inc_det = $this->db->insert('tbl_incidentes_detalles');
        
        //Actualizamos el principal
        if($estado_actual != $estado)
        {
            $this->db->set('estado_id', $estado);
        }

        if($asignado > 0)
        {
            $this->db->set('asignado', $asignado);
        }

        $this->db->set('prioridad_id', $this->input->post('prioridad'));
        $this->db->where('id', $this->input->post('inc_id'));
        $this->db->update('tbl_incidentes');      
        
        if( $enviar_correo == true ) {
            $this->enviarCorreo($this->input->post('inc_id'), 'asignado');
        }
        echo 1;
    }

    public function cerrados()
    {
        $accion = 'cerrados';
        $d = array();
        $d['title'] = "Casos cerrados";
        $data = array();
        $data['subview'] = $this->load->view($this->controlador.'/'.$accion, $d, true);
        $data['controlador'] = $this->controlador;
        $data['accion'] = $accion;
        $this->layout_library->load_layout($data);
    }

    public function cerrarcaso_action()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('America/Managua'));
        $fecha = $now->format('Y-m-d H:i:s');

        $this->db->set('cerrado', 1);
        $this->db->set('observacion_cierre', $this->input->post('observacion'));
        $this->db->set('fecha_cierre', $fecha);
        $this->db->set('cerrado_por', $this->session->userdata('user_id'));
        $this->db->where('id', $this->input->post('inc_id'));
        $this->db->update('tbl_incidentes');

        //Enviamos el correo
        $this->enviarCorreo($this->input->post('inc_id'), 'cerrado');
        echo 1;        
    }

    public function enviarCorreo($id, $tipo)
    {
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";         
        $config["smtp_host"] = 'srv12.mihosting.com';
        $config["smtp_user"] = 'sistemas@cifnic-company.com';
        $config["smtp_pass"] = 'Cifnic2020$%';   
        $config["smtp_port"] = '465';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['validate'] = TRUE;
        $this->email->initialize($config);

        $inc = $this->incidentes_m->get_by_id($id);
        $det = $this->incidentes_m->get_ultimo_incidentes_detalle($id);
        $asunto = $inc->asunto;
        $ticket = $inc->id;
        $fecha = $inc->fechaF;
        $comentario = $det->comentario;
        $asunto_email = "";

        //correos de coordinador
        $correos_coord = $this->user_m->get_correos_coordinadores();
        $to = $correos_coord;
        $to .= $inc->correo_creado_por;

        if($tipo == "creado") {
            $asunto_email = "El usuario ".$inc->creado_por." ha creado un nuevo caso. Asunto: ".$inc->asunto."<br /> Se ha generado el Ticket #".$ticket;
        }

        if($tipo == "cerrado") {
            $asunto_email = "El usuario ". $inc->cerrado_por ." ha cerrado el caso: ".$inc->asunto.". Ticket #".$ticket.". Observaci&oacute;n: ".$inc->observacion_cierre;            
        }

        if($tipo == "asignado") {
            $asunto_email = "Se ha asignado el caso ".$inc->asunto." con Ticket #".$ticket." al area de ". $inc->area.", el usuario que lo atenderá es ". $inc->asignado_a;
            $to .= ", ".$inc->correo_asignado_a;
        }       

        //Variables de configuracion
        $email_app = $this->configuraciones_m->get_key('email_app');
        $titulo_app = $this->configuraciones_m->get_key('title_app');
 
        //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from($email_app, $titulo_app);
        //$this->email->to('jsandino02@hotmail.com, jasen.artola@cifnic-company.com', 'App Helpdesk');
        $this->email->to($to, 'App Helpdesk');
        $this->email->subject($asunto);
        
        $templateEmail = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="description" content="">
          <meta name="author" content="">
         </head>
         <body style="font-family: Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333; background-color: #fff;">
         <div style="margin-top: 20px; background: #fff; padding: 20px; border-radius: 3px;">
         <img src="https://cifnic-company.com/apps/serlisahelpdesk/assets/images/logo_serlisa.png" alt="helpdesk">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 7px; font-size: 24px; margin-top: 20px; color: #636e7b;">
            '.$asunto_email.'</h3>
            <p style="margin: 0 0 10px; font-family: Calibri">El caso fue creado el: '. $fecha .' - Categoria:  '.$inc->categoria.' - '.$inc->subcategoria.'</p>
            <div style="color: #31708f; background-color: #d9edf7; border-color: #bce8f1; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <p><strong>'.$det->modificado_por.' escribi&oacute;: </strong>'.$comentario.' </p></div>        
            <p style="color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <strong>Nota:</strong> Este correo fue generado automaticamente por SERLISA Helpdesk.</p>
        <p><a href="http://getbootstrap.com/" target="_blank" style="color: #fff; background-color: #3071a9; border-color: #285e8e; padding: 8px 15px; display: none ;
            padding: 6px 12px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            border-width: 0; outline: 0; text-decoration: none;
            border-radius: 3px;
            line-height: 21px;
            -moz-transition: all 0.2s ease-out 0s;
            -webkit-transition: all 0.2s ease-out 0s;
            transition: all 0.2s ease-out 0s;
            padding: 8px 15px;
            border-width: 0;">Ver detalle del caso</a></p>                
        </body>
        </html>';

        //Definimos el mensaje a enviar
        $this->email->message($templateEmail);
         
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if($this->email->send())
        {
            $this->session->set_flashdata('envio', 'Email enviado correctamente');
        }
        else {
            $this->email->print_debugger();  
        }
    }

    public function asignados($estado_id = 0)
	{
        $accion = 'asignados';

        $d = array();
		$d['title'] = 'Casos asignados';

        $d['estado_id'] = $estado_id;
        $d['estados'] = $this->estados_m->get_estados();

		$data = array();
		$data['subview'] = $this->load->view($this->controlador .'/'.$accion, $d, true);
		$data['controlador'] = $this->controlador;
		$data['accion'] = $accion;
		
		$this->layout_library->load_layout($data);
	}

    public function enviarCorreoPrueba()
    {
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";         
        $config["smtp_host"] = 'srv12.mihosting.com';
        $config["smtp_user"] = 'sistemas@cifnic-company.com';
        $config["smtp_pass"] = 'Cifnic2020$%';   
        $config["smtp_port"] = '465';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['validate'] = TRUE;
        $this->email->initialize($config);

        $asunto = "Correo de prueba";
        $ticket = "#0000";
        $fecha = date("dd/MM/yyyy");
        $comentario = "Este es un correo de prueba";
        $asunto_email = "Sin asunto";

        //Variables de configuracion
        $email_app = $this->configuraciones_m->get_key('email_app');
        $titulo_app = $this->configuraciones_m->get_key('title_app');
 
        //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from($email_app, $titulo_app);
        $this->email->to('jsandino02@hotmail.com, jasen.artola@cifnic-company.com', 'App Helpdesk');
        $this->email->subject($asunto);
        
        $templateEmail = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="description" content="">
          <meta name="author" content="">
         </head>
         <body style="font-family: Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143; color: #333; background-color: #fff;">
         <div style="margin-top: 20px; background: #fff; padding: 20px; border-radius: 3px;">
         <img src="https://cifnic-company.com/apps/serlisahelpdesk/assets/images/logo_serlisa.png" alt="helpdesk">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 7px; font-size: 24px; margin-top: 20px; color: #636e7b;">
            '.$asunto_email.'</h3>
            <p style="margin: 0 0 10px; font-family: Calibri">El caso fue creado el: '. $fecha .' - Categoria:  xxx - xxx</p>
            <div style="color: #31708f; background-color: #d9edf7; border-color: #bce8f1; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <p><strong>xxx escribi&oacute;: </strong>'.$comentario.' </p></div>        
            <p style="color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <strong>Nota:</strong> Este correo fue generado automaticamente por SERLISA Helpdesk.</p>
        <p><a href="http://getbootstrap.com/" target="_blank" style="color: #fff; background-color: #3071a9; border-color: #285e8e; padding: 8px 15px; display: none ;
            padding: 6px 12px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            border-width: 0; outline: 0; text-decoration: none;
            border-radius: 3px;
            line-height: 21px;
            -moz-transition: all 0.2s ease-out 0s;
            -webkit-transition: all 0.2s ease-out 0s;
            transition: all 0.2s ease-out 0s;
            padding: 8px 15px;
            border-width: 0;">Ver detalle del caso</a></p>                
        </body>
        </html>';

        //Definimos el mensaje a enviar
        $this->email->message($templateEmail);
         
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if($this->email->send())
        {
            $this->session->set_flashdata('envio', 'Email enviado correctamente');
        }
        else {
            $this->email->print_debugger();  
        }
    }
}