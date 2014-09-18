<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Clientes extends CI_Controller {
		
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);


					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['nombre_pagina'] = $this->uri->segment(1);
				 		$this->load->model("cliente","cliente",true);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$this->load->view('clientes/index',$variables);
			 		}
			 		else
			 			header('location:'.site_url());
			 		
				}

			}

			public function alta($alert=0)
			{
				$user=$this->session->userdata("ltshoes");
				if($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['alta']==1)
					{
						$datos["nombre"] = $this->input->post("nombre");
						$datos["apellido"] = $this->input->post("apellido");
						$datos["dni"] = $this->input->post("dni");
						$datos["direccion"] = $this->input->post("direccion");
						$datos["telefono"] = $this->input->post("telefono");
						$datos["localidad"] = $this->input->post("localidad");
						$datos["barrio"] = $this->input->post("barrio");
						$datos["direccion_laboral"] = $this->input->post("direccion_laboral");
						$datos["telefono_laboral"] = $this->input->post("telefono_laboral");
						
						$variables['vista']="form-inc";
						$this->index($variables);
					}
					else
					 echo 'no tiene permisos para usar este modulo';
				}
			}
		
		}
		
		/* End of file clientes.php */
		/* Location: ./application/controllers/clientes.php */
?>