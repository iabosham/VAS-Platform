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
//
    if ($isJson) {

        $request = json_decode($requestString, true);
        
       if ($request != null) {

        if (!array_key_exists('username', $request)) {
            General::addError("username value is not provided");
        }
        if (!array_key_exists('password', $request)) {
            General::addError("password value is not provided");
        }
        if (!array_key_exists('messageId', $request) || !is_numeric($request['messageId'])) {
            General::addError("messageId value is not provided");
        }


        if (!General::getErrorFlage()) {

            $username = $request['username'];
            $secret = $request['password'];
            $messageId = $request['messageId'];

            $loginInfo = ClientControl::clientLogin($username, $secret);


            if ($loginInfo != null) {
 
               
                $messageInfo = $dataSource->getMessageQueueInfoData($messageId);

                if ($messageInfo != null) {
                    
                  $statusCode = 0 ;
                    
                    if($messageInfo['status'] == 1){
                        
                        $responseMessage = json_decode($messageInfo['response_message'], true);  
                        
                        if($responseMessage['resultCode'] == 0){
                            
                            $statusCode = 1; 
                            
                         }else {
                             
                             $statusCode = 2;
                            
                        }
                                
                        
                     } 

                     $data['responseStatus'] = "Successful";
                    $data['responseCode'] = 1;
                    $data['messageId'] = $messageId;
                    $data['messageStatus'] = $statusCode;
                } else {
                    $data['responseMessage'] = "Message is not found";
                    $data['responseStatus'] = "Fail";
                    $data['responseCode'] = 108;
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

