<?php
/*error_reporting(E_ALL);
dini_set('display_errors', '1');*/


define("TRACE_FILE", '/log/trace.log' );
define("TRACE_SIZE", 5000000 );

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Design extends Frontend_Controller {
	
	public function __construct(){
        parent::__construct();	
		$this->langs = getLanguages();
    }
	
	// get layout of designer
	//public function index($id = '', $hash = '', $color = 0, $design_id = '', $codcli = 0, $nombcli = '', $emacli = '', $talla = '')
	public function index($id = '', $hash = '', $nombcli = '', $emacli = '', $talla = '', $orden, $design_id = '')
	{		
		/*
		$this->traza("id->".$id);
		$this->traza("hash->".$hash);
		$this->traza("codcli->".$codcli);
		$this->traza("nombcli->".$nombcli);
		$this->traza("emacli->".$emacli);
		$this->traza("talla->".$talla);
		$this->traza("orden->".$orden);
		$this->traza("design_id->".$design_id);
		*/
		
		/*
		[Codigo Producto]/[Hash de validacion]/[Nombre Completo]/[Correo electronico del cliente]/[Talla]/[Numero de Orden]
		*/
		
		if($emacli != "")
		{
			$this->load->model('users_m');
			$where_check = array('email'=>$emacli);
			
			if($this->users_m->checkUser($where_check))
			{
				$this->users_m->login(false, $emacli);
			}
			else
			{
				
				//Registramos el usuario
				/*$group	= $this->users_m->getDefault();
				if ( count($group) > 0)
					$group_id 	= $group->id;
				else
					$group_id 	= 0;*/
				
				$usuario = array(
					'name' => $nombcli,
					'username' => $emacli,
					'password' => $this->users_m->hash('Inditexsa123*'),
					'email' => $emacli,
					'group' => 4, //Cliente
					'block' => 0,
					'send_email' => 1,
					'register_date' => date('Y-m-d H:i:s'),
					'activation' => 1
				);

				if($user_id = $this->users_m->save($usuario)) //register success.
				{					
					$user['id'] = $user_id;
					$user['name'] = $data['username'];
					$user['username'] = $data['username'];
					$user['email'] = $data['email'];
					$user['admin'] = '';
					$user['loggedin'] = 1;
					$this->session->set_userdata('user', $user);
					$this->session->set_userdata($user);
				}
			}
		}
		
		//Vamos a logear al usuario pasado por parametros
		/*$this->load->model('users_m');
		
		if( $this->users_m->login(false, $emacli) == TRUE ){
			$this->traza("logueando usuario: ".$emacli);
		}*/
		
		//$id = (int) $id;
				
		$data = array();
		//$data['color'] 	= (string) $color;
		$data['color'] 		= "";
		$data['design_id'] 	= $design_id;
		
		//Agregamos el hash y la orden
		$data['hash']  = $hash;
		$data['orden'] = $orden;
		
		$data['codcli'] = $codcli;
		$data['talla'] = $talla;
		
		$this->load->model('settings_m');
		$setting = $this->settings_m->getSetting();
		
		$data['setting'] = json_decode($setting->settings);
		$data['lang'] = $this->langs;
		
		$code_prod_ori = $id;
		
		//obtener el producto default or product id
		
		//Primero componemos el codigo del producto
		$producto_code = explode("_",$id);
		//echo $id;
		//echo "<br>";
		
		$c = count($producto_code);
		//echo $c;
		
		$nuevocode = "";
		
		for($i=0; $i<$c-1; $i++){
			if($i==0){
				$nuevocode .= $producto_code[$i];
			}
			else{
				$nuevocode .= "_".$producto_code[$i];
			}
		}
		
		//echo "<br>";
		//echo $nuevocode;
		//exit;
		
		$id = $nuevocode;
		
		if ($id != '')
		{
			$fields = array('sku'=>$id, 'published'=>1);
		}
		else
		{
			$fields = array('sku'=>'0','published'=>1);
		}
		
		$this->load->model('product_m');
		$rows = $this->product_m->getProduct($fields);
		
		if($rows == false)
		{
			$id = $code_prod_ori;
			
			if ($id != '')
			{
				$fields = array('sku'=>$id, 'published'=>1);
			}
			else
			{
				$fields = array('sku'=>'0','published'=>1);
			}
			
			$rows = $this->product_m->getProduct($fields);
		}
		
		
		//$this->traza("Query getProduct design.php->".$this->product_m->ultimaQuery());
		
		if ($rows != false)
		{
			$product = $rows[0];
				
			// get product design
			$design = $this->product_m->getProductDesign($product->id);
			
			if ($design == false)
			{
				$product = false;
			}
			else
			{
				$this->load->helper('product');
				$help_design = new helperProduct();
				$product->design = $help_design->getDesign($design);
				
				// attribute
				$attribute 	= $this->product_m->getAttribute($product->id);
				
				if (count($attribute)) 
				{					
					$product->attribute = $help_design->displayAttributes($attribute);
				}
				else
				{
					$product->attribute = '';
				}
				
				$product->attribute = $help_design->quantity($product->min_order) . $product->attribute;					
				
				$this->load->model('categories_m');
				$product->categories = $this->categories_m->getCategories('product');		
			}
			
			$data['product'] = $product;			
		}
		else
		{
			$data['product'] = false;			
		}
		
		$data['user'] = $this->session->userdata('user');
		
		// check user admin
		$is_admin = true;
		if ( empty($data['user']['id']) )
		{
			$is_admin = false;
		}
		else
		{
			//$this->load->model('users_m');
			//$is_admin	= $this->users_m->userPermission('art');
		}
		
		$data['is_admin'] = $is_admin;
		
		$designer = $this->load->view('components/design/designer', $data, true);
		
		$this->data['meta']	= '<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1, minimum-scale=0.5, maximum-scale=1.0"/>';		
		
		$this->data['content']	= $designer;		
		$this->data['subview']	= $this->load->view('layouts/design/default', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('design', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'design');
		
	}
	
	function colors()
	{
		if ( $this->session->userdata('colors') )
		{			
			$colors = $this->session->userdata('colors');
		}
		else
		{
			$colors = $this->help_products->getColor();
			$this->session->set_userdata('colors', $colors);
		}
		
		$data = array();
		
		if ($colors === false){
			$data['status'] = 0;
			$data['error'] = language('sys_try_again', $this->langs);
		}
		else{
			$data['status'] = 1;
		}
		
		$data['colors'] = $colors;
		
		echo json_encode($data);
		exit();	
	}
	
	function fonts()
	{
		$fonts = $this->help_products->getFonts();
		$this->session->set_userdata('fonts', $fonts);
		if ( $this->session->userdata('fonts') )
		{		
			$fonts = $this->session->userdata('fonts');
		}
		else
		{
			$fonts = $this->help_products->getFonts();
			$this->session->set_userdata('fonts', $fonts);
		}
				
		$data = array();
		
		if ($fonts === false){
			$data['status'] = 0;
			$data['error'] = language('sys_try_again', $this->langs);
		}
		else{
			$data['status'] = 1;
		}
		
		$data['fonts']		= $fonts;
		
		//echo '<pre>';print_r($data);echo '<pre>';exit;
		
		echo json_encode($data);
		exit();	
	}
	
	//-------------------------------------------------------
	//Traza para registrar archivos logs
	//-------------------------------------------------------
	function traza($mensaje)
	{
		$fileName = dirname($_SERVER["SCRIPT_FILENAME"]) . TRACE_FILE;
		if ( file_exists( $fileName ) && ( filesize( $fileName ) > 5000000) ){
			rename( $fileName,substr($fileName,0,(strlen($fileName)-4)) . "_" . date("ymdHis").".log");
			clearstatcache();		// in order to have a right size in the next filesize()
		}
		$timearray = explode(" ", microtime());
		$milliseconds = floor( $timearray[0] * 1000 );
		$mensaje = date( "d/m/Y H:i:s" ) . "." . sprintf( "%03d", $milliseconds ) . " - " . $mensaje . "\n";
		file_put_contents( $fileName, $mensaje, FILE_APPEND );
	}
}