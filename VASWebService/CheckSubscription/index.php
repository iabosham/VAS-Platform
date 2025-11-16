<?php

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';
require_once $accessPath . '/Model/DBConnection.php';
require_once $accessPath . '/Model/ServiceSubscription.php';
require_once $accessPath . '/Model/Subscriber.php';
require_once $accessPath . '/Model/Service.php';
require_once $accessPath . '/Model/Transaction.php';
require_once $accessPath . '/Model/GeneralQueue.php';
require_once $accessPath . '/Model/SMPPConnectionDataSource.php';


require_once $accessPath . '/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php';
require_once $accessPath . '/AccessControl/Subscriber/SubscriberControl.php';
require_once $accessPath . '/AccessControl/Service/ServiceControl.php';
require_once $accessPath . '/AccessControl/Transaction/TransactionControl.php';
require_once $accessPath . '/AccessControl/GeneralQueue/GeneralQueueControl.php';
 

require_once '../Control/BillingAPIControl.php';
require_once '../Control/MessageAPIControl.php';

$resultCode = 0;
$isActive = 0;

 
$data = array();
try {

    $msisdn = General::cleanGet("msisdn");
    $serviceId = General::cleanGet("serviceId");
//

    if ($msisdn != null && $serviceId > 0) {

        $subscriptionInfo = ServiceSubscriptionControl::getServiceSubscriptionInfoByMSISDNAndServiceCode($msisdn, $serviceId);

        if ($subscriptionInfo != null ) {

            if ($subscriptionInfo['isActive'] == 1 && $subscriptionInfo['sub_duration'] > 0 ) {
                 $resultCode = 1;
            } else {

                $billingResult = BillingAPIControl::bill($msisdn, $subscriptionInfo['billing_id'], $subscriptionInfo['price'], 
                $subscriptionInfo['operator_id'],$billtype = 1,"",
                $subscriptionInfo['billing_option'],$subscriptionInfo['sub_message'],$subscriptionInfo);

            if ($billingResult != null) {

                if ($billingResult->ResponseStatus == true) {
                 $resultCode = 1;
                 $isActive =1;
                 ServiceSubscriptionControl::activateSub($msisdn,$subscriptionInfo['serviceId'],$subscriptionInfo['service_method']);  

                 if($subscriptionInfo['isActive'] == 0){

                     
                        $messageInfo = array();
                        $messageInfo['message'] = $subscriptionInfo['sub_message'];
                        $messageInfo['msisdn'] = $msisdn;
                        $messageInfo['sourceAddress'] = $subscriptionInfo['free_source'];
                        $messageInfo['connId'] = $subscriptionInfo['operator_id'];
                        $messageInfo['serviceId'] = $subscriptionInfo['serviceId'];
                        GeneralQueueControl::addMessage($messageInfo);
                        
                        
                 }

                }else {
                $resultCode = 2;
                ServiceSubscriptionControl::updateCheckingDate($msisdn,$subscriptionInfo['serviceId']);                    
                }
                
                    $log = json_encode($billingResult); 

                    $tranInfo = array();
                    $tranInfo['msisdn'] = $msisdn;
                    $tranInfo['is_active'] = $isActive;
                    $tranInfo['service_method'] = 1 ;
                    $tranInfo['service_id'] = $subscriptionInfo['serviceId'];
                    $tranInfo['response_message'] = $log ; // str_replace("\"", "", $log);
                    
                    
                    $r = TransactionControl::addTransaction($tranInfo);
                }

                
            }
        }
    } else {
        $resultCode = -1;
    }
} catch (Exception $e) {
     $resultCode = -5;
}


 
print_r(1);

