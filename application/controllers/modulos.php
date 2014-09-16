<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Modulos extends CI_Controller 
{
	
		public function index($datos="")
		{
			$variables=$datos;
			$this->load->library('menu');
	 		$variables['menu'] = $this->menu->dame_menu();
	 		$variables['nombre_pagina'] = $this->uri->segment(1);
	 		$this->load->view('modulos/index',$variables);
		}

		public function alta($alert=0)
		{
			$user = $this->session->userdata('ltshoes');
			if($user['usuario_id']>0)
			{
				$datos['nombre'] = $this->input->post("nombre");
				$datos['ruta'] = $this->input->post("accion");
				$datos['icono'] = $this->input->post("icono");
				if ($datos['nombre']!="" and $datos['ruta']!="")
				{
					$this->load->model('modulo','modulo',true);
					$resupuesta=$this->modulo->insert($datos);
				}
				elseif ($alert==0){  //debo mostar las alertas
						$variables['mensaje']="Falta los datos requeridos para poder dar de alta el modulo";
				}
				$variables['vista']='form-inc';

				$this->index($variables);
			}
			else
				// no hay ningun usuario logeado
				header('location:'.site_url());
		}

		public function editar($id=0)
		{
			$user = $this->session->userdata("ltshoes");
			if ($user['usuario_id']>0)
			{
				$this->load->model("modulo","modulo",true);
				if ($id==0)//el formulario envio el id por post y esta intentando realizar un update
				{
					$id=$this->input->post("id");
					$datos['nombre'] = $this->input->post("nombre");
					$datos['ruta'] = $this->input->post("accion");
					$datos['icono'] = $this->input->post("icono");
					if ($datos["nombre"]!="" and $datos["ruta"]!="")
					{
						$this->modulo->update($id,$datos);
						$variables['mensaje']="Modulo modificado correctamente";
					}
					else
					{
						$datos['id']=$id;
						$variables['modulo']=$datos;
						$variables['mensaje']="Falta los datos requeridos para poder modificar el modulo";
					}
										}
				else //sino es que quiero ver los datos en el formulario y paso el id del modulo por url
				{
					$resultado=$this->modulo->getModulo($id);	
					$variables['modulo']=$resultado;
				}
	
				$variables['vista']='form-inc';
				$this->index($variables);
			}				
		}

		public function eliminar()
		{
			$user = $this->session->userdata("ltshoes");
			if ($user['usuario_id']>0)
			{
				$id=$this->input->post("id");
				$this->load->model("modulo","modulo",true);
				$resultado=$this->modulo->delete($id);
				if($resultado==true)
					echo '1';
				else
					echo '2';
			}
			else
				header('location:'.site_url());
		}
}
	
	/* End of file modulo.php */
	/* Location: ./application/controllers/modulo.php */
?>