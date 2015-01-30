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
     * @param int $priority The priority of the ticket [1,2,3,4,5].
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

      $userInfo = $user->getInfo($this->incidentHandler);

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

      // Use the Ticket ID to retrieve the Ticket Number.
      $TicketNr = $this->getNumber($TicketID);

      // Make sure the ticket number is not displayed in scientific notation
      // See http://forums.otrs.org/viewtopic.php?f=53&t=5135
      $big_integer = 1202400000;
      $Formatted_TicketNr = number_format($TicketNr, 0, '.', '');

      return array("TicketID" => $TicketID, "ArticleID" => $ArticleID, "TicketNumber" => $Formatted_TicketNr);

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
     $TicketNr = $this->client->__soapCall("Dispatch",array($this->username, $this->password,
                                                       "TicketObject",   "TicketNumberLookup",
                                                       "TicketID",       $TicketID,
                                                       ));
    return $TicketNr;

  }

  public function getInfo($ticketID){

     $user = new User;
     $userInfo = $user->getInfo($this->incidentHandler);

     $ticketInfo = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketGet",
                                                      "TicketID",     $ticketID,
                                                      "UserID",     $userInfo['UserID'],
                                                     ));
    //return $ticketInfo;

    return $this->formatOtrsArray($ticketInfo);
  }

  public function close($ticketID, $message){

     $user = new User;
     $article = new Article;
     $customer =  new Customer;


     $userInfo = $user->getInfo($this->incidentHandler);
     $ticketInfo = $this->getInfo($ticketID);
     $customerInfo = $customer->getInfo($ticketInfo['CustomerUserID']);

     $articleID = $article->create($ticketID, $userInfo['UserID'], $userInfo['UserEmail'], $ticketInfo['Title'], $customerInfo->UserEmail, $message);

     $success1 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketStateSet",
                                                      "State",        "closed successful",
                                                      "TicketID",     $ticketID,
                                                      "ArticleID",    $articleID,
                                                      "UserID",   $userInfo['UserID']
                                                     ));
    $success2 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketLockSet",
                                                      "Lock",        "lock",
                                                      "TicketID",     $ticketID,
                                                      "UserID",   $userInfo['UserID']
                                                     ));

    if ($success1 && $success2)
      $success = 1;
    else
      $success = 0;

    return $success;
  }

  public function getPriorities(){
    $priorities = $this->client->__soapCall("Dispatch",array($this->username, $this->password,
                                                       "PriorityObject",   "PriorityList",
                                                       "Valid",       1,
                                                       ));

    return $this->formatOtrsArray($priorities);
  }
}








