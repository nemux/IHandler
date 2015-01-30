<?php

namespace Otrs;

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

    public function create($TicketID, $userId, $userEmail, $title, $customerEmail, $body) {

       $ArticleID = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                         "TicketObject",   "ArticleCreate",
                                                         "TicketID",       $TicketID,
                                                         "ArticleType",    "email-notification-int",
                                                         "SenderType",     "system",
                                                         "HistoryType",    "WebRequestCustomer",
                                                         "HistoryComment", "Creado desde GCS Incident System",
                                                         "From",           'GCS-IM System <gcs_im@globalcybersec.com>',
                                                         'To', $customerEmail,
                                                         "Subject",        $title,
                                                         "ContentType",    "text/html; charset=UTF-8",
                                                         "Body",           $body,
                                                         "UserID",         $userId,
                                                         "HistoryComment", 'Ticket generado por el Sistema GCS-IM',
                                                         "OrigHeader", array(
                                                           'From' => $userEmail,
                                                           'To' => $customerEmail,
                                                           'Subject' => $title,
                                                           'Body' => $body
                                                         ),
                                                        ));
      return $ArticleID;
    }

  public function AllSenderTypeList(){

     $SenderTypeList = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                         "TicketObject",   "ArticleSenderTypeList",
                                                         "Result", "HASH"
                                                         ));

    return $this->formatOtrsArray($SenderTypeList);
  }

  public function AllArticleTypeList(){
     $ArticleTypeList = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                                                         "TicketObject",   "ArticleTypeList",
                                                         "Result", "HASH"
                                                         ));
    return $this->formatOtrsArray($ArticleTypeList);
  }
}
