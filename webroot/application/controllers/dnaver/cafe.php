<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class cafe extends REST_Controller
{
  function __construct(){       
      parent::__construct();
      $this->load->view('/dnaver/head');
      $this->load->view('/dnaver/footer');
  }

/* 개발자 카페 확인하여 게시판 목록과 정보 갖고오기 */

  function cafepost_get_boardlist_get(){    

      $this->load->model('/dnaver/cafe_model');
      $this->cafe_model->cafepost_get_boardlist();
  }
  
/* 게시판 목록 view에 표시하기 */

  function cafepost_boardlist_get()
  {
     $this->load->model('/dnaver/cafe_model');
     $data = $this->cafe_model->get_boaridlist()->result_array();
     $this->load->view('/dnaver/cafe_view',array('data'=>$data) );
  } 


/* 설정된 게시판 weight값 적용하기 */

  function change_weight_get(){    
    $weight = 1;
    $index = 1;

    while($weight!=NULL)
    {
      $weight = $this->get('weight'.$index);
      $this->load->model('/dnaver/cafe_model');
      $this->cafe_model->change_weight($weight, $index);
      $index++;
    }
  }

/* 새로운 게시글 DB에 넣기 */

  function cafe_get_articlelist_get()
  {

    $this->load->model('/dnaver/cafe_model');
    $this->cafe_model->get_articles_manypage();
    
    //$this->load->view('/dnaver/cafe_articles_view',array('data'=>$data));
  } 

}

