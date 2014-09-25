<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Venta extends CI_Model {
	
			public function listado()
			{
				$query=$this->db->get("venta");
				$resultado=$query->result_array();
				return $resultado;
			}
	
	}
	
	/* End of file venta.php */
	/* Location: ./application/models/venta.php */
?>