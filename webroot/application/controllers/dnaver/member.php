<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class member extends REST_Controller
{
  function __construct()
  {       
      parent::__construct();

      $this->load->view('/dnaver/head');
      $this->load->view('/dnaver/footer');
      $this->openapi_db = $this->load->database('openapi',true);
      $this->load->model('dnaver/member_model'); 
  }
  /*
  //TODO
  //api사용과 이벤트 참여한 사람을 회원으로 삽입한다.
  function insert_get()
  {
    if(!$this->get('joinpath'))
      $this->response(NULL, 400);

    $joinpath=$this->get('joinpath');

    if(!strcmp($joinpath,'openapi')) $this->member_model->insert_openapi();
    else if(!strcmp($joinpath,'event')) $this->member_model->insert_event();
    else $this->response(NULL, 400);
  }*/

  //TODO
  //dna 카페에 가입되어 있는 사람을 회원으로 삽입한다.
  function insert_from_DNA_get()
  {
     $this->member_model->insert_from_DNA();
  }

  //TODO
  //모든 회원의 리스트를 가져온다 
  function show_member_get()
  {
    $data = $this->member_model->show_member()->result_array();
    $this->load->view('/dnaver/member_management_view',array('data'=>$data));
  }

  function calcul_point_grade_get()
  {
    $data = $this->member_model->calcul_point();
    $data = $this->member_model->calcul_grade();
  }

  function insert_from_api_get()
  {
    $this->member_model->insert_openapi();
  }

  function insert_from_event_get()
  {
    $this->member_model->insert_event();
  }
}