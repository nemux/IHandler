<?php

class Criticity extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'criticity';
    protected $fillable = ['name', 'description'];

}
