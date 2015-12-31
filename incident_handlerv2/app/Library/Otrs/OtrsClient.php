<?php

namespace App\Library\Otrs;

use Exception;
use SoapClient;
use SoapFault;

class OtrsClient
{
    private $url;
    private $username;
    private $password;
    private $agent;
    private $client;

    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Constructor de la clase, donde se definen la URL y credenciales para las consultas SOAP
     */
    public function __construct()
    {
        $this->url = env('OTRS_HOST');
        $this->username = env('OTRS_SOAP_USER');
        $this->password = env('OTRS_SOAP_PASS');
        $this->agent = env('OTRS_AGENT');

        $this->client = new SoapClient(null, array('location' => $this->url,
            'uri' => "Core",
            'trace' => 1,
            'exceptions' => true,
            'login' => $this->username,
            'password' => $this->password,
            'style' => SOAP_RPC,
            'use' => SOAP_ENCODED));
    }

    /**
     * Respuesta común cuando el resultado no tiene elementos
     *
     * @return array
     */
    private function noDataResponse()
    {
        return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
    }

    /**
     * Formatea un objeto Json a un arreglo de parámetros para un objeto
     *
     * @param $data
     * @return array
     */
    private function formatOtrsArray($data)
    {
        $arrayInfo = array();
        $i = 0;
        foreach ($data as $name => $value) {
            if (false !== strpos($name, "s-gensym")) {
                $temp[$i] = $value;
                if ($i % 2 != 0) {
                    $v = $temp[$i - 1];
                    $arrayInfo[$v] = $value;
                }
                $i++;
            }
        }
        return $arrayInfo;
    }

    /**+
     * Devuelve una lista con los datos de los clientes
     *
     * @return array
     */
    public function getCustomerUsers()
    {
        try {
            $customersList = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "CustomerUserObject", "CustomerSearch",
                    "UserLogin", "*",
                )
            );
            if (sizeof($customersList) > 0) {
                $tmpCustomerInfo = $this->formatOtrsArray($customersList);
                if (sizeof($tmpCustomerInfo) > 0) {
                    $CustomerInfo = array();
                    $i = 0;
                    foreach ($tmpCustomerInfo as $k => $v) {
                        $CustomerInfo[$i] = array("UserName" => $k, "Name" => $v);
                        $i++;
                    }
                    $CustomerInfo["response_status"] = 0;
                    return $CustomerInfo;
                } else
                    return $this->noDataResponse();
            } else
                return $this->noDataResponse();
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Customer::getCustomerUsers().");
        }
    }

    /**
     * Devuelve el ID del cliente, buscándolo por su nombre de cliente
     *
     * @param $customerName
     * @return array
     */
    public function getCustomerId($customerName)
    {
        try {
            $customerID = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "CustomerUserObject", "CustomerIDs",
                    "User", $customerName,
                )
            );
            return $this->returnSoapData($customerID);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Customer::getById().");
        }
    }

    /**
     * Devuelve la información completa de un cliente
     *
     * @param $customerName
     * @return array
     */
    public function getCustomerInfo($customerName)
    {
        try {
            $customerInfo = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "CustomerUserObject", "CustomerUserDataGet",
                    "User", $customerName,
                )
            );
            return $this->returnSoapData($customerInfo);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Customer::getInfo().");
        }
    }

    /**
     * Crea un artículo para el ticket
     *
     * @param $ticketId
     * @param $userId
     * @param $userEmail
     * @param $title
     * @param $customerEmail
     * @param $body
     * @return array
     */
    public function createArticle($ticketId, $userId, $userEmail, $title, $customerEmail, $body)
    {
        try {
            $articleId = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "ArticleCreate",
                "TicketID", $ticketId,
                "ArticleType", "email-notification-int",
                "SenderType", "system",
                "HistoryType", "WebRequestCustomer",
                "HistoryComment", "Creado desde GCS Incident System", //TODO determinar si los parámetros serán enviados al archivo .env
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

            return $this->returnSoapData($articleId);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Article::create().");
        }
    }

    /**
     * Obtiene una lista de los tipos de Sender
     *
     * @return array
     */
    public function getSenderTypes()
    {
        try {

            $senderTypes = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                    "TicketObject", "ArticleSenderTypeList", "Result", "HASH")
            );
            return $this->returnSoapData($senderTypes);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Article::AllSenderTypeList().");
        }
    }

    /**
     * Obtiene una lista de los tipos de artículos
     *
     * @return array
     */
    public function getArticleTypes()
    {
        try {
            $articleTypes = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "ArticleTypeList", "Result", "HASH"
            ));
            return $this->returnSoapData($articleTypes);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Article::AllArticleTypeList().");
        }
    }

    /**
     * Busca un usuario con el campo $field y el patrón $pattern
     *
     * @param $field
     * @param $pattern
     * @return array|mixed
     */
    private function searchUsers($field, $pattern)
    {
        try {
            $users = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "UserObject", "UserSearch",
                    $field, $pattern,
                )
            );
            return $users;
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on User::search().");
        }
    }


    /**
     * Devuelve una lista de todos los usuarios
     *
     * @return array
     */
    public function getUsers()
    {
        try {
            $users = $this->searchUsers("Search", "*");

            if (isset($users['error_code']))
//                throw new Exception($users);
                throw new Exception($users['error_description'], $users['error_code']);

            if (sizeof($users) > 0) {
                $usersL = $this->formatOtrsArray($users);
                $user = array();

                $i = 0;
                foreach ($usersL as $k => $v) {
                    $user[$i] = array("id" => $k, "UserName" => explode(" ", $v)[0], "FirstName" => explode(" ", $v)[1],
                        "LastName" => explode(" ", $v)[2]);
                    $i++;
                }
                $user["response_status"] = 0;
                return $user;
            } else {
                return $this->noDataResponse();
            }
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failes to connect to OTRS on User::getAll().");
        } catch (Exception $e) {
            return array("response_status" => -1, "error_code" => $e->getCode(), "error_description" => $e->getMessage());
        }
    }

    /**
     * Devuelve la información completa de un usuario por su nombre de usuario
     *
     * @param $username
     * @return array
     */
    public function getUserInfo($username)
    {
        try {
            $users = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "UserObject", "GetUserData",
                    "User", $username,
                )
            );
            return $this->returnSoapData($users);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on OtrsClient::getUserInfo().");
        }
    }

    /**
     * Valida si el tamaño de los datos es mayor a cero y de ser así, devuelve un objeto con un campo extra, que es el
     * código de respuesta de la llamada al WebService
     *
     * @param $data
     * @return array
     */
    private function returnSoapData($data)
    {
        if (is_array($data)) {
            $returnData = $this->formatOtrsArray($data);
        } else {
            $returnData = $data;
        }
        $tmpData["response_status"] = 0;
        return $returnData;
    }

    /**
     *
     * Create a ticket in Otrs.
     *
     * @param string $title The Title of the ticket.
     * @param int $priority The priority of the ticket [1-10].
     * @param $customerUserId
     * @param $customerMail
     * @param string $body The text for the article.
     * @return array
     */
    public function createTicket($title, $priority, $customerUserId, $customerMail, $body)
    {
        try {
            $userInfo = $this->getUserInfo($this->agent);

//            \Log::info($userInfo);

            if (isset($userInfo['error_code']))
                throw new Exception($userInfo['error_description'], $userInfo['error_code']);

            # Create a new ticket. The function returns the Ticket ID.
            $ticketId = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "TicketCreate",
                "Title", $title,
                "Queue", "gcs_im_queue", //TODO este campo debe estar activado en el OTRS como una "FILA"
                "Lock", "unlock",
                "PriorityID", $priority,
                "State", "new",
                "CustomerUser", $customerUserId,
                "OwnerID", $userInfo['UserID'],
                "UserID", $userInfo['UserID'],
            ));

//            \Log::info($ticketId);

            # A ticket is not usefull without at least one article. The function create and
            # returns an Article ID.
            $articleId = $this->createArticle($ticketId, $userInfo['UserID'], $userInfo['UserEmail'], $title, $customerMail, $body);

//            \Log::info($articleId);

            if (isset($articleId['error_code']))
//                throw new Exception($articleId);
                throw new Exception($articleId['error_description'], $articleId['error_code']);

            // Use the Ticket ID to retrieve the Ticket Number.
            $ticketNumber = $this->getTicketNumber($ticketId);

            if (isset($ticketNumber['error_code']))
//                throw new Exception($ticketNumber);
                throw new Exception($ticketNumber['error_description'], $ticketNumber['error_code']);

            // Make sure the ticket number is not displayed in scientific notation
            // See http://forums.otrs.org/viewtopic.php?f=53&t=5135
            // $big_integer = 1202400000;
            $formattedTicketNumber = number_format($ticketNumber['TicketNr'], 0, '.', '');

            return array("response_status" => 0, "TicketID" => $ticketId, "ArticleID" => $articleId, "TicketNumber" => $formattedTicketNumber);
        } catch (SoapFault  $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Ticket::create().");
        } catch (Exception $e) {
            return array("response_status" => -1, "error_code" => $e->getCode(), "error_description" => $e->getMessage());
        }
    }

    /**
     * Get the Ticket Number using the TicketID.
     * @param $ticketId
     * @return array
     */
    public function getTicketNumber($ticketId)
    {
        try {
            $ticketNumber = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "TicketNumberLookup",
                "TicketID", $ticketId,
            ));
            return array('TicketNr' => $ticketNumber, "response_status" => 0);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Ticket::getNumber().");
        }
    }

    /**
     * @param $ticketID
     * @return array
     */
    public function getTicketInfo($ticketID)
    {
        try {
            $userInfo = $this->getUserInfo($this->agent);

            if (isset($userInfo['error_code']))
//                throw new Exception($userInfo);
                throw new Exception($userInfo['error_description'], $userInfo['error_code']);

            $ticketInfo = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "TicketGet",
                "TicketID", $ticketID,
                "UserID", $userInfo['UserID'],
            ));
            return $this->returnSoapData($ticketInfo);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Ticket::getInfo().");
        } catch (Exception $e) {
            return array("response_status" => -1, "error_code" => $e->getCode(), "error_description" => $e->getMessage());
        }
    }

    /**
     * Cierra un ticket
     *
     * @param $ticketID
     * @param $message
     * @return array
     */
    public function closeTicket($ticketID, $message)
    {
        try {

            $userInfo = $this->getUserInfo($this->agent);

            if (isset($userInfo['error_code']))
//                throw new Exception($userInfo);
                throw new Exception($userInfo['error_description'], $userInfo['error_code']);

            $ticketInfo = $this->getTicketInfo($ticketID);

            if (isset($ticketInfo['error_code']))
//                throw new Exception($ticketInfo);
                throw new Exception($ticketInfo['error_description'], $ticketInfo['error_code']);

            $customerInfo = $this->getCustomerInfo($ticketInfo['CustomerUserID']);

            if (isset($customerInfo['error_code']))
//                throw new Exception($customerInfo);
                throw new Exception($customerInfo['error_description'], $customerInfo['error_code']);


            $articleID = $this->createArticle($ticketID, $userInfo['UserID'], $userInfo['UserEmail'], $ticketInfo['Title'], $customerInfo['UserEmail'], $message);

            if (isset($articleID['error_code']))
//                throw new Exception($articleID);
                throw new Exception($articleID['error_description'], $articleID['error_code']);

            $success1 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "TicketStateSet",
                "State", "closed successful",
                "TicketID", $ticketID,
                "ArticleID", $articleID['ArticleID'],
                "UserID", $userInfo['UserID']
            ));

            //TODO ¿En verdad es necesario bloquear el ticket una vez cerrado?
            $success2 = $this->client->__soapCall("Dispatch", array($this->username, $this->password,
                "TicketObject", "TicketLockSet",
                "Lock", "lock",
                "TicketID", $ticketID,
                "UserID", $userInfo['UserID']
            ));

            if ($success1 && $success2)
                return array("response_status" => 0);
            else
                return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Ticket::close()");
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => $s->getCode(), "error_description" => $s->getMessage() . " -- Failed to connect to OTRS on Ticket::close().");
        } catch (Exception $e) {
            return array("response_status" => -1, "error_code" => $e->getCode(), "error_description" => $e->getMessage());
        }
    }

    /**
     * Devuelve una lista de las opciones de prioridad para un ticket
     *
     * @return array
     */
    public function getTicketPriorities()
    {
        try {
            $priorities = $this->client->__soapCall("Dispatch", array($this->username, $this->password, "Priority", "PrioList", "Valid", 1,));
            return $this->returnSoapData($priorities);
        } catch (SoapFault $e) {
            return array("response_status" => -1, "error_code" => $e->getCode(), "error_description" => $e->getMessage() . " -- Failed to connect to OTRS on Ticket::getPriorities().");
        }
    }
}