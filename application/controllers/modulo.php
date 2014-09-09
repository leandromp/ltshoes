<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Modulo extends CI_Controller {
	
		public function index()
		{
			$this->load->library('menu');
	 		$variables['menu'] = $this->menu->dame_menu();
	 		$variables['nombre_pagina'] = $this->uri->segment(1);
	 		$this->load->view('modulos/index',$variables);
		}
	
	}
	
	/* End of file modulo.php */
	/* Location: ./application/controllers/modulo.php */
?>