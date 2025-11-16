<?php
class ReSendConfigControl {
   
  
    public static function AddReSendConfig($serviceID,$attemp,$time){
       $resendObj = new ReSendConfig();
       $result =  $resendObj->addReSendConfigData($serviceID, $attemp, $time);
       $resendObj->close();
       return $result ;
   
   }
   
     public static function removeSubscriberFromService($id){
       $resendObj = new ReSendConfig();
       $result =  $resendObj->removeReSendConfig($id);
       $resendObj->close();
       return $result ;
   }
  
   
      public static function getReSendConfigInfo($serviceID, $attemp){
       $resendObj = new ReSendConfig();
       $result =  $resendObj->getReSendConfigData($serviceID, $attemp);
       $resendObj->close() ;
       return $result ;
   }
   
    public static function getReSendConfigsInfo($serviceID){
       $resendObj = new ReSendConfig();
       $result =  $resendObj->getReSendConfigsData($serviceID);
       $resendObj->close() ;
       return $result ;
   }
   
}