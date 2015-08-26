<?php


class Rule extends Eloquent
{
    protected $table = 'rules';
    protected $fillable = ['sid', 'rule', 'message', 'translate', 'rule_is', 'why'];


    public function incidents()
    {
        return $this->belongsToMany('Incident', 'incidents_rules', 'rules_id', 'incidents_id');
    }
}
