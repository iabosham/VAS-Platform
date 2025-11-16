<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Message.php');
require_once('../../SDPAccess/AccessControl/Message/MessageControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $id = General::clean("id");
 $message = General::clean("message");
 $status = General::clean("status");
   
//Input Validations
 General::isNull($id, "Enter message value", $errflag);
 General::isNull($message, "Enter message value", $errflag);
    
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Message/edit_message.php?id=$id");
    exit();
 }


 if($status == 2){
     $status = 0 ; 
 }
$isUpdated = MessageControl::updateTextAndStatus($id,$status,$message );  

if($isUpdated){
  
     header("location: ../../View/Message/index.php");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Message has been updated successfully... ")  ;
    session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
      header("location: ../../View/Message/edit_message.php?id=$id");
     exit();
   
}
 