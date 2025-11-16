<?php
class ContentControl extends Content{
   
   public static function getContents(){
       
        $contentTypeObj = new Content();
        return $contentTypeObj->getContentsData();
    }
    
    
      public static function getContentsByClientId($clientId){
       
        $contentTypeObj = new Content();
        return $contentTypeObj->getContentsByClientIdData($clientId);
    }
    
    
   
  public static function AddContent($title,$status){
        $contentTypeObj = new Content();
        return $contentTypeObj->addContentData($title,$status) ;
   } 
   
   
    public static function getContentsByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new Content();
   return $contentTypeObj->getContentsByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
    public static function getSubscriberContents($msisdn,$vendorId,$serviceId){
       $contentTypeObj = new Content();
       $result =  $contentTypeObj->getSubscriberContentsData($msisdn,$vendorId,$serviceId);
       $contentTypeObj->close();
       
       return $result;
   
   }
   
    public static function getUnapprovedContentsByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new Content();
   return $contentTypeObj->getUnapprovedContentsByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
   public static function getContentInfoById($contentId){
       $contentTypeObj = new Content();
   return $contentTypeObj->getContentInfoByIdData($contentId);
   
   }
   
   public static function deleteContent($contentId){
       $contentTypeObj = new Content();
   return $contentTypeObj->deleteContentData($contentId);
   
   }
   
 
   public static function updateContent($title, $statusFlag,$id){
       $contentTypeObj = new Content();
       $result = $contentTypeObj->updateContentData($title, $statusFlag,$id) ;
       $contentTypeObj->close();
   return $result;
   }
   
     public static function updateContentStatus($contentID,$status){
       $contentTypeObj = new Content();
   return $contentTypeObj->updateContentStatusData($contentID, $status) ;
   }
   
    public static function updateApprovalStatus($contentID,$approvalFlage){
       $contentTypeObj = new Content();
   return $contentTypeObj->updateApprovalStatusData($contentID, $approvalFlage) ;
   }
   
    public static function checkIsContentExistByDate($content, $date, $serviceId){
       $contentTypeObj = new Content();
       return $contentTypeObj->checkIsContentExistByDateData($content, $date, $serviceId) ;
   }
   
      public static function getMaxOrderIdOfContent($serviceId){
       $contentTypeObj = new Content();
       return $contentTypeObj->getMaxOrderIdOfContentData($serviceId) ;
   }
  
   
}