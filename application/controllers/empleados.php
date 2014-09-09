<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empleados extends CI_Controller {
	
		public function index()
		{
			
		}

		public function login()
		{
			$nombre=$this->input->post("nombre");
			$password=$this->input->post("password");
			if ($nombre!="" AND $password!="")
			{
				$this->load->model("empleado","empleado",true);
				$resultado=$this->empleado->comprobarLogeo($nombre,$password);
				if ($resultado)
					{
						$sesion['nombre']=$resultado['nombre'];
						$sesion['apellido']=$resultado['apellido'];
						$sesion['usuario']=$resultado['usuario'];
						$sesion['correo']=$resultado['correo'];
						$sesion['ultimo_acceso']=date('Y-m-d h:m:s');
						$sesion['usuario_id']=$resultado['id'];
						$this->session->set_userdata('ltshoes',$sesion);
						header('location:'.site_url('/home/dashboard'));
					}
				else
					$variables['mensaje']="Los datos ingresados no son correctos, Intentelo nuevamente";
					
			}
			else
				$variables['mensaje']= 'Debe ingresar ambos datos para poder identificarse';

			$this->load->view('login',$variables);

		}

		
}
	
	/* End of file empleados.php */
	/* Location: ./application/controllers/empleados.php */
?>