<?php

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

require_once $accessPath . '/Model/DBConnection.php';

require_once $accessPath . '/Model/MessageQueueGeneral.php';

require_once $accessPath . '/Model/Client.php';
require_once $accessPath . '/Model/Service.php';

require_once $accessPath . '/AccessControl/Client/ClientControl.php';
require_once $accessPath . '/AccessControl/Service/ServiceControl.php';

$dataSource = new MessageQueueGeneral();

$data = array();
try {
    $requestString = General::getJsonData(General::getRequestData());

    $isJson = General::isJson($requestString);
 
    if ($isJson) {

        $request = json_decode($requestString, true);
        
        if($request != null){

        if (!array_key_exists('username', $request)) {
            General::addError("username value is not provided");
        }
        if (!array_key_exists('password', $request)) {
            General::addError("password value is not provided");
        }
        if (!array_key_exists('serviceId', $request)) {
            General::addError("serviceId value is not provided");
        }
        if (!array_key_exists('MSG', $request)) {
            General::addError("MSG value is not provided");
        }
        if (!array_key_exists('mobileNo', $request)) {
            General::addError("mobileNo value is not provided");
        }

        if (!array_key_exists('sourceType', $request)) {
            General::addError("sourceType value is not provided");
        }

        if (!General::getErrorFlage()) {

            $username = $request['username'];
            $secret = $request['password'];
            $serviceId = $request['serviceId'];
            $message = $request['MSG'];
            $msisdn = $request['mobileNo'];
            $sourceType = $request['sourceType'];

            $loginInfo = ClientControl::clientLogin($username, $secret);


            if ($loginInfo != null) {

                $serviceInfo = ServiceControl::getServiceInfoById($serviceId);

                if ($serviceInfo != null) {

                    if ($serviceInfo['vendorID'] == $loginInfo['vendorId'] || $serviceInfo['type'] == 2 ) {
                        if ($serviceInfo['isActive'] == 1) {

                            if ($serviceInfo['connId'] > 0) {

                                $senderName = $serviceInfo['free_source'];

                                if ($sourceType == 2) {
                                     $senderName = $serviceInfo['sender_name'];
                                }

                                $messageId = $dataSource->addMessageData($msisdn, $message, $serviceInfo['connId'], $senderName, $loginInfo['id'], $serviceId);

                                if ($messageId > 0) {

                                    $data['responseMessage'] = "MSG has been posted successfully";
                                    $data['responseStatus'] = "Successful";
                                    $data['responseCode'] = 1;
                                    $data['messageId'] = $messageId;
                                } else {
                                    $data['responseMessage'] = "System Error";
                                    $data['responseStatus'] = "Fail";
                                    $data['responseCode'] = 108;
                                }
                            } else {
                                $data['responseMessage'] = "Connection is not set for this service";
                                $data['responseStatus'] = "Fail";
                                $data['responseCode'] = 107;
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
        
        }else {
            
            $data['responseMessage'] =  "Method GET is not allowed. ";
            $data['responseStatus'] = "Fail";
            $data['responseCode'] = 100;
        }
    } else {

        $data['responseMessage'] = "Invalid JSON format ";
        $data['responseStatus'] = "Fail";
        $data['responseCode'] = 101;
    }
   
} catch (Exception $e) {
    $data['responseMessage'] = $e;
    $data['responseStatus'] = "Fail";
    $data['responseCode'] = -1;
}

$json = (json_encode($data));
print_r($json);

