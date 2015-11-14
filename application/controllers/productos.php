<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Productos extends CI_Controller
	{
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					
					$this->load->model("empleado","empleado",true);
					$this->load->model("configuracion","configuracion",TRUE);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['tipo_productos'] = $this->configuracion->getVariosCodigo(3);
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
							//$datos["marca"] = $this->input->post("marca");
							$datos["codigo"] = $this->input->post("codigo");
							$datos["tipo"] = $this->input->post("tipo");
							$datos["descripcion"] = $this->input->post("descripcion");
							$datos["precio"] = $this->input->post("precio");
							$datos["fabricante"] = $this->input->post("fabricante");
							$datos["fecha_ingreso"] = $this->input->post("fecha_ingreso");
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
								$variables['mensaje'] = 'Los datos fueron ingresados correctamente';
								else
								$variables['error'] = 'hubo un error al intentar actualizar la Base de Datos';		
							}
							else
								$variables['error'] = 'debe ingresar los datos necesarios para guardar el producto';
							
						}
						$this->load->model('configuracion','configuracion',TRUE);
			 			$variables['tipo_productos'] = $this->configuracion->getVariosCodigo(3);
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
									//$datos["marca"] = $this->input->post("marca");
									$datos["codigo"] = $this->input->post("codigo");
									$datos["tipo"] = $this->input->post("tipo");
									$datos["descripcion"] = $this->input->post("descripcion");
									$datos["precio"] = $this->input->post("precio");
									$datos['fabricante'] = $this->input->post("fabricante");
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
										$variables['mensaje'] = 'Los datos fueron ingresados correctamente';
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

			public function talles($id)
			{
				$user=$this->session->userdata("ltshoes");
					if($user['usuario_id']>0)
					{
						$this->load->model("empleado","empleado",true);
						$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
						if($permisos['modificacion']==1)
						{
							
							if($id>0) //si el id vi
							{
								$this->load->model("producto","producto",true);
								$resultado = $this->producto->getTalles($id);
								//if($resultado)
								//{
									$variables['producto']=$this->producto->getProductoId($id);
									$variables['talles']=$resultado;
									$variables['vista']='talles-inc';
								//}
								//else
									//$mensaje['este producto no tiene ningun talle asociado'];
							}
							else
								$mensaje['no selecciono ningun producto'];

						}

						$this->index($variables);
					}
			}
		

			public function dame_talles()
			{
				$id=$this->input->post("producto_id");
				$this->load->model("producto","producto",true);
				$tipo = $this->producto->getProductoId($id);
				$tipo_cat = strtoupper($tipo['tipo']);
				if($tipo!="" and $tipo_cat=="CALZADO")
					$tipo=1;
				else
					$tipo=2;
				$talles = $this->producto->getComboTalles($id,$tipo);
				echo json_encode($talles);
			}

			public function guardar_talle()
			{
				$id_producto = $this->input->post("id_producto");
				$datos['talle'] = trim($this->input->post("talle"));
				$datos['cantidad'] = $this->input->post("cantidad");
				if ($datos['cantidad']>0)
				{
					$this->load->model("talle","talle",true);
					$resultado = $this->talle->getTalleId($id_producto,$datos['talle']);
					//print_r($resultado); 
					if ($resultado['cantidad']>0)
					{
						$cantidad=$datos['cantidad'];//$resultado['cantidad']+ le saque esto por que sumaba
						$this->talle->updateTalle($id_producto,$resultado['id_talle'],$cantidad);
					}
					else
					{
						$datos['id_talle']=$datos['talle'];
						$datos['id_producto']=$id_producto;
						unset($datos['talle']);
						$this->talle->insertTalle($datos);
					}
					echo 1;
				}
				else
					echo 2;

			}

			public function eliminar_talle()
			{
				$id=$this->input->post("id");
				$this->load->model("talle","talle",true);
				if ($this->talle->delete($id))
					echo 1;
				else
					echo 2;
			}

			public function agregar_outlet()
			{
				$producto_id = $this->input->post("producto_id");
				$talle_id = $this->input->post("talle_id");
				$temporada = $this->input->post("temporada");
				$precio = $this->input->post("precio");
				$this->load->model('producto','producto',true);
				if($producto_id!=0 and $temporada!=0 and $talle_id!=0 and $precio!='')
				{
					if($this->producto->outlet($producto_id,$talle_id,$temporada,$precio))
						echo 'ok';
					else
						echo 'db_error';
				}
				else
					echo 'error_datos';
				
			}

			public function ver_outlet()
			{
				$user=$this->session->userdata("ltshoes");
				if($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['modificacion']==1)
					{
						$this->load->model('producto','producto',true);
						$variables['productos_outlet'] = $this->producto->getOutlet();
						$variables['vista']='outlet-inc';
						$this->index($variables);
					}
					else
					echo 'no tiene permisos para usar este modulo';
				}
				else
					header('location:'.site_url());
			}

	
	}
	
	/* End of file productos.php */
	/* Location: ./application/controllers/productos.php */
?>