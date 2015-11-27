<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genericos extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
	}

	public function update()
	{
		$campo = $this->input->post("campo");
		$valor = $this->input->post("valor");
		$id = $this->input->post("id");
		$tabla = $this->input->post("tabla");
		$this->load->model('generico','generico',true);
		if ($this->generico->update($campo,$valor,$id,$tabla))
			echo 1;
		else
			echo 2;
	}

}

/* End of file genericos.php */
/* Location: ./application/controllers/genericos.php */