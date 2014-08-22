<meta charset="utf-8" />
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cafe_model extends CI_Model {

	function __construct()
	{
  	  parent::__construct();
    	}



      /*    DESCRIPTION
	    Function_Name: cafepost_get_boardlist()
	    Functionality:    게시판 목록 중복처리하여 DB에 삽입.
	    Variable: NONE	 	
	    Output: 카페에 있는 게시판 종류를 디비에 출력     
	    Return Value: NONE
     */
	function cafepost_get_boardlist()
	{
		$openapi_db = $this->load->database('openapi', true);

	$ch = curl_init();
    	$url = "https://apis.daum.net/cafe/boards/daumdna.json";

      	curl_setopt($ch, CURLOPT_URL,$url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

      	$output = curl_exec($ch);
      	curl_close($ch);
      	$boardlistjson = json_decode($output);
		
		foreach($boardlistjson->board as $b)
		{									
			$query_boardid = "INSERT INTO member_boards (name)
							  SELECT * FROM (SELECT ? AS a) AS temp
							  WHERE NOT EXISTS ( SELECT 1 FROM member_boards AS m WHERE m.name= ? )";

			$values = array($b->boardId,
							$b->boardId);

			$openapi_db->query($query_boardid,$values);
		}
	}    
	

      /*    DESCRIPTION
	    Function_Name: get_boaridlist()
	    Functionality:    게시판 보드 종류를 디비에서 가져옴 .
	    Variable: NONE	 	
	    Output: NONE
	    Return Value: 멤버 보드에서 보드 종류를 가져옴 
     */
	function get_boaridlist()
	{
		$openapi_db = $this->load->database('openapi', true);
		return $openapi_db->query("SELECT id, weight, name FROM member_boards");
	}

      /*    DESCRIPTION
	    Function_Name: change_weight()
	    Functionality:    게시판 가중치 변경.
	    Variable:  $weight=게시판 가중치 $index=변경할 게시판 고유 번호 	 	
	    Output: 게시판 가중치 변경 성공 여부       
	    Return Value: NONE
     */
	function change_weight($weight, $index)
	{
    	$this->openapi_db = $this->load->database('openapi');

    	$openapi_db->query("UPDATE member_boards
    						SET weight="."'".$weight."'"."
              				WHERE id=".$index);
    	}

      /*    DESCRIPTION
	    Function_Name: get_articles_manypage()
	    Functionality:    새로운 글이 몇 페이지 까지 있는지 확인하여 해당 페이지를 전달하는 함수 
	    Variable: NONE	 	
	    Output:       
	    Return Value: NONE
     */
	function get_articles_manypage()
	{
		$openapi_db = $this->load->database('openapi', true);

		$boardidall = $openapi_db->query("SELECT id 
							FROM member_boards")->result();

		foreach ($boardidall as $bid) 
		{			
			$bidt = $bid->id;			
			$lastarticle = $openapi_db->query("SELECT id
							FROM member_board_activity
							WHERE board_id = '".$bidt."' 
							ORDER BY articleid DESC LIMIT 1")->result();	

			$pagenum = $this->get_articles_pagenum($bidt, $lastarticle[0]->id);

			for($pagenumber='1'; $pagenumber<=$pagenum; $pagenumber++)
			{
				$this->get_articles_onepage($bidt, $pagenumber, $lastarticle[0]->id);
			}						
		}				
	}
	
      /*    DESCRIPTION
	    Function_Name: get_articles_manypage()
	    Functionality:    새로운 글이 몇페이지까지 있는지 확인하는 함수.
	    Variable: $bidt=게시판 아이디 $lastarticle=마지막 게시글 	 	
	    Output:       
	    Return Value: NONE
     */
	function get_articles_pagenum($bidt, $lastarticle)
	{

		$openapi_db = $this->load->database('openapi', true);

		$pagenum = 1;

		$boardname=$this->get_board_name_helper($bidt);

		while(1)
		{

		$ch = curl_init();
	    	$url = "https://apis.daum.net/cafe/articles/daumdna/$boardname.json?page=$pagenum";

	      	curl_setopt($ch, CURLOPT_URL,$url);
	      	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	      	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	      	$output = curl_exec($ch);
	      	curl_close($ch);
	      	$postlistjson = json_decode($output);

			      	foreach($postlistjson->article as $post)
			      	{
		      			$nowarticle = $post->articleId;

					if($nowarticle <= $lastarticle)
		      			{
						return $pagenum;
					}

				}
				$pagenum++;
		}

	}
     
      /*    DESCRIPTION
	    Function_Name: get_articles_onepage()
	    Functionality:   새로운 글들을 확인하여 DB에 저장하는 함수
	    Variable: $bidt=게시판 아이디 $pagenumber=확인할 게시판 숫자, $lastarticle = 마지막 게시글 	 	
	    Output:       
	    Return Value: NONE
     */


	function get_articles_onepage($bidt, $pagenumber, $lastarticle)
	{
	    
	    $openapi_db = $this->load->database('openapi',true);
	    $ch = curl_init();
	    $boardname=$this->get_board_name_helper($bidt);
    	    $url = "https://apis.daum.net/cafe/articles/daumdna/$boardname.json?page=$pagenumber";

      	    curl_setopt($ch, CURLOPT_URL,$url);
      	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      	$output = curl_exec($ch);
      	curl_close($ch);
      	$postlistjson = json_decode($output);      	
      	
      	foreach ($postlistjson->article as $value)
      	{	
      		$date = date("Y-m-d H:i:s", number_format($value->regDateTime/1000,0,',',''));
      		$nowarticle = $value->articleId;

			if($value->userName->value != 'DNA지기')
			{
	      		if($nowarticle > $lastarticle)
	      		{
		      		$userid = $openapi_db->query("SELECT userid  
		      									  FROM member_members
		      									  WHERE nickname="."'".$value->userName->value."'")->result_array();      		      		
		      		
		      		if(empty($userid))
		      		{      		      		
		      			$userid[0]['userid']='anonymous';      
		      			$id_of_user=$this->nickname_to_id_helper; //Anonymous user id number		
				}
				else
				{
					$id_of_user=$this->userid_to_id_helper($userid[0]['userid']);
				}	

					$board_id=$this->get_board_id_helper($value->boardId);

					// 두가지의 경우의 수를 찾지 못한다면 ? 

					$openapi_db->query("INSERT INTO member_board_activity (board_id, id, member_id, writedate, type)
									    VALUES ('".$board_id."','".$value->articleId."','".$id_of_user."','".$date."','board')");		      		
		      	}

		    }
      	}
	}


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


}

/* End of file cafe_model.php */
/* Location: ./system/application/models/dnaver/cafe_model.php */