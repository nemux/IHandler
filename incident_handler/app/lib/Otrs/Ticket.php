<?php

namespace Otrs;

use stdClass;

class Ticket extends Otrs {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Create a ticket in Otrs.
     *
     * @param string $title The Title of the ticket.
     * @param int $priority The priority of the ticket [1,2,3,4,5,6,7,8,9,10].
     * @param string $customer The id of the customer.
     * @param string $body The text for the article.
     *
     * @return array([TicketID] => int, [ArticleID] => int, [TicketNumber] => int)
     *
     */

    public function create($title, $priority, $customer, $body) {

      //Before create ticket, search the ID for the user assigned to Incident Manager System
      $user = new User;
      $article = new Article;

      try {

        $userInfo = $user->getInfo($this->incidentHandler);

        if (isset($userInfo['error_code']))
          throw new Exception($userInfo);


          # Create a new ticket. The function returns the Ticket ID.
          $TicketID = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                        "TicketObject", "TicketCreate",
                                                        "Title",        $title,
                                                        "Queue",        "gcs_im_queue",
                                                        "Lock",         "unlock",
                                                        "PriorityID",   $priority,
                                                        "State",        "new",
                                                        "CustomerUser", $customer->otrs_userID,
                                                        "OwnerID",      $userInfo['UserID'],
                                                        "UserID",       $userInfo['UserID'],
                                                       ));

          # A ticket is not usefull without at least one article. The function create and
          # returns an Article ID.

          $ArticleID = $article->create($TicketID, $userInfo['UserID'], $userInfo['UserEmail'], $title, $customer->mail, $body);

          if (isset($ArticleID['error_code']))
            throw new Exception($ArticleID);

          // Use the Ticket ID to retrieve the Ticket Number.
          $TicketNr = $this->getNumber($TicketID);

          if (isset($TicketNr['error_code']))
            throw new Exception($TicketNr);

          // Make sure the ticket number is not displayed in scientific notation
          // See http://forums.otrs.org/viewtopic.php?f=53&t=5135
          $big_integer = 1202400000;
          $Formatted_TicketNr = number_format($TicketNr['TicketNr'], 0, '.', '');

          return array("response_status" => 0, "TicketID" => $TicketID, "ArticleID" => $ArticleID['ArticleID'], "TicketNumber" => $Formatted_TicketNr);
        } catch (Exception $e) {
              return array("response_status" => -1, "error_code" => $e['error_code'], "error_description" => $e['error_description']);
        } catch (FatalException  $s){
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::create().");
        }
    }

     /*
     * Get the Ticket Number using the TicketID.
     *
     * @param string $title The Title of the ticket.
     * @param int $priority The priority of the ticket [1,2,3,4,5].
     * @param string $customer The id of the customer.
     * @param string $body The text for the article.
     *
     * @return array([TicketID] => int, [ArticleID] => int, [TicketNumber] => int)
     *
     */

  public function getNumber($TicketID){
    try {
     $TicketNr = $this->client->__soapCall("Dispatch",array($this->username, $this->password,
                                                       "TicketObject",   "TicketNumberLookup",
                                                       "TicketID",       $TicketID,
                                                       ));
      return array ('TicketNr' => $TicketNr, "response_status" => 0 );
    } catch(SoapFault $s) {
      return array("response_status" => -1,"error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::getNumber().");
    }
  }

  public function getInfo($ticketID){

    $user = new User;
    try {
      $userInfo = $user->getInfo($this->incidentHandler);

      if (isset($userInfo['error_code']))
        throw new Exception($userInfo);

      $ticketInfo = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketGet",
                                                      "TicketID",     $ticketID,
                                                      "UserID",     $userInfo['UserID'],
                                                     ));
      //return $ticketInfo;
      $tmpData = $this->formatOtrsArray($ticketInfo);
      $tmpData["response_status"]=0;
      return $tmpData;
    } catch (Exception $e) {
        return array("response_status" => -1, "error_code" => $e['error_code'], "error_description" => $e['error_description']);
    } catch (SoapFault $s){
        return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::getInfo().");
    }
  }

  public function close($ticketID, $message){

     $user = new User;
     $article = new Article;
     $customer =  new Customer;

     try {

       $userInfo = $user->getInfo($this->incidentHandler);

       if (isset($userInfo['error_code']))
        throw new Exception($userInfo);

       $ticketInfo = $this->getInfo($ticketID);

       if (isset($ticketInfo['error_code']))
        throw new Exception($ticketInfo);

       $customerInfo = $customer->getInfo($ticketInfo['CustomerUserID']);

       if (isset($customerInfo['error_code']))
         throw new Exception($customerInfo);


       $articleID = $article->create($ticketID, $userInfo['UserID'], $userInfo['UserEmail'], $ticketInfo['Title'], $customerInfo['UserEmail'], $message);

       if (isset($articleID['error_code']))
         throw new Exception($articleID);

       $success1 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketStateSet",
                                                      "State",        "closed successful",
                                                      "TicketID",     $ticketID,
                                                      "ArticleID",    $articleID['ArticleID'],
                                                      "UserID",   $userInfo['UserID']
                                                     ));
       $success2 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketLockSet",
                                                      "Lock",        "lock",
                                                      "TicketID",     $ticketID,
                                                      "UserID",   $userInfo['UserID']
                                                     ));
       if ($success1 && $success2)
         return array("response_status" => 0);
       else
         return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::close()");

     } catch (Exception $e) {
          return array("response_status" => -1, "error_code" => $e['error_code'], "error_description" => $e['error_description']);
     } catch(SoapFault $s){
          return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::close().");
     }
  }

  public function getPriorities(){

    try {
      $priorities = $this->client->__soapCall("Dispatch",array($this->username, $this->password,
                                                         "PriorityObject",   "PriorityList",
                                                         "Valid",       1,
                                                         ));
      $tmpData = $this->formatOtrsArray($priorities);
      $tmpData["response_status"] = 0;
      return $tmpData;
    } catch(SoapFault $e) {
      return array("response_status" => -1,"error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::getPriorities().");
    }
  }
}








