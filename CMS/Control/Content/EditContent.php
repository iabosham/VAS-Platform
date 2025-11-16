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
 $id = General::clean("id");
 $title = General::clean("title");
 $status = General::clean("status");

$statusFlag = 0 ;
 
//Input Validations
General::isNull($title, "Enter a Service title", $errflag);

if($status != null){
     $statusFlag = 1 ; 
}
 

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Content/edit_content.php?id=$id");
    exit();
 }


 $isUpdated = ContentControl::updateContent($title, $statusFlag,$id);

if($isUpdated){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service has been updated successfully")  ;
    session_write_close();
    header("location: ../../View/Content");
    exit();
}else {
    General::addError("No changes ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Content/edit_content.php?id=$id");
    exit();
   
}
 