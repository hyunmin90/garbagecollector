<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {

  	function __construct()
  	{       
     	parent::__construct();
      	     $this->load->view('/dnaver/head');
      	     $this->load->view('/dnaver/footer');
  	}

	function index()
	{
		$this->load->view('/dnaver/index');
	}
}
?>
