<?php

namespace App\Handlers\Events;

use App\Events\EventUser;
use App\Models\Log\Log;

class HandleSaveUser
{
    protected $username;
    protected $user;

    /**
     * Create the event handler.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventUser $event
     * @return void
     */
    public function handle(EventUser $event)
    {
        $this->username = $event->username;
        $this->user = $event->user;

        Log::info($this->username, "Se guardó/actualizó el Usuario con ID '{$this->user->id}' y nombre de usuario '{$this->user->username}'");
    }
}
