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
					 		$variables['clientes']=$this->cliente->getClienteId($id);
					 		$this->load->model("producto","producto",true);
					 		//cargo el listado de productos
				 			$variables['productos']=$this->producto->listado();
					 		$variables['vista']='carrito-inc';	
						}
						/*else
						{
							$variables['vista']="cliente-inc";
							$variables['mensaje']="no se selecciono ningun cliente";
						}*/

						

					}

					$this->index($variables);

			}

		}

		public function agregar_producto()
		{
			$id=$this->input->post("id");
			$cantidad = $this->input->post("cantidad");
			if($id>0)
			{
				if($cantidad>0)
					{
						$this->load->library("session");
						$this->load->model("producto","producto",true);
						$producto = $this->producto->getProductoId($id);
						$carrito = $this->session->userdata("carrito");
						if($carrito)
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
							$productos[]=$producto;
							
						}
						$carrito['productos']=$productos;//actualizo el carrito 
						$this->session->set_userdata('carrito',$carrito);

						print_r($carrito);
						echo 1;

					}
				else
					echo 2; //la cantidad no es mayor 0
			}
			else
			echo 3; // no selecciono ningun producto 

		}

	
	}
	
	/* End of file ventas.php */
	/* Location: ./application/controllers/ventas.php */
?>