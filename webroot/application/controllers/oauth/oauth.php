<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

//TODO call grant badge model
class oauth extends REST_Controller
{
   function __construct(){       
      parent::__construct();
      $this->load->view('/dnaver/head');
      $this->load->view('/dnaver/footer');
     
      $this->load->model('oauth/oauth_model'); 
  }

  function test_get()
  {
    $code=$this->get('code');
    $this->load->view('/oauth/test');
  }

  function test2_get()
  {
    $code=$this->get('code');
    echo("<script> alert('$code') </script>");
    $this->load->view('/oauth/test2',array('data'=>$code));
  }
}

/* End of file badge.php */
/* Location: ./system/application/controllers/oauth/oauth.php */