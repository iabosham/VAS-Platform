<?php

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

require_once $accessPath . '/Model/ServiceSubscription.php';

require_once $accessPath . '/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php';

$resultCode = 0;

$dataSource = new MessageQueueGeneral();

$data = array();
try {

    $msisdn = General::cleanGet("msisdn");
    $serviceId = General::cleanGet("serviceId");
//

    if ($msisdn != null && $serviceId > 0) {

        $subscriptionInfo = ServiceSubscriptionControl::getServiceSubscriptionInfoByMSISDN($messageId, $serviceId);

        if ($subscriptionInfo != null && $subscriptionInfo['status'] == 1) {

            if ($subscriptionInfo['isActive'] == 1) {

                $resultCode = 1;
            } else {
                $resultCode = 2;
            }
        }
    } else {
        $resultCode = -1;
    }
} catch (Exception $e) {
    
    $resultCode = -5;
}


 
print_r($resultCode);

