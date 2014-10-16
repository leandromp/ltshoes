<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Permiso extends CI_Model {
	
		public function updateSimple($modulo_id,$perfil_id,$columna,$valor)
		{
			$this->db->where('usuario_id',$perfil_id);
			$this->db->where('modulo_id',$modulo_id);
			if($this->db->update('permiso',array($columna=>$valor)))
				return true;
			else
				return false;
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

		//public function insertEmpty($id)
	
	}
	
	/* End of file permiso.php */
	/* Location: ./application/views/modulos/permiso.php */
?>