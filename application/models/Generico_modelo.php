<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generico_modelo extends CI_Model{

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function listado($table,$estado,$params=[]){
		switch ($table) {
			case 'proceso_producto':
				$query = $this->db->query("	SELECT proceso_producto.*,
																proceso_categoria_producto.descripcion as tipodesc
																FROM proceso_producto 
																INNER JOIN proceso_categoria_producto ON proceso_producto.categoria=proceso_categoria_producto.id
																WHERE proceso_producto.estado REGEXP ?",
																array('^['.$estado.']'));
				break;
			default:
				$query = $this->db->query("SELECT * FROM $table WHERE estado REGEXP ? ORDER BY id DESC", array('^['.$estado.']'));
				break;
		}
		return $query->result_array();
	}
}
?>