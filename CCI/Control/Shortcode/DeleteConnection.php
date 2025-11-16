<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ShortcodeConnection.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $id = General::cleanGet("id");
 $shortcodeId = General::cleanGet("shortcodeId");
  
//Input Validations
 General::isNull($id, "Enter  a valid connection value", $errflag);
 General::isNull($shortcodeId, "Enter short code value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    exit();
 }

$smppConn = new ShortcodeConnectionDataSource();

$isDeleted = $smppConn->deleteConnectionData($id);
$smppConn->close();
   
if($isDeleted){
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Connection has been removed successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Check log error");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    exit();
   
}
 