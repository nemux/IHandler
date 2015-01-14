<?php

namespace app\lib\Otrs;

use stdClass;

class Article extends Otrs {

    public function __construct() {
        parent::__construct();
    }

    /* Create an Article from a Ticket
     *
     * @param $TicketID The TicketID to associate with.
     * @param $userId The userId from the user to create the ticket.
     * @param $userEmail The email form the user to create the ticket.
     * @param $title Th title from the message.
     * @param $customer The name of the customer.
     * @param $body The message to send.
     *
     * @return int The ArticleID from the new Article.
     *
     */

    public function createArticle($TicketID, $userId, $userEmail, $title, $customer, $body) {

       $ArticleID = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                         "TicketObject",   "ArticleCreate",
                                                         "TicketID",       $TicketID,
                                                         "ArticleType",    "webrequest",
                                                         "SenderType",     "customer",
                                                         "HistoryType",    "WebRequestCustomer",
                                                         "HistoryComment", "Creado desde GCS Incident System",
                                                         "From",           $customer,
                                                         "Subject",        $title,
                                                         "ContentType",    "text/plain; charset=ISO-8859-1",
                                                         "Body",           $body,
                                                         "UserID",         $userId,
                                                         "Loop",           0,
                                                         "AutoResponseType", 'auto reply',
                                                         "OrigHeader", array(
                                                           'From' => $userEmail,
                                                           'To' => 'Postmaster',
                                                           'Subject' => $title,
                                                           'Body' => $body
                                                         ),
                                                        ));
      return $ArticleID;
    }
}
