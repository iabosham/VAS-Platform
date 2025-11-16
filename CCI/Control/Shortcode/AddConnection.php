<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SMPPConnectionDataSource.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $connectionId = General::clean("connectionId");
 $shortcodeId = General::clean("shortcodeId");
  
//Input Validations
 General::isNull($connectionId, "Enter  a valid connection value", $errflag);
 General::isNull($shortcodeId, "Enter short code value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    exit();
 }

$smppConn = new SMPPConnectionDataSource();

$isAdded = $smppConn->insertShortcodeConnectionData($shortcodeId, $connectionId);
$smppConn->close();
   
if($isAdded){
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Connection has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Check log error");
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    exit();
   
}
 