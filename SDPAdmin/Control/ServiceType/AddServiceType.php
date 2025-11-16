<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceType.php');
require_once('../../SDPAccess/AccessControl/ServiceType/ServiceTypeControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $name = General::clean("name");
 $code = General::clean("code");
  
//Input Validations
 General::isNull($name, "Enter ServiceType name value", $errflag);
 General::isNull($code, "Enter ServiceType code value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ServiceType/reg_service_type.php");
    exit();
 }


 $isAdded  = ServiceTypeControl::AddServiceType($name,$code,Cookie::getUserId());

if($isAdded){
  
    header("location: ../../View/ServiceType/index.php");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service Type has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/ServiceType/reg_service_type.php");
     exit();
   
}
 