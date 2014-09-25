<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Cliente extends CI_Model {
		
			public function getClientes()
			{
				$query=$this->db->get("cliente");
				$resultado= $query->result_array();
				$cantidad= count($resultado);
				if ($cantidad>0)
					return $resultado;
				else
					return false;

			}

			public function insert($datos)
			{
				if($this->db->insert("cliente",$datos))
					return true;
				else
					return false;

			}

			public function delete($id)
			{
				if($this->db->delete("cliente",array("id"=>$id)))
					return true;
				else
					return false;
			}

			public function update($id,$datos)
			{	
				$this->db->where("id",$id);
				if($this->db->update("cliente",$datos))
					return true;
				else
					return false;
			}

			public function getClienteId($id)
			{
				$query=$this->db->get_where("cliente",array("id"=>$id));
				$resultado=$query->result_array();
				if(count($resultado)>0)
					return $resultado[0];
				else
					return false;
			}


	
	}
	
	/* End of file cliente.php */
	/* Location: ./application/models/cliente.php */
?>