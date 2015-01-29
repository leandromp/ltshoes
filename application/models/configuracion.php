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

		public function getTalles($tipo_producto)
		{
			$sql="SELECT id as valor,numero as nombre FROM talle where tipo_producto=".$tipo_producto;
			$query = $this->db->query($sql);
			$resultado = $query->result_array();
			if(count($resultado)>0)
				return $resultado;
			else
				return FALSE;
		}

		public function eliminar($id)
		{
			if($this->db->delete("varios",array('id'=>$id)))
				return TRUE;
			else
				return FALSE;

			
		}

		public function insertVarios($datos)
		{
			if($this->db->insert("varios",$datos))
				return TRUE;
			else
				return FALSE;
		}

		public function insertTalle($datos)
		{
			if($this->db->insert("talle",$datos))
				return TRUE;
			else
				return FALSE;
		}

		
	
	}
	
	/* End of file configuracion.php */
	/* Location: ./application/models/configuracion.php */
?>