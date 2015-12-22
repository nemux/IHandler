<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class EventModel extends Event
{
    use SerializesModels;

    public $username;
    public $model;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param $username
     * @param $action
     * @param $model
     */
    public function __construct($username, $action, $model)
    {
        $this->username = $username;
        $this->action = $action;
        $this->model = $model;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
