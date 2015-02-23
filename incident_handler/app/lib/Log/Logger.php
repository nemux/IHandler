<?php

namespace Log;

class Logger {


  private function write($user_id, $username, $action){

    $log = new \Logger;

    $log->user_id = $user_id;
    $log->username = $username;
    $log->action = $action;

    $request = \Request::instance();
    $request->setTrustedProxies(array('10.0.0.0/8')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
    $ip = $request->getClientIp();
    $log->ip =  $ip;
    $log->save();
  }

  public function info($user_id, $username, $action){
    $this->write($user_id, $username, 'INFO:'.$action);
  }

  public function error($user_id, $username, $action){
    $this->write($user_id, $username, 'ERROR:'.$action);
  }

    public function warning($user_id, $username, $action){
    $this->write($user_id, $username, 'WARNING:'.$action);
  }

}
