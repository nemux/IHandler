<?php

class Image extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'images';
    protected $fillable = ['source', 'file', 'name', 'incidents_id', 'evidence_types_id', 'mda5', 'sha1', 'sha256'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    public function incident()
    {
        return $this->belongsTo('Incident', 'incidents_id', 'id');
    }

    public function imageType()
    {
        return $this->belongsTo('Image', 'evidence_types_id', 'id');
    }

}
