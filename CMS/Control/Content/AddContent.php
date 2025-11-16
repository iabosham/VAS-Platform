<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $title = General::clean("title");
 $status = General::clean("status");

$statusFlag = 0 ;
 
//Input Validations
General::isNull($title, "Enter a content title", $errflag);

if($status != null){
     $statusFlag = 1 ; 
}
 

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Content/add_content.php");
    exit();
 }


 $isAdded = ContentControl::AddContent($title, $statusFlag);

if($isAdded){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service has been added successfully")  ;
    session_write_close();
    header("location: ../../View/Content");
    exit();
}else {
    General::addError("System Error ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Content/reg_user.php");
    exit();
   
}
 