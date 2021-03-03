<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->helper('text');
		$this->load->model('generico_modelo');
	}

	function productos(){

		$tipos = baselistado('proceso_categoria_producto',['estado'=>'1']);

		$datos = array(
								'menu_text' => 'Sistema',
								'submenu_text' => 'Productos',
								'titulo_text' => 'Productos',
								'export_text' => 'Listado de productos',
								'registro_text' => 'producto',
								'tipos'=>$tipos,
							);
		
		$funciones = array('funciones' => array('proceso/productos',));

		$this->load->view('bases/cabezera');
		$this->load->view('bases/menu');
		$this->load->view('bases/barra');
		$this->load->view('proceso/productos',$datos);
		$this->load->view('bases/pie');
		$this->load->view('bases/funciones',$funciones);

	}

}
