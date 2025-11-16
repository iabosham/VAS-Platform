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
   
        $serviceId = General::clean("serviceID")  ;
        $keyId = General::clean("keyId")  ;
        General::isNull($keyId, "Invaled key value", $errflag);
        
         
        if(General::getErrorFlage()) {
            Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
            session_write_close();
             header("location: ../../View/Service/service_info.php?id=$serviceId");
            exit();
         }

          
       $isRemoved = ServiceControl::deleteServiceKeyById($keyId);

        if($isRemoved){
        
            header("location: ../../View/Service/service_info.php?id=$serviceId");
            Session::setSessionValue(Session::$SUCCESS_INSERTION,"Service Key has been removed successfully... ")  ;
            session_write_close();
            exit();
    
        }else {
          
            General::addError("System error");
            Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
            session_write_close();
             header("location: ../../View/Service/service_info.php?id=$serviceId");
            exit();
     
        }
 
    
 }  catch (Exception $e){
       
     
 }
 
 