<?php
class ShortcodeControl extends Shortcode{
 
     public static function getShortcodes($companyId){
       $shortcodeObj = new Shortcode();
   return $shortcodeObj->getShortcodesData($companyId);
   
   }
   
    public static function getShortcodesByVendorId($vendorID){
       $shortcodeObj = new Shortcode();
   return $shortcodeObj->getShortcodesByVendorIdData($vendorID);
   
   }
   
    public static function AddShortcode($title,$code, $vendorID, $userID,$companyId){
       $shortcodeObj = new Shortcode();
   return $shortcodeObj->addShortcodeData($title,$code, $vendorID, $userID,$companyId) ;
   
   }
   
   public static function getShortcodeInfoByNumber($number){
       $shortcodeObj = new Shortcode();
   return $shortcodeObj->getShortcodeInfoByNumberData($number);
   
   }
   
     public static function getShortcodeInfoById($id){
       $shortcodeObj = new Shortcode();
   return $shortcodeObj->getShortcodeInfoByIdData($id);
   
   }
   
}