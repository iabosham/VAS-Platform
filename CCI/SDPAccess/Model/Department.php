<?php

class Department extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
      
   
     public  function addDepartment($name,$isRegion){
      $flage = false  ;  
    try {
      $stmt = $this->connection->prepare("insert into department(name,is_region) values(?,?)");
      
      $stmt->bind_param("si",$name,$isRegion);
      $stmt->execute();
       if($stmt->errno == 0){
          $flage = true ;
      }else {
          General::writeEvent("addDepartment error".$stmt->error);
          $flage = false ;
      }
      $stmt->close();
      
    }catch(Exception $e) {
       General::writeEvent("addDepartment error".$e->getMessage());
      $flage = false ;
    }
    
    return $flage ; 
    }
     
}
