<?php

namespace App\Models\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class TicketStatus extends BaseModel
{
    use SoftDeletes;

    protected $table = 'ticket_status';
}
