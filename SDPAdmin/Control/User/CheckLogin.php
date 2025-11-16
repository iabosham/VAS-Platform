<?php

//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Company.php');
require_once('../../SDPAccess/AccessControl/SMPP/CompanyControl.php');


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


$userInfo = UserControl::checkLogin($username, $password, 1);

if ($userInfo != null) {

    if ($userInfo['status'] == 1) {
        Cookie::setId($userInfo['id']);
        Cookie::setName($userInfo['name']);
        Cookie::setLogin($userInfo['login']);
        Cookie::setUserType($userInfo['user_type']);
        Cookie::setCompanyID($userInfo['company_id']);
        
        if($userInfo['company_id'] > 0){
            
           
            
            $companyInfo = CompanyControl::getCompanyInfo($userInfo['company_id']);
            
            if($companyInfo != null){
                Cookie::setCompanyName($companyInfo['name']);  
            }else {
                Cookie::setCompanyName("None");  
            }
            
            
        }else {
            Cookie::setCompanyName("All");  
            
        }

        header("location: ../../View/Shortcode");
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
 