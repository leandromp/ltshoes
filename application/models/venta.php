<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Venta extends CI_Model {
	
			public function listado()
			{	
				$sql="SELECT * FROM venta v
					INNER JOIN cliente c ON v.id_cliente=c.id ";
				$query=$this->db->query($sql);
				$resultado=$query->result_array();
				return $resultado;
			}

			public function insertVenta($datos)
			{
				if ($this->db->insert("venta",$datos))
					return $this->db->insert_id();
				else
					return false;
			}

			public function insertLVenta($datos)
			{
				if($this->db->insert("detalle_venta",$datos))
					return true;
				else
					return false;
			}

			public function getPPagos()
			{
				$this->db->where("codigo",1);
				$query=$this->db->get("varios");
				$resultado=$query->result_array();
				return $resultado;

			}
	
	}
	
	/* End of file venta.php */
	/* Location: ./application/models/venta.php */
?>