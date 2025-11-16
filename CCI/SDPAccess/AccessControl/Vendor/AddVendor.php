<?php
//Start session
session_start();
require_once('../../Common/General.php');
require_once('../../Common/Cookie.php');
require_once('../../Common/Session.php');
require_once('../../Model/DBConnection.php');
require_once('../../Model/Vendor.php');
require_once('../../Control/Vendor/VendorControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$name = General::clean("name");
$address = General::clean("address");
$phone = General::clean("phone");
$email= General::clean("email");
$desc = General::clean("desc");

if(General::clean("status") != null ){
    $status = General::clean("status");
 }else {
    $status = 0 ;

}
  
//Input Validations
General::isNull($name, "Enter vendor's name value", $errflag);
 General::isNull($address, "Enter address value", $errflag);
General::isNull($phone, "Enter phone value", $errflag);
General::isNull($email, "Enter email value", $errflag);
General::isNull($desc, "Enter description value", $errflag);
  
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
    header("location: ../../View/Vendor/reg_vendor.php");
    exit();
 }


 $isAdded  = VendorControl::AddVendor($name, $status, $address, $phone,$email, $desc,  Cookie::getUserId()) ;

if($isAdded){
  
    header("location: ../../View/Vendor/index.php");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Vendor has been added successfully... ")  ;
     session_write_close();
    exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
     session_write_close();
     //header("location: ../../View/Vendor/reg_vendor.php");
     //exit();
   
}
 