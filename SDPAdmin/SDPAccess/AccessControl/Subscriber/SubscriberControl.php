<?php
class SubscriberControl {
   
   public static function getSubscribers(){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscribersData();
       $subscriberObj->close();
       return $result ;
   
   }
   
    public static function AddSubscriber($msisdn){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->addSubscriberData($msisdn);
       $subscriberObj->close();
       return $result ;
   
   }
   
   public static function getSubscribersOfService($serivceID){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscribersOfSerivce($serivceID);
       $subscriberObj->close();
       return $result ;
   
   }
   
    public static function getSubscribersOfSerivceCount($serivceID,$fromDate,$toDate, $companyId,$stateId){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscribersOfSerivceCountData($serivceID,$fromDate,$toDate, $companyId,$stateId);
       $subscriberObj->close();
       return $result ;
   
   }
   
   
   
   
   public static function getServiceSubscriptionCount($serivceID){
       $subscriberObj = new ServiceSubscription();
       $result = $subscriberObj->getServiceSubscriptionCountData($serivceID);
       $subscriberObj->close();
       return $result ;
   
   }
    
   
   public static function getSubscriberServices($subscriberID){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscriberServicesData($subscriberID);
       $subscriberObj->close();
       return $result ;
   
   }
   
   public static function getSubscriberServicesByServiceType($subscriberID,$type){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscriberServicesByServiceTypeData($subscriberID,$type);
       $subscriberObj->close();
       return $result ;
   
   }
   
   public static function getSubscriberInfoByNumber($msisdn){
       $subscriberObj = new Subscriber();
       $result = $subscriberObj->getSubscriberInfoByNumberData($msisdn) ;
       $subscriberObj->close();
   return $result;
   
   }
   
}