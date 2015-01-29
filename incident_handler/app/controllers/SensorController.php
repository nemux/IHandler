<?php

class SensorController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function create()
    {
      $input = Input::all();
      $sensor=new Sensor;
      $customer=Customer::lists('company', 'id');

      if ($input) {
        $sensor->name=$input['name'];
        $sensor->ip=$input['ip'];
        $sensor->montage=$input['montage'];
        $sensor->customers_id=$input['customers_id'];
        $sensor->save();
        return Redirect::to('sensor/view/'.$sensor->id);
      }
      else{
        return $this->layout = View::make("sensor.form", array(
        'sensor'=>$sensor,
        'customer'=>$customer,
        'action'=>'SensorController@create',
        'title'=>"Nuevo Sensor",
        ));
      }
    }

    public function postUpdate()
    {
      $input = Input::all();
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id=$input['id'];
      $sensor=Sensor::find($id);

      if ($input) {
        $sensor->ip=$input['ip'];
        $sensor->name=$input['name'];
        $sensor->montage=$input['montage'];
        $sensor->customers_id=$input['customers_id'];
        $sensor->save();
        return Redirect::to('sensor/view/'.$sensor->id);
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
