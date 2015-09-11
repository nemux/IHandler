<?php

class SocialMediaEvidence extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'socialmedia_evidence';
    protected $fillable = ['customer_id', 'socialmedia_id', 'file', 'name', 'footnote', 'md5', 'sha1', 'sha256'];
}
