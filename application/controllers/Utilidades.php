<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Utilidades extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
        $this->load->model('incidentes_m');
	}

    public function enviarCorreo($id)
    {
        $inc = $this->incidentes_m->get_by_id($id);
        $det = $this->incidentes_m->get_ultimo_incidentes_detalle($id);
        //$para, $ticket, $fecha, $asunto, $comentario
        $asunto = $inc->asunto;
        $ticket = $inc->id;
        $fecha = $inc->fecha_creacion;
        $comen = $det->comentario;

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
        $config['validate'] = true;
        $this->email->initialize($config);
 
        //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from('sistemas@cifnic-company.com', 'Sistema Helpdesk');
        $this->email->to('jsandino02@hotmail.com, jsandino02@gmail.com', 'App Helpdesk');
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
         <img src="https://cifnic-company.com/apps/helpdesk/assets/images/logo-cifnic.png" alt="helpdesk">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 7px; font-size: 24px; margin-top: 20px; color: #636e7b;">
            Ticket #'.$ticket.' - Caso: '.$inc->asunto.'</h3>
            <p style="margin: 0 0 10px;">Fecha: '.$det->modificado.' - Categoria:  '.$inc->categoria.' - '.$inc->subcategoria.'s</p>
            <div style="color: #31708f; background-color: #d9edf7; border-color: #bce8f1; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <p><strong>Usuario '.$det->modificado_por.' escribi&oacute;: </strong>'.$det->comentario.'. Este caso fue creado el '.$inc->fecha_creacion.', por el usuario '.$inc->creado_por.' fue creado bajo el motivo: '.$inc->descripcion.'. </p></div>        
            <p style="color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
            <strong>Nota:</strong> Este correo fue generado automaticamente por la aplacion Helpdesk.</p>
        <p><a href="http://getbootstrap.com/" target="_blank" style="color: #fff; background-color: #3071a9; border-color: #285e8e; padding: 8px 15px; display: inline-block;
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
        if($this->email->send()){
            $this->session->set_flashdata('envio', 'Email enviado correctamente');
        }else{
            $this->email->print_debugger();  
        }
    }
}