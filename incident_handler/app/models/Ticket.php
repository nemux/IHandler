<?php

class Ticket extends Eloquent {
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'tickets';
    protected $fillable = ['otrs_ticket_id','otrs_ticket_number','datetime','incident_handler_id','incidents_id','internal_number'];
    protected $softDelete = true;

    public function incidentHandler(){
        return $this->belongsTo('IncidentHandler','incident_handler_id','id');
    }

    public function history(){
        return $this->hasMany('TicketHistory','tickets_id','id');
    }

    public function incident(){
        return $this->belongsTo('Incident','incidents_id','id');
    }
}
