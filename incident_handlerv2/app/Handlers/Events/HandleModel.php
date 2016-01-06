<?php

namespace App\Handlers\Events;

use App\Events\EventModel;
use Models\IncidentManager\BaseModel;
use Models\IncidentManager\Log\Log;

class HandleModel
{
    /**
     * @var string
     */
    protected $username;
    /**
     * @var BaseModel
     */
    protected $model;
    /**
     * @var string
     */
    protected $action;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventModel $event
     * @return void
     */
    public function handle(EventModel $event)
    {
        $this->username = $event->username;
        $this->model = $event->model;
        $this->action = $event->action;

        $class = strtoupper($event->model->getTable());
        $truncated = mb_strimwidth(json_encode($this->model), 0, 255);

        Log::info($this->username, "{$this->action} de un objeto TIPO '{$class}' con ID '{$this->model->id}' / '{$truncated}'");
    }
}
