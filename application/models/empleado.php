<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empleado extends CI_Model {
		
		public function getEmpleados($perfil_id=0)
		{	
			if($perfil_id!=0)
				$this->db->where("perfil_id",$perfil_id);

			$query=$this->db->get("empleado");
			$resultado=$query->result_array();
			if(count($resultado)>0)
				return $resultado;
			else
				return false;

		}

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
		
		public function getPermisos($perfil_id,$modulo_id)
		{
			$this->db->where("perfil_id",$perfil_id);
			$this->db->where("modulo_id",$modulo_id);
			$query=$this->db->get("permiso");
			$resultado=$query->result_array();
			if(count($resultado)>0)
				return $resultado[0];
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
	
	}
	
	/* End of file empleado.php */
	/* Location: ./application/models/empleado.php */
?>