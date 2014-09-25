<?php 

	$carpeta="dashboard/";
	$this->load->view('cabecera');
	$this->load->view('home');
	$this->load->view($carpeta.'principal');
	$this->load->view('pie');
?>