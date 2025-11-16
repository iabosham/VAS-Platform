<?php
class SubContentControl extends SubContent{
   
   public static function getSubContents($mainContentId){
       
        $contentTypeObj = new SubContent();
        return $contentTypeObj->getSubContentsData($mainContentId);
    }
   
  public static function AddSubContent($title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId){
        $contentTypeObj = new SubContent();
        return $contentTypeObj->addSubContentData($title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId) ;
   } 
   
   
    public static function getSubContentsByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new SubContent();
   return $contentTypeObj->getSubContentsByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
    public static function getSubscriberSubContents($msisdn,$vendorId,$serviceId){
       $contentTypeObj = new SubContent();
       $result =  $contentTypeObj->getSubscriberSubContentsData($msisdn,$vendorId,$serviceId);
       $contentTypeObj->close();
       
       return $result;
   
   }
   
    public static function getUnapprovedSubContentsByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new SubContent();
   return $contentTypeObj->getUnapprovedSubContentsByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
   public static function getSubContentInfoById($contentId){
       $contentTypeObj = new SubContent();
   return $contentTypeObj->getSubContentInfoByIdData($contentId);
   
   }
   
   public static function deleteSubContent($contentId){
       $contentTypeObj = new SubContent();
   return $contentTypeObj->deleteSubContentData($contentId);
   
   }
   
 
   public static function updateSubContent($title, $statusFlag,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId,$id){
       $contentTypeObj = new SubContent();
       $result = $contentTypeObj->updateSubContentData($title, $statusFlag,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId,$id) ;
       $contentTypeObj->close();
   return $result;
   }
   
     public static function updateSubContentStatus($contentID,$status){
       $contentTypeObj = new SubContent();
   return $contentTypeObj->updateSubContentStatusData($contentID, $status) ;
   }
   
    public static function updateContentExtraId($contentId,$id){
        
       $contentTypeObj = new SubContent();
       $result = $contentTypeObj->updateContentExtraIdData($contentId,$id) ;
       $contentTypeObj->close();
       
       return $result;
   }
   
    public static function checkIsSubContentExistByDate($content, $date, $serviceId){
       $contentTypeObj = new SubContent();
       return $contentTypeObj->checkIsSubContentExistByDateData($content, $date, $serviceId) ;
   }
   
      public static function getMaxOrderIdOfSubContent($serviceId){
       $contentTypeObj = new SubContent();
       return $contentTypeObj->getMaxOrderIdOfSubContentData($serviceId) ;
   }
  
   
}