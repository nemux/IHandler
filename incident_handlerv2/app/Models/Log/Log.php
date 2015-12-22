<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

class Log extends Model //Esta clase no extiende de BaseModel porque de lo contrario se ciclaría almacenando los datos de esta tabla
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
     * Almacena en la bitácora un registro de tipo INFO
     *
     * @param $message
     */
    public static function info($username, $message)
    {
        self::addLog(self::INFO, $username, $message);
        \Log::info($message);
    }

    /**
     * Almacena en la bitácora un registro de tipo DEBUG
     *
     * @param $message
     */
    public static function debug($username, $message)
    {
        self::addLog(self::DEBUG, $username, $message);
        \Log::debug($message);
    }

    /**
     * Almacena en la bitácora un registro de tipo WARNING
     *
     * @param $message
     */
    public static function warning($username, $message)
    {
        self::addLog(self::WARNING, $username, $message);
        \Log::warning($message);
    }

    /**
     * Almacena en la bitácora un registro de tipo ERROR
     *
     * @param $message
     */
    public static function error($username, $message)
    {
        self::addLog(self::ERROR, $username, $message);
        \Log::error($message);
    }
}
