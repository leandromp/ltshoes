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
				 		$this->load->model("varios","varios",TRUE);
				 		$variables['localidades']=$this->varios->getVariosCodigo(2);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$this->load->view('clientes/index',$variables);
			 		}
			 		else
			 			header('location:'.site_url());
			 		
				}

			}

			public function alta($id=0)
			{
				$user=$this->session->userdata("ltshoes");
				if($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['alta']==1)
					{

						if($id!=0)
						{
							
							$variables['mensaje']="";
						}
						else
						{
							$error=0;
							$datos["nombre"] = $this->input->post("nombre");
							$datos["apellido"] = $this->input->post("apellido");
							$datos["dni"] = $this->input->post("dni");
							$datos["direccion"] = $this->input->post("direccion");
							$datos["telefono"] = $this->input->post("telefono");
							//controlo que los datos no vengan vacios
							foreach ($datos as $key => $value) 
							{
								if($value=="")
									$error=1;
							}						
							$datos["localidad"] = $this->input->post("localidad");
							$datos["barrio"] = $this->input->post("barrio");
							$datos["direccion_laboral"] = $this->input->post("direccion_laboral");
							$datos["telefono_laboral"] = $this->input->post("telefono_laboral");
							$this->load->model("cliente","cliente",true);

							if($error!=1) //si los datos no vienen vacios entonces intento hacer el insert en la DB
							{
								$resultado=$this->cliente->insert($datos);
								if($resultado==true){
									$variables['mensaje'] = 'Los datos fueron ingresados correctamente';
									header('location:'.site_url('clientes/index'));
								}
								
								else
								$variables['error'] = 'hubo un error al intentar actualizar la Base de Datos';		
							}
							else
								$variables['error'] = 'debe ingresar los datos necesarios para dar de alta al cliente';
							
						}
						$variables['vista']="form-inc";
						$this->index($variables);
					}
					else
					 echo 'no tiene permisos para usar este modulo';
				}
			}

			public function eliminar()
			{
				$user=$this->session->userdata("ltshoes");
				if($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['baja']==1)
					{
						$id=$this->input->post("id");
						$this->load->model("cliente","cliente",true);
						$this->cliente->delete($id);
						echo 1;
					}
					else
						echo 3; //no tiene permisos
				}	
			}
		

			public function editar($id=0)
			{
				$user=$this->session->userdata("ltshoes");
					if($user['usuario_id']>0)
					{
						$this->load->model("empleado","empleado",true);
						$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
						if($permisos['modificacion']==1)
						{
							
								if($id==0) //si el id viene por post
								{
									$error=0;
									$id=$this->input->post("id");
									$datos["nombre"] = $this->input->post("nombre");
									$datos["apellido"] = $this->input->post("apellido");
									$datos["dni"] = $this->input->post("dni");
									$datos["direccion"] = $this->input->post("direccion");
									$datos["telefono"] = $this->input->post("telefono");
									//controlo que los datos necesario no vengan vacios
									foreach ($datos as $key => $value) 
									{
										if($value=="")
											$error=1;
									}						

									$datos["localidad"] = $this->input->post("localidad");
									$datos["barrio"] = $this->input->post("barrio");
									$datos["direccion_laboral"] = $this->input->post("direccion_laboral");
									$datos["telefono_laboral"] = $this->input->post("telefono_laboral");
									$this->load->model("cliente","cliente",true);

									if($error!=1) //si los datos no vienen vacios entonces intento hacer el update en la DB
									{
										$resultado=$this->cliente->update($id,$datos);
										if($resultado==true)
										$variables['error'] = 'Los datos fueron ingresados correctamente';
										else
										$variables['error'] = 'hubo un error al intentar actualizar la Base de Datos';		
									}
									else
										$variables['error'] = 'debe ingresar los datos necesarios para dar de alta al cliente';


								}
								else //sino viene por url entonces completo los campos del formulario con los datos del cliente
								{

									$this->load->model("cliente","cliente",true);
									$variables['cliente']=$this->cliente->getClienteId($id);
								}

								$variables['vista']="form-inc"; //por cualquiera sea listado o modificacion muestro el formulario y paso un mensaje.
								
						}
						else
							$variables['mensaje']="No tiene permisos para acceder a esta funcion";


						$this->index($variables);
					}
			}
		
}
		
		/* End of file clientes.php */
		/* Location: ./application/controllers/clientes.php */
?>