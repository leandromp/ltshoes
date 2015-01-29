<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Talles extends CI_Controller {

	public function index()
	{
		
	}

	public function eliminar()
	{
		$id=$this->input->post("id");
		$this->load->model("talle","talle",true);
		if ($this->talle->deleteTalle($id))
			echo 1;
		else
			echo 2;
	}

}

/* End of file talle.php */
/* Location: ./application/controllers/talle.php */

?>