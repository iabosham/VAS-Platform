<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SystemMessage.php');
require_once('../../SDPAccess/AccessControl/SystemMessage/SystemMessageControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $message = General::clean("message");
 $desc = General::clean("desc");
 $code = General::clean("code");
  
//Input Validations
 General::isNull($message, "Enter message value", $errflag);
 General::isNull($desc, "Enter description value", $errflag);
 General::isNull($code, "Enter message code value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/SystemMessage/reg_message.php");
    exit();
 }


 $isAdded  = SystemMessageControl::AddSystemMessage($message, $code, $desc);

if($isAdded){
  
     header("location: ../../View/SystemMessage/index.php");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"System message has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
      header("location: ../../View/SystemMessage/reg_message.php");
     exit();
   
}
 