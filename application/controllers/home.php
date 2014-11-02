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
	 			$this->load->library('menu');
	 			$variables['menu'] = $this->menu->dame_menu();
	 			$this->load->view('dashboard/index',$variables);	
	 		}
	 		
	 	}
	 
	 }
	 
	 /* End of file home.php */
	 /* Location: ./application/controllers/home.php */ 
?>