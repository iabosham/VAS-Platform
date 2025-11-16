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
$id = General::clean("id");
$password = General::clean("password");
$comfirmpassword = General::clean("comfirmpassword");
  
 
//Input Validations
General::isNull($password, "Enter client's password value", $errflag);
General::isNull($comfirmpassword, "Enter client's confirm password value", $errflag);

 
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
     header("location: ../../View/Client/reset_password.php?id=$id ");
    exit();
 }


 $isAdded  = ClientControl::RestClientPassword($password,$id) ;

if($isAdded){
     header("location: ../../View/Client");
     
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
     session_write_close();
     header("location: ../../View/Client/reset_password.php");
     exit();
   
}
 