<?php

//Start session
session_start();
include '../../Control/Include/PublicRequirement.php';


include '../../SDPAccess/Model/Service.php';
include '../../SDPAccess/Model/SubContent.php';

include '../../SDPAccess/AccessControl/Service/ServiceControl.php';
include '../../SDPAccess/AccessControl/SubContent/SubContentControl.php';

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;


try {



    $id = General::clean("id");
    $serviceName = General::clean("serviceName");
    $serviceTypeID = General::clean("serviceTypeID");
    $serviceKey = General::clean("serviceKey");
    $oldServiceKey = General::clean("oldServiceKey");
    $shortcodeID = General::clean("shortcodeID");
    $subMessage = General::clean("subMessage");
    $unSubMessage = General::clean("unSubMessage");
    $senderName = General::clean("senderName");
    $freeSource = General::clean("fs");
    $method = General::clean("method");
    $unSubKey = General::clean("unSubKey");
    $contentId = General::clean("contentId");
    
    $senderInfo = General::clean("senderInfo");
    $systemId = General::clean("systemId");
    $type = General::clean("type");
    $typeId = 1;
    if ($type != null) {
    $typeId = 2;
    }




    General::isNull($id, "Invaled service id", $errflag);
    General::isNull($serviceName, "Enter Service name value", $errflag);
    General::isNull($serviceTypeID, "Enter Service Type value", $errflag);
    General::isNull($serviceKey, "Enter Service key value", $errflag);
    General::isNull($shortcodeID, "Enter shortcode value", $errflag);
    General::isNull($senderName, "Enter sender name value", $errflag);
    General::isNull($freeSource, "Enter free source value", $errflag);
    General::isNull($method, "Enter Sending method value", $errflag);

    if (General::getErrorFlage()) {
        Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
        session_write_close();
        header("location: ../../View/Service/edit_service.php?id=$id");
        exit();
    }


    $isUpdated = ServiceControl::updateService($id, $serviceName, $serviceTypeID, $serviceKey, $shortcodeID
            , Cookie::getUserId(), $subMessage, $unSubMessage, $senderName, $freeSource, $method, $unSubKey
            , $contentId,$senderInfo,$systemId,$typeId);

    if ($isUpdated) {
         
        // $isContentUpdated = SubContentControl::updateContentExtraId($contentId,$id);
 

        $keyInfo = ServiceControl::getServiceKeyInfoBykey($id, $oldServiceKey);
        if ($keyInfo != null) {
            ServiceControl::updateServiceKey($keyInfo['id'], $serviceKey);
        }
        header("location: ../../View/Service/index.php");
        Session::setSessionValue(Session::$SUCCESS_OPERATION, "Service  has been updated successfully... ");
        session_write_close();
        exit();
    } else {

        General::addError("System error");
        Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
        session_write_close();
        header("location: ../../View/Service/edit_service.php?id=$id");
        exit();
    }
} catch (Exception $e) {
    
}
 
 