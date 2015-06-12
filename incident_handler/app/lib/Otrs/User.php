<?php

namespace Otrs;

class User extends Otrs
{

    public function __construct()
    {
        parent::__construct();
    }


    private function search($field, $pattern)
    {

        try {
            $usersList = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "UserObject", "UserSearch",
                    $field, $pattern,
                )
            );
            return $usersList;
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on User::search().");
        }
    }


    /*
     * Search for all users.
     *
     * @return array([id] => int, [UserName] => string, [FirstName] => string, [LastName] => string ) An array with all the users.
     *
     */
    public function getAll()
    {

        try {
            $search = "*";
            $usersList = $this->search("Search", "*");

            if (isset($usersList['error_code']))
                throw new Exception($usersList);

            if (sizeof($usersList) > 0) {
                $ul = $this->formatOtrsArray($usersList);
                $userData = array();

                $i = 0;
                foreach ($ul as $k => $v) {
                    $us = explode(" ", $v)[0];
                    $nm = explode(" ", $v)[1];
                    $userData[$i] = array("id" => $k, "UserName" => explode(" ", $v)[0], "FirstName" => explode(" ", $v)[1],
                        "LastName" => explode(" ", $v)[2]);
                    $i++;
                }
                $userData["response_status"] = 0;
                return $userData;
            } else {
                return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
            }
        } catch (Exception $e) {
            return array("response_status" => -1, "error_code" => $e["error_code"], "error_description" => $e["error_description"]);
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failes to connect to OTRS on User::getAll().");
        }
    }


    /*
     * Get the information from a user
     *
     * @param string $user Username to search.
     *
     * @return array(UserInfo). Array with all the Information from the user.
     */
    public function getInfo($user)
    {
        /*
        $usersList = $this->userSearch("UserLogin",$user);

        if (sizeof($usersList) > 0){
          $ul = $this->formatOtrsArray($usersList);
          $userData = array();
          $i = 0;
          foreach($ul as $k=>$v){
            $us = explode(" ", $v)[0];
            $nm = explode(" ", $v)[1];
            $userData[$i] = array("id" => $k, "UserName" => explode(" ", $v)[0], "FirstName" => explode(" ", $v)[1],
                                  "LastName" => explode(" ", $v)[2]);
            $i++;
          }
          return $userData;
        } else {
          return array("error_code" => 0, "error_description" => "No data.");
        }
        */

        try {
            $usersList = $this->client->__soapCall("Dispatch",
                array($this->username, $this->password,
                    "UserObject", "GetUserData",
                    "User", $user,
                )
            );
            if (sizeof($usersList) > 0) {
                $tmpData = $this->formatOtrsArray($usersList);
                $tmpData["response_status"] = 0;
                return $tmpData;
            } else
                return array("response_status" => 0, "error_code" => 0, "error_description" => "No data.");
        } catch (SoapFault $s) {
            return array("response_status" => -1, "error_code" => 1, "error_description" => "Failed to connect to OTRS on User::getInfo().");
        }
    }
}
