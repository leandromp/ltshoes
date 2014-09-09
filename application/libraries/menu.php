<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Menu
	{
	  protected 	$ci;
	
		public function __construct()
		{
	        $this->ci =& get_instance();
	        
		}

		public function dame_menu()
		{
			$this->ci =& get_instance();
			$this->ci->load->model('menu_modelo','menu_modelo',true);
			$resultado = $this->ci->menu_modelo->dameMenu();
			return ($resultado);
		}
	
		
	
	}
	
	/* End of file menu.php */
	/* Location: ./application/libraries/menu.php */
	
?>