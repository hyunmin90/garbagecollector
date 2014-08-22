	

<meta charset="utf-8" />
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class helper_model extends CI_Model
{

	
	function __construct()
	{
	  	parent::__construct();
	}	

	$openapi_db = $this->load->database('openapi', true);

	function get_board_id_helper($boardname)
	{
		$row=$openapi_db->query("SELECT * from member_boards where name="."'".$boardname."'""")->row(0);
		return $row->id;
	}
	function userid_to_id_helper($userid)
	{

		$row=$this->openapi_db->query("SELECT * from member_members where userid="."'".$userid."'"."")->row(0);
	
		return $row->id;
	}

	function get_board_name_helper($boardid)
	{
		$row=$this->openapi_db->query("SELECT * from member_boards where id="."'".$boardid."'""")->row(0);
		return $row->name;

	}

	function nickname_to_id_helper($nickname)
	{
		$row=$this->openapi_db->query("SELECT * from member_members where nickname="."'".$nickname."'"."")->row(0);
		return $row->id;
	}

	function count_frequency_helper($userid,$table) //특정 테이블의 유저가 활동한 빈번도 확인 헬퍼 
	{
		$row= $this->openapi_db->query("SELECT count(*) as count, userid from ".$table." where userid="."'".$userid."'"." group by userid order by count desc")->row(0);
		return $row->count;
	}

	function has_granted_helper($member_id,$badge) //지금 부여하려는 벳지가 유저가 보유하고 있는지 확인한다
	{
		$query=$this->openapi_db->query("SELECT member_id from member_badge_grant where member_id="."'".$member_id."'"." and badge_id="."'".$badge."'"." ");
		return $query->num_rows();		
	}


	function badge_grant_helper($badgeNumber,$userid) //뱃지 부여 통합 헬퍼 함수 
	{
		$getbadgedate = date("Y-m-d H:i:s");
		$this->openapi_db->query("INSERT INTO member_badge_grant(badge_id,grantdate,member_id) VALUES("."'".$badgeNumber."'".","."'".$getbadgedate."'".","."'".$userid."'".")");
	}


	function id_to_userid_helper($id)
	{
		$row= $this->openapi_db->query("SELECT userid from member_members where id="."'".$id."'"."")->row(0);
		return $row->userid;
	}


}

	?>