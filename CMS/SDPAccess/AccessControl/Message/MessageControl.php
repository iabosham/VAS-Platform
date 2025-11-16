<?php
class MessageControl extends Message{
   
   public static function getUnsentMessages(){
       $messageTypeObj = new Message();
   return $messageTypeObj->getUnsentMessagesData();
   
   }
   
   
    public static function getMessagesByVendor($vendorID, $fromDate, $toDate){
       $messageTypeObj = new Message();
   return $messageTypeObj->getMessagesByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
    public static function getSubscriberMessages($msisdn,$vendorId,$serviceId){
       $messageTypeObj = new Message();
       $result =  $messageTypeObj->getSubscriberMessagesData($msisdn,$vendorId,$serviceId);
       $messageTypeObj->close();
       
       return $result;
   
   }
   
    public static function getUnapprovedMessagesByVendor($vendorID, $fromDate, $toDate){
       $messageTypeObj = new Message();
   return $messageTypeObj->getUnapprovedMessagesByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
   public static function getMessageInfoById($messageId){
       $messageTypeObj = new Message();
   return $messageTypeObj->getMessageInfoByIdData($messageId);
   
   }
   
   public static function deleteMessage($messageId){
       $messageTypeObj = new Message();
   return $messageTypeObj->deleteMessageData($messageId);
   
   }
   
    public static function AddMessage($msg,$messageID,$sendTime,$clientID,$isApproved,$orderId){
       $messageTypeObj = new Message();
   return $messageTypeObj->addMessageData($msg,$messageID,$sendTime,$clientID,$isApproved,$orderId) ;
   } 
   
   public static function updateMessage($msg,$messageID,$sendTime,$clientID,$id){
       $messageTypeObj = new Message();
       $result = $messageTypeObj->updateMessageData($msg,$messageID,$sendTime,$clientID,$id) ;
       $messageTypeObj->close();
   return $result;
   }
   
     public static function updateMessageStatus($messageID,$status){
       $messageTypeObj = new Message();
   return $messageTypeObj->updateMessageStatusData($messageID, $status) ;
   }
   
    public static function updateApprovalStatus($messageID,$approvalFlage){
       $messageTypeObj = new Message();
   return $messageTypeObj->updateApprovalStatusData($messageID, $approvalFlage) ;
   }
   
    public static function checkIsMessageExistByDate($message, $date, $serviceId){
       $messageTypeObj = new Message();
       return $messageTypeObj->checkIsMessageExistByDateData($message, $date, $serviceId) ;
   }
   
      public static function getMaxOrderIdOfMessage($serviceId){
       $messageTypeObj = new Message();
       return $messageTypeObj->getMaxOrderIdOfMessageData($serviceId) ;
   }
  
   
}