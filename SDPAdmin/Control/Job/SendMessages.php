<?php

require_once('JobConfig.php');

echo $path  = JobConfig::getProjectPath() ;
require_once($path.'/SDPAccess/Common/Config.php');
require_once($path.'/SDPAccess/Common/General.php');
require_once($path.'/SDPAccess/Model/DBConnection.php');
require_once($path.'/SDPAccess/Model/Subscriber.php');
require_once($path.'/SDPAccess/Model/Message.php');
require_once($path.'/SDPAccess/Model/MessageQueue.php');
require_once($path.'/SDPAccess/Model/MessageHistory.php');
require_once($path.'/SDPAccess/AccessControl/Subscriber/SubscriberControl.php');
require_once($path.'/SDPAccess/AccessControl/Message/MessageControl.php');
require_once($path.'/SDPAccess/AccessControl/MessageQueue/MessageQueueControl.php');
require_once($path.'/SDPAccess/AccessControl/MessageHistory/MessageHistoryControl.php');
require_once('SMS.php');

$messagesQueue = MessageQueueControl::getMessageQueues();
 
if($messagesQueue != null){
    
    foreach ($messagesQueue as $message){
        
        
         $sendInfo = SMS::send($message['msisdn'], $message['msg'],$message['number']);
         
         if($sendInfo != null){
              if($sendInfo['success'] == 1){
                 $isMessageAddedToHistory =  MessageHistoryControl::AddMessageHistory($message['messageID'], $message['subscriberID'],$sendInfo['resultid']);

                 if($isMessageAddedToHistory){
                     MessageQueueControl::deleteMessageQueue($message['messageQueueId']); 
                 }else {
                   General::writeEventCron("message didn't add to history. result:".$sendInfo['errormessage'] );  
                 }
              }else {
                 General::writeEventCron("message not sent. result:".$sendInfo['errormessage'] );
              }
         }else {
              General::writeEventCron("No response when sending the message");
         }
        
         
          
     }
    
    }else {
                 General::writeEventCron("There is no messages in queue");
    }

  