<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');

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
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Vendor/reg_vendor.php");
    exit();
 }
 
 
  $publicKey =  General::getFileString("publicKey","Enter A public key file ");
  $privateKey =  General::getFileString("privateKey","Enter A public key file ");
                 
 

 $isAdded  = VendorControl::AddVendor($name, $status, $address, $phone,$email, $desc,  Cookie::getUserId(),$publicKey,$privateKey) ;

if($isAdded){
  
     header("location: ../../View/Vendor/index.php");
     Session::setSessionValue(Session::$SUCCESS_INSERTION,"Vendor has been added successfully... ")  ;
     session_write_close();
     exit();
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
     session_write_close();
     header("location: ../../View/Vendor/reg_vendor.php");
     exit();
   
}
 