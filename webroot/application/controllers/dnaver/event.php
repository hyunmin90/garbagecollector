<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class event extends REST_Controller
{
  function __construct(){       
      parent::__construct();
  }

  function winnerinsert_get(){  

    /* view화면 로드하여 출력*/
    $this->load->view('/dnaver/head');
    $this->load->view('/dnaver/footer');
    $this->load->view('/dnaver/prize_view');

  } 

  function eventinsert_get(){  

    /* view화면 로드하여 출력*/
    $this->load->view('/dnaver/head');
    $this->load->view('/dnaver/footer');
    $this->load->view('/dnaver/event_view');

  }   

  function winnerinsert_to_db_get(){  

    /* Get방식으로 전송된 입력값 변수에 저장 */
    $email=$this->get('email');
    $name=$this->get('name');
    $prize=$this->get('prize');

    $this->load->model('/dnaver/event_model');
    $this->event_model->winnerinsert_to_db($email,$name,$prize);

  }  

  function eventinsert_to_db_get(){  

    /* Get방식으로 전송된 입력값 변수에 저장 */
    $id=$this->get('id');
    $name=$this->get('name');
    $type=$this->get('type');
    $eventdate=$this->get('eventdate');
    $url=$this->get('url');

    $this->load->model('/dnaver/event_model');
    $this->event_model->eventinsert_to_db($id,$name,$type,$eventdate,$url);

  } 


}

