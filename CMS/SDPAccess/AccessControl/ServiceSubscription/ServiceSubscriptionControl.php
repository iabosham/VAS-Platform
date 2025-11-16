<?php
class ServiceSubscriptionControl extends ServiceSubscription{
   
  
    public static function AddServiceSubscription($subscriberID,$serviceID,$msisdn){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->addServiceSubscriptionData($subscriberID, $serviceID,$msisdn);
       $serviceSubscriptionObj->close();
       return $result ;
   //
   }
   
     public static function removeSubscriberFromService($subscriberID,$serviceID){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->removeSubscriberFromServiceData($subscriberID, $serviceID);
       $serviceSubscriptionObj->close();
       return $result ;
   }
   
   public static function deleteServiceSubscription($id){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->deleteServiceSubscriptionData($id);
       $serviceSubscriptionObj->close();
       return $result ;
   }
   
   
   
      public static function getSubscriberServices($msisdn){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->getSubscriberServicesData($msisdn);
       $serviceSubscriptionObj->close();
       return $result ;
   }
   
   public static function removeSubscriberFromAllServices($subscriberID){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->removeSubscriberFromAllServicesData($subscriberID);
       $serviceSubscriptionObj->close();
       return $result ;
   }
   
      public static function getServiceSubscriptionInfo($subscriberID,$serviceID){
       $serviceSubscriptionObj = new ServiceSubscription();
       $result =  $serviceSubscriptionObj->getServiceSubscriptionInfoData($subscriberID, $serviceID);
       $serviceSubscriptionObj->close() ;
       return $result ;
   }
   
}