<?php
class BlacklistControl extends Blacklist{
   
   public static function getBlacklistInfoByIP($ip){
       $blacklistObj = new Blacklist();
   return $blacklistObj->getBlacklistInfoByIPData($ip);
   
   }
   
 
   
   public static function deleteFromBlacklist($ip){
       $blacklistObj = new Blacklist();
   return $blacklistObj->deleteFromBlacklistData($ip);
   
   }
   
    public static function AddBlacklist($ip, $attemps){
       $blacklistObj = new Blacklist();
   return $blacklistObj->addBlacklistData($ip, $attemps);
   }
   
     public static function updateBlacklist($attepms, $ip){
       $blacklistObj = new Blacklist();
   return $blacklistObj->updateBlacklistData($attepms, $ip);
   }
  
   
}