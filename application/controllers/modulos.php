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
					$modulo_id=$this->modulo->insert($datos);
					//cargo todos los perfiles para hacer un insert por cada uno en la tabla 
					//permisos pero con los campos en 0
					$this->load->model("permiso","permiso",true);
					$perfiles=$this->permiso->getPerfiles();
					foreach ($perfiles as $key => $value) 
					{
						if ($this->permiso->insertEmpty($modulo_id,$value['id']))
							$variables['mensaje'] = 'Datos Actualizados correctamente';
						else
							$variables['mensaje'] = 'error en la base de datos';

					}
				}
				else
				{  
					if($alert==0)	//debo mostar las alertas
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

		public function permisos($update=0)
		{
			$user = $this->session->userdata("ltshoes");
			if ($user['usuario_id']>0 and $user['perfil_id']==1)
			{
				$this->load->model("modulo","modulo",true);
				$this->load->model("empleado","empleado",true);
				$perfiles = $this->empleado->getPerfiles();
				if($update==0)
				{
					$resultado = $this->modulo->listado($user['usuario_id']);
					$variables['permisos'] = $resultado;
					$variables['perfiles']= $perfiles;
					$variables['vista']='permisos-inc';
					$this->index($variables);
				}
				else
				{
					
					$perfil_id=$this->input->post("perfil_id");
					if($perfil_id>0)//corroboro que el perfil de usuario exista;
					{
						//obtengo la cantidad de modulos del sistema
						$modulos=$this->modulo->getAll();
						$this->load->model("permiso","permiso",true);
						foreach ($modulos as $key => $value) {
							//echo 'modulo_id es'.$value['id'];
						 	for ($i=1; $i < 5 ; $i++) { 
						 		$value['id'].'-'.$i;
						 		$columna=array(1=>'alta',2=>'baja',3=>'modificacion',4=>'consulta');
						 		$opcion=$this->input->post($value['id'].'-'.$i);

						 		if($opcion=='on')
						 			$valor_update=1;
						 		else
						 			$valor_update=0;
						 		if(!$this->permiso->updateSimple($value['id'],$perfil_id,$columna[$i],$valor_update))
						 			$variables['error']= 'lo sentimos hubo un error al actulizar la base de datos.';
						 		else
						 			$variables['mensaje']="Modificaciones Guardadas Correctamente";
						 			
							 	}
							 $variables['perfiles']=$perfiles;
							 $variables['permisos']=$this->modulo->listado($user['perfil_id']);;
						}
					}
					else
					{
						$variables['permisos'] = "";

						$variables['error']="no ha seleccionado ningun perfil de usuario";
					}
					

					$variables['vista']="permisos-inc";
					$this->index($variables);
				}
				
				
			}
			else
			{
				echo 'no tiene permisos para acceder al modulo';
			}
		}

		public function cambiar_perfil()
		{
			$perfil_id=$this->input->post("perfil");
			if($perfil_id>0)
			{
				$this->load->model("empleado","empleado",true);
				$perfiles = $this->empleado->getPerfiles();
				$variables['perfiles']=$perfiles;
				// arriba vuelvo a cargar los perfiles
				$this->load->model("modulo","modulo",true);
				$variables['perfil_seleccionado']=$perfil_id;
				$variables['permisos'] = $this->modulo->listado($perfil_id);
				$this->load->view("modulos/permisos-inc",$variables);
			}
		}

}
	
	/* End of file modulo.php */
	/* Location: ./application/controllers/modulo.php */
?>