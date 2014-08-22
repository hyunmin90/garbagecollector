<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_model extends CI_Model {

  function __construct(){
    parent::__construct();
    $this->joinPoint = 10;
  }

  function model_load_model($model_name)
  {
    $CI =& get_instance();
    $CI->load->model($model_name);
    //$temp = split("/",$model_name);
    preg_match("/\/([A-Za-z_]+)/", $model_name, $temp);
    return $CI->$temp[1];
  }

  //TODO
  //api를 발급 받은 사람을 회원으로 가입 시킨다. 
  //api를 한번 이상 발급 받았으면서, 가장 먼저 발급 받았을 때의 날짜를 가입날짜로 지정한다.
  function insert_openapi() {

     $this->openapi_db->query("INSERT INTO member_members(userid,createdate,joinpath,point)
              SELECT
                  DISTINCT userid,
                  (SELECT issuedate FROM api_key AS B WHERE B.userid = api_key.userid ORDER BY issuedate LIMIT 1) AS createdate,
                  'openapi'
                  ,".$this->joinPoint."
              FROM api_key
              WHERE
                  issuedate > ifnull((SELECT createdate FROM member_members WHERE joinpath = 'openapi' ORDER BY createdate DESC LIMIT 1),date('0000-00-00'))
                  AND
                  userid NOT IN (SELECT userid FROM member_members )");
      
  }

  //TODO Need fix. Too slow when there are much more users around
  //insert user participating event into member_users Table
  function insert_event() {

     $this->openapi_db->query("INSERT INTO member_members(userid,createdate,joinpath,point)
              SELECT
                  DISTINCT member_id,
                  (SELECT joindate FROM member_event_join AS B WHERE B.member_id = member_event_join.member_id ORDER BY joindate LIMIT 1) AS createdate ,
                  'event'
                  ,".$this->joinPoint."
              FROM member_event_join
              WHERE
                  joindate > ifnull((SELECT createdate FROM member_members WHERE joinpath = 'event' ORDER BY createdate DESC LIMIT 1),date('0000-00-00'))
                  AND
                  id NOT IN (SELECT userid FROM member_members )");
  }

  //TODO
  //return all DNA member users
  function show_member(){
      return $this->openapi_db->query("SELECT * 
                                       FROM member_members
                                       ORDER BY createdate DESC"
      );
  }

  //회원이 게시한 글들을 boardid로 구분하여 boardid에 해당하는 가중치를 곱해 계산한다.
  //가져오는 글들은 어제 날자 이후에 쓰여진 글들이다.
  function calcul_point()
  {
    $userlist = $this->model_load_model("dnaver/member_model")->show_member()->result();

    foreach($userlist as $u)
    {
      $id = $u->id;
      $yesterday = date("Y-m-d",strtotime("-1 days"));

      $Query = "UPDATE member_members SET point=point+
                      (SELECT ifnull(SUM(total),0)
                       FROM
                        (SELECT

                          (SELECT COUNT(board_id)*member_boards.weight
                           FROM member_board_activity
                           WHERE member_board_activity.board_id = member_boards.id
                           AND member_id = ?
                           AND date_format(writedate,'%Y-%m-%d') >= ?
                          ) as total

                         FROM member_boards
                        ) AS M
                      )
               WHERE id = ?";

               //duraboys 라는 회원이 게시한 글을 boardid로 나누어 가중치를 주어 계산하는 질의
               /*
              SELECT

              (SELECT COUNT(boardid)*member_boards.weight
                FROM member_board_activity
                WHERE member_board_activity.boardid = member_boards.boardid
                AND userid = 'duraboys'
              ) as total,
              member_boards.boardid as id

              FROM member_boards

               */

      $array = array($id,$yesterday,$id);
      $this->openapi_db->query($Query,$array);
    }
  }

  function calcul_grade()
  {
    $userlist = $this->model_load_model("dnaver/member_model")->show_member()->result();

    foreach($userlist as $u)
    {
      $userid = $u->userid;

      $Query = "UPDATE member_members SET grade = 
            CASE
                WHEN point > 500 THEN 1
                WHEN point > 400 THEN 2
                WHEN point > 300 THEN 3
                WHEN point > 200 THEN 4
                ELSE 5
            END
            WHERE userid ="."'".$userid."'";

      $this->openapi_db->query($Query);
    }
  }

  //TODO
  //DNA카페를 통해 회원을 가입시킨다.
  function insert_from_DNA()
  {
        $nl = "\xA";
        $a = "callCount=1".$nl;
        $a .= "page=/_c21_/founder_member_admin_v2?grpid=17Bc8".$nl;
        $a .= "httpSessionId=".$nl;
        $a .= "scriptSessionId=DC0CF6B068E60ED08D3882B28188B9EE929".$nl;
        $a .= "c0-scriptName=MemberList".$nl;
        $a .= "c0-methodName=getMemberList".$nl;
        $a .= "c0-id=0".$nl;
        $a .= "c0-param0=string:17Bc8".$nl;
        $a .= "c0-e1=number:1".$nl;//가져오는 회원의 시작 번호
        $a .= "c0-e2=number:10000".$nl;//끝 번호, 즉 10000명을 가져온다. 10000명 이하라면 최대값을 가져온다.
        $a .= "c0-e3=null:null".$nl;
        $a .= "c0-e4=number:0".$nl;
        $a .= "c0-e5=null:null".$nl;
        $a .= "c0-e6=null:null".$nl;
        $a .= "c0-param1=Object_Object:{curPage:reference:c0-e1, listLimit:reference:c0-e2, sortType:reference:c0-e3, sortValue:reference:c0-e4, roleCode:reference:c0-e5, memberType:reference:c0-e6}".$nl;
        $a .= "c0-e7=number:0".$nl;
        $a .= "c0-e8=null:null".$nl;
        $a .= "c0-e9=number:0".$nl;
        $a .= "c0-e11=number:0".$nl;
        $a .= "c0-e12=number:0".$nl;
        $a .= "c0-e10=Object_Object:{articleCnt:reference:c0-e11, commentCnt:reference:c0-e12}".$nl;
        $a .= "c0-e14=null:null".$nl;
        $a .= "c0-e15=number:0".$nl;
        $a .= "c0-e13=Object_Object:{month:reference:c0-e14, visitCnt:reference:c0-e15}".$nl;
        $a .= "c0-e17=null:null".$nl;
        $a .= "c0-e18=null:null".$nl;
        $a .= "c0-e19=null:null".$nl;
        $a .= "c0-e16=Object_Object:{startDt:reference:c0-e17, endDt:reference:c0-e18, type:reference:c0-e19}".$nl;
        $a .= "c0-param2=Object_Object:{searchMode:reference:c0-e7, searchText:reference:c0-e8, moreless:reference:c0-e9, articleSearch:reference:c0-e10, visitSearch:reference:c0-e13, termSearch:reference:c0-e16}".$nl;
        $a .= "batchId=0".$nl;

        //인증 URL 날리기
        $ch = curl_init();
        $url = "https://logins.daum.net/accounts/backend.do?id=research2005&pw=".urlencode ("daum!@#$")."&ip=192.168.175.116";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
        curl_setopt($ch, CURLOPT_HEADER  ,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);

        //인증 쿠키 얻기
        $cookies = array();
        preg_match_all('/Set-Cookie:(?<cookie>\s{0,}.*)$/im', $output, $cookies);
        $cookie_string = implode(";", $cookies['cookie']);

        //멤버쉽 리스트 얻기
        $ch = curl_init();
        $url = "http://cafe.daum.net/_c21_/dwr/founder/call/plaincall/MemberList.getMemberList.dwr";
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_HEADER  ,1);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        curl_setopt($ch, CURLOPT_REFERER,"http://cafe.daum.net/_c21_/founder_member_admin_v2?grpid=17Bc8");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $a);
        
        $output = curl_exec($ch);
        curl_close($ch);

        $d_member = array();
        $all_member = array(array());

        preg_match_all('/\.daumid=(.*)objans/', $output, $d_member);

        $count = 0;
        foreach($d_member[0] as $d)
        {
           preg_match('/\.daumid="(.*)";/iU', $d, $d_ids);
           preg_match('/\.nickname="(.+)";/Uim', $d, $d_nicks);

          $all_member[$count]['id'] = $d_ids[1];
          $all_member[$count++]['nick'] = $d_nicks[1];
        }

        //DB - INSERT TO member_users
        $createdate = date("Y-m-d H:i:s");

        if(!array_key_exists('id',$all_member[0]))
        {
          echo("<script> alert('do not access backward login') 
                window.location = 'http://l.developers.daum.net/dnaver/member/show_member' </script>");
          //echo('<HTML> <meta http-equiv="refresh" content="0; url=http://l.developers.daum.net/dnaver/member/show_member" /> </HTML>');
          return;
        }
        $numb_of_useradded=0;
        foreach($all_member as $all)
        {
          if(is_null($all['id']))
            continue;

          $Query = "INSERT INTO member_members (userid, nickname, joinpath, email, phone, 
                                             birthday, point, grade, cafejoin, createdate)
                    SELECT * FROM (SELECT ? as a, ? as b, ? as c, ? as d, ? as e, ? as f,
                                          ? as g, ? as h, ? as i, ? as m) AS temp
                    WHERE NOT EXISTS (SELECT 1 FROM member_members as m WHERE m.userid=?)";

          //encoding unicode nickname to utf8
          $encode_nick = preg_replace('/\\\u([0-9a-f]{3,4})/i','&#x\\1;', $all['nick']);

          $values = array($all['id']
                          ,html_entity_decode($encode_nick, ENT_COMPAT, 'UTF-8')
                          ,'DNAcafe'
                          , $all['id'].'@daum.net'
                          ,null       //phone
                          ,null         //birthday
                          ,50           //point
                          ,5            //grade
                          ,1            //cafejoin
                          ,$createdate   //createday
                          ,$all['id']
                          );

         // print_r($values);
          $this->openapi_db->query($Query,$values);
              if ($this->openapi_db->affected_rows()==1)
              {
                  $numb_of_useradded++;
              }
        }

      //This logic is designed to count how many users are added through cafe everyday
        $values2 = array( 
          'numb_of_added'=>$numb_of_useradded,
           'date_added'=>date('Y-m-d H:i:s')
          );
          $this->openapi_db->insert('no_of_user_added_day_cafe',$values2);
  }

  //TODO
  //전체 회원의 수를 가져온다.
  function total_member(){
      return $this->openapi_db->query("SELECT count(userid) as cnt
                                       FROM member_members"
      );
  }
}

/* End of file member_model.php */
/* Location: ./system/application/models/dnaver/member_model.php */