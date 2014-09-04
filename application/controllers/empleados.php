<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empleados extends CI_Controller {
	
		public function index()
		{
			
		}

		public function login()
		{
			$datos['nombre']=$this->input->post("nombre");
			$datos['password']=$this->input->post("password");
			if ($datos['nombre']!="" AND $datos["password"]!="")
			{
				$resutlado=$this->load->model("empleado","empleado",true);
				if ($resutlado==false)
					echo 'los datos ingresados no son correctos intentelo nuevamente';
				else
					echo 'logeado correctamente';
			}
			else
				echo 'Debe ingresar ambos datos para poder identificarse';

		}
	
	}
	
	/* End of file empleados.php */
	/* Location: ./application/controllers/empleados.php */
?>