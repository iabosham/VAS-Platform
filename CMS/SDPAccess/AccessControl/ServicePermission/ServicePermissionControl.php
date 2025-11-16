<?php
class ServicePermissionControl extends ServicePermission{
   
   public static function getServicePermissions(){
       
        $contentTypeObj = new ServicePermission();
        return $contentTypeObj->getServicePermissionsData();
    }
   
  public static function AddServicePermission($subServiceId,$providerId){
        $contentTypeObj = new ServicePermission();
        $result =  $contentTypeObj->addServicePermissionData($subServiceId,$providerId) ;
        $contentTypeObj->close();
        return $result ;
   } 
   
   
    public static function getLastServicePermissions(){
       $contentTypeObj = new ServicePermission();
       $result =  $contentTypeObj->getLastServicePermissionsData();
       $contentTypeObj->close(); 
       return $result ;
   
   }  
   
   public static function getServicePermissionsByProviderId($providerId){
       $contentTypeObj = new ServicePermission();
       $result =  $contentTypeObj->getServicePermissionsByProviderIdData($providerId);
       $contentTypeObj->close(); 
       return $result ;
   
   }
   
   
   
   
   
    public static function getSubscriberServicePermissions($msisdn,$vendorId,$serviceId){
       $contentTypeObj = new ServicePermission();
       $result =  $contentTypeObj->getSubscriberServicePermissionsData($msisdn,$vendorId,$serviceId);
       $contentTypeObj->close();
       
       return $result;
   
   }
   
    public static function getUnapprovedServicePermissionsByVendor($vendorID, $fromDate, $toDate){
       $contentTypeObj = new ServicePermission();
   return $contentTypeObj->getUnapprovedServicePermissionsByVendorData($vendorID, $fromDate, $toDate);
   
   }
   
   public static function getServicePermissionInfo($subServiceId, $providerId){
       $contentTypeObj = new ServicePermission();
        $result=  $contentTypeObj->getServicePermissionInfoData($subServiceId, $providerId);
        $contentTypeObj->close();
        return  $result;
   
   }
   
   public static function deleteServicePermission($contentId){
       $contentTypeObj = new ServicePermission();
   return $contentTypeObj->deleteServicePermissionData($contentId);
   
   }
   
 
   public static function updateServicePermission($title, $statusFlag,$id){
       $contentTypeObj = new ServicePermission();
       $result = $contentTypeObj->updateServicePermissionData($title, $statusFlag,$id) ;
       $contentTypeObj->close();
   return $result;
   }
   
     public static function updateServicePermissionStatus($contentID,$status){
       $contentTypeObj = new ServicePermission();
   return $contentTypeObj->updateServicePermissionStatusData($contentID, $status) ;
   }
   
    public static function updateApprovalStatus($contentID,$approvalFlage){
       $contentTypeObj = new ServicePermission();
   return $contentTypeObj->updateApprovalStatusData($contentID, $approvalFlage) ;
   }
   
    public static function checkIsServicePermissionExistByDate($content, $date, $serviceId){
       $contentTypeObj = new ServicePermission();
       return $contentTypeObj->checkIsServicePermissionExistByDateData($content, $date, $serviceId) ;
   }
   
      public static function getMaxOrderIdOfServicePermission($serviceId){
       $contentTypeObj = new ServicePermission();
       return $contentTypeObj->getMaxOrderIdOfServicePermissionData($serviceId) ;
   }
  
   
}