<?php


class Signature extends Eloquent
{
    protected $table = 'signatures';
    protected $fillable = ['signature', 'description', 'recommendation', 'reference', 'risk'];


    public function incidents()
    {
        return $this->belongsToMany('Incident', 'incidents_signatures', 'signatures_id', 'incidents_id');
    }
}