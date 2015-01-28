<?php

class OtrsController extends BaseController{

   public function import(){
      return $this->layout = View::make("otrs.import", array(
        'actions'=> array('OtrsController@importCustomers' => 'Importar Clientes'
                          ),
        'title'=>"Importar información desde OTRS",
        'total'=>0
        ));
    }

    public function importCustomers()
    {
      //Import all OTRS Customers
      $oc = new Otrs\Customer();
      $customers = $oc->getAll();
      $log = new Log\Logger();

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

      $log->write(Auth::user()->id, Auth::user()->username, $total_inserted." Clientes Importados de OTRS." );
      return array("total_inserted" => $total_inserted);
      //return Redirect::to('otrs/import');
    }


  public function sendTicket($id){

    $a = new Otrs\Article();

    print_r($a->AllSenderTypeList());
    print("<br/>");
    print_r($a->AllArticleTypeList());

  }


  public function test(){
    /*
    $o = new Otrs\Customer();
    $u = new Otrs\User();
    $ticket = new Otrs\Ticket();
    $a = new Otrs\Article();

      $ticket_info = $ticket->createTicket("Ticket desde Laravel", 3, "ldeleon", "Probando la creacion de tickets desde Laravel, intento 2");
  foreach($ticket_info as $k=>$v){
      print("[");
      print($k);
      print("]=>");
      print($v);
      print("<br/>");

  //print_r($o->getAll());
  /*
  foreach ($u->getAll() as $k=>$v){
    print("[");
    print($k);
    print("]=>");
    foreach($v as $k2 => $v2){
      print("[");
      print($k2);
      print("]=>");
      print($v2);
      print("<br/>");
    }
    //print_r($v);
    print("<br/>");
  }
  */
  /*
  print_r($u->getUserInfo($name));

  foreach($u->getUserInfo($name) as $k=>$v){
     print("[");
      print($k);
      print("]=>");
      print($v);
      print("<br/>");
  }
  */


  /*
  $ticket_info = $t->createTicket("Ticket desde Laravel", 3, "ldeleon", "Probando la creacion de tickets desde Laravel, intento 2");
  foreach($ticket_info as $k=>$v){
      print("[");
      print($k);
      print("]=>");
      print($v);
      print("<br/>");
  }
  */

  //print_r($a->createArticle(21, 3, "juas@juas.com", "Poniendo otro articulo juas, juas", "nemux", "A ver si jala esta madre y no se truena"));

  //$nombre = $o->getCustomerById($name);
  //print_r($nombre);
  //$d = $o->getCustomerInfo($name);
  //print_r($d);
  //return array("function"=>'get/otrs');

  }


}
