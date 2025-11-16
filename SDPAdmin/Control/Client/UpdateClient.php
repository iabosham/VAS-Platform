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
$name = General::clean("name");
$login = General::clean("login");
 $phone = General::clean("phone");
$email = General::clean("email");

//Input Validations
General::isNull($name, "Enter a full name", $errflag);
General::isNull($login, "Enter a login name", $errflag);
  
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Client/edit_client.php?id=$id");
    exit();
 }


 $isUpdated = ClientControl::updateClient($id, $name, $login, $email, $phone);

if($isUpdated){
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"client has been updated successfully")  ;
    session_write_close();
    header("location: ../../View/Client");
    exit();
}else {
    General::addError("Check input values");
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Client/edit_client.php?id=$id");
    exit();
   
}
 