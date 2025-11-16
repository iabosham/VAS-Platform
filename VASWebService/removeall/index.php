<?php
header('Content-Type: text/json; charset=utf-8');
require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';
require_once $accessPath . '/Model/DBConnection.php';
require_once $accessPath . '/Model/ServiceSubscription.php';
require_once $accessPath . '/Model/Subscriber.php';
require_once $accessPath . '/Model/GeneralQueue.php';
require_once $accessPath . '/Model/SMPPConnectionDataSource.php';
require_once $accessPath . '/Model/UnSub.php';


require_once $accessPath . '/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php';
require_once $accessPath . '/AccessControl/Subscriber/SubscriberControl.php';
require_once $accessPath . '/AccessControl/GeneralQueue/GeneralQueueControl.php';
require_once $accessPath . '/AccessControl/UnSub/UnSubControl.php';

require_once '../Control/BillingAPIControl.php';
require_once '../Control/MessageAPIControl.php';


require_once $accessPath . '/Model/Subscriber.php';

require_once $accessPath . '/AccessControl/Subscriber/SubscriberControl.php';

$dataSource = new SubscriberControl();



$data = array();
if (Code::checkLogin()) {
    try {
        
        $msisdn = General::cleanGet("mdn");
        $removeAll = ServiceController::removeAll($msisdn);
        switch ($removeAll) {
            case 0:
                $data['result'] = 0;
                $data['msg'] = "unsubscribed successfully";
                $data['success'] = true;
                break;
            case 5:
                $data['result'] =  4;
                $data['msg'] =  "There is no service subscribed";
                $data['success'] = false;
                break;
            case 6:
                $data['result'] = 4;
                $data['msg'] = "mdn not valid (ex 120120120)";
                $data['success'] = false;
                break;
            default:
                $data['result'] = 10;
                $data['msg'] = "System error";
                $data['success'] = false;
                break;
        }
    } catch (Exception $e) {


        $data['result'] = 10;
        $data['msg'] = "System error";
        $data['success'] = false;
    }
} else {
    http_response_code(403);
    $data['result'] = 5;
    $data['msg'] = "Authentication error";
    $data['success'] = false;
    $data['data'] = [];
}
$json = (json_encode($data, JSON_UNESCAPED_UNICODE));
print_r($json);
