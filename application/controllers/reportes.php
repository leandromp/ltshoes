<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Reportes extends CI_Controller {
		
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],31);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['nombre_pagina'] = $this->uri->segment(1);
				 		$this->load->model("cliente","cliente",true);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$this->load->view('reportes/index',$variables);
			 		}
			 		//else
			 			//header('location:'.site_url());
			 		
				}	
			}

			public function ver_reporte()
			{
				$fecha_desde = $this->input->post("desde");
				$fecha_hasta = $this->input->post("hasta");
				$id_reporte = $this->input->post("id_reporte");
				$this->load->model("reporte","reporte",TRUE);
				if($fecha_desde=="" and $fecha_hasta=="")
				{
					$fecha_hasta=date("Y-m-d");
					$temp=strtotime('-7 days', strtotime($fecha_hasta));
					$fecha_desde=date("Y-m-d",$temp);
					
				}
			}

			public function mostrar_reporte()
			{
				$desde = $this->input->post("desde");
				$hasta = $this->input->post("hasta");
				$id_tabla = $this->input->post("id_tabla");
				if($id_tabla>0)
				{
					if($desde<$hasta)
					{
						$this->load->model("reporte","reporte",TRUE);
						if($id_tabla==1)
							$variables['reporte'] = $this->reporte->getVentasFechas($desde,$hasta);
						else
							$variables['reporte'] = $this->reporte->getPagosFechas($desde,$hasta);
						$this->load->view('dashboard/reporte-detalle',$variables);
					}
					else
						echo 3;//la fecha desde es mayo r que la fecha hasta
				}	
				else
				 echo 2;//no selecciono ningun tipo de reporte

			}

			public function ver_moras()
			{
				$fecha = date('Y-m-d');
				$this->load->model("reporte","reporte",TRUE);
				$variables['reporte'] = $this->reporte->getMora($fecha);
				$this->load->view("dashboard/mora-detalle",$variables);
			}
		
		}
		
		/* End of file reportes.php */
		/* Location: ./application/controllers/reportes.php */	
?>