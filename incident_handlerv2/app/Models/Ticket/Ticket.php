<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'ticket';

    public function estatus()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_status_id');
    }
}
