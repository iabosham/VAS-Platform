<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $id = General::cleanGet("id");
   
//Input Validations
 General::isNull($id, "Enter  a valid content value", $errflag);
   
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ContentMessage");
    exit();
 }

 $isDeleted = ContentMessageControl::deleteContentMessage($id);
   
if($isDeleted){
    header("location: ../../View/ContentMessage");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Content has been deleted successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Can't delete");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ContentMessage");
    exit();
   
}
 