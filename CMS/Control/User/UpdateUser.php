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
$name = General::clean("name");
$login = General::clean("login");
$type = General::clean("type");
$phone = General::clean("phone");
$email = General::clean("email");
$secret = General::clean("secret");
 $status = General::clean("status");
 
 $statusFlag = 0 ;

 
 if($status != null){
     $statusFlag = 1 ; 
}
 


//Input Validations
General::isNull($name, "Enter a full name", $errflag);
General::isNull($login, "Enter a login name", $errflag);
General::isNull($type, "Enter a user type", $errflag);
 
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/User/edit_user.php?id=$id");
    exit();
 }


 $isUpdated = UserControl::updateUser($id, $name, $login, $type, $email, $phone,$statusFlag,$secret);

if($isUpdated){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"User has been updated successfully")  ;
    session_write_close();
    header("location: ../../View/User");
    exit();
}else {
    General::addError("Check input values");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/User/edit_user.php?id=$id");
    exit();
   
}
 