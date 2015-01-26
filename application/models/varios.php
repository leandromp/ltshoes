<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Varios extends CI_Model {
		
		public function getVariosCodigo($codigo)
		{
			$query = $this->db->get_where("varios",array('codigo'=>$codigo));
			$resultado=$query->result_array();
			if(count($resultado)>0)
				return $resultado;
			else
				return false;
		}
		
	
	}
	
	/* End of file varios.php */
	/* Location: ./application/models/varios.php */
?>