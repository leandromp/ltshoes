<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Model {

	public function getVentasFechasMonto($desde,$hasta)
	{
		$sql="select SUM(monto) as total from venta where fecha between '".$desde."' and '".$hasta."'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res[0]['total'];
		else
			return FALSE;
	}

	public function getVentasFechas($desde,$hasta)
	{
		$sql="select v.fecha,v.monto,CONCAT(c.nombre,' ',c.apellido) as nombre from venta v 
			  inner join cliente c on (v.id_cliente = c.id)  
		      where v.fecha between '".$desde."' and '".$hasta."' ORDER BY v.id DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res;
		else
			return FALSE;
	}

	public function getPagosFechas($desde,$hasta)
	{
		$sql="select dpp.monto,dpp.fecha_vencimiento,dpp.fecha_pago as fecha,
				dpp.monto_pago,  CONCAT(c.nombre,' ',c.apellido) as nombre, 
				v.nombre as tipo_pago
				 from detalle_plan_pago dpp
				inner join plan_pago pp on (dpp.plan_pago_id=pp.id)
				inner join cuenta_corriente cc on (pp.id_cuenta_corriente=cc.id)
				inner join cliente c on (cc.id_cliente=c.id)
				inner join varios v on (pp.tipo = v.valor and v.codigo=1)
				where fecha_pago between '".$desde."' and '".$hasta.	"'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res;
		else
			return FALSE;
	}

	public function getCobradoFechaMonto($desde,$hasta)
	{
		$sql="select SUM(monto_pago) as total FROM detalle_plan_pago where fecha_pago between  '".$desde."' and '".$hasta."'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res[0]['total'];
		else
			return FALSE;
	}

	public function getCantidad($tabla)
	{
		$sql = "SELECT COUNT(id) as cantidad FROM ".$tabla;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res[0]['cantidad'];
		else
			return FALSE;

	}

	public function getMora($fecha)
	{
		$sql="select c.nombre,c.apellido,c.direccion,c.telefono,dpp.monto,
						datediff('".$fecha."',dpp.fecha_vencimiento) as dias_mora
							from cliente c
						inner join cuenta_corriente cc on (c.id=cc.id_cliente)
						inner join plan_pago pp on (cc.id=pp.id_cuenta_corriente)
						inner join detalle_plan_pago dpp on (pp.id=dpp.plan_pago_id)
						where dpp.fecha_vencimiento<'".$fecha."'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res;
		else
			return FALSE;
	}

	public function getProductosOutlet()
	{
		$sql = "select p.descripcion, rt.precio_outlet , rt.cantidad , rt.temporada
				from producto p
				inner join relacion_talle rt on (p.id = rt.id_producto and rt.outlet=TRUE) ";

		$query = $this->db->query($sql);
		$res = $query->result_array();
		if ($query->num_rows()>0)
			return $res;
		else
			return FALSE;
	}

}

/* End of file reporte.php */
/* Location: ./application/models/reporte.php */
?>