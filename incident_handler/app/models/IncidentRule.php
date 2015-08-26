<?php

class IncidentRule extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'incidents_rules';
    protected $fillable = ['incidents_id', 'rules_id'];


    public function rule()
    {
        return $this->belongsTo('Rule', 'rules_id', 'id');
    }


    public function incidents()
    {
        return $this->belongsTo('Incident', 'incidents_id', 'id');
    }

}
