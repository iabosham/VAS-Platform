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
$id = General::clean("id");
$title = General::clean("title");
$status = General::clean("status");
$contentId = General::clean("contentId");

$contentTypeId = General::clean("contentTypeId");
$msgCount = General::clean("msgCount");
$needApproval = General::clean("needApproval");
$desc = General::clean("desc");
$contentLength = General::clean("contentLength");

$statusFlag = 0;$approveFlag = 0;

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
    header("location: ../../View/SubContent/edit_content.php?id=$id");
    exit();
}


$isUpdated = SubContentControl::updateSubContent($title, $statusFlag,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId, $id);

if ($isUpdated) {
    Session::setSessionValue(Session::$SUCCESS_OPERATION, "Service has been updated successfully");
    session_write_close();
    header("location: ../../View/SubContent");
    exit();
} else {
    General::addError("No changes ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/SubContent/edit_content.php?id=$id");
    exit();
}
 