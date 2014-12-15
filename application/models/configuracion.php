<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Configuracion extends CI_Model {
	
		public function getVariosCodigo($codigo)	
		{
			$query = $this->db->get_where('varios',array('codigo'=>$codigo));
			$resultado = $query->result_array();
			if(count($resultado)>0)
				return $resultado;
			else
				return FALSE;
		}

		public function eliminar($id)
		{
			$this->db->delete_where("varios",array('id'=>$codigo));
			
		}
		
	
	}
	
	/* End of file configuracion.php */
	/* Location: ./application/models/configuracion.php */
?>