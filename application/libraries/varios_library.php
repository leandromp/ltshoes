<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Varios_library 
	{
		protected $ci;

		public function __construct()
		{
	        $this->ci =& get_instance();
		}

		public function rotar_fecha($fecha)
		{
			if ($fecha)
			{
				$temp = explode('-', $fecha);
				$fecha_rotada = $temp[2].'/'.$temp[1].'/'.$temp[0];
				return $fecha_rotada;		
			}
			else
				return '';
			
		}
	}
?>