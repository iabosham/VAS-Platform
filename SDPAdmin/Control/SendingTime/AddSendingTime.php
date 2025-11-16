<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SendingTime.php');
require_once('../../SDPAccess/AccessControl/SendingTime/SendingTimeControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $time= General::clean("time");
 $order = General::clean("order");
 $serviceId = General::clean("serviceID");
  
//Input Validations
  General::isNull($time, "Enter time value", $errflag);
 General::isNull($order, "Enter order value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Service/service_info.php?id=$serviceId");
    exit();
 }

 
 $isAlreadyExist = SendingTimeControl::getSendingTimeInfo($serviceId,$order);
 
 $isAdded = false ; 
 
 if($isAlreadyExist == null){
     $isAdded  = SendingTimeControl::AddSendingTime($serviceId,$order,$time);
 }else {
     SendingTimeControl::removeSendingTime($isAlreadyExist['id']);
    $isAdded  = SendingTimeControl::AddSendingTime($serviceId,$order,$time);
     
 }

if($isAdded){
  
     header("location: ../../View/Service/service_info.php?id=$serviceId");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Sending has been added successfully... ")  ;
    session_write_close();
    exit();
    
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
     session_write_close();
      header("location: ../../View/Service/service_info.php?id=$serviceId");
     exit();
   
}
 