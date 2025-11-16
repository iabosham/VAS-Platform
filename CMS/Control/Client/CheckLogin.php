<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$username = General::clean("username");
$password = General::clean("password");

//Input Validations
General::isNull($username, "Enter user's name", $errflag);
General::isNull($password, "Enter user's password", $errflag);

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
    header("location: ../../index.php");
    exit();
 }


 $userInfo  = ClientControl::clientLogin($username, $password);
 print_r($userInfo);

if($userInfo != null){
    CookieClient::setId($userInfo['id']) ;
    CookieClient::setName($userInfo['name']) ;
    CookieClient::setUserType($userInfo['user_type']) ;
    
    if($userInfo['user_type'] == 2){
        
        header("location: ../../View/Inbox/");

    }else {
        header("location: ../../View/ContentMessage/");

    }
        
     
        exit();
}else {
//     General::addError("Check username and password");
//    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
//    session_write_close();
//    header("location: ../../index.php");
//     exit();
   
}
 