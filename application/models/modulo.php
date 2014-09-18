<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Modulo extends CI_Model {
	
		public function listado($usuario_id=0)
		{
			if($usuario_id==0)
				$usuario_id=$this->input->post("perfil");

			$sql="SELECT m.nombre, p.* FROM modulo m
			 	   LEFT JOIN permiso p on m.id=p.modulo_id
			 	   WHERE usuario_id=".$usuario_id;
			$query = $this->db->query($sql);
			$resultado = $query->result_array();
			if (count($resultado)>0)
			{
				return $resultado;
			}
			else
				return false;

		}


		public function insert($datos)
		{
			if($this->db->insert('modulo',$datos))
				return $modulo_id=$this->db->insert_id();
			else
				return false;

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