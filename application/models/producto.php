<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Producto extends CI_Model 
		{
			
			public function listado()	
			{
				$query=$this->db->get("producto");
				$resultado=$query->result_array();
				return $resultado;

			}

			public function insert($datos)
			{
				if($this->db->insert("producto",$datos))
					return true;
				else
					return false;

			}

			public function delete($id)
			{
				if($this->db->delete("producto",array("id"=>$id)))
					return true;
				else
					return false;
			}

			public function update($id,$datos)
			{	
				$this->db->where("id",$id);
				if($this->db->update("producto",$datos))
					return true;
				else
					return false;
			}

			public function getProductoId($id)
			{
				$query=$this->db->get_where("producto",array("id"=>$id));
				$resultado=$query->result_array();
					return $resultado[0];
			}
		
		}
		
		/* End of file producto.php */
		/* Location: ./application/models/producto.php */
?>