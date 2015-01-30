<?php

class TicketStatus extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'tickets_status';
  protected $fillable = ['name','description'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


}
