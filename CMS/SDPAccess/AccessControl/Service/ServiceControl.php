<?php
class ServiceControl {
   
   public static function getServiceInfoById($serviceId){
       $serviceObj = new Service();
       $info = $serviceObj->getServiceInfoByIdData($serviceId);
       $serviceObj->connection->close();
 
       return $info ;
   
   }
   
   public static function getServicesByVendorID($vendorId){
       $serviceObj = new Service();
       $result = $serviceObj->ByVendorIdData($vendorId); 
       $serviceObj->close();
   return $result;
    }
   
     public static function updateServiceStatus($id, $status, $comment,$userID){
       $serviceObj = new Service();
       $result = $serviceObj->updateStatus($id, $status, $comment,$userID) ; 
       $serviceObj->close();
   return $result ;
   
   }
   
      public static function getServices(){
          
       $serviceObj = new Service();
       $result  = $serviceObj->getServicesData();
       $serviceObj->close();
       
   return $result ;
   
   }
   
   public static function getServicesByType($type){
          
       $serviceObj = new Service();
       $result  = $serviceObj->getServicesByTypeData($type);
       $serviceObj->close();
       
   return $result ;
   
   }
   
    public static function AddService($name, $serviceType, $serviceKey,$shortcodeID, $userID,$subMessage,$ubSubMessage,$senderName,$freeSource,$method,$subServiceId){
       
       $serviceObj = new Service();
       $result = $serviceObj->addServiceData($name, $serviceType, $serviceKey,$shortcodeID, $userID,$subMessage,$ubSubMessage,$senderName,$freeSource,$method,$subServiceId); 
       $serviceObj->close();
       
   return $result ;
   
   }
   
    public static function addKey($key,$serviceId,$type){
       $serviceObj = new Service();
       $result = $serviceObj->addKeyData($key,$serviceId,$type); 
       $serviceObj->close();
   return $result ;
   
   }
   
      public static function deleteServiceKeyById($id){
       $serviceObj = new Service();
       $result = $serviceObj->deleteServiceKeyByIdData($id); 
       $serviceObj->close();
       
   return $result ;
   
   }
   
       public static function getkeysByServiceId($id){
       $serviceObj = new Service();
       $result = $serviceObj->getkeysByServiceIdData($id); 
       $serviceObj->close();
       
   return $result ;
   
   }
   
   
   
   
   
   
   
    public static function updateService($id,$name, $serviceType, $serviceKey,$shortcodeID, $userID,$subMessage,$ubSubMessage,$senderName,$freeSource,$method){
       $serviceObj = new Service();
       $result = $serviceObj->updateServiceData($id,$name, $serviceType, $serviceKey,$shortcodeID, $userID,$subMessage,$ubSubMessage,$senderName,$freeSource,$method); 
       $serviceObj->close();
   return $result ;
   
   }
   
   public static function getServiceInfoByCode($code){
       $serviceObj = new Service();
       $result = $serviceObj->getServiceInfoByCodeData($code); 
       $serviceObj->close();
   return $result; 
   
   }
   
    public static function getServiceInfoByServiceKey($key,$shortcode){
       $serviceObj = new Service();
       $result = $serviceObj->getServiceInfoByServiceKeyData($key,$shortcode);
       $serviceObj->close();
   return $result ;
    }
   
   
    
   public static function getServiceKeyInfo($key,$shortcode){
       $serviceObj = new Service();
       $result = $serviceObj->getServiceKeyInfoData($key,$shortcode);
       $serviceObj->close();
   return $result ;
   
   }
   
    public static function getServiceKeyInfoBykey($serviceId,$key){
       $serviceObj = new Service();
       $result = $serviceObj->getServiceKeyInfoBykeyData($serviceId,$key);
       $serviceObj->close();
   return $result ;
   
   }
   
       public static function updateServiceKey($keyId,$serviceKey) {
       $serviceObj = new Service();
       $result = $serviceObj->updateServiceKeyData($keyId,$serviceKey) ;
       $serviceObj->close();
   return $result ;
   
   }
   
   
}