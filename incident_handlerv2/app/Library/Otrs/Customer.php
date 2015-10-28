<?php

namespace Otrs;

use stdClass;

class Customer extends Otrs
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Get all the Customers from OTRS.
    *
    * @return array([UserName] =>  string) An array with all the users.
    */
    public function getAll()
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
                    return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
            } else
                return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Customer::getAll().");
        }
    }


    /*
     * Get the CustomerID from the UserName.
     *
     * @param string $id The UserName to get de CustomerID.
     *
     * @return string Return the CustomerID.
     */
    public function getById($id)
    {
        try {
            $customerID = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "CustomerUserObject", "CustomerIDs",
                    "User", $id,
                )
            );
            if (sizeof($customerID) > 0) {
                $customerID["response_status"] = 0;
                return $customerID;
            } else
                return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Customer::getById().");
        }
    }


    /*
     * Get the informacion costumer.
     *
     * @param string $user The Username or UserID from OTRS.
     *
     * @return stdClass Returns the data from the user.
     */
    public function getInfo($user)
    {

        try {
            $customerInfo = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "CustomerUserObject", "CustomerUserDataGet",
                    "User", $user,
                )
            );
            //return $this->formatOtrsArray($customerInfo);
            if (sizeof($customerInfo) > 0) {
                $userInfoTmp = $this->formatOtrsArray($customerInfo);
                $userInfo = array();
                $userInfo['UserEmail'] = $userInfoTmp['UserEmail'];
                $userInfo['UserFirstname'] = $userInfoTmp['UserFirstname'];
                $userInfo['UserStreet'] = $userInfoTmp['UserStreet'];
                $userInfo['UserCountry'] = $userInfoTmp['UserCountry'];
                $userInfo['UserComment'] = $userInfoTmp['UserComment'];
                $userInfo['UserRefreshTime'] = $userInfoTmp['UserRefreshTime'];
                $userInfo['UserID'] = $userInfoTmp['UserID'];
                $userInfo['UserCity'] = $userInfoTmp['UserCity'];
                $userInfo['UserFax'] = $userInfoTmp['UserFax'];
                $userInfo['ValidID'] = $userInfoTmp['ValidID'];
                $userInfo['UserMobile'] = $userInfoTmp['UserMobile'];
                $userInfo['UserLogin'] = $userInfoTmp['UserLogin'];
                $userInfo['UserZip'] = $userInfoTmp['UserZip'];
                $userInfo['UserPassword'] = $userInfoTmp['UserPassword'];
                $userInfo['UserLastname'] = $userInfoTmp['UserLastname'];
                $userInfo['UserPhone'] = $userInfoTmp['UserPhone'];
                $userInfo['UserTitle'] = $userInfoTmp['UserTitle'];
                $userInfo['UserCustomerID'] = $userInfoTmp['UserCustomerID'];
                $userInfo['UserShowTickets'] = $userInfoTmp['UserShowTickets'];
                $userInfo['UserShowTickets'] = $userInfoTmp['UserShowTickets'];
                //$userInfo->UserLanguage = $userInfoTmp['UserLanguage'];
                $userInfo['Source'] = $userInfoTmp['Source'];
                $userInfo['response_status'] = 0;
                return $userInfo;

            } else {
                return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
            }
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on Customer::getInfo().");
        }
    }
}
