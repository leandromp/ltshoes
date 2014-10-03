<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Talle extends CI_Model {

		public function getTalles($id)
		{
			$sql="SELECT * FROM relacion_talle rt 
			INNER JOIN talles on rt.id_talle=t.id
			WHERE rt.id_producto=".$id;
			$query=$this->db->query($sql);
			$resultado=$query->result_array();
			if (count($resultado)>0)
				return $resultado;
			else
				return false;
		}
	
		public function getTalleId($id_producto,$talle)
		{
			$sql="SELECT rt.cantidad,t.numero,rt.id_talle FROM relacion_talle rt 
			INNER JOIN talle t on rt.id_talle=t.id
			WHERE rt.id_producto=".$id_producto." AND t.numero=".$talle;
			$query=$this->db->query($sql);
			$resultado=$query->result_array();
			if (count($resultado)>0)
				return $resultado[0];
			else
				return false;
		}

		public function updateTalle($id_producto,$talle,$cantidad)
		{
			$this->db->where("id_talle",$talle);
			$this->db->where("id_producto",$id_producto);
			if($this->db->update("relacion_talle",array("cantidad" => $cantidad)))
				return true;
			else
				return false;
		}

		public function insertTalle($datos)
		{
			$this->db->insert("relacion_talle",$datos);
		}

		public function delete($id)
		{
			if ($this->db->delete("relacion_talle",array("id" => $id)))
				return true;
			else
				return false;
		}
	
	}
	
	/* End of file talle.php */
	/* Location: ./application/models/talle.php */
?>