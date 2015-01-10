<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
	class Ccorrientes extends CI_Controller 
	{
		
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],30);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['nombre_pagina'] = $this->uri->segment(1);
				 		$this->load->model("cliente","cliente",true);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$this->load->view('ccorriente/index',$variables);
			 		}
			 		//else
			 			//header('location:'.site_url());
			 		
				}	
			}

			public function ver_detalle_cuenta($id)
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],30);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			//echo $id;
			 			$this->load->library("varios_library");
			 			$this->load->model("ccorriente","ccorriente",TRUE);
			 			$this->load->model("cliente","cliente",TRUE);
			 			$variables['cliente']=$this->cliente->getClienteId($id);
			 			$variables['ccorriente'] = $this->ccorriente->getCCorrienteId($id);
			 			$variables['planes'] = $this->ccorriente->getPlanesId($variables['ccorriente']['id']);
			 			
			 			$variables['vista']="detalle-cuenta";
			 			$this->index($variables);
			 		}
			 		else
			 			header('location:'.site_url());
				}

			}

			public function ver_detalle_plan($id_plan,$id_cliente)
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->library("varios_library");
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],30);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$this->load->model("empleado","empleado",TRUE);
			 			$this->load->model("ccorriente","ccorriente",TRUE);

			 			$variables['id_cliente']=$id_cliente;
			 			$variables['empleados']=$this->empleado->getEmpleados(0);
			 			$variables['detalle_pp']=$this->ccorriente->getDetalleID($id_plan);
			 			$variables['vista']="detalle-plan-pago";
			 		}
			 		else
			 			$variables['mensaje']="No tiene permisos para acceder a esta funcion";

			 		$this->index($variables);
				}
					else
					header('location:'.site_url());

			}

			public function cancelar_pago()
			{
				$fecha = $this->input->post("fecha");
				$fecha_temp=explode("/", $fecha);
				$datos['fecha_pago']=$fecha_temp[2].'-'.$fecha_temp[1].'-'.$fecha_temp[0];
				$datos['monto_pago'] = $this->input->post("monto");
				$datos['id_empleado'] = $this->input->post("id_empleado");
				$id = $this->input->post("id");
				if ($id and $datos['fecha_pago'] and $datos['monto_pago'])
				{
					$this->load->model('ccorriente','ccorriente',TRUE);
					// primero hago update el pago en la tabla detalle_plan_pago
					if($this->ccorriente->updateDetallePlan($id,$datos))
					{
						$plan_pago_id=$this->ccorriente->getPlanId($id);
						$cuenta_corriente_id=$this->ccorriente->getCCorrientebyId($plan_pago_id);
						// traigo todos los datos de la cuenta corriente
						$datos_cuenta= $this->ccorriente->getDetalleCuenta($cuenta_corriente_id);
						foreach ($datos_cuenta as $key => $value) {
							$value['haber']+=$datos['monto_pago'];
							$saldo=$value['debe']-$value['haber'];
							$datos_cuenta_c['haber'] = $value['haber'];
							$datos_cuenta_c['saldo'] = $saldo;
						}
						
						$this->ccorriente->updateCuenta($cuenta_corriente_id,$datos_cuenta_c);
						$res['res']='1';
					}
						
					else
						$res['res']='3';
				}
				else
					$res['res']='2';

				echo json_encode($res);
			}
		
	}
		
		/* End of file ccorriente.php */
		/* Location: ./application/controllers/ccorriente.php */
?>