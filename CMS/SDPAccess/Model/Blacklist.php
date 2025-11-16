<?php

class Blacklist extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
      
   
     public  function addBlacklistData($ip,$attemps){
      $blacklistId = 0  ;  
    try {
      $stmt = $this->connection->prepare("insert into blacklist(ip_address,attemps_count)"
              . " values(?,?)");
      
      $stmt->bind_param("si",$ip,$attemps);
      $stmt->execute();
      
       if($stmt->insert_id > 0){
          $blacklistId = $stmt->insert_id ;
      }else {
          General::writeEvent("addBlacklist error".$stmt->error);
       }
      $stmt->close();
      
    }catch(Exception $e) {
       General::writeEvent("addBlacklist error".$e->getMessage());
     }
    
    return $blacklistId ; 
    }
    
     public  function updateBlacklistData($attepms,$ip){
      $flage =  false  ;  
    try {
      $stmt = $this->connection->prepare("update blacklist SET attemps_count = ? ,creation_date = NOW() where ip_address = ? ");
      
      $stmt->bind_param("is",$attepms,$ip);
      $stmt->execute();
       
       if($stmt->errno == 0 && $stmt->affected_rows > 0){
          $flage = true;
      }else {
          General::writeEvent("updateBlacklistData error".$stmt->error);
       }
      $stmt->close();
      
    }catch(Exception $e) {
       General::writeEvent("updateBlacklistData error".$e->getMessage());
     }
    
    return $flage ; 
    }
    
     public  function getBlacklistInfoByIPData($ip){
        $row = null ;
    try {
      $stmt = $this->connection->prepare("select id, ip_address,"
              . "TIMESTAMPDIFF(MINUTE,creation_date,NOW()) as duration,attemps_count,creation_date from blacklist where ip_address = ? ");
      
      $stmt->bind_param("s",$ip);
      $stmt->execute();
        if($stmt->errno == 0 ){
           $result = $stmt->get_result();
          if($result->num_rows > 0){
         $row = $result->fetch_assoc() ; }
        }else {
          General::writeEvent("getBlacklistInfoByIP error".$stmt->error);
       }
      $stmt->close();
      
    }catch(Exception $e) {
       General::writeEvent("getBlacklistInfoByIP error".$e->getMessage());
     }
     return $row ; 
    }
    
    public  function deleteFromBlacklistData($ip){
      $flage =  false  ;  
    try {
      $stmt = $this->connection->prepare("DELETE FROM blacklist WHERE ip_address = ?");
      
      $stmt->bind_param("s",$ip);
      $stmt->execute();
       
       if($stmt->errno == 0 && $stmt->affected_rows > 0){
          $flage = true;
      }else {
          General::writeEvent("deleteFromBlacklistData error".$stmt->error);
       }
      $stmt->close();
      
    }catch(Exception $e) {
       General::writeEvent("deleteFromBlacklistData error".$e->getMessage());
     }
    
    return $flage ; 
    }
     
}
