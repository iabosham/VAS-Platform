<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ReSendConfig.php');
require_once('../../SDPAccess/AccessControl/ReSendConfig/ReSendConfigControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $time= General::clean("time");
 $attemp = General::clean("attemp");
 $serviceId = General::clean("serviceID");
  
//Input Validations
  General::isNull($time, "Enter time value", $errflag);
 General::isNull($attemp, "Enter attemp value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Service/service_info.php?id=$serviceId");
    exit();
 }

 
 $isAlreadyExist = ReSendConfigControl::getReSendConfigInfo($serviceId,$attemp);
 
 $isAdded = false ; 
 
 if($isAlreadyExist == null){
     $isAdded  = ReSendConfigControl::AddReSendConfig($serviceId,$attemp,$time);
 }

if($isAdded){
  
     header("location: ../../View/Service/service_info.php?id=$serviceId");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"ReSending config has been added successfully... ")  ;
    session_write_close();
    exit();
    
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
     session_write_close();
      header("location: ../../View/Service/service_info.php?id=$serviceId");
     exit();
   
}
 