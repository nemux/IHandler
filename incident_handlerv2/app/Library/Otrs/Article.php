<?php

namespace Otrs;

use stdClass;

class Article extends Otrs
{

    public function __construct()
    {
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
     * @return array('ArticleID' => $ArticleID, 'response_status' => '0')
     *
     */

    public function create($TicketID, $userId, $userEmail, $title, $customerEmail, $body)
    {

        try {
            $ArticleID = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "ArticleCreate",
                "TicketID", $TicketID,
                "ArticleType", "email-notification-int",
                "SenderType", "system",
                "HistoryType", "WebRequestCustomer",
                "HistoryComment", "Creado desde GCS Incident System",
                "From", 'GCS-IM System <csirt@globalcybersec.com>',
                'To', $customerEmail,
                "Subject", $title,
                "ContentType", "text/html; charset=UTF-8",
                "Body", $body,
                "UserID", $userId,
                "HistoryComment", 'Ticket generado por el Sistema GCS-IM',
                "OrigHeader", array(
                    'From' => $userEmail,
                    'To' => $customerEmail,
                    'Subject' => $title,
                    'Body' => $body
                ),
            ));
            return array('ArticleID' => $ArticleID, 'response_status' => 0);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Article::create().");
        }
    }

    public function AllSenderTypeList()
    {

        try {

            $SenderTypeList = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "ArticleSenderTypeList",
                "Result", "HASH"
            ));

            $tmpData = $this->formatOtrsArray($SenderTypeList);
            $tmpData["response_status"] = 0;
            return $tmpData;
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Article::AllSenderTypeList().");
        }
    }

    public function AllArticleTypeList()
    {
        try {
            $ArticleTypeList = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "ArticleTypeList",
                "Result", "HASH"
            ));
            $tmpData = $this->formatOtrsArray($ArticleTypeList);
            $tmData["response_status"] = 0;
            return $tmData;
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Article::AllArticleTypeList().");
        }
    }
}
