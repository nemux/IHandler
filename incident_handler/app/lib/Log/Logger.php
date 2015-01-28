<?php

namespace Log;

class Logger {


  public function write($user_id, $username, $action){

    $log = new \Logger;

    $log->user_id = $user_id;
    $log->username = $username;
    $log->action = $action;
    $log->ip =  \Request::getClientIp();
    $log->save();
  }

}
