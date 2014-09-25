<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Productos extends CI_Controller
	{
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['nombre_pagina'] = $this->uri->segment(1);
				 		$this->load->model("producto","producto",true);
				 		$variables['productos']=$this->producto->listado();
				 		
			 		}
			 		else
			 		{
			 			$variables['productos']="";
			 			$variables['error']="no tiene permisos para acceder al modulo";
			 		}

			 		$this->load->view('productos/index',$variables);
			 		
				}
				else
			 			header('location:'.site_url());
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
							$datos["marca"] = $this->input->post("marca");
							$datos["codigo"] = $this->input->post("codigo");
							$datos["tipo"] = $this->input->post("tipo");
							$datos["descripcion"] = $this->input->post("descripcion");
							$datos["precio"] = $this->input->post("precio");
							//controlo que los datos no vengan vacios
							foreach ($datos as $key => $value) 
							{
								if($value=="")
									$error=1;
							}						
						
							$this->load->model("producto","producto",true);

							if($error!=1) //si los datos no vienen vacios entonces intento hacer el insert en la DB
							{
								$resultado=$this->producto->insert($datos);
								if($resultado==true)
								$variables['error'] = 'Los datos fueron ingresados correctamente';
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
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					if($permisos['baja']==1)
					{
						$id=$this->input->post("id");
						$this->load->model("producto","producto",true);
						$this->producto->delete($id);
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
									$datos["marca"] = $this->input->post("marca");
									$datos["codigo"] = $this->input->post("codigo");
									$datos["tipo"] = $this->input->post("tipo");
									$datos["descripcion"] = $this->input->post("descripcion");
									$datos["precio"] = $this->input->post("precio");
									//controlo que los datos necesario no vengan vacios
									foreach ($datos as $key => $value) 
									{
										if($value=="")
											$error=1;
									}						

									$this->load->model("producto","producto",true);

									if($error!=1) //si los datos no vienen vacios entonces intento hacer el update en la DB
									{
										$resultado=$this->producto->update($id,$datos);
										if($resultado==true)
										$variables['error'] = 'Los datos fueron ingresados correctamente';
										else
										$variables['error'] = 'hubo un error al intentar actualizar la Base de Datos';		
									}
									else
										$variables['error'] = 'debe ingresar los datos necesarios para dar de alta al producto';


								}
								else //sino viene por url entonces completo los campos del formulario con los datos del cliente
								{

									$this->load->model("producto","producto",true);
									$variables['producto']=$this->producto->getProductoId($id);
								}

								$variables['vista']="form-inc"; //por cualquiera sea listado o modificacion muestro el formulario y paso un mensaje.
								
						}
						else
							$variables['mensaje']="No tiene permisos para acceder a esta funcion";


						$this->index($variables);
					}
			}
		



	
	}
	
	/* End of file productos.php */
	/* Location: ./application/controllers/productos.php */
?>