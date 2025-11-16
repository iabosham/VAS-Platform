<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/Model/GeneralQueue.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');
require_once('../../SDPAccess/AccessControl/GeneralQueue/GeneralQueueControl.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $msisdn = General::clean("msisdn");
 $id = General::clean("id");
 $serviceId = General::clean("serviceId");
 
   
//Input Validations
 General::isNull($id, "Invalid service subscription value", $errflag);
   
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Home/index.php?msisdn=$msisdn");
    exit();
 }

 $isRemoved = ServiceSubscriptionControl::deleteServiceSubscription($id);
 
if($isRemoved){
    
    $serviceInfo = ServiceControl::getServiceInfoById($serviceId);
    
    $messageInfo = array();
    $messageInfo['message'] = $serviceInfo['unsub_message'];
    $messageInfo['msisdn'] = $msisdn;
    $messageInfo['sourceAddress'] = "Info";
    $messageInfo['connId'] = Cookie::getSystemID();
    
     GeneralQueueControl::addMessage($messageInfo);
    
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Customer has been removed successfully from Service ... ")  ;
    session_write_close();
    header("location: ../../View/Home/index.php?msisdn=$msisdn");
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/Home/index.php?msisdn=$msisdn");
     exit();
   
}
 