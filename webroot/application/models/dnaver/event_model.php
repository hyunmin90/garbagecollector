<meta charset="utf-8" />
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class event_model extends CI_Model {

	function winnerinsert_to_db($email,$name,$prize)
	{
		/* DB호출 */
    	$this->openapi_db = $this->load->database('openapi',true);

    	/* 수상자 추가 쿼리 */
    	$userid = $this->openapi_db->query("SELECT userid
    					 FROM member_members
    					 WHERE member_members.email ="."'".$email."'")->result();

    	$registerdate = $this->dopenapi_db->query("SELECT registerdate
    						FROM member_events_join
    						WHERE name ="."'".$name."'"."
    						AND userid ="."'".$userid[0]->userid."'"."
    						ORDER BY registerdate DESC LIMIT 0,1")->result();

    	$this->openapi_db->query("UPDATE member_events_join
							      SET prize = "."'".$prize."'"."
							      WHERE userid = "."'".$userid[0]->userid."'"."
							      AND registerdate = "."'".$registerdate[0]->registerdate."'");
  	}

  	function eventinsert_to_db($id,$name,$type,$eventdate,$url)
	{
		/* DB호출 */
    	$this->openapi_db = $this->load->database('openapi');

    	/* 행사 추가 쿼리 */
    	$this->db->query("INSERT INTO member_events (id, name, type, eventdate, url)
              VALUES ("."'".$id."'".","."'".$name."'".","."'".$type."'".","."'".$eventdate."'".","."'".$url."')");
  	}

}

/* End of file event_model.php */
/* Location: ./system/application/models/dnaver/event_model.php */