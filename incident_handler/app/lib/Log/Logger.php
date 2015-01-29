<?php

namespace Log;

class Logger {


  public function write($user_id, $username, $action){

    $log = new \Logger;

    $log->user_id = $user_id;
    $log->username = $username;
    $log->action = $action;

    $request = \Request::instance();
    $request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
    $ip = $request->getClientIp();
    $log->ip =  $ip;
    $log->save();
  }

}
