<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Permiso extends CI_Model {
	
		public function insertEmpty($modulo_id,$perfil_id)		
		{
			if ($this->db->insert("permiso",array('modulo_id'=>$modulo_id,'usuario_id'=>$perfil_id)))
				return true;
			else
				false;

		}

		public function getPerfiles()
		{
			$query=$this->db->get("perfil");
			$resultado=$query->result_array();
			if(count($resultado)>0)
				return $resultado;
			else
				return false;

		}
	
	}
	
	/* End of file permiso.php */
	/* Location: ./application/models/permiso.php */
?>