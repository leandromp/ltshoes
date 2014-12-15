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
			$this->configuracion->eliminar($id);


		}
		else
			header('location:'.site_url());
	}

 }
 
 /* End of file configuraciones.php */
 /* Location: ./application/controllers/configuraciones.php */
?>