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
$id = General::clean("id");
$name = General::clean("name");
$address = General::clean("address");
$phone = General::clean("phone");
$email = General::clean("email");
$desc = General::clean("desc");


//Input Validations
General::isNull($name, "Enter provider's name value", $errflag);


if (General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/Provider/edit_provider.php?id=$id");
    exit();
}

$isUpdated = VendorControl::updateVendor($id, $name, $address, $phone, $email, $desc);

if ($isUpdated) {
    Session::setSessionValue(Session::$SUCCESS_OPERATION, "Provider info has been updated successfully... ");
    session_write_close();
    header("location: ../../View/Provider/index.php");
    exit();
} else {
    General::addError("Not updated ... ");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/Provider/edit_provider.php?id=$id");
    exit();
}
 
 