<?php

class OtrsController extends BaseController{


  public function sendTicket($id){

    $u = new Otrs\User();
    $o = new Otrs\Customer();
    $t = new Otrs\Ticket();
    $a = new Otrs\Article();
    //$incident = Incident::find($id);
    //$ticket = new Ticket;


    //$ticket_info = $ticketOtrs->createTicket($incident->title, 3, "ldeleon",$incident->description);

    //$ticket->otrs_ticket_id = $ticket_info->TicketID;
    //$ticket->otrs_ticket_number = $ticket_info->TicketNumber;
    //$ticket->incident_handler_id = $ticket_info-> Auth::user()->id;

    //print_r($o->getAll());
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
    }*/
    //print_r($v);

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
