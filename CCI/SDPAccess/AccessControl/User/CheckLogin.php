<?php
//Start session
session_start();
require_once('../../Common/General.php');
require_once('../../Common/Cookie.php');
require_once('../../Common/Session.php');
require_once('../../Model/DBConnection.php');
require_once('../../Model/User.php');

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

if(General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
    header("location: ../../index.php");
    exit();
 }


$user = new User() ;
$userInfo  =  $user->checkLogin($username, $password);

if($userInfo != null){
    Cookie::setId($userInfo['id']) ;
    Cookie::setName($userInfo['name']) ;
    Cookie::setLogin($userInfo['login']) ;
    Cookie::setUserType($userInfo['user_type']) ;
    
    header("location: ../../View/Service");
    exit();
}else {
     General::addError("Check username and password");
    Session::setSessionValue(Session::$ENVALED_LOGIN, General::getError())  ;
    session_write_close();
    header("location: ../../index.php");
     exit();
   
}
 