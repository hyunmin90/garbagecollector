<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

//TODO call grant badge model
class badge extends REST_Controller
{
   function __construct(){       
      parent::__construct();
      $this->load->view('/dnaver/head');
      $this->load->view('/dnaver/footer');
      $this->openapi_db = $this->load->database('openapi',true);
      $this->load->model('dnaver/badge_model'); 
  }

  //TODO
  //모든 배지에 대하여, 회원에 배지를 수여하는 작업을 진행한다.
  function grant_badge_get(){
    $this->badge_model->grant_badge();
  }

  //TODO
  //배지를 수여받은 회원들의 리스트를 출력한다.
  function show_member_badges_get()
  {
    $data = $this->badge_model->show_member_badges()->result_array();
    $this->load->view('/dnaver/badge_view',array('data'=>$data) );
  }

  function grant_badge_based_api_get()
  {
   $this->badge_model->grant_badge_based_api();
    $this->load->view('/dnaver/badge_test' );



  } 


  //TODO
  //배지 종류에 대한 리스트를 출력한다.
  function show_badgelist_get()
  {
    $data = $this->badge_model->get_badgelist()->result_array();
    $this->load->view('/dnaver/badge_list_view',array('data'=>$data) );
  }

  //TODO
  //새로운 배지를 입력하는 뷰를 출력한다.
  function insert_badge_form_get()
  {
     $this->load->view('/dnaver/insert_badge_view');
  }

  //TODO
  //새로운 배지를 삽입한다.
  function insert_badge_get()
  {
    $badge = $this->get('badge');
    $description = $this->get('description');
    $getprocess = $this->get('getprocess');

    $this->badge_model->insert_badge($badge,$description,$getprocess);

    $affected_rows = $this->openapi_db->affected_rows();
    $error_message = $this->openapi_db->_error_message();

    echo("<script> alert('affected rows is $affected_rows, $badge')
                    window.location = 'http://l.developers.daum.net/dnaver/badge/insert_badge_form' </script>");
  }

  //TODO
  //모든 배지에 대한 희소성 값을 갱신한다.
  function calcul_badge_scarcity_get()
  {
     $this->badge_model->calcul_badge_scarcity();
  }
}

/* End of file badge.php */
/* Location: ./system/application/controllers/dnaver/badge.php */