<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empleado extends CI_Model {
		
		public function comprobarLogeo($nombre,$password)
		{
			$query=$this->db->get_where('empleado',array('nombre'=>$nombre,'password'=>$password));
			$resultado = $query->result_array();
			$cant = count($resultado);
			if($cant==1)
				return $resultado[0];
			else
				return false;
		}
		
	
	}
	
	/* End of file empleado.php */
	/* Location: ./application/models/empleado.php */
?>