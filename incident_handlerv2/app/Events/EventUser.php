<?php

namespace App\Events;

use App\Models\User\User;
use Illuminate\Queue\SerializesModels;

class EventUser extends Event
{
    use SerializesModels;

    public $username;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param $username
     * @param User $user
     */
    public function __construct($username, User $user)
    {
        $this->username = $username;
        $this->user = $user;
    }
}
