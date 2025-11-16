<?php

//Start session
session_start();

require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServicePermission.php');
require_once('../../SDPAccess/AccessControl/ServicePermission/ServicePermissionControl.php');

require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$serviceId = General::clean("serviceId");
$subServiceId = General::clean("subServiceId");
$providerId = General::clean("providerId");


//Input Validations
General::isNull($providerId, "Enter the provider value", $errflag);
General::isNull($subServiceId, "Enter the service value", $errflag);



if (General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/ServicePermission/index.php");
    exit();
}

$isAdded = false;
if ($subServiceId > 0) {

    $info = ServicePermissionControl::getServicePermissionInfo($subServiceId, $providerId);

    if ($info == null) {
        $isAdded = ServicePermissionControl::AddServicePermission($subServiceId, $providerId);
    } else {
        $isAdded = true;
    }
} else {
    $subServices = SubContentControl::getSubContents($serviceId);

    if ($subServices != null) {
        foreach ($subServices as $subService) {

            $info = ServicePermissionControl::getServicePermissionInfo($subService['id'], $providerId);

            if ($info == null) {
                $isAdded = ServicePermissionControl::AddServicePermission($subService['id'], $providerId);
            } else {
                $isAdded = true;
            }
        }
    }
}


if ($isAdded) {
    Session::setSessionValue(Session::$SUCCESS_OPERATION, "Permission has been granted successfully");
    session_write_close();
    header("location: ../../View/ServicePermission/index.php?providerId=$providerId");
    exit();
} else {
    General::addError("System Error ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/ServicePermission/index.php");
    exit();
}
 