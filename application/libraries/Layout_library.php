<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_library
{
	function load_layout($d)
	{
		$CI=& get_instance();

		$data = array();
		$html = "";

		$data['subview'] = $d['subview'];
		$data['header'] = $CI->load->view('layout/header', array(), true);

		$controlador = $d['controlador'];
		$accion = $d['accion'];

		//vamos a cargar el sidebar
		$CI->load->database();
		$CI->load->model('menu_m');

		$data_sidebar = array();

		if($CI->session->userdata('perfil'))
		{
			//Todos los elementos
			$data_sidebar = $CI->menu_m->get_menu_items($CI->session->userdata('perfil'), 0);

            foreach ($data_sidebar as $m) 
            {
            	if( $m->es_padre == 0 && $m->id_padre == 0 )
            	{
            		$current = '';
            		if($m->controlador == $controlador && $m->accion == $accion)
            		{
            			$current = 'class="active"';
            		}

            		$html .= '<li '.$current.'>';
            		$html .= '<a href="'.site_url($m->controlador.'/'.$m->accion).'">';
            		$html .= '<i class="'.$m->icono_estilo.'"></i>&nbsp;'.$m->descripcion;
            		$html .= '</a></i>';
            	}
            	else
            	{
            		if($m->es_padre == 1)
            		{
            			$submenu = $CI->menu_m->get_menu_items($CI->session->userdata('perfil'), $m->id);

            			$c = count($submenu);

            			if($c > 0)
            			{

            				$html .= '<li>';
		            		$html .= '<a href="javascript:void(0)">';
		            		$html .= '<i class="'.$m->icono_estilo.'"></i>&nbsp;'.$m->descripcion.'<span class="fa arrow"></span>';
		            		$html .= '</a>';
		            		$html .= '<ul class="nav nav-second-level">';
            					
            				foreach ($submenu as $s) 
            				{
            					$html .= '<li>';
            					$html .= '<a href="'.site_url($s->controlador.'/'.$s->accion).'">';
            					$html .= '<i class="fa fa-angle-double-right fa-fw"></i>&nbsp;'.$s->descripcion;
            					$html .= '</a></i>';
            				}

            				$html .= '</ul></li>';
            			}
            		}
            	}
            }

			$d['data_sidebar'] = $html;
			
		}
		else
		{
			$d['data_sidebar'] = '';
		}


		$data['sidebar'] = $CI->load->view('layout/sidebar', $d, true);
		$data['footer'] = $CI->load->view('layout/footer', array(), true);
	    
	    
	    $CI->load->view('layout/layout', $data);
	    
	}

	
}