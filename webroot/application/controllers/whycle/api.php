<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class api extends REST_Controller
{
  function __construct()
  {       
      parent::__construct();
      $this->load->model('servertocs');
  }

  function userlogin_get()//domain can not be ROOT
  {
    if(!$this->get('username')||!$this->get('password'))
    {
      $this->response(NULL, 400);
    }
      $username=$this->get('username');
      $password=$this->get('password');
      $this->response($this->servertocs->login($username,$password),200);
  }

  function vmdeploy_get()
  {
        //CPU: 500Mhz, 1Ghz, 2Ghz,  MEM: 512, 1024, 2048, STORAGE: 5GB, 10GB, 20GB, 50GB 선택적 교차 가능으로 vm policy 제작

        if(!$this->get('name')||!$this->get('templateid')||!$this->get('cpu')||!$this->get('ram')||!$this->get('hdd'))//accoount, domainid는 쿠키로
        {
          $this->response(NULL, 400);
        }

        $displayname = $this->get('name');//an optional user generated name for the virtual machine
        $templateid = $this->get('templateid');
        //$serviceofferingid = $this->get('serviceofferingid');

        $memorySize = $this->get('ram');
        $cpuSpeed = $this->get('cpu');
        $volumeSize = $this->get('hdd');        
        $diskofferingid = array('5'=> 'f5b858c7-23fa-46a3-8493-6f3220a7a3e4','10'=> '8b3d4694-6253-4f17-b1b1-a879326d367b'
                               ,'20'=> '2f446bda-30c9-4cbb-a112-9fbf8a1dd14b','50'=> '44af1aa1-6d14-4d9f-95a4-0a6dccecef9e');

        $serviceofferingid = array(
          '500' => array('512' => '72be1dd9-cd21-489a-beaf-eda615a9621e','1024' => 'a01b2cf4-2460-4792-91ca-2b8461cc1048','2048' => '5d6e7871-e35d-4156-adb7-fee69e854679')
          ,'1' => array('512' => '5f7a730d-1c5e-40c0-a255-8df4e897dfab','1024' => 'd88e8b73-4a57-41a8-b26a-4ef9bf9a8050','2048' => '59cbee6c-1490-4e8e-ad5f-1ac274e2d88c')
          ,'2' => array('512' => '57929572-952e-459c-9cf5-1749fede124b','1024' => '12b7feac-c80d-4995-9643-139f9d5d88ef','2048' => '4a237cf3-4ea0-4ce7-aff4-0eb4e2b4cde8')
        );

        /*
        $specid=$this->get('specid');//사양 e.g 작은 사양, 보통 사양
        $serviceofferingid = 1;
        //specid 에 맞는 serviceofferingid 할당
        if($specid == 'small') $serviceofferingid = '1682c1cb-e8b1-44d8-af1c-6db25a48d0e0';
        else if($specid == 'regular') $serviceofferingid = '196ed865-9f06-4307-9743-2c0a6601e85b';
        */

        $this->response($this->servertocs->vmdeploy($displayname,$templateid,$serviceofferingid[$cpuSpeed][$memorySize],$diskofferingid[$volumeSize]));
  }

  function vmstart_get()
  {
      if(!$this->get('vmid'))
        {
          $this->response(NULL, 400);
        }

        $vmid=$this->get('vmid');//The ID of the virtual machine
        $this->response($this->servertocs->vmstart($vmid));
  }

  function vmstop_get()
  {
    if(!$this->get('vmid'))
    {
      $this->response(NULL, 400);
    }

    $vmid=$this->get('vmid');//The ID of the virtual machine
    $this->response($this->servertocs->vmstop($vmid));
  }

  function vmdestroy_get()
  {
       if(!$this->get('vmid'))
        {
          $this->response(NULL, 400);
        }

        $vmid=$this->get('vmid');
        $this->response($this->servertocs->vmdestroy($vmid));
  }

    /*
  { "loginresponse" : { "timeout" : "1800", "lastname" : "cloud", "registered" : "false",
   "username" : "admin", "firstname" : "admin", "domainid" : "692094a8-0369-11e4-a62a-60a44c60711e", 
   "type" : "1", "userid" : "b97cc3c2-0369-11e4-a62a-60a44c60711e", "sessionkey" : "Rpf6myAZn565Jdb9chj8psNP0z0=", "account" : "admin" } }
    */

  function vmlist_get()
  {
      $vmid=$this->get('vmid');  
 

      $this->response($this->servertocs->vmlist($vmid,200));
  }

  function vmstatus_get()
  {
      if(!$this->get('jobid'))
      {
        $this->response(NULL, 400);
      }

      $jobid=$this->get('jobid');
      $this->response($this->servertocs->vmstatus($jobid));
  }

  function templateslist_get()
  {
      $this->response($this->servertocs->templateslist());
  }

  function accountinfo_get()
  {
      if(!$this->get('name'))
      {
        $this->response(NULL, 400);
      }

      $name=$this->get('name');
      $this->response($this->servertocs->accountinfo($name));
  }

  function serviceofferinglist_get()
  {
      $this->response($this->servertocs->serviceofferinglist());
  }

  function listvolumes_get()
  {
     if(!$this->get('name'))
      {
        $this->response(NULL, 400);
      }

      $name=$this->get('name');
      $this->response($this->servertocs->listvolumes($name));
  }

  function boardlist_get()
  {


  }
  function boardwrite_get()
  {


  }
  function boardmodify_get()
  {



  }
 function boarddelete_get()
 {



 }





    
}