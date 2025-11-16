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
$id = General::clean("id");
$password = General::clean("password");
$comfirmpassword = General::clean("comfirmpassword");

//Input Validations
General::isNull($password, "Enter client's password value", $errflag);
General::isNull($comfirmpassword, "Enter client's confirm password value", $errflag);

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
     header("location: ../../View/User/Chan_password.php");
    exit();
 }


$user = new User() ;
$isAdded  =  $user->changeUserPasswordData($id, $password);

if($isAdded){
     header("location: ../../View/User");
     
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
     session_write_close();
     header("location: ../../View/User/Chan_password.php");
     exit();
   
}