<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class oauth_model extends CI_Model {

  function test()
  {
     $ch = curl_init();
     $url = "https://accounts.google.com/o/oauth2/auth?redirect_uri=https%3A%2F%2Fdevelopers.google.com%2Foauthplayground&response_type=code&client_id=407408718192.apps.googleusercontent.com&scope=https%3A%2F%2Fmail.google.com%2F&approval_prompt=force&access_type=offline";
     //echo $url;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);
        curl_close($ch);

        print_r($output);

        //return json_decode($output,true);
        //$json= json_decode($output);
        //$sessionK=$json->loginresponse->sessionkey;
        //setcookie("sessionkey",$sessionK,time()+3600); //expire time
        //var_dump($sessionK);  
        //var_dump($_COOKIE['sessionkey']);
    //$this->load->helper('url');
    //$this->load->view('welcome_message');
  }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */