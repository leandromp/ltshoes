<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Ventas extends CI_Controller {
	
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
				 		$this->load->model("venta","venta",true);
				 		$variables['ventas']=$this->venta->listado();
				 		
			 		}
			 		else
			 		{
			 			$variables['productos']="";
			 			$variables['error']="no tiene permisos para acceder al modulo";
			 		}

			 		$this->load->view('ventas/index',$variables);
			 		
				}
				else
			 			header('location:'.site_url());
			}

		public function alta()
		{
			$user=$this->session->userdata("ltshoes");
			if($user['usuario_id']>0)
			{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['alta']==1)
					{
						//cargo la vista para selecionar el cliente
						$this->load->model("cliente","cliente",true);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$variables['vista']='cliente-inc';

					}

					$this->index($variables);

			}

		}

		public function seleccionar_cliente($id=0)
		{
			$user=$this->session->userdata("ltshoes");
			if($user['usuario_id']>0)
			{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],19);
					if($permisos['alta']==1)
					{
						
						if($id>0)//no se selecciono ningun cliente 
						{
							//cargo la vista para selecionar el cliente
							$this->load->model("cliente","cliente",true);
							$carrito=$this->session->userdata("carrito");
					 		$carrito['cliente']=$this->cliente->getClienteId($id);
					 		$this->session->set_userdata("carrito",$carrito);

					 		$variables['cliente']=$carrito['cliente'];
					 		$this->load->model("producto","producto",true);
					 		//cargo el listado de productos
				 			$variables['productos']=$this->producto->listado();
				 			foreach ($variables['productos'] as $key => $value) {
				 				$variables['productos'][$key]['talles']=$this->producto->getTalles($value['id']);
				 			}
					 		$variables['vista']='carrito-inc';	
						}
						else
						{
							$variables['vista']="cliente-inc";
							$variables['mensaje']="no se selecciono ningun cliente";
						}

						

					}

					$this->index($variables);

			}

		}

		public function agregar_producto()
		{
			$id=$this->input->post("id");
			$cantidad = $this->input->post("cantidad");
			$talle = $this->input->post("talle");
			$stock = trim($this->input->post("stock"));
			if($id>0)
			{
				if ($cantidad <= $stock)
				{
					if($cantidad>0)
						{
							$this->load->library("session");
							$this->load->model("producto","producto",true);
							$producto = $this->producto->getProductoId($id);
							$carrito = $this->session->userdata("carrito");
							if(isset($carrito['productos']))
							{
								$update_cantidad=0;
								//Recorro el carro para saber si tengo que hacer un update de la cantidad
								$productos=$carrito['productos'];
								foreach ($productos as $key => $value) 
								{
									if($id==$value['id'])
									{
										$update_cantidad=1;
										$productos[$key]['cantidad']+=$cantidad;
									}

								}
								//sino entonces lo que hago es agregar el producto al carro.
								if($update_cantidad==0)
								{
									$producto["id"] = $producto["id"];
									$producto["descripcion"] = $producto["descripcion"];
									$producto["precio"] = $producto["precio"];
									$producto["cantidad"] = $cantidad;
									$producto["talle"] = $talle;
									$productos[]=$producto;//agrego el producto al array
									
									//$this->session->set_userdata('carrito',$carrito);//actualizo la sesion
								}


							}
							else//es el primer producto
							{
								$producto["id"] = $producto["id"];
								$producto["descripcion"] = $producto["descripcion"];
								$producto["precio"] = $producto["precio"];
								$producto["cantidad"] = $cantidad;
								$producto["talle"] = $talle;
								$productos[]=$producto;
								
							}

							$carrito['productos']=$productos;//actualizo el carrito 
							$this->session->set_userdata('carrito',$carrito);

							//print_r($carrito);
							
							$res['cantidad']=count($productos);
							$res['res']=1;

						}
					else
						$res['res']=2; //la cantidad no es mayor 0	
				}
				else
					$res['res']=4; // la cantidad de producto ingresado es mayor que el stock disponible
				
			}
			else
			$res['res']=3; // no selecciono ningun producto 

		echo json_encode($res);
		}

		public function eliminar_producto_carrito()
		{	
			$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
			 		if ($permisos['baja']==1)
			 		{
			 			$id = $this->input->post("id");
			 			if($id>0)
			 			{
			 				$carrito = $this->session->userdata("carrito");
			 				foreach ($carrito['productos'] as $key => $value) {
			 					
			 					if ($id == $value['id'])
			 						unset($carrito['productos'][$key]);
			 					else
			 						$res['total']+=$carrito['productos'][$key]['precio']*$carrito['productos'][$key]['cantidad'];
			 				}
			 				$this->session->set_userdata("carrito",$carrito);
			 				$res['cantidad']=count($carrito['productos']);
							$res['res']=1;
			 			}
			 			else
			 			$res['res']=2; // no ha seleccionado ningun productos
			 		}
			 		else
			 		$res['res']=3; // no tiene permisos suficientes para realizar la operacion
			 		echo json_encode($res);
			 	}
			 	else
			 		header('location:'.site_url());
		}

		public function ver_carrito()	
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
			 			$variables['carrito']=$this->session->userdata("carrito");
						$this->load->view("carrito/index",$variables);
					}
					else
						$mensaje="no tiene permisos para ver este modulo";
				}
		}

		public function confirmar_compra()
		{

			$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					
			 		if ($permisos['alta']==1)
			 		{
						$this->session->userdata("carrito");
						$this->load->model("empleado","empleado",TRUE);
						$variables['carrito'] = $this->session->userdata("carrito");
						//guardo la venta en 
						//$fecha  = date("m-d-Y");
						$variables['empleados'] = $this->empleado->getEmpleados();
					}
					else
						$variables['mensaje']="No tiene permisos parar acceder hasta modulo";


						$variables['vista']="confirmar-compra-inc";


					$this->index($variables);
				}
				else
					header('location:'.site_url());

		}

		public function guardar_compra()
		{
			$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					
			 		if ($permisos['alta']==1)
			 		{
			 			$opcion_pago=$this->input->post("opcion-pago");
						
						if ($opcion_pago!="")
						{

							$total_compra=0;
							$carrito=$this->session->userdata("carrito");
							$this->load->model("venta","venta",true);
							//  calculo el total de la compra 
							foreach ($carrito['productos'] as $key => $value) {
								$total_compra+=$value['precio']*$value['cantidad'];
							}
							if($this->input->post('fecha')=="")
								$datos_venta['fecha'] = $fecha=date("Y-m-d");
							else
								$datos_venta['fecha'] = $this->input->post('fecha');
							
							$datos_venta['monto'] = $total_compra;
							$datos_venta['id_cliente'] = $carrito['cliente']['id'];
							$datos_venta['id_empleado'] = $this->input->post("empleado");

							if ($id_venta=$this->venta->insertVenta($datos_venta))
								{
									$id_venta;
									//guardo el detalle de la lineas de venta
									foreach ($carrito['productos'] as $key => $value) 
									{
										$datos_lv['id_producto'] = $value ['id'];
										$cantidad = $this->venta->getCantidadRelacion($value['id'],$value['talle']);
										$cantidad_anterior = $cantidad[0]['cantidad'];
										$relacionid = $cantidad[0]['relacionid'];
										$cantidad_actual= $cantidad_anterior - $value['cantidad'];
										$ok=$this->venta->updateCantidad($relacionid,$cantidad_actual);
										if ($ok==FALSE)
										{
											
											header('location:'.site_url('ventas'));
											break;
										}
										$datos_lv['cantidad'] = $value['cantidad'];
										$datos_lv['precio'] = $value['precio'];
										$datos_lv['id_venta'] = $id_venta;
										$this->venta->insertLVenta($datos_lv);

									}
								}
							else
								$variables['mensaje']="no se pudo realizar la operacion solicitada. Comuniquese con el Administrador";
							//control si ademas de guardar la venta tambien voy a realizar el alta de  plan de pago
							if($opcion_pago>0)
							{
								switch ($opcion_pago) {
										case '1':
											$variables['monto_cuota'] = $total_compra/16;
											$variables['cantidad_cuotas'] = 16;
											break;
										case '2':
											$variables['monto_cuota'] = $total_compra/8;
											$variables['cantidad_cuotas'] = 8;
											break;
										case '3':
											$variables['monto_cuota'] = $total_compra/4;
											$variables['cantidad_cuotas'] = 4;
											break;
								}
								$variables['opcion_pago']=$opcion_pago;
								$variables['id_venta']=$id_venta;
								$variables['vista']='seleccion-pago';
								$cliente=$this->session->userdata("carrito");
								$variables['cliente'] = $cliente['cliente'];
								$variables['total_compra'] = $total_compra;
								$variables['opciones_pago']=$this->venta->getPPagos();
								//print_r($variables);
								$this->session->unset_userdata("carrito");
								$this->index($variables);
							}
							else
							{
								$this->session->unset_userdata("carrito");
								header('location:'.site_url('ventas'));
							}
								
						}
						//else
						
						
					}
					//else //no tiene permisos para la operacion sobre el modulo


					//$this->index($variables);
				}
				else
					header('location:'.site_url());
		}

		public function guardar_opcion_pago() //este metodo deberia ir en el controlador ccorriente ?
		{
			$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
					
			 		if ($permisos['alta']==1)
			 		{
			 			$this->load->model("ccorriente","ccorriente",TRUE);
			 			$this->load->model("venta","venta",TRUE);

			 			$datos['id_venta'] = $this->input->post("id_venta");
			 			$datos['id_cliente'] = $this->input->post("id_cliente");
			 			//obtengo los datos del id de cuenta corriente del cliente 
			 			$cuenta_datos = $this->ccorriente->getCCorrienteId($datos['id_cliente']);
			 			
			 			if ($cuenta_datos)
			 			{
			 				$datos['id_cuenta_corriente'] = $cuenta_datos['id'];
			 				$datos['debe']= $cuenta_datos['debe'];
			 			}
			 			else
			 			{
			 				$datos_cc['id_cliente'] = $datos['id_cliente'];
			 				$datos_cc['debe']= 0;
			 				$last_id = $this->ccorriente->insertBlank($datos_cc);
			 				
			 				$datos['id_cuenta_corriente'] = $last_id;
			 				// armo los datos para insertar en la tabla plan pago
			 				$datos['debe'] = 0;
			 			}

			 				//hago una actulizacion de la cuenta corriente del cliente
			 				$datos['debe'] += $this->input->post("monto_total");
			 				if($this->ccorriente->update($datos['id_cliente'],"debe",$datos['debe']))
			 				{
			 					//si hubo exito al hacer el UPdate en la C Corriente hago los respectivos
			 					//insert en las tablas plan pago y detalle plan pago
			 					$datos_pp['tipo']= $this->input->post("plan-pago");
			 					$datos_pp['monto_total'] = $this->input->post("monto_total");
			 					$datos_pp['monto_cuota'] = $this->input->post("monto-cuota");
			 					$datos_pp['id_cuenta_corriente'] = $cuenta_datos['id'];
			 					$datos_pp['id_venta'] = $datos['id_venta'];
			 					//inserto el plan de pago
			 					$id_plan_pago = $this->ccorriente->insertPlanPago($datos_pp);
			 					$cantidad_cuotas=$this->input->post("cantidad-pagos");
			 					//inserto los detalles de plan de pago 
			 					$datos_dp['monto']=$this->input->post("monto-cuota");
			 					$datos_dp['fecha_vencimiento']=date('Y-m-d');
			 					$datos_dp['plan_pago_id'] = $id_plan_pago;
			 					
			 					$dias_s=0;
			 					$mes_s=0;
			 					for ($i=1; $i <=$cantidad_cuotas  ; $i++)
			 					{

			 						switch($datos_pp['tipo'])
			 						{
			 							case 3:
			 							$dias=0;
			 							$mes=1;
			 							break;
			 							case 2:
			 							$dias=15;
			 							$mes=0;
			 							break;
			 							case 1:
			 							$dias=7;
			 							$mes=0;
			 							break;
			 						}
			 						$this->ccorriente->insertLineaPlanPago($datos_dp);	
			 						///calculo la siguiente fecha de vencimiento.
			 						$dias_s+=$dias;
			 						$mes_s+=$mes;
			 						$fecha = mktime(0,0,0,date('m')+$mes_s,date('d')+$dias_s, date('y'));
			 						$datos_dp['fecha_vencimiento']=date('Y-m-d',$fecha);

			 					}
			 					

						 			$variables['mensaje'] = "Plan de pago y Venta guardados con exito";			
			 				}
			 				else
			 					$variables['error']="No tiene conexion con la db comunique al Administrador";

			 			
			 			$this->index($variables);

			 		}
			 		else
			 		$variables['error'] = "no tiene permisos para realizar la accion";
			 }
			 else
			 	header('location:'.site_url());
		}


		public function mostrar_stock()
		{
			$talle=$this->input->post("talle");
			$producto_id = $this->input->post("producto_id");
			$this->load->model('venta','venta',TRUE);
			$cantidad = $this->venta->getCantidadById($producto_id,$talle);
			echo $cantidad;
		}

		public function eliminar()
		{
			$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],20);
			 		if ($permisos['baja']==1)
			 		{
			 			$venta_id=$this->input->post('id');
			 			$this->load->model('venta','venta',TRUE);
			 			if($venta_id>0)
			 			{
			 				if($this->venta->delete($venta_id))
			 					echo '1';
			 				else
			 					echo 2;
			 			}
			 			else
			 				echo 3;

			 		}

				}
				else
					header('location:'.site_url());
		}

}
	
	/* End of file ventas.php */
	/* Location: ./application/controllers/ventas.php */
?>
