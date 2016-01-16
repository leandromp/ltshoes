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

		public function diasDiferencia($fecha_mayor, $fecha_menor)
		{
			if ($this->validaFecha($fecha_mayor) and $this->validaFecha($fecha_menor))
			{
				$dia_mayor = substr($fecha_mayor, 0, 2);
				$mes_mayor = substr($fecha_mayor, 3, 2);
				$anio_mayor = substr($fecha_mayor, 6, 4);

				$dia_menor = substr($fecha_menor, 0, 2);
				$mes_menor = substr($fecha_menor, 3, 2);
				$anio_menor = substr($fecha_menor, 6, 4);

				$segundos_mayor = mktime(0,0,0,$mes_mayor,$dia_mayor,$anio_mayor);
				$segundos_menor = mktime(0,0,0,$mes_menor,$dia_menor,$anio_menor);

				$diferencia_segundos = $segundos_mayor - $segundos_menor;
				if ($diferencia_segundos < 0)
				{
					$diferencia_segundos = $diferencia_segundos * (-1);
					return 0;
				}
				elseif($diferencia_segundos > 0)
				{
					$diferencia_dias = $diferencia_segundos / (60 * 60 * 24);
					return round($diferencia_dias);
				}
				else
					return 0;
			}
			else
				return 0;
		}

		public function validaFecha($date,$separador="/")
		{
			$day = substr($date, 0, 2);
			$mes = substr($date, 3, 2);
			$anio = substr($date, 6, 4);
			if (strlen($date) == 10)
			{
				if ($day <= 31)
				{
					if ($mes == "01" or $mes == "03" or $mes == "05" or $mes == "07" or $mes == "08" or $mes == "10" or $mes == "12")
					{
						return true;
					}
					else
					{
						if (($mes == "04" or $mes == "06" or $mes == "09" or $mes == "11") and $day <= "30")
						{
							return true;
						}
						else
						{
							if ($mes == "02")
							{
								if (fmod($anio,4) == 0 and $day <= 29)
									return true;
								else
									if ($day <= 28)
										return true;
									else
										return false;
							}
							else
								return false;
						}
					}
				}
				else
					return false;
			}
			else
				return false;
		}

	}
?>