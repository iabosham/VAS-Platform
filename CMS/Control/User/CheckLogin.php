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
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../admin/index.php");
    exit();
}


$userInfo = UserControl::checkLogin($username, $password, 2);

if ($userInfo != null) {

    if ($userInfo['status'] == 1) {
        Cookie::setId($userInfo['id']);
        Cookie::setName($userInfo['name']);
        Cookie::setLogin($userInfo['login']);
        Cookie::setUserType($userInfo['user_type']);
        Cookie::setSystemID($userInfo['system_id']);

        header("location: ../../View/Home");
        exit();
    } else {

        General::addError("In active user");
        Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
        session_write_close();
        header("location: ../../admin/index.php");
        exit();
    }
} else {
    General::addError("Check username and password");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../admin/index.php");
    exit();
}
 
