<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/Model/Subscriber.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');
require_once('../../SDPAccess/AccessControl/Subscriber/SubscriberControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $msisdn = General::clean("msisdn");
 $serviceID = General::clean("id");
   
//Input Validations
 General::isNull($serviceID, "Invalid service id value", $errflag);
   
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Home/index.php?msisdn=$msisdn");
    exit();
 }

 ServiceSubscriptionControl::getServiceSubscriptionInfo($subscriberID, $serviceID);
 $subscriberInfo = SubscriberControl::getSubscriberInfoByNumber($msisdn);
 
 if($subscriberInfo != null){
     $subscriberID = $subscriberInfo['id'];
 }else {
     $subscriberID =  SubscriberControl::AddSubscriber($msisdn);
 }
 
  $subscriptionInfo = ServiceSubscriptionControl::getServiceSubscriptionInfo($subscriberID, $serviceID);
  
  if($subscriptionInfo == null){
     $isAdded = ServiceSubscriptionControl::AddServiceSubscription($subscriberID, $serviceID, $msisdn);
  }else {
      $isAdded = false ;
      General::addError("Already subscribed ...");
  }
 
if($isAdded){
  
     Session::setSessionValue(Session::$SUCCESS_OPERATION,"Customer has been added to Service successfully... ")  ;
     session_write_close();
     header("location: ../../View/Home/index.php?msisdn=$msisdn");
    exit();
}else {
     
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/Home/index.php?msisdn=$msisdn");
     exit();
   
}
 