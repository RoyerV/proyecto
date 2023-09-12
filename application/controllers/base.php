<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	
	public function index()
	{
		$this->load->view('inicio');
	}
    public function res()
	{
		$this->load->view('resumen');
	}
    public function obj()
	{
		$this->load->view('objetivos');
	}

	public function pruebabd()
	{
		$query=$this->db->get('clientes');
		$execonsulta=$query->result();
		print_r($execonsulta);
	}
}