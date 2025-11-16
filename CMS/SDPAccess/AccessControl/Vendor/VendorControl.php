<?php
class VendorControl extends Vendor{
   
   public static function getVendors(){
       $vendorObj = new Vendor();
      return $vendorObj->getVendorsData();
   
   }
   
    public static function AddVendor($name, $status, $address, $phone,$email, $desc,$userID){
       $vendorObj = new Vendor();
       $result= $vendorObj->addVendorData($name, $status, $address, $phone,$email, $desc,$userID);
       $vendorObj->close();
       return $result ; 
   
   }
   
   
   public static function getVendorInfoByID($vendorID){
       $vendorObj = new Vendor();
      return $vendorObj->getVendorInfoData($vendorID);
   
   }
   
      public static function updateVendor($id, $name, $address,$phone,$email,$desc){
       $contentTypeObj = new Vendor();
       $result = $contentTypeObj->updateVendorData($id, $name, $address,$phone,$email,$desc) ;
       $contentTypeObj->close();
   return $result;
   }
   
}