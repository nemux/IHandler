<?php

class AttackController extends BaseController{
  public function index(){

    $attacks = array('Seleccione una Categoria');
    $tmp = Attack::where('attack_parent_id','=','1')->orderBy('id','asc')->lists('name','id');

    foreach ($tmp as $k=>$v)
      $attacks[$k] = $v;

    return View::make('attack.index', array(
      'attacks' => $attacks,
    ));

  }

  public function get_byID($id){

    $attacks = Attack::where('attack_parent_id','=',$id)->orderBy('id','asc')->lists('name','id');
    return $attacks;
  }

  public function view($id){

    $attack = Attack::find($id);
    $parent = Attack::find($attack->attack_parent_id);

    return View::make('attack.view', array(
      'attack' => $attack,
      'parent' => $parent
    ));
  }

  public function post_create()
  {
      $input = Input::all();
      $log = new Log\Logger();
      $attack = new Attack();

      $attack->name=$input['name'];
      $attack->description=$input['description'];
      $attack->attack_parent_id=$input['attack_parent_id'];
      $attack->save();
      $log->info(Auth::user()->id,Auth::user()->username,'Se creó el Ataque con ID: '. $attack->id);
      return Redirect::to('/attack/view/'.$attack->id);

  }

  public function get_create()
  {
        $attack = new Attack();
        $parent = Attack::where('attack_parent_id','=','1')->orderBy('id','asc')->lists('name','id');

        return $this->layout = View::make("attack.form", array(
        'attack'=>$attack,
        'parent'=>$parent,
        'action'=>'AttackController@post_create',
        'title'=>"Crear Ataque",
        ));
  }

  public function get_update($id){

        $attack = Attack::find($id);
        $parent = Attack::where('attack_parent_id','=','1')->orderBy('id','asc')->lists('name','id');


        return $this->layout = View::make("attack.form", array(
        'attack'=>$attack,
        'parent'=>$parent,
        'action'=>'AttackController@post_update',
        'title'=>"Actualizar Ataque",
        'update'=>"1"
        ));
  }

  public function post_update()
    {
      $input = Input::all();
      $id = $input['id'];
      $attack = Attack::find($id);
      $log = new Log\Logger();

      if ($input) {
        $attack->description = $input['description'];
        $attack->name=$input['name'];
        $attack->attack_parent_id=$input['attack_parent_id'];

        $attack->save();
        $log->info(Auth::user()->id,Auth::user()->username,'Se actualizó el Ataque con ID: '. $attack->id);
        return Redirect::to('attack/view/'.$attack->id);
      }
    }
}

?>
