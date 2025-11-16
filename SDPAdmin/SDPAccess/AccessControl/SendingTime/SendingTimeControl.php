<?php
class SendingTimeControl {
   
  
    public static function AddSendingTime($serviceID,$orderId,$time){
       $resendObj = new SendingTime();
       $result =  $resendObj->addSendingTimeData($serviceID, $orderId, $time);
       $resendObj->close();
       return $result ;
   
   }
 
      public static function getSendingTimeInfo($serviceID, $orderId){
       $resendObj = new SendingTime();
       $result =  $resendObj->getSendingTimeData($serviceID, $orderId);
       $resendObj->close() ;
       return $result ;
   }
   
    public static function getSendingTimesInfo($serviceID){
       $resendObj = new SendingTime();
       $result =  $resendObj->getSendingTimesData($serviceID);
       $resendObj->close() ;
       return $result ;
   }
   
    public static function removeSendingTime($id){
       $resendObj = new SendingTime();
       $result =  $resendObj->removeSendingTimeData($id);
       $resendObj->close() ;
       return $result ;
   }
   
   
   
}