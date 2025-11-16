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
  
  
        
        $comment = General::clean("comment")  ;
        $serviceID = General::clean("serviceID")  ;
        $status = General::clean("status")  ;
        
    
        if(General::getErrorFlage()) {
            Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
            session_write_close();
            header("location: ../../View/Service/service_info.php?id=$serviceID");
            exit();
         }

          
       $isUpdated = ServiceControl::updateServiceStatus($serviceID, $status, $comment, Cookie::getUserId());

        if($isUpdated){
        
            header("location: ../../View/Service/service_info.php?id=$serviceID");
            Session::setSessionValue(Session::$SUCCESS_INSERTION,"Done ... ")  ;
            session_write_close();
            exit();
    
        }else {
          
            General::addError("System error");
            Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
            session_write_close();
            header("location: ../../View/Service/service_info.php?id=$serviceID");
            exit();
     
        }
 
    
 }  catch (Exception $e){
       
     
 }
 
 