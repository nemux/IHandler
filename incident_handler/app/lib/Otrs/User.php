<?php

namespace Otrs;

use stdClass;

class User extends Otrs{

  public function __construct() {
    parent::__construct();
  }


  private function search($field, $pattern){
    $usersList = $this->client->__soapCall("Dispatch",
                                           array($this->username,$this->password,
                                                 "UserObject","UserSearch",
                                                 $field,$pattern,
                                                )
                                           );
    return $usersList;
  }


  /*
   * Search for all users.
   *
   * @return array([id] => int, [UserName] => string, [FirstName] => string, [LastName] => string ) An array with all the users.
   *
   */
  public function getAll(){
    $search = "*";
    $usersList = $this->search("Search","*");
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
  }


  /*
   * Get the information from a user
   *
   * @param string $user Username to search.
   *
   * @return array(UserInfo). Array with all the Information from the user.
   */
  public function getInfo($user){
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

     $usersList = $this->client->__soapCall("Dispatch",
                                           array($this->username,$this->password,
                                                 "UserObject","GetUserData",
                                                 "User",$user,
                                                )
                                           );
    if (sizeof($usersList) > 0)
     return $this->formatOtrsArray($usersList);
    else
      return array("error_code" => 0, "error_description" => "No data.");
  }
}
