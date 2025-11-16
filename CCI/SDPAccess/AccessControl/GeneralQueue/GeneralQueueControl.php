<?php
class GeneralQueueControl extends GeneralQueue{
   
  
  public static function addMessage($messageInfo){
      
            $contentTypeObj = new GeneralQueue();
            $result =  $contentTypeObj->addMessageData($messageInfo) ;
            $contentTypeObj->close();
            
        return $result;
   } 
    
}