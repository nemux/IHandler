<?php

namespace App\Models\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends BaseModel
{
    use SoftDeletes;

    protected $table = 'ticket';

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_status_id');
    }
}
