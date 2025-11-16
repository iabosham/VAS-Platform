<?php
header('Content-Type: text/json; charset=utf-8');
require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

$resultCode = 0;


$data = array();
if (Code::checkLogin()) {
    try {

        $msisdn = General::cleanGet("mdn");
        $serviceId = General::cleanGet("serviceid");
        $subcribe = ServiceController::remove($msisdn, $serviceId);
        switch ($subcribe) {
            case 0:
                $data['result'] = 0;
                $data['msg'] = "unsubscribed successfully";
                $data['success'] = true;
                break;
            case 2:
                $data['result'] = 1;
                $data['msg'] = "Subscriber is not registered in this service";
                $data['success'] = false;
                break;
            case 4:
                $data['result'] = 4;
                $data['msg'] = "mdn or serviceid required";
                $data['success'] = false;
                break;
            case 5:
                $data['result'] = 4;
                $data['msg'] = "service not found";
                $data['success'] = false;
                break;

            case 6:
                $data['result'] = 4;
                $data['msg'] = "mdn not valid (ex 120120120)";
                $data['success'] = false;
                break;
            default:
            General::writeEvent($subscribe);
                $data['result'] = 10;
                $data['msg'] = "System error";
                $data['success'] = false;
                break;
        }
    } catch (Exception $e) {
        General::writeEvent($e);
        $data['result'] = 10;
        $data['msg'] = "System error";
        $data['success'] = false;
    }
} else {
    http_response_code(403);
    $data['result'] = 5;
    $data['msg'] = "Authentication error";
    $data['success'] = false;
}

$json = (json_encode($data, JSON_UNESCAPED_UNICODE));
print_r($json);
