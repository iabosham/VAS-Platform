<?php
//Start session
session_start();
include '../../Control/Include/PublicRequirement.php';
 

 include '../../SDPAccess/Model/Service.php';
 include '../../SDPAccess/Model/Subscriber.php';
 include '../../SDPAccess/Model/ServiceSubscription.php';
  
 include '../../SDPAccess/AccessControl/Service/ServiceControl.php';
 include '../../SDPAccess/AccessControl/Subscriber/SubscriberControl.php';
 include '../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php';
   
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;
$isAdded = false ;


 try{
  
  
        
        $serviceId= General::clean("serviceId")  ;
        $customers = General::clean("customers")  ;
        
       
        
        $array= explode( "\n", $customers );
        
         //print_r($array);
        //print_r($array);
       
        General::isNull($serviceId, "Enter Service name value", $errflag);
        General::isNull($customers, "Enter Service code value", $errflag);
         
         
        if(General::getErrorFlage()) {
            Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
            session_write_close();
            header("location: ../../View/Bulk/register_customer.php");
            exit();
         }
         
         if($array !=null){
             
             foreach ($array as $object){
                 
               
                 $number = str_replace(" ", "",$object);
                 
                // if(strlen($number) == 11 ){
                     
                     $subscriberId = 0; 
                     
                    $subscriberInfo =  SubscriberControl::getSubscriberInfoByNumber($number);
                    
                    if($subscriberInfo != null){
                        $subscriberId = $subscriberInfo['id'];
                    }else {
                        $subscriberId = SubscriberControl::AddSubscriber($number);
                    }
                    
                    if($subscriberId > 0){
                        
                       $subscriptionInfo = ServiceSubscriptionControl::getServiceSubscriptionInfo($subscriberId, $serviceId);
                        
                       if($subscriptionInfo != null){
                          $isAdded = -5; 
                         
                       }else {
                         $isAdded = ServiceSubscriptionControl::AddServiceSubscription($subscriberId, $serviceId,$number);
  
                       }
                      
                     
                    }
                     
               //  }else {
                //     echo "sssssssss". $number ;
               //  }
             }
            
            
        }
 
 
    
 }  catch (Exception $e){
       
     
 }
 
 if($isAdded){
     
            Session::setSessionValue(Session::$SUCCESS_OPERATION, "Done")  ;
            session_write_close();
            header("location: ../../View/Bulk/register_customer.php");
            exit();
            
 }else {
     
            Session::setSessionValue(Session::$ENVALED_OPERATION,"Error")  ;
            session_write_close();
            header("location: ../../View/Bulk/register_customer.php");
            exit();
 }
 
 