<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');

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
$login = General::clean("login");
$password = General::clean("password");

if(General::clean("status") != null ){
    $status = General::clean("status");
 }else {
    $status = 0 ;

}
  
//Input Validations
General::isNull($name, "Enter vendor's name value", $errflag);
General::isNull($login, "Enter provider login", $errflag);
General::isNull($password, "Enter provider password", $errflag);
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Provider/add_provider.php");
    exit();
 }
 
 $vendorId  = VendorControl::AddVendor($name, 1, $address, $phone,$email, $desc,  Cookie::getUserId()) ;

if($vendorId > 0){
    
    $clientId = ClientControl::AddClient($name, $login, $password, $phone, $email, 1, 1, $vendorId, 1, $status,1, Cookie::getUserId());
    
    if($clientId > 0){
         Session::setSessionValue(Session::$SUCCESS_OPERATION,"Provider has been created successfully... ")  ;
         session_write_close();
         header("location: ../../View/Provider/index.php");
         exit();
     }else {
         General::addError("Error in creating Client");
         Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ; 
         session_write_close();
         header("location: ../../View/Provider/add_provider.php");
         exit();
         
     }
 
     
     
}else {
     General::addError("Check log error");
     Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
     session_write_close();
     header("location: ../../View/Provider/add_provider.php");
     exit();
   
}
 