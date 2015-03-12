<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Venta extends CI_Model {
	
			public function listado()
			{	
				$sql="SELECT v.fecha,v.monto,c.nombre,c.apellido,c.telefono FROM venta v
					INNER JOIN cliente c ON v.id_cliente=c.id ORDER BY fecha DESC ";
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

			public function delete($venta_id)
			{
				$this->db->where('id',$venta_id);
				if($this->db->delete("venta"))
				{
					//$this->db->where('id_venta',$venta_id);
					//if($this->db->delete("detalle_venta"))
						return TRUE;
					//else
					//	return FALSE;
				}
				else
					return FALSE;
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

			public function getCantidadById($producto_id,$talle)
			{
				$sql="SELECT r.cantidad FROm relacion_talle r 
						INNER JOIN talle t on (r.id_talle=t.id and t.numero=".$talle.")
						where r.id_producto=".$producto_id;
				$query = $this->db->query($sql);
				$resultado = $query->result_array();
				return ($resultado[0]['cantidad'])	;
			}

			public function getCantidadRelacion($producto_id,$talle)
			{
				$sql="select p.id idproducto, rt.id as relacionid , t.id as talle_id, rt.cantidad, t.numero from producto p 
						inner join relacion_talle rt on (p.id = rt.id_producto)
						inner join talle t on (t.id=rt.id_talle and t.numero='".$talle."')
						and p.id=".$producto_id;
				$query = $this->db->query($sql);
				if($query->num_rows()==1)
				{
					$resultado=$query->result_array();
					return $resultado;
				}
				else 
					return FALSE;
			}


			public function updateCantidad($id,$cantidad)
			{
				$this->db->where('id',$id);
				if($this->db->update("relacion_talle",array('cantidad'=>$cantidad)))
					return TRUE;
				else
					return FALSE;
			}
	
	}
	
	/* End of file venta.php */
	/* Location: ./application/models/venta.php */
?>