<?php
class SystemMessageControl extends SystemMessage{
 
     public static function getSystemMessages(){
       $systemMessageObj = new SystemMessage();
       $result = $systemMessageObj->getSystemMessagesData(); 
       $systemMessageObj->close();
       return $result ;
   
   }
   
    public static function getSystemMessagesByCode($code){
       $systemMessageObj = new SystemMessage();
       $result = $systemMessageObj->getSystemMessageByCodeData($code);
       $systemMessageObj->close() ;
       return $result ;
   
   }
   
    public static function AddSystemMessage($message,$code,$desc){
       $systemMessageObj = new SystemMessage();
       $result = $systemMessageObj->addSystemMessageData($message,$code,$desc) ;
       $systemMessageObj->close() ;
       
       return $result ;
   
   }
   
   public static function updateSystemMessage($id,$message,$code,$desc){
       $systemMessageObj = new SystemMessage();
       $result = $systemMessageObj->updateSystemMessageData($id, $message,$code,$desc) ;
       $systemMessageObj->close() ;
       
       return $result ;
   
   }
   
   
    
}