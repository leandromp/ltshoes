<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Cliente extends CI_Model {
		
			public function getClientes()
			{
				$query=$this->db->get("cliente");
				$resultado= $query->result_array();
				$cantidad= count($resultado);
				if ($cantidad>0)
					return $resultado;
				else
					return false;

			}


	
	}
	
	/* End of file cliente.php */
	/* Location: ./application/models/cliente.php */
?>