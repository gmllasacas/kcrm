<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generico extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->helper('text');
		$this->load->model('generico_modelo');
	}

	function nuevoregistro(){
		$inputs=$this->input->post();
		$table=$inputs['table'];
		if(count($inputs)==0 || $table==''){
			$response  =array(	'estado' =>'500',
											'msg'=>'Parámetros incorrectos');
		}else{
			switch ($table) {
				case 'proceso_producto':
					$exclude=array('id','table');
					$registro=basenuevoregistro($inputs,$table,$exclude);
					if($registro['estado']==200){
						$response=$registro;
					}else{
						$response=array(	'estado' =>500,
														'msg'=>'Error al escribir en la BD');
					}
					break;
				case 'proceso_venta':
					$producto_id=	$this->input->post('id');
					$fecha_creacion= date('Y-m-d H:i:s');
					$cantidad = 1;

					$producto = basedetalleregistro('proceso_producto',['estado'=>'1','id'=>$producto_id]);
					$stock = $producto['stock'];
					if($stock==0){
						$msg='El producto <b>'.$producto['nombre'].'</b> no tiene stock';
						$response=array(	'estado' =>500,
														'msg'=>$msg);
						break;
					}else{
						$inputs['producto']=$producto_id;
						$inputs['cantidad']=$cantidad;
						$inputs['fecha_creacion']=$fecha_creacion;
						$exclude=array('id','table');
						$registro=basenuevoregistro($inputs,$table,$exclude);
						if($registro['estado']==200){
							/**Venta */
								$inputs_p['stock']=($stock-$cantidad);
								$inputs_p['fecha_ultima_venta']=$fecha_creacion;
								baseactualizarregistro($inputs_p,'proceso_producto',['id'=>$producto_id],[]);
							/**Venta */
							$response=$registro;
						}else{
							$response=array(	'estado' =>500,
															'msg'=>'Error al escribir en la BD');
						}
					}
					break;
				default:
					$exclude=array('id','table');
					$inputs['fecha']=date('Y-m-d H:i:s');
					$registro=basenuevoregistro($inputs,$table,$exclude);
					if($registro['estado']==200){
						$response=$registro;
					}else{
						$response=array(	'estado' =>500,
														'msg'=>'Error al escribir en la BD');
					}
					break;
			}
		}
		echo json_encode($response);
	}

	function actualizarregistro(){
		$inputs=$this->input->post();
		$table=($this->input->post('table'));
		$id=($this->input->post('id'));
		if(count($inputs)==0){
			$response  =array(	'estado' =>'500',
											'msg'=>'Parámetros incorrectos');
		}else{
			switch ($table) {
				default:
					$where  =array('id'=>$id);
					$exclude=array('id','table');
					$registro=baseactualizarregistro($inputs,$table,$where,$exclude);
					if($registro['estado']==201){
						$response=$registro;
					}else{
						$response=array(	'estado' =>500,
														'msg'=>'Error al escribir en la BD');
					}
					break;
			}
		}
		echo json_encode($response);
	}

	function eliminarregistro(){
		$table=($this->input->post('table'));
		$id=($this->input->post('id'));
		if($id=='' || $table==''){
			$response  =array(	'estado' =>'500',
											'msg'=>'Parámetros incorrectos');
		}else{
			switch ($table) {
				default:
					$where  =array('id'=>$id);
					$registro=baseeliminarregistro($table,$where);
					if($registro['estado']==201){
						$response=$registro;
					}else{
						$response=array(	'estado' =>500,
														'msg'=>'Error al escribir en la BD');
					}
					break;
			}
		}
		echo json_encode($response);
	}

	function detalleregistro(){
		$table=($this->input->post('table'));
		$id=($this->input->post('id'));
		$date_format_mysql_full = $this->config->item('date_format_mysql_full');
		$date_format_mysql = $this->config->item('date_format_mysql');
		
		$this->form_validation->set_rules('table', 'table', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$response = array(	'estado' =>500,
											'msg'=>'Parámetros incorrectos');
		}else{
			switch ($table) {
				case 'proceso_producto':
					$where = array('id'=>$id);
					$registro=basedetalleregistro($table,$where);
					if(count($registro)>0){
						$response  =array(	'estado' =>200,
														'registro'=>$registro);	
					}else{
						$response  =array(	'estado' =>500,
														'msg'=>'No existe el registro');
					}
					break;
				default:
					$where = array('id' => $id);
					$registro = basedetalleregistro($table, $where);
					if (count($registro) > 0) {
						$response  = array(
							'estado' => 200,
							'registro' => $registro
						);
					} else {
						$response  = array(
							'estado' => 500,
							'msg' => 'No existe el registro'
						);
					}
					break;
			}
		}
		echo json_encode($response);
	}

	function listado(){

		$table=	strip_tags($this->input->post('table'));
		$estado=	strip_tags($this->input->post('estado'));

		$this->form_validation->set_rules('table', 'table', 'trim|required');
		$this->form_validation->set_rules('estado', 'estado', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$response = array(	'estado' =>500,
											'msg'=>'Parámetros incorrectos');
		}else{
			switch ($table) {
				case 'proceso_producto':
					$registros = $this->generico_modelo->listado($table,$estado);
					if(count($registros)>0){
						$response  =array(	'estado' =>200,
														'data'=>$registros);
					}else{
						$response  =array(	'estado' =>400,
														'msg'=>'No existen registros');	
					}
					break;
				default:
					$registros = $this->generico_modelo->listado($table,$estado);
					if(count($registros)>0){
						$response  =array(	'estado' =>200,
														'data'=>$registros);
					}else{
						$response  =array(	'estado' =>500,
														'msg'=>'No existen registros');	
					}
					break;
			}
		}
		echo json_encode($response);
	}

}