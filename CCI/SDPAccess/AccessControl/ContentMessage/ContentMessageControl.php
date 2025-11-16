<?php
class ContentMessageControl extends ContentMessage{
   
  
    
    
    public static function getContentMessagesByClientId($clientId){
       
        $contentTypeObj = new ContentMessage();
        return $contentTypeObj->getContentMessagesByClientIdData($clientId);
    }
    
        public static function getContentMessages($from, $to, $serviceId, $subServiceId, $approveFlag,$contentStaus){
       
        $contentTypeObj = new ContentMessage();
        return $contentTypeObj->getContentMessagesData($from, $to, $serviceId, $subServiceId, $approveFlag,$contentStaus);
    }
    
    
   
  public static function AddContentMessage($contentInfo){
      
            $contentTypeObj = new ContentMessage();
            $result =  $contentTypeObj->addContentMessageData($contentInfo) ;
            $contentTypeObj->close();
            
        return $result;
   } 
   
   
    public static function getContentMessagesByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new ContentMessage();
   return $contentTypeObj->getContentMessagesByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
    public static function getSubscriberContentMessages($msisdn,$vendorId,$serviceId){
       $contentTypeObj = new ContentMessage();
       $result =  $contentTypeObj->getSubscriberContentMessagesData($msisdn,$vendorId,$serviceId);
       $contentTypeObj->close();
       
       return $result;
   
   }
   
    public static function getUnapprovedContentMessagesByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new ContentMessage();
   return $contentTypeObj->getUnapprovedContentMessagesByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
   public static function getContentMessageInfoById($contentId){
       $contentTypeObj = new ContentMessage();
   return $contentTypeObj->getContentMessageInfoByIdData($contentId);
   
   }
   
   public static function deleteContentMessage($contentId){
       $contentTypeObj = new ContentMessage();
   return $contentTypeObj->deleteContentMessageData($contentId);
   
   }
   
 
   public static function updateContentMessage($msg, $orderId, $sendDate, $userId, $id){
       $contentTypeObj = new ContentMessage();
       $result = $contentTypeObj->updateContentMessageData($msg, $orderId, $sendDate, $userId, $id);
       $contentTypeObj->close();
   return $result;
   }
   
     public static function updateContentMessageStatus($contentID,$status){
       $contentTypeObj = new ContentMessage();
   return $contentTypeObj->updateContentMessageStatusData($contentID, $status) ;
   }
   
    public static function updateApprovalStatus($contentID,$approvalFlage,$userId){
       $contentTypeObj = new ContentMessage();
       $result =  $contentTypeObj->updateApprovalStatusData($contentID, $approvalFlage,$userId) ;
       $contentTypeObj->close();
       return $result ;
   }
   
    public static function updateContentStatus($contentID,$status,$userId){
       $contentTypeObj = new ContentMessage();
       $result =  $contentTypeObj->updateContentStatusData($contentID, $status,$userId) ;
       $contentTypeObj->close();
       return $result ;
   }
   
   
   
   
    public static function checkIsContentMessageExistByDate($content, $date, $serviceId){
       $contentTypeObj = new ContentMessage();
       return $contentTypeObj->checkIsContentMessageExistByDateData($content, $date, $serviceId) ;
   }
   
      public static function getMaxOrderIdOfContentMessage($serviceId){
       $contentTypeObj = new ContentMessage();
       return $contentTypeObj->getMaxOrderIdOfContentMessageData($serviceId) ;
   }
  
   
}