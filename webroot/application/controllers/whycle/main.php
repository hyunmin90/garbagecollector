<?php
class main extends CI_Controller {

	function index()
	{	
		$this->load->view('navbar');
		$this->load->view('index');
	}
	function listvm()
	{
		$this->load->view('navbar');
		$this->load->view('listvm');
	}
	function sbadmin()
	{
		$this->load->view('sbadmin');

	}
	function muttforum()
	{	
		$this->load->view('navbar');
		$this->load->view('muttforum');
	}
}
?>
