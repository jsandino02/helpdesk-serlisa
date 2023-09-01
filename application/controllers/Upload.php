<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('areas_m');
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');

        $this->controlador = 'upload';

		if( ! $this->logged_in )
        {
            redirect('account/login');
        }
	}

    function upload_file() {

        //upload file
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '5120'; //5 MB

        //Vamos a renombrar el archivo
        $code = substr(md5( microtime() ),0,4);
        $nombre_archivo = $code."_".$_FILES['file']['name'];
        $config['file_name'] = $nombre_archivo;

        if ($_FILES['file']['name'] != null) 
        {
            if (isset($_FILES['file']['name'])) 
            {
                if (0 < $_FILES['file']['error']) 
                {
                    echo 'Error during file upload' . $_FILES['file']['error'];
                } 
                else 
                {
                    if (file_exists('uploads/' . $_FILES['file']['name'])) 
                    {
                        echo 'File already exists : uploads/' . $_FILES['file']['name'];
                    } 
                    else 
                    {
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('file')) 
                        {
                            echo $this->upload->display_errors();
                        } 
                        else 
                        {
                            echo $nombre_archivo;
                        }
                    }
                }
            } 
            else 
            {
                echo '0';
            }
        }
        else
        {
            echo "0";
        }
    }
}