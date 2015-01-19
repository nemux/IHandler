<?php

class RuleController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function query($id)
    {
      $rule = Rule::where("sid" , '=', $id)->first();
      return $this->layout = View::make("rule.query", array(
      'rule'=>$rule,
      ));
    }
}


 ?>
