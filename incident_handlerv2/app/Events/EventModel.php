<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class EventModel extends Event
{
    use SerializesModels;

    public $username;
    public $class;
    public $model;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param $username
     * @param $class
     * @param $action
     * @param $model
     */
    public function __construct($username, $class, $action, $model)
    {
        $this->username = $username;
        $this->class = $class;
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
