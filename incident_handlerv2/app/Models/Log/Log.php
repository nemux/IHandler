<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  type
 * @property  message
 * @property  username
 */
class Log extends Model
{
    protected $table = 'log';

    const INFO = 1;
    const DEBUG = 2;
    const WARNING = 3;
    const ERROR = 4;

    /**
     * @param $type
     * @param $username
     * @param $message
     */
    private static function addLog($type, $username, $message)
    {
        $log = new Log();
        $log->type = $type;
        $log->username = $username;
        $log->message = $message;
        $log->save();
    }

    /**
     * @param $message
     */
    public static function info($username, $message)
    {
        self::addLog(self::INFO, $username, $message);
    }

    /**
     * @param $message
     */
    public static function debug($username, $message)
    {
        self::addLog(self::DEBUG, $username, $message);
    }

    /**
     * @param $message
     */
    public static function warning($username, $message)
    {
        self::addLog(self::WARNING, $username, $message);
    }

    /**
     * @param $message
     */
    public static function error($username, $message)
    {
        self::addLog(self::ERROR, $username, $message);
    }
}
