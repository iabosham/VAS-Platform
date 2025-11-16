<?php

header('Content-Type: text/json; charset=utf-8');

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

require_once $accessPath . '/Model/DBConnection.php';

require_once $accessPath . '/Model/MessageQueueGeneral.php';

require_once $accessPath . '/Model/Client.php';
require_once $accessPath . '/Model/Service.php';
require_once $accessPath . '/Model/Shortcode.php';
require_once $accessPath . '/Model/Inbox.php';

//require_once $accessPath . '/AccessControl/Client/ClientControl.php';
require_once $accessPath . '/AccessControl/Service/ServiceControl.php';

$dataSource = new MessageQueueGeneral();
$shortCodeData = new Shortcode();
$inboxDataSource = new Inbox();



$data = array();
try {
    $requestString = General::getJsonData(General::getRequestData());

    $isJson = General::isJson($requestString);

    if ($isJson) {

        $request = json_decode($requestString, true);


        if ($request != null) {

            if (!array_key_exists('username', $request)) {
                General::addError("username value is not provided");
            }

            if (!array_key_exists('password', $request)) {
                General::addError("password value is not provided");
            }

            if (!array_key_exists('shortcode', $request)) {
                General::addError("shortcode value is not provided");
            }

            if (!array_key_exists('fromDate', $request)) {
                General::addError("fromDate value is not provided");
            }

            if (!array_key_exists('toDate', $request)) {
                General::addError("toDate value is not provided");
            }

            if (array_key_exists('readFlag', $request)) {
                $readFlag = $request['readFlag'];
            } else {
                $readFlag = -1;
            }



            if (!General::getErrorFlage()) {

                $username = $request['username'];
                $secret = $request['password'];
                $shortcode = $request['shortcode'];
                $fromDate = $request['fromDate'];
                $toDate = $request['toDate'];


                $loginInfo = ClientControl::clientLogin($username, $secret);


                if ($loginInfo != null) {

                    $shortCodeInfo = $shortCodeData->getShortcodeInfoByNumberData($shortcode);

                    if ($shortCodeInfo != null) {

                        if ($shortCodeInfo['vendor_id'] == $loginInfo['vendorId']) {
                            if ($shortCodeInfo['isActive'] == 1) {

//                                $senderName = $shortCodeInfo['free_source'];
//
//                                if ($sourceType == 2) {
//                                     $senderName = $shortCodeInfo['sender_name'];
//                                }

                                $inbox = $inboxDataSource->getInboxMessagesByShortcode($fromDate, $toDate, $readFlag, $shortcode);

                                if ($inbox != null) {

                                    $data['responseMessage'] = "Received messages are founded";
                                    $data['responseStatus'] = "Successful";
                                    $data['responseCode'] = 1;
                                    $data['data'] = $inbox;
                                } else {
                                    $data['responseMessage'] = "No Message received ";
                                    $data['responseStatus'] = "Fail";
                                    $data['responseCode'] = 108;
                                }
                            } else {
                                $data['responseMessage'] = "Service is not active.";
                                $data['responseStatus'] = "Fail";
                                $data['responseCode'] = 106;
                            }
                        } else {
                            $data['responseMessage'] = "Service is not belong to Account";
                            $data['responseStatus'] = "Fail";
                            $data['responseCode'] = 105;
                        }
                    } else {
                        $data['responseMessage'] = "Invalid service id ";
                        $data['responseStatus'] = "Fail";
                        $data['responseCode'] = 104;
                    }
                } else {

                    $data['responseMessage'] = "Invalid login ";
                    $data['responseStatus'] = "Fail";
                    $data['responseCode'] = 103;
                }
            } else {
                $data['responseMessage'] = General::getError();
                $data['responseStatus'] = "Fail";
                $data['responseCode'] = 102;
            }
        } else {

            $data['responseMessage'] = "Method GET is not allowed. ";
            $data['responseStatus'] = "Fail";
            $data['responseCode'] = 100;
        }
    } else {

        $data['responseMessage'] = "Invalid JSON format";
        $data['responseStatus'] = "Fail";
        $data['responseCode'] = 101;
        $data['data'] = $inbox;
    }
} catch (Exception $e) {
    $data['responseMessage'] = $e;
    $data['responseStatus'] = "Fail";
    $data['responseCode'] = -1;
}


$json = (json_encode($data, JSON_UNESCAPED_UNICODE));
print_r($json);

