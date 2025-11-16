<?php
class SenderControl extends Sender{
   
   public static function getSendersByShortcodeId($shortcodeId){
       $serviceTypeObj = new Sender();
   return $serviceTypeObj->getSendersByShortcodeIdData($shortcodeId);
   
   }
   
   public static function getAllSenders(){
       $serviceTypeObj = new Sender();
   return $serviceTypeObj->getAllSendersData();
   
   }
   
    public static function AddSender($name,$shortcodeId,$userID){
       $serviceTypeObj = new Sender();
   return $serviceTypeObj->addSenderData($name,$shortcodeId,$userID) ;
   
   }
   
   public static function getSenderInfoByNumber($code){
       $serviceTypeObj = new Sender();
   return $serviceTypeObj->getSenderInfoByCodeData($code);
   
   }
   
}