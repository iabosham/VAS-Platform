<?php
//Start session
session_start();
include '../../Control/Include/PublicRequirement.php';
 

 include '../../SDPAccess/Model/Service.php';
  
 include '../../SDPAccess/AccessControl/Service/ServiceControl.php';
   
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;


 try{
  
  
        
        $serviceName = General::clean("serviceName")  ;
         $serviceTypeID = General::clean("serviceTypeID")  ;
        $serviceKey = General::clean("serviceKey")  ;
        $shortcodeID = General::clean("shortcodeID")  ;
        $subMessage = General::clean("subMessage")  ;
        $unSubMessage = General::clean("unSubMessage")  ;
        $senderName = General::clean("senderName")  ;
        $freeSource = General::clean("fs")  ;
        $method = General::clean("method")  ;
        $subServiceId = General::clean("subServiceId")  ;
        
        
         
        General::isNull($serviceName, "Enter Service name value", $errflag);
         General::isNull($serviceTypeID, "Enter Service Type value", $errflag);
        General::isNull($serviceKey, "Enter Service key value", $errflag);
        General::isNull($shortcodeID, "Enter shortcode value", $errflag);
        General::isNull($senderName, "Enter sender name value", $errflag);
        General::isNull($freeSource, "Enter 'Free Source' value", $errflag);
        General::isNull($method, "Enter 'Sending Method value", $errflag);
        General::isNull($subServiceId, "Enter sub content value", $errflag);
         
        if(General::getErrorFlage()) {
            Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
            session_write_close();
            header("location: ../../View/Service/reg_service.php");
            exit();
         }

          
       $serviceId= ServiceControl::AddService($serviceName,$serviceTypeID, $serviceKey,$shortcodeID, Cookie::getUserId(),$subMessage,$unSubMessage,$senderName,$freeSource,$method,$subServiceId) ;
       

        if($serviceId > 0){
            
          $isUpdated = ServiceControl::addKey($serviceKey, $serviceId, 1);

        
            header("location: ../../View/Service/index.php");
            Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service  has been added successfully... ")  ;
            session_write_close();
            exit();
    
        }else {
          
            General::addError("System error");
            Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
            session_write_close();
            header("location: ../../View/Service/reg_service.php");
            exit();
     
        }
 
    
 }  catch (Exception $e){
       
     
 }
 
 