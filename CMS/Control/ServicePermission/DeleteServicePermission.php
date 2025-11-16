<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServicePermission.php');
require_once('../../SDPAccess/AccessControl/ServicePermission/ServicePermissionControl.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $id = General::cleanGet("id");
   
//Input Validations
 General::isNull($id, "Enter  a valid Service value", $errflag);
   
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ServicePermission");
    exit();
 }

 $isDeleted = ServicePermissionControl::deleteServicePermission($id);
   
if($isDeleted){
    header("location: ../../View/ServicePermission");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service permission has been deleted successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Can't delete");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ServicePermission");
    exit();
   
}
 