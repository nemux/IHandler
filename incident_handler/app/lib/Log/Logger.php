<?php

namespace Log;

class Logger
{


    private function write($user_id, $username, $action)
    {

        $log = new \Logger;

        $log->user_id = $user_id;
        $log->username = $username;
        $log->action = $action;

        $request = \Request::instance();
        $request->setTrustedProxies(array('10.30.12.105', '127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
        $ip = $request->getClientIp();
        $log->ip = $ip;
        $log->save();
    }

    public function info($user_id, $username, $action)
    {
        \Log::info($user_id . " | " . $username . " | " . "INFO:: " . $action);
        $this->write($user_id, $username, 'INFO:' . $action);
    }

    public function error($user_id, $username, $action)
    {
        \Log::error($user_id . " | " . $username . " | " . "ERROR:: " . $action);
        $this->write($user_id, $username, 'ERROR:' . $action);
    }

    public function warning($user_id, $username, $action)
    {
        \Log::warning($user_id . " | " . $username . " | " . "WARNING:: " . $action);
        $this->write($user_id, $username, 'WARNING:' . $action);
    }

}
