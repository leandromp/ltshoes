<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
	 class Home extends CI_Controller {
	 
	 	public function index()
	 	{
			$this->load->view('login');
	 	}

	 	public function dashboard()
	 	{
	 		$this->load->library('menu');
	 		$variables['menu'] = $this->menu->dame_menu();
	 		$this->load->view('dashboard/index',$variables);
	 	}
	 
	 }
	 
	 /* End of file home.php */
	 /* Location: ./application/controllers/home.php */ 
?>