<?php
class MessageQueueControl extends MessageQueue{
   
   public static function getMessageQueues(){
       $messageQueueObj = new MessageQueue();
   return $messageQueueObj->getMessageQueuesData();
   
   }
   
    public static function AddMessageQueue($messageID, $subscriberID){
       $messageQueueObj = new MessageQueue();
   return $messageQueueObj->addMessageQueueData($messageID, $subscriberID);
   
   }
   
    public static function deleteMessageQueue($messageID){
       $messageQueueObj = new MessageQueue();
    return $messageQueueObj->deleteMessageQueueData($messageID);
   
   }
   
   public static function getMessageQueueCountsByMessageId($messageId){
       $messageQueueObj = new MessageQueue();
   return $messageQueueObj->getMessageQueueCountsByMessageIdData($messageId);
   
   }
   
   
   
}