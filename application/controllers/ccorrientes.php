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
			 		else
			 			header('location:'.site_url());
			 		
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

			 			$this->load->model("ccorriente","ccorriente",TRUE);
			 			$this->load->model("cliente","cliente",TRUE);
			 			$variables['cliente']=$this->cliente->getClienteId($id);
			 			$variables['ccorriente'] = $this->ccorriente->getCCorrienteId($id);
			 			$variables['planes'] = $this->ccorriente->getPlanesId($variables['ccorriente']['id']);
			 			foreach ($variables['planes'] as $key => $value) {

			 					$variables['planes'][$key]['detalle_pp']=$this->ccorriente->getDetalleID($value['id']);
			 			}
			 			$variables['vista']="detalle-cuenta";
			 			$this->index($variables);
			 		}
			 		else
			 			header('location:'.site_url());
				}

			}
		
	}
		
		/* End of file ccorriente.php */
		/* Location: ./application/controllers/ccorriente.php */
?>