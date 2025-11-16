<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');
require_once('../../Control/Shortcode/ShortcodeService.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $title = General::clean("title");
 $code = General::clean("code");
 $vendorID = General::clean("vendorID");
 $companyId = General::clean("companyId");
 
 
//Input Validations
 General::isNull($title, "Enter Shortcode title value", $errflag);
 General::isNull($code, "Enter Shortcode number value", $errflag);
 General::isNull($vendorID, "Enter vendor value", $errflag);
 General::isNull($companyId, "Enter company value", $errflag);
 
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Shortcode/reg_shortcode.php");
    exit();
 }
 
 $isAdded  = ShortcodeControl::AddShortcode($title,$code, $vendorID,Cookie::getUserId(),$companyId);

if($isAdded){
  
     header("location: ../../View/Shortcode/index.php");
     Session::setSessionValue(Session::$SUCCESS_OPERATION,"Service has been added successfully... ")  ;
     session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/Shortcode/reg_shortcode.php");
     exit();
   
   }
 