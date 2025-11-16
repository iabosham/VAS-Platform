<?php

//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
$title = General::clean("title");
$status = General::clean("status");
$contentId = General::clean("contentId");

$contentTypeId = General::clean("contentTypeId");
$msgCount = General::clean("msgCount");
$needApproval = General::clean("needApproval");
$desc = General::clean("desc");
$contentLength = General::clean("contentLength");

$statusFlag = 0;
$approveFlag = 0;

//Input Validations
General::isNull($contentId, "Enter a service name", $errflag);
General::isNull($title, "Enter a sub service title", $errflag);

General::isNull($contentTypeId, "Enter a content type", $errflag);
General::isNull($msgCount, "Enter a message count", $errflag);
General::isNull($contentLength, "Enter the content length", $errflag);

if ($status != null) {
    $statusFlag = 1;
}

if ($needApproval != null) {
    $approveFlag = 1;
}

if (General::getErrorFlage()) {
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/SubContent/add_content.php");
    exit();
}


$isAdded = SubContentControl::AddSubContent($title, $statusFlag,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc, $contentId);

if ($isAdded) {
    Session::setSessionValue(Session::$SUCCESS_OPERATION, "Sub Service has been added successfully");
    session_write_close();
    header("location: ../../View/SubContent");
    exit();
} else {
    General::addError("System Error ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/SubContent/add_content.php");
    exit();
}
 