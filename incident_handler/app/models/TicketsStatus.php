<?php

class TicketStatus extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'tickets_status';
  protected $fillable = ['name','description'];
  protected $softDelete = true;
  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


}
