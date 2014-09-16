<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Modulo extends CI_Model {
	
		public function insert($datos)
		{
			$this->db->insert('modulo',$datos);

		}	

		public function delete($id)
		{
			if ($this->db->delete('modulo',array('id' => $id) ) )
				return true;
			else
				return false;
		}

		public function getModulo($id)
		{
			$query=$this->db->get_where("modulo",array("id"=>$id));
			$resultado=$query->result_array();
			$cantidad=count($resultado);
			if ($cantidad>0)
				return $resultado[0];
			else
				return false;

		}

		public function update($id,$datos)
		{
			$this->db->where('id',$id);
			if ($this->db->update('modulo',$datos))
				return true;
			else
				return false;
		}
	
	}
	
	/* End of file modelo.php */
	/* Location: ./application/models/modelo.php */
?>