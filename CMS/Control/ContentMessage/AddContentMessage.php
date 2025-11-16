<?php

//Start session
session_start();
require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');


require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');

require_once('../../SDPAccess/Model/ContentSendTime.php');
require_once('../../SDPAccess/AccessControl/ContentSendTime/ContentSendTimeControl.php');


//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

$isAdded = false;
$insertCount = 0;

//POST values
$subServiceId = General::clean("subServiceId");

$contentType = General::clean("contentType");

General::isNull($subServiceId, "Enter the service", $errflag);




if (!General::getErrorFlage()) {
    
    $clientInfo = ClientControl::getClientInfoById(CookieClient::getUserId());

if ($clientInfo != null) {
 

if ($contentType == 1) {


    $orderId = General::clean("orderId");
    $sendDate = General::clean("sendDate");
    $msg = General::clean("msg");
 
    
    General::isNull($orderId, "Enter the message order number ", $errflag);
    General::isNull($sendDate, "Enter the message send date", $errflag);
    General::isNull($msg, "Enter the message ", $errflag);

    $timeInfo = ContentSendTimeControl::getContentSendTimeInfo($orderId);

    if ($timeInfo == null) {
        General::addError("Invalid Message Time");
    } else {
        $sendDate .= " " . $timeInfo['send_time'];
    }
    
   if (strlen($msg) > 3000) {
         General::addError("Invalid Message Size: ".strlen($msg)." -> max length is 3000 ");
   } 
     
    $repeatedMessageOrder = ContentMessageControl::getInfoByDateAndOrder($subServiceId, $orderId, $sendDate);

    if($repeatedMessageOrder != null){
        
         General::addError("Repeated message order.");
        
    } 

    if (General::getErrorFlage()) {
        Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
        session_write_close();
        header("location: ../../View/ContentMessage/new_content.php");
        exit();
    }

    $contentInfo['subService'] = $subServiceId;
    $contentInfo['serial'] = $orderId;
    $contentInfo['clientId'] = $clientInfo['id'];
    $contentInfo['msg'] = $msg;
    $contentInfo['sendingDate'] = $sendDate;
    $contentInfo['approvalFlag'] = $clientInfo['is_approve'];
    $contentInfo['userId'] = 0;

    $insertId = ContentMessageControl::AddContentMessage($contentInfo);

    if ($insertId > 0) {

        $insertCount ++;
        $isAdded = true;
    } else {

        General::addError("Invalid insertion ");
    }
} else if ($contentType == 2) {

    require_once '../../lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';


    print_r($_FILES["bulk_file"]);

    $name = $_FILES["bulk_file"]["name"];
    $ext = end((explode(".", $name)));


    if (isset($_FILES["bulk_file"]) && $_FILES["bulk_file"]["error"] == 0 && $_FILES["bulk_file"]["size"] > 0 && $ext == 'xls') {


        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($_FILES["bulk_file"]['tmp_name']);

        //Itrating through all the sheets in the excel workbook and storing the array data
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $arrayData[$worksheet->getTitle()] = $worksheet->toArray();
        }

        foreach ($arrayData as $sheet) {
            echo "--------------------------------------------------------------<br />";

            if ($sheet != null) {
                foreach ($sheet as $row) {

                    if (array_key_exists(0, $row) && array_key_exists(1, $row) && array_key_exists(2, $row) && $row[0] != '' && is_numeric($row[2])) {

                        $orderId = $row[2];

                        $timeInfo = ContentSendTimeControl::getContentSendTimeInfo($orderId);

                        if ($timeInfo == null) {

                            echo "Invalid Message Time";
                            General::addError("Invalid Message Time");
                        } else {

                            $newDate = date("Y-m-d", strtotime($row[1])) . " " . $timeInfo['send_time'];

                            echo $row[0] . " - " . $newDate . " - " . $row[2] . "<br />";

                            $contentInfo['subService'] = $subServiceId;
                            $contentInfo['serial'] = $orderId;
                            $contentInfo['clientId'] = $clientInfo['id'];
                            $contentInfo['msg'] = $row[0];
                            $contentInfo['sendingDate'] = $newDate;
                            $contentInfo['approvalFlag'] = $clientInfo['is_approve'];
                            $contentInfo['userId'] = 0;

                            $insertId = ContentMessageControl::AddContentMessage($contentInfo);

                            if ($insertId > 0) {
                                $insertCount++;
                            }
                        }
                    } else {
                        echo "eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee";
                    }
                }
            }
            echo "--------------------------------------------------------------<br />";
        }

        if ($insertCount > 0) {
            $isAdded = true;
        }
    } else {

        General::addError("Invalid file");
    }
} else if ($contentType == 3) {

    $rootPath = filter_input(INPUT_SERVER, "DOCUMENT_ROOT");

    $name = $_FILES["media_file"]["name"];
    $ext = end((explode(".", $name)));

    $uuid = uniqid();
    
    $public_ip = General::getConfigurationParameter("public_ip", "localhost", General::getConfigurationFile());
    $filePath = "http://".$public_ip."/Media/" . $uuid . '.' . $ext ;

    if (isset($_FILES["media_file"]) && $_FILES["media_file"]["error"] == 0 && $_FILES["media_file"]["size"] > 0) {

        $uploadedFlag = move_uploaded_file($_FILES["media_file"]["tmp_name"], $rootPath . "/Media/" . $uuid . '.' . $ext);

        if ($uploadedFlag == 1) {


            $orderId = General::clean("orderId");
            $sendDate = General::clean("sendDate");
            $msg = General::clean("msg");
            
           
            General::isNull($orderId, "Enter the message order number ", $errflag);
            General::isNull($sendDate, "Enter the message send date", $errflag);
            General::isNull($msg, "Enter the message ", $errflag);

            $timeInfo = ContentSendTimeControl::getContentSendTimeInfo($orderId);

            if ($timeInfo == null) {

                General::addError("Invalid Message Time");
            } else {
                $sendDate .= " " . $timeInfo['send_time'];
            }
            $msg.= "\r\n".$filePath;
            


            if (General::getErrorFlage()) {
                Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
                session_write_close();
                header("location: ../../View/ContentMessage/new_content.php");
                exit();
            }

            $contentInfo['subService'] = $subServiceId;
            $contentInfo['serial'] = $orderId;
            $contentInfo['clientId'] = $clientInfo['id'];
            $contentInfo['msg'] = $msg;
            $contentInfo['sendingDate'] = $sendDate;
            $contentInfo['approvalFlag'] = $clientInfo['is_approve'];
            $contentInfo['userId'] = 0;

            $insertId = ContentMessageControl::AddContentMessage($contentInfo);

            if ($insertId > 0) {

                $insertCount ++;
                $isAdded = true;
            } else {

                General::addError("Invalid insertion ");
            }
        }

         
    } else {

          General::addError("Invalid file ");
    }

    //
}

} 


}

if ($isAdded) {
    Session::setSessionValue(Session::$SUCCESS_OPERATION, "Content has been pushed successfully, messages count: $insertCount");
    session_write_close();
    header("location: ../../View/ContentMessage/new_content.php");
    exit();
} else {
    
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError());
    session_write_close();
    header("location: ../../View/ContentMessage/new_content.php");
    exit();
}
 
 


