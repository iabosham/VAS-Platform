<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$name = General::clean("name");
$login = General::clean("login");
$email = General::clean("email");
$phone = General::clean("phone");
$secret = General::clean("secret");
$vendorID = General::clean("vendorID");
 
//Input Validations
General::isNull($name, "Enter client's name value", $errflag);
General::isNull($login, "Enter login value", $errflag);
General::isNull($email, "Enter email value", $errflag);
General::isNull($phone, "Enter phone value", $errflag);
General::isNull($secret, "Enter secret value", $errflag);
General::isNull($vendorID, "Enter vendor value", $errflag);
 
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
    header("location: ../../SDPAccess/View/Client/reg_client.php");
    exit();
 }


 $isAdded  = ClientControl::AddClient($name, $login, $secret, $phone, $email, 1, 1, $vendorID,1,1,1, Cookie::getUserId()) ;

if($isAdded){
  
    header("location: ../../View/Client/index.php");
    
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
     session_write_close();
     header("location: ../../View/Client/reg_client.php");
     exit(); 
   
}
 