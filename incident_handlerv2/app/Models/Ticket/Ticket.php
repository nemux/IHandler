<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Ticket\Ticket
 *
 * @property integer $id
 * @property integer $otrs_ticket_id
 * @property string $otrs_ticket_number
 * @property string $internal_number
 * @property boolean $send_reminder
 * @property integer $user_id
 * @property integer $incident_id
 * @property integer $ticket_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereOtrsTicketId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereOtrsTicketNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereInternalNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereSendReminder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereTicketStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ticket\Ticket whereDeletedAt($value)
 */
class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'ticket';
}
