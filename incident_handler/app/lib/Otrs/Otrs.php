<?php

namespace Otrs;

use SoapClient;

abstract class Otrs {

  protected $url      = "";
  protected $username = "";
  protected $password = "";
  protected $incidentHandler = "";
  protected $client;


  public function getUrl() { return $this->url;}
  public function getUsername() { return $this->username;}
  public function getPassword() { return $this->password;}

  public function __construct(){

    $this->url      = "http://192.168.1.134/otrs/rpc.pl";
    $this->username = "some_user";
    $this->password = "some_pass";
    $this->incidentHandler = "gcs_im";

    $this->client = new SoapClient(null, array('location'  =>  $this->url,
                                         'uri'       => "Core",
                                         'trace'     => 1,
                                         'login'     => $this->username,
                                         'password'  => $this->password,
                                         'style'     => SOAP_RPC,
                                         'use'       => SOAP_ENCODED));
  }

  public function __construct1($url, $username, $password){
    $this->url = $url;
    $this->username = $username;
    $this->password = $password;

    $this->client = new SoapClient(null, array('location'  =>  $url,
                                         'uri'       => "Core",
                                         'trace'     => 1,
                                         'login'     => $this->username,
                                         'password'  => $this->password,
                                         'style'     => SOAP_RPC,
                                         'use'       => SOAP_ENCODED));
  }


  protected function formatOtrsArray($data){
    $arrayInfo = array();
    $i = 0;
      foreach ($data as $name => $value) {
        if (false !== strpos($name, "s-gensym")) {
          $temp[$i] = $value;
          if($i % 2 != 0) {
            $v = $temp[$i-1];
            $arrayInfo[$v] = $value;
          }
          $i++;
        }
      }
    return $arrayInfo;
  }
}
