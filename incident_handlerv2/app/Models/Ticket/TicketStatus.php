<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Ticket\TicketStatus
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\TicketStatus whereDeletedAt($value)
 */
class TicketStatus extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_status';
}
