<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Venta extends CI_Model {
	
			public function listado()
			{	
				$sql="SELECT v.id,v.fecha,v.monto,c.nombre,c.apellido,c.telefono FROM venta v
					INNER JOIN cliente c ON v.id_cliente=c.id where v.eliminada=0 ORDER BY v.id DESC ";
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
				$sql="UPDATE venta set eliminada=1 where id=".$venta_id;
				echo $sql;
				if($this->db->query($sql))
						return TRUE;
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
				$sql="SELECT r.cantidad,r.precio_outlet FROm relacion_talle r 
						INNER JOIN talle t on (r.id_talle=t.id and t.numero='".$talle."')
						where r.id_producto=".$producto_id;
				$query = $this->db->query($sql);
				$resultado = $query->result_array();
				return ($resultado)	;
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

			public function deleteDetalleVenta($venta_id)
			{
				$this->db->where('id_venta',$venta_id);
				if($this->db->delete("detalle_venta"))
					return TRUE;
				else
					return FALSE;

			}

			public function getPrecioById($producto_id)
			{
				$sql = "SELECT precio FROM producto where id=".$producto_id;
				$query = $this->db->query($sql);
				if($query->num_rows()>0)
				{
					$resultado=$query->result_array();
					return $resultado[0]['precio'];
				}
				else 
					return FALSE;
			}

			public function getDetalleVentaById($venta_id)
			{
				$sql="select * from venta v 
						inner join detalle_venta dv on (v.id=dv.id_venta)
						left join producto p on (dv.id_producto=p.id)
						left join cliente c on (v.id_cliente=c.id)
						where v.id=".$venta_id;
				$query = $this->db->query($sql);
				if($query->num_rows()>0)
				{
					$resultado=$query->result_array();
					return $resultado;
				}
				else 
					return FALSE;
			}

			public function getDetallePagosById($venta_id)
			{
				$sql="select v.id,pp.id,dpp.* from venta v 
					inner join plan_pago pp on (v.id=pp.id_venta)
					left join detalle_plan_pago dpp on (pp.id = dpp.plan_pago_id)
					where v.id=".$venta_id;
				$query = $this->db->query($sql);
				if($query->num_rows()>0)
				{
					$resultado=$query->result_array();
					return $resultado;
				}
				else 
					return FALSE;
			}
	
	}
	
	/* End of file venta.php */
	/* Location: ./application/models/venta.php */
?>