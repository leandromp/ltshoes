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
	
	}
	
	/* End of file permiso.php */
	/* Location: ./application/views/modulos/permiso.php */
?>