<?php


class EvidenceType extends Eloquent {
  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'evidence_types';
  protected $fillable = ['name','description'];
  protected $softDelete = true;



}
