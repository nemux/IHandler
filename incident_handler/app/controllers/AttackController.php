<?php

class AttackController extends BaseController{
  public function index(){

    $attacks = Attack::where('attack_parent_id','=','1')->orderBy('id','asc')->lists('name','id');

    //return $attacks;

    return View::make('attacks.index', array(
      'attacks' => $attacks,
    ));

  }

  public function get_byID($id){

    $attacks = Attack::where('attack_parent_id','=',$id)->orderBy('id','asc')->lists('name','id');
    return $attacks;
  }

}

?>
