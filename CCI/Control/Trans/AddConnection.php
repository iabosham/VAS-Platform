<?php
//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/TransDataSource.php');
 
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $connectionId = General::clean("connectionId");
 $transId = General::clean("transId");
  
//Input Validations
 General::isNull($connectionId, "Enter  a valid connection value", $errflag);
 General::isNull($transId, "Enter trans value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Trans/info.php?id=$transId");
    exit();
 }

$transData = new TransDataSource();

$isAdded = $transData->insertTransConnectionData($transId, $connectionId);
$transData->close();
   
if($isAdded){
    header("location: ../../View/Trans/info.php?id=$transId");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Connection has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Check log error");
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Trans/info.php?id=$transId");
    exit();
   
}
 