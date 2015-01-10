<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
	 class Home extends CI_Controller {
	 
	 	public function index()
	 	{
			$this->load->view('login');
	 	}

	 	public function dashboard()
	 	{
	 		$user = $this->session->userdata("ltshoes");
	 		if ($user['usuario_id']>0)
	 		{
	 			$hasta=date('Y-m-d');
	 			$desde = strtotime ( '-7 day' , strtotime ( $hasta ) ) ;
				$desde = date ( 'Y-m-j' , $desde );
				$hasta_anterior = strtotime ( '-1 day' , strtotime ( $desde ) ) ;
				$hasta_anterior = date ( 'Y-m-j' , $hasta_anterior );
				$desde_anterior = strtotime ( '-8 day' , strtotime ( $desde ) ) ;
				$desde_anterior = date ( 'Y-m-j' , $desde_anterior );

	 			$this->load->model("reporte","reporte",TRUE);
	 			$venta_semana=$this->reporte->getVentasFechasMonto($desde,$hasta);
	 			$venta_semana_anterior=$this->reporte->getVentasFechasMonto($desde_anterior,$hasta_anterior);
	 			$total = $venta_semana + $venta_semana_anterior;
	 			$variables['semana_po'] = ($venta_semana * 100) / $total;
	 			//  Metodos para calcular el porcentaje de cobranzas
	 			$cobros_semana=$this->reporte->getCobradoFechaMonto($desde,$hasta);
	 			$cobros_semana_anterior=$this->reporte->getCobradoFechaMonto($desde_anterior,$hasta_anterior);
	 			$total_cobro = $cobros_semana + $cobros_semana_anterior;
	 			$variables['cobro_po'] = ($cobros_semana * 100) / $total_cobro;
	 			/********************************************************/
	 			$variables['cantidad_clientes']=$this->reporte->getCantidad('cliente');
	 			$variables['cantidad_productos']=$this->reporte->getCantidad('producto');
	 			$this->load->library('menu');
	 			$variables['menu'] = $this->menu->dame_menu();
	 			$variables['reportes'] = "";
	 			$this->load->view('dashboard/index',$variables);	
	 		}
	 		
	 	}
	 
	 }
	 
	 /* End of file home.php */
	 /* Location: ./application/controllers/home.php */ 
?>