<?php

class CustomerController extends BaseController {

protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function create()
    {
      //Import all OTRS Customers
      $oc = new Otrs\Customer();
      $customers = $oc->getAll();

      $total_inserted = 0;
      foreach($customers as $k => $v){

        $cu = $oc->getCustomerInfo($v['UserName']);

        $exists = Customer::where('otrs_userID','=', $cu->UserID)->count();

        if ($exists == 0){
          $customer = new Customer;

          $customer->name = $cu->UserFirstname . " " . $cu->UserLastname;
          $customer->company = $cu->UserTitle;
          $customer->mail = $cu->UserEmail;
          $customer->phone = $cu->UserPhone;
          $customer->otrs_userID = $cu->UserID;
          $customer->otrs_userlogin = $cu->UserLogin;
          $customer->otrs_usercustomerID = $cu->UserCustomerID;
          $customer->otrs_validID = $cu->ValidID;
          $customer->save();
          $total_inserted++;
        }
      }
      return array("total_inserted" => $total_inserted);
      return Redirect::to('customer/import');
    }

    public function postUpdate()
    {
      $input = Input::all();
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id= $input['id'];

      $customer = Customer::find($id);

      if ($input) {
        $customer->name = $input['name'];
        $customer->company = $input['company'];
        $customer->phone = $input['phone'];
        $customer->mail = $input['mail'];
        $customer->save();

        return Redirect::to('customer/view/'.$customer->id);
      }


    }
    public function getUpdate($id){

        $customer=Customer::find($id);
        //$customer=Customer::lists('company', 'id');
        return $this->layout = View::make("customer.form", array(
        'customer'=>$customer,
        'action'=>'CustomerController@postUpdate',
        'title'=>"Actualizar Cliente",
        'update'=>"1"
        ));

    }

    public function view($id)
    {
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $customer=Customer::find($id);


      return $this->layout = View::make('customer.view', array(
        'customer'=>$customer,
        'action'=>'CustomerController@getUpdate',
        ));
    }

    public function index(){
      $customer = Customer::all();
      return $this->layout = View::make('customer.index', array(
        'customer'=>$customer
        ));
    }


    public function import(){

      return $this->layout = View::make("customer.import", array(
        'action'=>'CustomerController@create',
        'title'=>"Nuevo Cliente"
        ));
    }


}
