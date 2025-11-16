<?php
class MessageHistoryArchiveControl {
   
  
   
   public static function getMessageHistoryCountsByMessageId($messageId,$tableNumber){
       
        $messageHistoryObj = new MessageHistoryArchive();
        
        $table = "message_history_".$tableNumber ;
       
        $result = $messageHistoryObj->getMessageHistoryCountsByMessageIdData($messageId, $table);
        
        $messageHistoryObj->close();

   return $result;
   
   }
     public static function getMessageHistoryByMessageAndMsisdn($messageId,$msisdn,$tableNumber){
       
        $messageHistoryObj = new MessageHistoryArchive();
        
        $table = "message_history_".$tableNumber ;
       
        $result = $messageHistoryObj->getMessageHistoryByMessageAndMsisdnData($messageId,$msisdn,$table);
        
        $messageHistoryObj->close();

   return $result;
   
   }
   
     public static function getMessagePartCountByMessageId($messageId,$tableNumber){
       
        $messageHistoryObj = new MessageHistoryArchive();
        
        $table = "message_history_".$tableNumber ;
       
        $result = $messageHistoryObj->getMessagePartCountByMessageIdData($messageId,$table);
        
        $messageHistoryObj->close();

   return $result;
   
   }
   
   
   
   
}