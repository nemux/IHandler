<?php


class Sensor extends Eloquent
{


    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sensors';
    protected $fillable = ['ip', 'name', 'customers_id', 'montage'];


    public function customers()
    {
        return $this->belongsTo('Customer', 'customers_id', 'id');
    }
}
