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
  public function getSoapUsername() { return $this->username;}
  public function getSoapPassword() { return $this->password;}
  public function getOtrsUser() { return $this->incidentHandlers;}


  public function __construct(){

    $this->url      = "http://10.30.12.107/otrs/rpc.pl";
    $this->username = "csirt_global";
    $this->password = ".0040C3c1rT0400.";
    $this->incidentHandler = "gcs_im";

    $this->client = new SoapClient(null, array('location'  =>  $this->url,
                                         'uri'       => "Core",
                                         'trace'     => 1,
                                         'exceptions' => true,
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
                                         'exceptions' => true,
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
