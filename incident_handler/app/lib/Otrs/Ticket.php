<?php

namespace app\lib\Otrs;

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

    public function createTicket($title, $priority, $customer, $body) {

      //Before create ticket, search the ID for the user assigned to Incident Handler System
      $user = new User;
      $article = new Article;

      $userInfo = $user->getUserInfo($this->incidentHandler);

      # Create a new ticket. The function returns the Ticket ID.
      $TicketID = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                      "TicketObject", "TicketCreate",
                                                      "Title",        $title,
                                                      "Queue",        "Postmaster",
                                                      "Lock",         "unlock",
                                                      "PriorityID",   $priority,
                                                      "State",        "new",
                                                      "CustomerUser", $customer,
                                                      "OwnerID",      $userInfo['UserID'],
                                                      "UserID",       $userInfo['UserID'],
                                                     ));


      # A ticket is not usefull without at least one article. The function create and
      # returns an Article ID.

      $ArticleID = $article->createArticle($TicketID, $userInfo['UserID'], $userInfo['UserEmail'], $title, $customer, $body);


      // Use the Ticket ID to retrieve the Ticket Number.
      $TicketNr = $this->getTicketNumber($TicketID);

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

  public function getTicketNumber($TicketID){
     $TicketNr = $this->client->__soapCall("Dispatch",array($this->username, $this->password,
                                                       "TicketObject",   "TicketNumberLookup",
                                                       "TicketID",       $TicketID,
                                                       ));
    return $TicketNr;

  }
}








