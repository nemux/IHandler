<?php

namespace Otrs;

use stdClass;

class Customer extends Otrs {

    public function __construct() {
        parent::__construct();
    }

   /*
   * Get all the Customers from OTRS.
   *
   * @return array([UserName] =>  string) An array with all the users.
   */
  public function getAll(){

    $customersList = $this->client->__soapCall("Dispatch",
                                         array($this->username,$this->password,
                                               "CustomerUserObject","CustomerSearch",
                                               "UserLogin","*",
                                              )
                                         ) ;
    $tmpCustomerInfo = $this->formatOtrsArray($customersList);

    if (sizeof($tmpCustomerInfo) > 0 ){
      $CustomerInfo = array();
      $i = 0;
      foreach($tmpCustomerInfo as $k => $v){
        $CustomerInfo[$i] =  array("UserName" => $k, "Name"=> $v);
        $i++;
      }
      return $CustomerInfo;
    }
    else
      return array("error_code" => 0, "error_description" => "No data.");
  }


  /*
   * Get the CustomerID from the UserName.
   *
   * @param string $id The UserName to get de CustomerID.
   *
   * @return string Return the CustomerID.
   */
  public function getCustomerById($id){
    $customerID = $this->client->__soapCall("Dispatch",
                                         array($this->username,$this->password,
                                               "CustomerUserObject","CustomerIDs",
                                               "User",$id,
                                               )
                                         );
    if (sizeof($customerID) > 0)
      return $customerID;
    else
      return array("error_code" => 0, "error_description" => "No data.");
  }


  /*
   * Get the informacion costumer.
   *
   * @param string $user The Username or UserID from OTRS.
   *
   * @return stdClass Returns the data from the user.
   */
  public function getCustomerInfo($user){
    $customerInfo = $this->client->__soapCall("Dispatch",
                                         array($this->username,$this->password,
                                               "CustomerUserObject","CustomerUserDataGet",
                                               "User",$user,
                                               )
                                         );
    return $this->formatOtrsArray($customerInfo);
    if (sizeof($customerInfo) > 0){
      $userInfoTmp = $this->formatOtrsArray($customerInfo);

      $userInfo = new stdClass();
      $userInfo->UserEmail= $userInfoTmp['UserEmail'];
      $userInfo->UserFirstname = $userInfoTmp['UserFirstname'];
      $userInfo->UserStreet =  $userInfoTmp['UserStreet'];
      $userInfo->UserCountry =  $userInfoTmp['UserCountry'];
      $userInfo->UserComment =  $userInfoTmp['UserComment'];
      $userInfo->UserRefreshTime =  $userInfoTmp['UserRefreshTime'];
      $userInfo->UserID = $userInfoTmp['UserID'];
      $userInfo->UserCity =  $userInfoTmp['UserCity'];
      $userInfo->UserFax =  $userInfoTmp['UserFax'];
      $userInfo->ValidID = $userInfoTmp['ValidID'];
      $userInfo->UserMobile =  $userInfoTmp['UserMobile'];
      $userInfo->UserLogin = $userInfoTmp['UserLogin'];
      $userInfo->UserZip =  $userInfoTmp['UserZip'];
      $userInfo->UserPassword =  $userInfoTmp['UserPassword'];
      $userInfo->UserLastname = $userInfoTmp['UserLastname'];
      $userInfo->UserPhone =  $userInfoTmp['UserPhone'];
      $userInfo->UserTitle = $userInfoTmp['UserTitle'];
      $userInfo->UserCustomerID = $userInfoTmp['UserCustomerID'];
      $userInfo->UserShowTickets = $userInfoTmp['UserShowTickets'];
      $userInfo->UserLanguage = $userInfoTmp['UserLanguage'];
      $userInfo->Source = $userInfoTmp['Source'];
      return $userInfo;
    } else {
      return array("error_code" => 0, "error_description" => "No data.");
    }
  }
}
