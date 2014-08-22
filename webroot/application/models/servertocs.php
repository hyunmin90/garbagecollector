<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servertocs extends CI_Model {

  function login($username,$password)
  {
     $ch = curl_init();
     $url = "http://cf.dev.daum.net:8080/client/api?command=login&username=$username&password=$password&domain=community&response=json";
     //echo $url;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output,true);

        //$json= json_decode($output);
        //$sessionK=$json->loginresponse->sessionkey;
        //setcookie("sessionkey",$sessionK,time()+3600); //expire time
        //var_dump($sessionK);  
        //var_dump($_COOKIE['sessionkey']);
    //$this->load->helper('url');
    //$this->load->view('welcome_message');
  }

  function vmstart($vmid)
  {
     $ch = curl_init();
     $url = "http://cf.dev.daum.net:7979/client/api?command=startVirtualMachine&id=$vmid&response=json";

     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     $output = curl_exec($ch);
     curl_close($ch);

     $json = json_decode($output);

     if(!empty($json->startvirtualmachineresponse->jobid))
        $jobid = array('jobid' => $json->startvirtualmachineresponse->jobid);
     else
        $jobid = array('errortext' => $json->startvirtualmachineresponse->errortext);
     
     $finalArray = array('startvmresponse' => $jobid);
     return $finalArray;
  }

  function vmstop($vmid)
  {
     $ch = curl_init();
     $url = "http://cf.dev.daum.net:7979/client/api?command=stopVirtualMachine&id=$vmid&response=json";
     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     $output = curl_exec($ch);
     curl_close($ch);

     $json = json_decode($output);

     if(!empty($json->stopvirtualmachineresponse->jobid))
        $jobid = array('jobid' => $json->stopvirtualmachineresponse->jobid);
     else
        $jobid = array('errortext' => $json->startvirtualmachineresponse->Error);

     $finalArray = array('stopvmresponse' => $jobid);
     return $finalArray;
  } 

  function vmlist($vmid)  //what called variable varifies if this is being called by create vm. if so we wait until the vm is being made.
  {
    //$cookie_name='sessionkey';
    //$sessionKey= $_COOKIE[$cookie_name];
    //echo $sessionKey;
    //echo $sessionKey;
    //사용자 ID(쿠키), VM ID(옵션) //-VM명, -서비스사양, 디스크사양?, -상태, -담당자, -IP, -생성일, 마지막 상태변경일?, -현재 CPU 사용률
    $ch = curl_init();
    $account = "test";//daum 모듈을 통해 받아온다.
    $domainid = "04a929f8-1797-11e4-b9a1-60a44c60711e";//community의 domain ID
   
    $url = "http://cf.dev.daum.net:7979/client/api?command=listVirtualMachines&response=json"
    ."&account=$account"
    ."&domainid=$domainid"
    ."&listAll=true";

    if(!is_null($vmid)) $url.="&id=$vmid";

     curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($output);

    $count = 0;
    


    if(!empty($json->listvirtualmachinesresponse->count)){
      $tempArray = array('count' => $json->listvirtualmachinesresponse->count);

      foreach($json->listvirtualmachinesresponse->virtualmachine as $v){

        if ($v->state=="Error"){
          $tempArray['virtualmachine'][$count] = array('name' => $v->name
                                                      ,'id'             => $v->id 
                                                      ,'account'             => $v->account 
                                                      ,'serviceofferingname' => $v->serviceofferingname
                                                      ,'templatename'        => $v->templatename
                                                      ,'state'               => $v->state
                                                      ,'ipaddress'           => 'error'
                                                      ,'created'             =>"error"
                                                     );
          $count++;}
          else{
            $tempArray['virtualmachine'][$count] = array('name' => $v->name
                                                      ,'id'             => $v->id 
                                                      ,'account'             => $v->account 
                                                      ,'serviceofferingname' => $v->serviceofferingname
                                                      ,'templatename'        => $v->templatename
                                                      ,'state'               => $v->state
                                                      ,'ipaddress'           =>$v->nic[0]->ipaddress
                                                      ,'created'             => $v->created
                                                     );
                $count++;
              }

     


        }
    }
    else{
        $tempArray = array('count' => 0);
    }
    $finalArray = array('listvmresponse' => $tempArray);
    return $finalArray;
  }

  function vmdeploy($name,$templateid,$serviceofferingid,$diskofferingid)
  {
    /*
    $url = "http://cf.dev.daum.net:7979/client/api?command=deployVirtualMachine&response=json"
    ."&zoneid=9936ca83-6837-47db-b942-d3a722fe1e31"
    ."&account=$account"
    ."&domainid=c3cb4f0c-7e64-4330-a274-047978242325"
    ."&templateid=6967f186-0369-11e4-a62a-60a44c60711e"
    ."&hypervisor=XenServer"
    ."&serviceofferingid=1682c1cb-e8b1-44d8-af1c-6db25a48d0e0"
    ."&displayname=sdfdsfsdfdsf";
    */

    $ch = curl_init();
    $zoneid="814e7454-3318-4b19-9f1a-e36d48043287";
    $account="test";                                 //daum 모듈을 통해 받아온다.
    $domainid="04a929f8-1797-11e4-b9a1-60a44c60711e";//community의 domainID
    $hypervisor="XenServer";

    $url ="http://cf.dev.daum.net:7979/client/api?command=deployVirtualMachine&response=json"
    ."&zoneid=$zoneid"
    ."&account=$account"
    ."&domainid=$domainid"
    ."&templateid=$templateid"
    ."&hypervisor=$hypervisor"
    ."&serviceofferingid=$serviceofferingid"
    ."&diskofferingid=$diskofferingid"
    ."&name=$name";

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($output);

    if(!empty($json->deployvirtualmachineresponse->jobid))
        $jobid = array('jobid' => $json->deployvirtualmachineresponse->jobid);
     else
        $jobid = array('errortext' => $json->deployvirtualmachineresponse->errortext);

    $finalArray = array('deployvmresponse' => $jobid);
    return $finalArray;
  }

  function vmdestroy($id)
  {
    $ch = curl_init();
    $url = "http://192.168.161.45:7979/client/api?command=destroyVirtualMachine&id=$id&expunge=true&response=json";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($output);//objectize

    if(!empty($json->destroyvirtualmachineresponse->jobid))
        $jobid = array('jobid' => $json->destroyvirtualmachineresponse->jobid);
    else
        $jobid = array('errortext' => $json->destroyvirtualmachineresponse->errortext);

    $finalArray = array('destroyvmresponse' => $jobid);
    return $finalArray;
  }

  function templateslist()
  {
    $ch = curl_init();
    $url = "http://cf.dev.daum.net:7979/client/api?command=listTemplates&response=json&listAll=true&templatefilter=all&account=admin";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($output);
    $count=0;

    if(!empty($json->listtemplatesresponse->count)){
      $tempArray = array('count' => $json->listtemplatesresponse->count);
      foreach($json->listtemplatesresponse->template as $t){     
        $tempArray['template'][$count] = array('id' => $t->id, 'name' => $t->name, 'ostypename' => $t->ostypename);
        $count++;
      }
    }
    else{
        $tempArray = array('count' => 0);
    }
    $finalArray = array('listtemplatesresponse' => $tempArray);
    return $finalArray;
  }

  function vmstatus($jobid)//jobAsync API
  {  
    $ch = curl_init();
    $url="http://cf.dev.daum.net:7979/client/api?command=queryAsyncJobResult&jobId=$jobid&response=json";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($output);// json_decode 두번 째 인자로 true면 arr로 default는 obj
    $queryasyncjobresultresponse = $json->queryasyncjobresultresponse;

    //jobstatus==0 Job has not completed, 
    //jobstatus==1 Job completed, 
    //jobstatus==2 Failed to update XenServer Tools Version 6.1+ field. Error

    if($queryasyncjobresultresponse->jobstatus==0) $stringjobstatus = 'notcompleted';
    else if($queryasyncjobresultresponse->jobstatus==1) $stringjobstatus = 'completed';
    else $stringjobstatus = 'Error';//Failed to update XenServer Tools Version 6.1+ field. Error
    
    $jobtype = split("\.",$queryasyncjobresultresponse->cmd);//org.apache.cloudstack.api.command.user.vm.DeployVMCmd를 split
    $tempArray = array('accountid' => $queryasyncjobresultresponse->accountid
      ,'jobstatus' => $stringjobstatus//$queryasyncjobresultresponse->jobstatus,
      ,'cmd' => $jobtype[7]
      ,'jobstatus'=>$queryasyncjobresultresponse->jobstatus
      //,'jobprocstatus' => $queryasyncjobresultresponse->jobprocstatus // the progress information of the PENDING job
      ,'jobresultcode' => $queryasyncjobresultresponse->jobresultcode 
      );

    $finalArray = array('queryasyncjobresultresponse' => $tempArray);
    return $finalArray;
    //$finalJSON = json_encode($finalArray); 
    //echo $finalJSON;
  }

  function accountinfo($name)
  {
    $ch = curl_init();
    $url="http://cf.dev.daum.net:7979/api?command=listAccounts&listAll=true&name=$name&response=json";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($output);

    if(!empty($json->listaccountsresponse->account[0])){

      $default_account = $json->listaccountsresponse->account[0];
      
      //setcookie("sessionkey",$sessionK,time()+3600); //expire time
      //save these value to database and call them when needed

      $account = array('id' => $default_account->id
        ,'domain' => $default_account->domain
        ,'domainid' => $default_account->domainid
        ,'cpulimit' => $default_account->cpulimit
        ,'cputotal' => $default_account->cputotal
        ,'cpuavailable' => $default_account->cpuavailable
        ,'memorylimit' => $default_account->memorylimit
        ,'memorytotal' => $default_account->memorytotal
        ,'memoryavailable' => $default_account->memoryavailable
        ,'primarystoragelimit' => $default_account->primarystoragelimit
        ,'primarystorageavailable' => $default_account->primarystorageavailable
        ,'secondarystoragelimit' => $default_account->secondarystoragelimit
        ,'secondarystoragetotal' => $default_account->secondarystoragetotal
        ,'secondarystorageavailable' => $default_account->secondarystorageavailable);
    }
    else{
      $account = array('id' => "error");
    }

    $finalArray = array('listaccountsresponse' => $account);
    return $finalArray;
    //$finalJSON = json_encode($finalArray);
    //echo($finalJSON);
  }

  function serviceofferinglist()
  {
    $ch = curl_init();
    $url="http://cf.dev.daum.net:7979/api?command=listServiceOfferings&listAll=true&issystem=false&response=json";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);
    
    $json = json_decode($output);
    $count=0;
    $tempArray = array('count' => $json->listserviceofferingsresponse->count);
    foreach($json->listserviceofferingsresponse->serviceoffering as $s){     
      $tempArray['serviceoffering'][$count] = array('id' => $s->id
                                                    ,'name' => $s->name
                                                    ,'cpunumber' => $s->cpunumber
                                                    ,'cpuspeed' => $s->cpuspeed
                                                    ,'memory' => $s->memory);
      $count++;
    }
    $finalArray = array('serviceofferinglist' => $tempArray);
    return $finalArray;
    //$finalJSON = json_encode($finalArray);    
    //echo $finalJSON;
  }

  function listvolumes($name)
  {
    $domainid='04a929f8-1797-11e4-b9a1-60a44c60711e';//communitiy domainid
    $ch = curl_init();
    $url="http://192.168.161.45:7979/client/api?command=listVolumes&account=$name&domainid=$domainid&response=json";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($ch);
    curl_close($ch);
    
    $json = json_decode($output);
    $count = 0;

    $tempArray = array('count' => $json->listvolumesresponse->count);
    foreach($json->listvolumesresponse->volume as $v){     
      $tempArray['volume'][$count] = array('id' => $v->id
                                                    ,'type' => $v->type
                                                    ,'size' => $v->size
                                                    ,'state' => $v->state);
      $count++;
    }
    $finalArray = array('listvolumesresponse' => $tempArray);
    return $finalArray;
    //$finalJSON = json_encode($finalArray);    
    //echo $finalJSON;
  }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */