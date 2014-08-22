<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class badge_model extends CI_Model {

	function __construct(){
  	  parent::__construct();
    }



    /*    DESCRIPTION
	    Function_Name: model_load_model()
	    Functionality: 다른 모델을 로드해서 현 모델에서 사용가능하게 해주는 기능 
	    Variable: $Model_name 모델이름을 변수로 받아 로드해준다 	
	    Output: 호출한 함수에서 요구한 모델을 사용가능하게 아웃풋 해준다 
	    Return Value: 임시 배열에 모델을 저장한다 

    */
    function model_load_model($model_name)
   	{
	      $CI =& get_instance();
	      $CI->load->model($model_name);
	      $temp = split("/",$model_name);
	      return $CI->$temp[1];
   	}

      /*    DESCRIPTION
	    Function_Name: get_badgelist()
	    Functionality: 벳지의 리스트를 받아온다  
	    Variable: NONE	
	    Output: 벳지의 리스트를 받아 아웃풋 해준다  
	    Return Value: 리스트 값을 배열로 리턴해준다  
     */
	function get_badgelist()
	{
		return $this->openapi_db->query("SELECT id, name, getprocess, description, status, scarcity FROM member_badges");
	}

      /*    DESCRIPTION
	    Function_Name: insert_badge()
	    Functionality: 새로운 벳지를 DB에 입력해준다   
	    Variable: $name=이름, $description=벳지 용도 설명,$getprocess=받은 경로  	
	    Output: 디비에 새로운 벳지 정보를 입력하고 성공여부 판단 
	    Return Value: NONE
     */	

	function insert_badge($name,$description,$getprocess)
	{
		$Query = "INSERT INTO member_badges(name, description, getprocess)
              			  VALUES(?,?,?)";

	       	$array = array($name,$description,$getprocess);
	    	$this->openapi_db->query($Query,$array);

  	}
	
      /*    DESCRIPTION
	    Function_Name: grant_badge()
	    Functionality: member_members에 저장된 사용자 정보를 이용하여 
	    사용자에게 벳지를 부여한다. 부여한 벳지정보를 통하여 추후 포인트 및 
	    사용자 중요도 판단을 가능하게 해준다   
	    Variable: NONE	
	    Output: 하위 헬퍼 함수들을 사용하여 벳지를 부여 한다 
	    Return Value:  NONE   
     */

	function grant_badge()
	{

		$badgelist = $this->get_badgelist()->result();

		foreach($badgelist as $b)
		{	
			
			switch ($b->name) {
					
				//TODO
				//DNA 카페에 가압된 사람에게 수여한다. 배지코드 - cj1
				case 'cj1':

					$this->grant_badge_based_cafe();
					break;

				//TODO
				//API를 기준 이상 발급 받은 사람에게 수여한다 .배지코드 - a1, a3, a5
				//한번만 부르면, a1,a3,a5 발급 가능 
				case 'a1' :
					$this->grant_badge_based_api();
					break;			


				//TODO
				//질문 게시판에 글을 50번 이상 게시한 사람에게 수여한다. 배지코드 - qna50
				case (preg_match('/^qna/', $b->getprocess) ? true : false) :
					$this->grant_badge_based_cafe_boardType("KErw",50,$b->id);
					break;


				//TODO
				//게시판을 통틀어 총 글을 기준 이상 작성한 사람에게 수여한다. 배지코드 - bw5, bw30
				case (preg_match('/^bw/', $b->getprocess) ? true : false) :
					$this->grant_badge_based_cafe_boardType(0,str_replace('bw','',$b->getprocess),$b->id);
					break;

				//TODO
				//카페를 기준 이상 방문한 사람에게 수여한다. (한줄 메모장에 남긴 글의 갯수로 확인) 배지코드 - vc3, vc30, vc50
				case (preg_match('/^vc/', $b->getprocess) ? true : false) :
					$this->grant_badge_based_cafe_boardType("_memo",str_replace('vc','',$b->getprocess),$b->id);
					break;
				
				//TODO
				//이벤트에 참가하여서 수상 경렬 횟수로 배지를 부여한다. 배지코드 - ew1
				case (preg_match('/^ew/', $b->getprocess) ? true : false) :
					$this->grant_badge_based_event("prize");
					break;

				//TODO
				//이벤트에 참가한 횟수로 배지를 부여한다. 배지코드 - ep3, ep5
				case 'ep3':
					$this->grant_badge_based_event("none");

//					break;

				default:
					# code...
					break;
			}
			

		}
	}


      /*    DESCRIPTION
	    Function_Name: grant_badge_based_api()
	    Functionality: 전날 기준 API 사용 횟수를 사용하여 
	    벳지를 부여해주는 함수이다. 
	    Variable: NONE	
	    Output: API 사용률을 판단하여 벳지를 DB 에 입력후 성공 여부를 알려준다    
	    Return Value: NONE  
     */

function grant_badge_based_api() //api 기준 벳지 부여 함수 
{
	
	$getbadgedate = date("Y-m-d H:i:s");
	
	$temp= $this->openapi_db->query("SELECT id from member_members as k natural join (SELECT distinct userid, count(*)  as count  FROM api_key  WHERE issuedate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() group by userid) as t  ")->result();
	foreach($temp as $b)
	{
		
		$userid=$this->id_to_userid($b->id);
	
		$count=$this->count_frequency_helper($userid, "api_key");	

		
		if($count>=1)
			if($this->has_granted_helper($b->id,2)==0)
				$this->badge_grant_helper(2,$b->id);
			
		if($count>=3)
			if($this->has_granted_helper($b->id,3)==0)
				$this->badge_grant_helper(3,$b->id);
		if($count>=5)
			if($this->has_granted_helper($b->id,4)==0)
				$this->badge_grant_helper(4,$b->id);
		



	}	
}

      /*    DESCRIPTION
	    Function_Name: grant_badge_based_cafe()
	    Functionality: 카페를 가입하면 벳지를 부여한다  
	    Variable: NONE	
	    Output: 카페 가입 여부를 확인하여 벳지를 부여한 후 성공여부 판단     
	    Return Value: NONE  
     */

function grant_badge_based_cafe() //카페 가입시 벳지 부여 함수  
{
	$getbadgedate = date("Y-m-d H:i:s");
	$temp = $this->openapi_db->query("SELECT distinct *  FROM member_members WHERE cafejoin=1 and createdate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() ")->result();
	foreach($temp as $b)
	{	

		$id=$b->id;
	
		if($this->has_granted_helper($id,1)==0)
		{	$this->badge_grant_helper(1,$id);}
		
	}	

}

      /*    DESCRIPTION
	    Function_Name: grant_badge_based_cafe_boardType()
	    Functionality: 게시판 종류와 조건에 따라서 벳지를 부여하는 함수   
	    Variable: $boardid=보드 식별 아이디, $Number=벳지부여 조건,
	    $BadgeNumber=부여할 벳지 식별 숫자 	
	    Output: 카페 조건을 충족 할 시에 벳지를 부여한다.     
	    Return Value: NONE  
     */

function grant_badge_based_cafe_boardType($boardid,$Number,$badgeNumber) //카페의 게시판 기반 벳지 부여 함수 
{
	$getbadgedate = date("Y-m-d H:i:s");

	if($boardid==0)
	{
		$temp=$this->openapi_db->query("SELECT member_id,writedate FROM openapi.member_board_activity where  type='board' and writedate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() group by member_id ")->result();
	}
	else
	{
		$temp=$this->openapi_db->query("SELECT member_id,writedate FROM openapi.member_board_activity where  boardid="."'".$boardid."'"." and writedate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() group by userid ")->result();
	}

	foreach($temp as $b)
	{
		
		$userid=$this->id_to_userid($b->id);
		$count=$this->count_frequency_helper($userid, "member_board_activity");

		if($this->has_granted_helper($b->member_id,$badgeNumber)==0)
		{
	
				if($count>=$Number)
					$this->badge_grant_helper($badgeNumber,$b->member_id);


		}

	}


}

      /*    DESCRIPTION
	    Function_Name: grant_badge_based_event()
	    Functionality: 이벤트에 따라서 벳지를 부여하는 함수    
	    Variable: $type=이벤트 부여시 참여 기반인지 상 기반인지 확인해 주는 변수 
	    i.e) Prize= 상을 받았을시 부여하는 벳지 	
	    Output: 이벤트 참여 여부로 벳지 부여 후 성공여부 판단 
	    Return Value: NONE  
     */


function grant_badge_based_event($type) //이벤트 기반 함수
{
	$getbadgedate = date("Y-m-d H:i:s");

	if($type=="prize")
		$temp=$this->openapi_db->query("SELECT member_id from member_event_join where prize IS NOT NULL and joindate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() group by member_id  ")->result();

	else
		$temp=$this->openapi_db->query("SELECT member_id from member_event_join where joindate BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 day) AND CURDATE() group by member_id  ")->result();
	
	foreach($temp as $b)
	{
		if($type=="prize")	
		{		
			if(has_granted_helper($b->member_id,11)==0)
			{	
				$this->badge_grant_helper(11,$b->member_id);
		
			}
		} 

		else
		{
			$userid=$this->id_to_userid($b->id);		
			$count=$this->count_frequency_helper($userid, "member_event_join");
			
			
			if(has_granted_helper($b->id,12)==false)
			{
					if($count>=3)
						$this->badge_grant_helper(12,$b->userid);
			}
			if(has_granted_helper($b->id,13)==false)
			{
					if($count>=5)
						$this->badge_grant_helper(13,$b->userid);
		
			}




		}
	}


}

      /*    DESCRIPTION
	    Function_Name: count_frequency_helper()
	    Functionality: 특정 유저가 특정 테이블에서 몇번이나 빈번도가 
	    나타나는지 확인해주는 함수     
	    Variable: $userid=유저 식별 아이디 $Table=확인할 DB 테이블  	 	
	    Output: 빈도 확인 결과값 
	    Return Value: 몇번이나 특정 유저가 테이블에 나타나는지 확인 후 그 수를 반환   
     */

function count_frequency_helper($userid,$table) //특정 테이블의 유저가 활동한 빈번도 확인 헬퍼 
{
	$row= $this->openapi_db->query("SELECT count(*) as count, userid from ".$table." where userid="."'".$userid."'"." group by userid order by count desc")->row(0);
	return $row->count;
}


      /*    DESCRIPTION
	    Function_Name: has_granted_helper()
	    Functionality: 특정 유저가 특정 벳지를 부여받았는지 확인해주는 함수  
	    Variable: $member_id=유저 식별 아이디 $badge=벳지 식별 아이디   	 	
	    Output: 특정 벳지 부여 여부  
	    Return Value: 벳지가 부여 되었는지 확인후 결과값 반환    
     */
function has_granted_helper($member_id,$badge) //지금 부여하려는 벳지가 유저가 보유하고 있는지 확인한다
{

	$query=$this->openapi_db->query("SELECT member_id from member_badge_grant where member_id="."'".$member_id."'"." and badge_id="."'".$badge."'"." ");
	return $query->num_rows();
	
}

    /*    DESCRIPTION
	    Function_Name: badge_grant_helper()
	    Functionality: 특정 유저에게 특정 벳지를 부여  
	    Variable: $badgeNumber=벳지 식별 아이디 $userid=유저 식별 아이디   	 	
	    Output: 특정 벳지 부여후 성공여부 확인
	    Return Value: NONE    
     */
function badge_grant_helper($badgeNumber,$userid) //뱃지 부여 통합 헬퍼 함수 
{
	$getbadgedate = date("Y-m-d H:i:s");
	$this->openapi_db->query("INSERT INTO member_badge_grant(badge_id,grantdate,member_id) VALUES("."'".$badgeNumber."'".","."'".$getbadgedate."'".","."'".$userid."'".")");
}


    /*    DESCRIPTION
	    Function_Name: userid_to_id()
	    Functionality: 글자로된  유저 아이디를 유저 고유 번호로 변환해주는 함수   
	    Variable:  $userid=글자로된  유저 식별 아이디   	 	
	    Output: 유저 고유 번호 확인 성공여부 반환  
	    Return Value: 유저 고유 번호 반환    
     */
function userid_to_id($userid)
{

		$row=$this->openapi_db->query("SELECT * from member_members where userid="."'".$userid."'"."")->row(0);
	
		return $row->id;

}

    /*    DESCRIPTION
	    Function_Name: id_to_userid()
	    Functionality:  id 를 받아서 유저의 글자로 된 고유 아이디를 반환 해주는 함수    
	    Variable:  $id = 유저 고유식별 번호    	 	
	    Output: 유저의 고유 식별  번호 확인 및 성공여부 출력  
	    Return Value: 유저 고유 번호 반환    
     */
function id_to_userid($id)
{
	$row= $this->openapi_db->query("SELECT userid from member_members where id="."'".$id."'"."")->row(0);
	return $row->userid;
}




      /*    DESCRIPTION
	    Function_Name: show_member_badge()
	    Functionality:    회원 중 배지를 받은 사람의 리스트를 가져온다.    
	    Variable: NONE	 	
	    Output: 유저중 뱃지를 부여받은 사람의 리스트를 출력   
	    Return Value: 뱃지 부여받은 유저의 리스트를 배열로 반환     
     */
  function show_member_badge(){
      return $this->openapi_db->query("SELECT * 
                                       FROM member_members JOIN member_badge_grant AS m ON (member_members.id = m.member_id) JOIN member_badges ON (m.badge_id = member_badges.id)
                                       ORDER BY m.member_id DESC"
      );
  }

      /*    DESCRIPTION
	    Function_Name: calcul_badge_scarcity()
	    Functionality:    배지의 희소성을 계산한다. (배지를 수여받은 사람 수 / 전체 사람 수)*100 로 계산한다.
	    Variable: NONE	 	
	    Output: 뱃지의 희소성을 판단 후 DB에 출력    
	    Return Value: NONE
     */

  function calcul_badge_scarcity()
  {
  	$totalMemberObj = $this->model_load_model("dnaver/member_model")->total_member()->result();
  	$totalMember = $totalMemberObj[0]->cnt;

  	$badgelist = $this->get_badgelist()->result();

  	foreach ($badgelist as $b)
  	{
  		$Query = "UPDATE member_badges 
  	 		  SET scarcity = (SELECT round( count(badge_id)/? * 100 ,2) FROM member_badge_grant WHERE badge_id = ?),
			  used = (SELECT if(count(badge_id)=0,0,1) FROM member_badge_grant WHERE badge_id = ?)
			  WHERE id = ?";

		$Array = array($totalMember,$b->id,$b->id,$b->id);
  		$this->openapi_db->query($Query,$Array);
  	}
  }
}

/* End of file badge_model.php */
/* Location: ./system/application/models/dnaver/badge_model.php */