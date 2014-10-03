<?php
	$carpeta="carrito/";
	$this->load->view('cabecera');
	$this->load->view('home');
	if (!isset($vista))
		$this->load->view($carpeta.'principal');
	else
		$this->load->view($carpeta.$vista);
	$this->load->view('pie')
?>