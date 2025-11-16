<?php
class ServiceTypeControl extends ServiceType{
   
   public static function getServiceTypes(){
       $serviceTypeObj = new ServiceType();
   return $serviceTypeObj->getServiceTypesData();
   
   }
   
   public static function getAllServiceTypes(){
       $serviceTypeObj = new ServiceType();
   return $serviceTypeObj->getAllServiceTypesData();
   
   }
   
    public static function AddServiceType($name,$code,$userID){
       $serviceTypeObj = new ServiceType();
   return $serviceTypeObj->addServiceTypeData($name,$code,$userID) ;
   
   }
   
   public static function getServiceTypeInfoByNumber($code){
       $serviceTypeObj = new ServiceType();
   return $serviceTypeObj->getServiceTypeInfoByCodeData($code);
   
   }
   
}