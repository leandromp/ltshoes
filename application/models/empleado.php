<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empleado extends CI_Model {
		
		public function comprobarLogeo($nombre,$password)
		{
			$query=$this->db->get_where('empleado',array('nombre'=>$nombre,'password'=>$password));
			$result = $query->resul_array();
			$cant = count($result);
			if($result==1)
				return $resul;
			else
				return false;
		}
		
	
	}
	
	/* End of file empleado.php */
	/* Location: ./application/models/empleado.php */
?>