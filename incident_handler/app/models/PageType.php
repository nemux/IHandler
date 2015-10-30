<?php

class PageType extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'page_type';
    protected $fillable = ['type', 'description'];


    public function pages()
    {
        return $this->hasMany('CustomerPage', 'page_type_id', 'id');
    }
}
