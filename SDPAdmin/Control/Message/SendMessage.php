<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

require_once('../../SDPAccess/Model/MessageQueueGeneral.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;
$successFlage  = false;

//POST values
 $serviceId = General::clean("serviceId");
 $msg = General::clean("msg");
 $msisdn= General::clean("msisdn");
   
//Input Validations
 General::isNull($serviceId, "Enter Service  ", $errflag);
 General::isNull($msg, "Enter Message  ", $errflag);
 General::isNull($msisdn, "Enter Phone Number  ", $errflag);
    
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Message/send_message.php");
    exit();
 }

 $serviceInfo = ServiceControl::getServiceInfoById($serviceId);
 
 if($serviceInfo != null){
     
     $msgQueue = new MessageQueueGeneral();
     $messageId = $msgQueue->addMessageData($msisdn, $msg,$serviceInfo['connId'],$serviceInfo['sender_name'], Cookie::getUserId(), $serviceInfo['id'],1);
     $msgQueue->close();
     
     if($messageId > 0 ){
         $successFlage = true; 
      }else {
        General::addError("error while inserting message ");

      }
   
 }else {
     General::addError("Invalid service ");
     
 }
 
 
if($successFlage){
  
     header("location: ../../View/Message/send_message.php");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Message has been posted successfully... ")  ;
    session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
      header("location: ../../View/Message/send_message.php?id=$id");
     exit();
   
}
 