<?php

namespace App\Handlers\Events;

use App\Events\EventModel;
use App\Models\Log\Log;

class HandleModel
{
    protected $username;
    protected $class;
    protected $model;
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
        $this->class = $event->class;
        $this->model = $event->model;
        $this->action = $event->action;
        $truncated = mb_strimwidth(json_encode($this->model), 0, 255);

        Log::info($this->username, "Se {$this->action} un modelo de tipo '{$this->class}' con ID '{$this->model->id}' / '{$truncated}'");
    }
}
