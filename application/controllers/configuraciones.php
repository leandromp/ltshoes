<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Configuraciones extends CI_Controller {
 
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
	 			$this->load->model("configuracion","configuracion",TRUE);
	 			$variables['localidades'] = $this->configuracion->getVariosCodigo(2);
	 			$variables['zonas'] = $this->configuracion->getVariosCodigo(4);
	 			$variables['talles_calzado'] = $this->configuracion->getTalles(1);
	 			$variables['talles_ropa'] = $this->configuracion->getTalles(2);
	 			$variables['nombre_pagina'] = $this->uri->segment(1);
		 		$this->load->view('configuracion/index',$variables);
	 		}
	 		else
	 			header('location:'.site_url());
	 		
		}

	}


	public function eliminar()
	{
		$id = $this->input->post("id");
		if($id>0)
		{
			
			$this->load->model("configuracion","configuracion",TRUE);
			if($this->configuracion->eliminar($id))
				echo 1;	
			else
				echo 2;
		}
		else
			header('location:'.site_url());
	}

	public function agregar_opcion()
	{
		
		$user=$this->session->userdata("ltshoes");
		if ($user['usuario_id']>0)
		{
			$this->load->model("empleado","empleado",true);
			$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
			if($permisos['alta']==1)
			{

				$valor=$this->input->post("valor");
				$tipo=$this->input->post("tipo");
				if($valor!="" and $tipo!="")
				{
					$datos['codigo']=$tipo;
					$datos['nombre']=$valor;
					$this->load->model("configuracion","configuracion",TRUE);
					if($tipo>2)
					{
						if($tipo==3)
							$datos['codigo']=2; //cambio por que el valor de la tabla varios es 2

						$ok = $this->configuracion->insertVarios($datos);
					}
						
					else
					{
						$datos_talle['numero'] = $valor;
						$datos_talle['tipo_producto'] = $tipo;
						$ok = $this->configuracion->insertTalle($datos_talle);
					}

					if($ok==TRUE)
						echo 1;
					else
						echo 3;
				}
				else
					echo 3;
			}
			else
				echo 2;
		}
		else
			header('location:'.site_url());
	}
 }
 
 /* End of file configuraciones.php */
 /* Location: ./application/controllers/configuraciones.php */
?>