<?php

class Category extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'time_range'];

    /**
     * Remueve la cadena que coincida con la expresión regular, comúnmente "CAT - 5" por ejemplo
     *
     * @return mixed
     */
    public function noCat()
    {
        $cat = preg_replace("/(CAT \\d* - )/", "$2", $this->name);
        return $cat;
    }
}
