<?php

class ReSendConfig extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
      
      public  function addReSendConfigData($serviceID,$attemp,$time){
      
      $isAdded = false  ;
      try {
          
        $stmt = $this->connection->prepare("insert into resend_message_config(service_id,attemp_number,send_time) "
              . " values(?,?,?)")   ;
       
        $stmt->bind_param("iis",$serviceID,$attemp,$time) ;
        
        $stmt->execute();
       if($stmt->insert_id > 0){
            $isAdded = true ;
       }else {
          General::addError($stmt->error);
          General::writeEvent("addReSendConfigData error".$stmt->error);
       }
        $stmt->close();
        }catch(Exception $e) {
       General::writeEvent("addReSendConfigData ... error".$e->getMessage());
     }
      
        return $isAdded ;
      }
       
   
      
        public  function removeReSendConfig($id){
           $rem_qry = "delete from resend_message_config where id = $id   " ;
           
            if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("removeReSendConfig-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
    
      
       public  function getReSendConfigData($serviceID,$attemp){
         
      $qry = "select * from resend_message_config where service_id = $serviceID and attemp_number = $attemp " ;
      
      $result = $this->connection->query($qry);
      
       
      $row = null ;
      if($result != null){
       if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
         
         } 
         }  
        return $row ;
       
      }
      
      public  function getReSendConfigsData($serviceId){
      $qry = "select * from resend_message_config where service_id = $serviceId  order by attemp_number  " ;
      
      $result = $this->connection->query($qry);
       $table = array();
      if ($result !=null && $result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
         }
        }  
          return $table ;
       
      }
       
    
}
