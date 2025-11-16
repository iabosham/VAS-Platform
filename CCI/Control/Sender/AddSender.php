<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Sender.php');
require_once('../../SDPAccess/AccessControl/Sender/SenderControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $name = General::clean("senderName");
 $shortcodeId = General::clean("shortcodeId");
  
//Input Validations
 General::isNull($name, "Enter Sender name value", $errflag);
 General::isNull($shortcodeId, "Enter Short code value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    exit();
 }


 $isAdded  = SenderControl::AddSender($name,$shortcodeId,Cookie::getUserId());

if($isAdded){
  
     header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Sender name has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
     session_write_close();
      header("location: ../../View/Shortcode/info.php?id=$shortcodeId");
     exit();
   
}
 