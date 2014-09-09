<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Menu_modelo extends CI_Model {
	
		public function dameMenu()		
		{
			$query=$this->db->get('modulo');
			$resultado = $query->result_array();
			return $resultado;
		}

	
	}
	
	/* End of file menu.php */
	/* Location: ./application/models/menu.php */
?>