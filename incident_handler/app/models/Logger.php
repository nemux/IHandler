<?php

class Logger extends Eloquent{

  protected $connection = 'log';
  protected $fillable = ['user_id','username','ip','action'];
  protected $table = 'log';
  protected $softDelete = true;


}
