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
 $id = General::clean("id");
 $title= General::clean("title");
  
//Input Validations
 General::isNull($id, "Enter  a valid id value", $errflag);
 General::isNull($title, "Enter title value", $errflag);
  
   
if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Trans/index.php");
    exit();
 }

$transData = new TransDataSource();

$isAdded = $transData->addTransData($id, $title);
$transData->close();
   
if($isAdded){
    header("location: ../../View/Trans/index.php");
    Session::setSessionValue(Session::$SUCCESS_INSERTION,"Connection has been added successfully... ")  ;
    session_write_close();
    exit();
}else {
    General::addError("Check log error");
    Session::setSessionValue(Session::$ENVALED_INSERTION, General::getError())  ;
    session_write_close();
    header("location: ../../View/Trans/index.php");
    exit();
   
}
 