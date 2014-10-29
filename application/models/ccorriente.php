<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Ccorriente extends CI_Model 
		{

			public function getCCorrienteId($id)
			{
				$query=$this->db->get_where("cuenta_corriente",array("id_cliente" => $id));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado[0];
				else
					return false;
			}

			public function insertBlank($datos)
			{

				if($this->db->insert("cuenta_corriente",$datos))
					return $this->db->insert_id();
				else
					return false;
			}

			public function update($id_cliente,$columna="",$valor="")
			{
				$this->db->where("id_cliente",$id_cliente);
				if ($this->db->update("cuenta_corriente",array($columna => $valor)))
					return true;
				else
					return false;
			}

			public function insertPlanPago($datos)
			{
				if($this->db->insert("plan_pago",$datos))
					return $this->db->insert_id();
				else
					return false;
			}

			public function insertLineaPlanPago($datos)
			{
				if($this->db->insert("detalle_plan_pago",$datos))
					return TRUE;
				else
					return FALSE;
			}

			public function getPlanesId($id_ccorriente)
			{
				$query=$this->db->get_where("plan_pago",array("id_cuenta_corriente" => $id_ccorriente));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado;
				else
					return false;
			}

			public function getPlanId($id)
			{
				$query=$this->db->get_where("detalle_plan_pago",array("id" => $id));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado[0]['plan_pago_id'];
				else
					return false;
			}

			public function getDetalleID($id_plan_pago)
			{
				$query=$this->db->get_where("detalle_plan_pago",array("plan_pago_id" => $id_plan_pago));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado;
				else
					return false;
			}

			public function updateDetallePlan($id,$datos)
			{
				$this->db->where("id",$id);
				if($this->db->update("detalle_plan_pago",$datos))
					return TRUE;
				else
					return FALSE;
			}

			public function getCCorrientebyId($id)
			{
				$query=$this->db->get_where("plan_pago",array("id" => $id));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado[0]['id_cuenta_corriente'];
				else
					return false;
			}

			public function getDetalleCuenta($id)
			{
				$query=$this->db->get_where("cuenta_corriente",array("id" => $id));
				$resultado = $query->result_array();
				if (count($resultado)>0)
					return $resultado;
				else
					return false;
			}

			public function updateCuenta($id,$datos)
			{
				$this->db->where("id",$id);
				if ($this->db->update("cuenta_corriente",$datos))
					return true;
				else
					return false;
			}

		
		}
		
		/* End of file ccorriente.php */
		/* Location: ./application/models/ccorriente.php */
?>