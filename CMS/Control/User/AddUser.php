<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/User.php');
require_once('../../SDPAccess/AccessControl/User/UserControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$name = General::clean("name");
$login = General::clean("login");
$type = General::clean("type");
$password = General::clean("password");
$phone = General::clean("phone");
$email = General::clean("email");

//Input Validations
General::isNull($name, "Enter a full name", $errflag);
General::isNull($login, "Enter a login name", $errflag);
General::isNull($type, "Enter a user type", $errflag);
General::isNull($password, "Enter a password", $errflag);

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/User/add_user.php");
    exit();
 }


 $isAdded = UserControl::addUser($name, $login, $password, $type, $email, $phone,2) ;

if($isAdded){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"User has been added successfully")  ;
    session_write_close();
    header("location: ../../View/User");
    exit();
}else {
    General::addError("Check username and password");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/User/add_user.php");
    exit();
   
}
 