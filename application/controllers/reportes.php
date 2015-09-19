<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Reportes extends CI_Controller {
		
			public function index($variables="")
			{
				$user=$this->session->userdata("ltshoes");
				if ($user['usuario_id']>0)
				{
					$this->load->model("empleado","empleado",true);
					$permisos=$this->empleado->getPermisos($user['usuario_id'],31);
					$this->load->library('menu');
			 		$variables['menu'] = $this->menu->dame_menu();
			 		if ($permisos['consulta']==1)
			 		{
			 			$variables['nombre_pagina'] = $this->uri->segment(1);
				 		$this->load->model("cliente","cliente",true);
				 		$variables['clientes']=$this->cliente->getClientes();
				 		$this->load->view('reportes/index',$variables);
			 		}
			 		//else
			 			//header('location:'.site_url());
			 		
				}	
			}

			public function ver_reporte()
			{
				$fecha_desde = $this->input->post("desde");
				$fecha_hasta = $this->input->post("hasta");
				$id_reporte = $this->input->post("id_reporte");
				$this->load->model("reporte","reporte",TRUE);
				if($fecha_desde=="" and $fecha_hasta=="")
				{
					$fecha_hasta=date("Y-m-d");
					$temp=strtotime('-7 days', strtotime($fecha_hasta));
					$fecha_desde=date("Y-m-d",$temp);
					
				}
			}

			public function mostrar_reporte()
			{
				$desde = $this->input->post("desde");
				$hasta = $this->input->post("hasta");
				$id_tabla = $this->input->post("id_tabla");
				if($id_tabla>0)
				{
					if($desde<$hasta)
					{
						$this->load->model("reporte","reporte",TRUE);
						if($id_tabla==1)
							$variables['reporte'] = $this->reporte->getVentasFechas($desde,$hasta);
						else
							$variables['reporte'] = $this->reporte->getPagosFechas($desde,$hasta);
						$this->load->view('dashboard/reporte-detalle',$variables);
					}
					else
						echo 3;//la fecha desde es mayo r que la fecha hasta
				}	
				else
				 echo 2;//no selecciono ningun tipo de reporte

			}

			public function ver_moras()
			{
				$fecha = date('Y-m-d');
				$this->load->model("reporte","reporte",TRUE);
				$variables['reporte'] = $this->reporte->getMora($fecha);
				$this->load->view("dashboard/mora-detalle",$variables);
			}


	public function ver_reporte_outlet()
	{
		$this->load->model('reporte','reporte',TRUE);
		$resultado = $this->reporte->getProductosOutlet();
		$html= '<style>';
		$html.='table{border: 1px solid #000; width:400px; font-size:10px}
				tr td th {width:105px;border: 1px solid #000;}
				.productos > td{border-bottom:1px solid #e6e6e6;}';
		$html.='</style>';
		$html.='<table>';
		if($resultado)
			{

				$html.='<table>';
				$html.='<tr> <th> Descripcion </th> <th> Talle </th> <th> Precio </th> <th> Cantidad </th>  <th> Temporada </th></tr>';
				foreach ($resultado as $key => $value) 
				{
					if($value['temporada']==1)
						$temporada='PRIMAVERA/VERANO';
					else
						$temporada=	'OTOÑO/INVIERNO';
					$html.='<tr class="productos"> <td> '.$value['descripcion'].'</td><td>'.$value['talle'].'</td> <td>'.$value['precio_outlet'].'</td> <td>'.$value['cantidad'].'</td> <td>'.$temporada.'</td> </tr>';
				
				}
					$html.='</table>';
			}
		else
			$html = 'No existe ningun producto en la lista de outlet';
		//echo $html;
		$this->_pdf($html);
	}

	public function imprimir_comprobante_pago($id_venta)
	{
		$this->load->model('venta','venta',true);
		$detalle_venta=$this->venta->getDetalleVentaById($id_venta);
		$detalle_pagos=$this->venta->getDetallePagosById($id_venta);
		$html= '<style>';
		$html.='table {border: 1px solid #000; width:400px; font-size:10px}
				tr td{width:105px;}
				.pago{border:1px solid #000; width:100px;}
				.detalle_titulo > td{width:630px; margin:15px; background-color:#e1e1e1;}
				.productos > td{border:1px solid #000; width:157px;}';
		$html.='</style>';
		$html.='<table>';
		//$html.='<tr> <td> Datos del Cliente </td> </tr>';
		$html.='<tr>';
			$html.='<td> Nombre :</td> <td> '.$detalle_venta[0]["nombre"].','.$detalle_venta[0]["apellido"].' </td>';
			$html.='<td> Direccion :</td> <td> '.$detalle_venta[0]["direccion"].' </td>';
			$html.='<td> Telefono :</td> <td> '.$detalle_venta[0]["telefono"].' </td>';
		$html.="</tr><tr>";
			$html.='<td> Direccion Laboral :</td> <td> '.$detalle_venta[0]["direccion_laboral"].' </td>';
			$html.='<td> Telefono Laboral :</td> <td> '.$detalle_venta[0]["telefono_laboral"].' </td>';
		$html.="</tr>";
		$html.='<tr class="detalle_titulo"><td> Detalle de la Compra </td></tr>';
		$html.='<tr class="productos"> <td> Descripcion </td><td> Precio </td> <td> Cantidad </td> <td> Subtotal </td> </tr>';
		foreach ($detalle_venta as $key => $value) 
		{
			$html.='<tr class="productos">';
			$html.='<td> '.$value['descripcion'].'</td>';
			$html.='<td> '.$value['precio'].'</td>';
			$html.='<td> '.$value['cantidad'].'</td>';
			$html.='<td> '.$value['cantidad']*$value['precio'].'</td>';
			$html.='</tr>';
		}
		$html.='<tr class="detalle_titulo"><td> Detalle de los pagos </td></tr>';
		$html.='<tr>';
		$i=0;
		foreach ($detalle_pagos as $p => $dp) {
			$i++;
			if($i<=6)
			{
			$html.='<td class="pago"> Monto:<br><b>'.$dp['monto'].'</b><br>';
			$html.='Fecha de pago:<br>'.$dp['fecha_vencimiento'].'<br>';
			$html.='Firma:................ </td>';
			}
			else
			{
				$i=0;
				$html.='</tr><tr>';
			}
			
			
		}
		$html.='</tr>';
		$html.='</table>';
		//echo $html;
		$this->_pdf($html);
	}	

	public function _pdf($html)
	{
		ini_set('memory_limit', '128M');
		$this->load->library('Pdf');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Leandro Perez');
		$pdf->SetTitle('Reporte Titulo');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData('',0, 'Reporte', 'Lt Shoes', array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// set text shadow effect
		//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		// Set some content to print

			// Print text using writeHTMLCell()
			//	writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('example_001.pdf', 'I');

			//============================================================+
			// END OF FILE
			//==========================================================
	}

}
		
		/* End of file reportes.php */
		/* Location: ./application/controllers/reportes.php */	
?>