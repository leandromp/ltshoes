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

	public function pdf()
	{
		$this->load->library('Pdf');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
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
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
';

			// Print text using writeHTMLCell()
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