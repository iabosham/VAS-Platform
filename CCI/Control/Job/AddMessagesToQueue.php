<?php
require_once('JobConfig.php');

$path  = JobConfig::getProjectPath();
require_once($path.'/SDPAccess/Common/General.php');
require_once($path.'/SDPAccess/Model/DBConnection.php');
require_once($path.'/SDPAccess/Model/Subscriber.php');
require_once($path.'/SDPAccess/Model/Message.php');
require_once($path.'/SDPAccess/Model/MessageQueue.php');
require_once($path.'/SDPAccess/AccessControl/Subscriber/SubscriberControl.php');
require_once($path.'/SDPAccess/AccessControl/Message/MessageControl.php');
require_once($path.'/SDPAccess/AccessControl/MessageQueue/MessageQueueControl.php');

$messages = MessageControl::getUnsentMessages();

if($messages != null){
    
    foreach ($messages as $message){
        
        $subscribersOfServices = SubscriberControl::getSubscribersOfService($message['service_id']);
        
        if($subscribersOfServices != null){
             foreach ($subscribersOfServices as $subscriber){
                     MessageQueueControl::AddMessageQueue($message['id'], $subscriber['id']);
             }
             MessageControl::updateMessageStatus($message['id'], 1);
             
        }else {
             General::writeEventCron("There is no subscribers for this serviceID: ".$message['service_id']);
             MessageControl::updateMessageStatus($message['id'], 2);
        }
        
      }
    }else {
                 General::writeEventCron("There is no unsent messages");
    }

  