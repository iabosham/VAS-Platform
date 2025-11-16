<?php
class ContentSendTimeControl {
   
  
    public static function AddContentSendTime($serviceID,$attemp,$time){
       $resendObj = new ContentSendTime();
       $result =  $resendObj->addContentSendTimeData($serviceID, $attemp, $time);
       $resendObj->close();
       return $result ;
   
   }
   
     public static function removeSubscriberFromService($id){
       $resendObj = new ContentSendTime();
       $result =  $resendObj->removeContentSendTime($id);
       $resendObj->close();
       return $result ;
   }
  
   
      public static function getContentSendTimeInfo($orderID ){
       $resendObj = new ContentSendTime();
       $result =  $resendObj->getContentSendTimeData($orderID);
       $resendObj->close() ;
       return $result ;
   }
   
    public static function getContentSendTimesInfo($serviceID){
       $resendObj = new ContentSendTime();
       $result =  $resendObj->getContentSendTimesData($serviceID);
       $resendObj->close() ;
       return $result ;
   }
   
}