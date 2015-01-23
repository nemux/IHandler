<?php

class ApprovedController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */

    public function postUpdate()
    {
      $input = Input::all();
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id=$input['id'];
      $incident=Incident::find($id);

      if ($input) {
        $incident->ip=$input['ip'];
        $incident->name=$input['name'];
        $incident->customers_id=$input['customers_id'];
        $incident->save();
        return Redirect::to('approved/approved/'.$incident->id);
      }


    }
    public function getUpdate($id){

        $sensor=Sensor::find($id);
        $customer=Customer::lists('company', 'id');
        return $this->layout = View::make("sensor.form", array(
        'sensor'=>$sensor,
        'customer'=>$customer,
        'action'=>'SensorController@postUpdate',
        'title'=>"Actualizar Sensor",
        'update'=>"1"
        ));

    }

    public function view($id)
    {
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $sensor=Sensor::find($id);


      return $this->layout = View::make('sensor.view', array(
        'sensor'=>$sensor,

        'action'=>'SensorController@getUpdate',
        ));
    }

    public function index(){
      $sensor=Sensor::all();
      return $this->layout = View::make('sensor.index', array(
        'sensor'=>$sensor,

        ));
    }

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */

}
