<?php
class MessageHistoryControl extends MessageHistory{
   
   public static function getMessageHistorysByMessageId($messageId){
       $messageHistoryObj = new MessageHistory();
   return $messageHistoryObj->getMessageHistoryByMessageIdData($messageId);
   
   }
   
    public static function AddMessageHistory($messageID, $subscriberID,$resultID){
       $messageHistoryObj = new MessageHistory();
   return $messageHistoryObj->addMessageHistoryData($messageID, $subscriberID,$resultID);
   
   }
   
   public static function getMessageHistoryCountsByMessageId($messageId){
       $messageHistoryObj = new MessageHistory();
   return $messageHistoryObj->getMessageHistoryCountsByMessageIdData($messageId);
   
   }
   
}