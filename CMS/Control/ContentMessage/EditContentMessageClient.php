<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $id = General::clean("id");
 $msg = General::clean("msg");
 $orderId = General::clean("orderId");
 $sendDate = General::clean("sendDate");
 $status = 0;
 
  
//Input Validations
General::isNull($msg, "Enter a message", $errflag);
General::isNull($sendDate, "Enter sending time", $errflag);


 if (strlen($msg) > 3000) {
         General::addError("Invalid Message Size: ".strlen($msg)." -> max length is 3000 ");
   } 
 
 

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Content/edit_content.php?id=$id");
    exit();
}


 $isUpdated = ContentMessageControl::updateContentMessage($msg, $orderId, $sendDate, 0, $status , $id);
if($isUpdated){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Message has been updated successfully")  ;
    session_write_close();
    header("location: ../../View/ContentMessage/index.php");
    exit();
}else {
    General::addError("No changes ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ContentMessage/edit_content.php?id=$id");
    exit();
   
}
 