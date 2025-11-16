<?php

//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
 

require_once('../../SDPAccess/Model/User.php');
require_once('../../SDPAccess/AccessControl/User/UserControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$username = General::clean("username");
$password = General::clean("password");

//Input Validations
General::isNull($username, "Enter user's name", $errflag);
General::isNull($password, "Enter user's password", $errflag);

if (General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError());
    session_write_close();
    header("location: ../../index.php");
    exit();
}


$userInfo = UserControl::checkLogin($username, $password);

if ($userInfo != null) {

    if ($userInfo['status'] == 1) {
        
        Cookie::setId($userInfo['id']);
        Cookie::setName($userInfo['name']);
        Cookie::setLogin($userInfo['username']);
        Cookie::setUserType($userInfo['country_id']);
        Cookie::setCompanyID($userInfo['id']);
        Cookie::setCompanyName($userInfo['name']);  
        Cookie::setPrefix($userInfo['num_pre_hint']); 
        Cookie::setSystemID($userInfo['def_conn']); 
        
        
      header("location: ../../View/Home");
       exit();
    } else {
        General::addError("Inactive user");
        Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError());
        session_write_close();
        header("location: ../../index.php");
        exit();
    }
} else {
    General::addError("Check username and password");
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError());
    session_write_close();
    header("location: ../../index.php");
    exit();
}
 