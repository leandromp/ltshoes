<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generico extends CI_Model {

	public function update($campo,$valor,$id,$tabla)
	{
		$sql= " UPDATE ".$tabla." SET ".$campo."='".$valor."' WHERE id=".$id;
		if($this->db->query($sql))
			return true;
		else
			return false;

	}

}

/* End of file generico.php */
/* Location: ./application/models/generico.php */