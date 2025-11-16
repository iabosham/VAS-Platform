<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $msisdn = General::clean("msisdn");
 $id = General::clean("id");
   
//Input Validations
 General::isNull($id, "Invalid service subscription value", $errflag);
   
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Subscriber/un_subscribe.php?msisdn=$msisdn");
    exit();
 }

 $isRemoved = ServiceSubscriptionControl::deleteServiceSubscription($id);
 
if($isRemoved){
  
     Session::setSessionValue(Session::$SUCCESS_OPERATION,"Subscriber has been removed from Service successfully... ")  ;
     session_write_close();
     header("location: ../../View/Subscriber/un_subscribe.php?msisdn=$msisdn");
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/Subscriber/un_subscribe.php?msisdn=$msisdn");
     exit();
   
}
 